/**
 * Blog Archive Module
 *
 * Server-driven search, category filtering and pagination for the blog
 * archive. Every interaction queries the Blog_Posts AJAX endpoint:
 *  - search input (debounced) and filter buttons replace the grid with page 1
 *  - "Load More" appends the next page for the active search/filter
 * In-flight requests are aborted when a newer one starts, so a fast typer
 * never sees stale results. The featured post is rendered server-side and
 * excluded from grid queries via the section's data-exclude attribute.
 */

const SEARCH_DEBOUNCE_MS = 300;
const SKELETON_COUNT = 3;
// Keep skeletons on screen at least this long — an instant flash looks broken.
const MIN_SKELETON_MS = 400;
const CARD_STAGGER_MS = 80;

interface FilterResponse {
	success: boolean;
	data: {
		html: string;
		hasMore: boolean;
		found: number;
	};
}

export class BlogArchive {
	private root: HTMLElement;
	private grid: HTMLElement;
	private filters: HTMLButtonElement[];
	private searchInput: HTMLInputElement | null;
	private loadMore: HTMLButtonElement | null;
	private empty: HTMLElement | null;

	private search = "";
	private category = "";
	private page = 1;
	private excludeId: string;
	private debounceTimer: number | undefined;
	private controller: AbortController | null = null;
	private filterToggle: HTMLButtonElement | null;
	private filtersPanel: HTMLElement | null;
	private filtersBackdrop: HTMLElement | null;

	constructor(root: HTMLElement, grid: HTMLElement) {
		this.root = root;
		this.grid = grid;
		this.filters = Array.from(root.querySelectorAll<HTMLButtonElement>(".blog-archive__filter"));
		this.searchInput = root.querySelector<HTMLInputElement>(".blog-archive__search-input");
		this.loadMore = root.querySelector<HTMLButtonElement>(".blog-archive__load-more");
		this.empty = root.querySelector<HTMLElement>(".blog-archive__empty");
		this.filterToggle = root.querySelector<HTMLButtonElement>(".blog-archive__filter-toggle");
		this.filtersPanel = root.querySelector<HTMLElement>(".blog-archive__filters");
		this.filtersBackdrop = root.querySelector<HTMLElement>(".blog-archive__filters-backdrop");
		this.excludeId = root.dataset.exclude || "0";

		this.bind();
	}

	private setFiltersPopup(open: boolean): void {
		this.filtersPanel?.classList.toggle("is-open", open);
		this.filtersBackdrop?.classList.toggle("is-open", open);
		this.filterToggle?.setAttribute("aria-expanded", open ? "true" : "false");
		document.body.classList.toggle("filters-popup-open", open);
	}

	private bind(): void {
		this.filterToggle?.addEventListener("click", () => {
			this.setFiltersPopup(!this.filtersPanel?.classList.contains("is-open"));
		});

		this.filtersBackdrop?.addEventListener("click", () => this.setFiltersPopup(false));

		document.addEventListener("keydown", (e: KeyboardEvent) => {
			if (e.key === "Escape") {
				this.setFiltersPopup(false);
			}
		});

		this.filters.forEach((button) => {
			button.addEventListener("click", () => {
				this.category = button.dataset.filter || "";

				this.filters.forEach((b) => {
					b.classList.toggle("is-active", b === button);
				});

				this.setFiltersPopup(false);

				void this.fetchPosts(1, false);
			});
		});

		this.searchInput?.addEventListener("input", () => {
			window.clearTimeout(this.debounceTimer);

			this.debounceTimer = window.setTimeout(() => {
				const value = (this.searchInput?.value || "").trim();

				if (value === this.search) {
					return;
				}

				this.search = value;
				void this.fetchPosts(1, false);
			}, SEARCH_DEBOUNCE_MS);
		});

		this.loadMore?.addEventListener("click", () => {
			void this.fetchPosts(this.page + 1, true);
		});
	}

	private skeletonMarkup(): string {
		const card = `
			<div class="card-elegant blog-archive__skeleton" aria-hidden="true">
				<div class="blog-archive__skeleton-thumb"></div>
				<div class="blog-archive__skeleton-line blog-archive__skeleton-line--sm"></div>
				<div class="blog-archive__skeleton-line blog-archive__skeleton-line--lg"></div>
				<div class="blog-archive__skeleton-line"></div>
			</div>`;

		return card.repeat(SKELETON_COUNT);
	}

	private revealNewCards(startIndex: number): void {
		const cards = Array.from(this.grid.children) as HTMLElement[];

		cards.slice(startIndex).forEach((card, index) => {
			card.classList.add("is-entering");
			card.style.animationDelay = `${index * CARD_STAGGER_MS}ms`;
		});
	}

	private async fetchPosts(page: number, append: boolean): Promise<void> {
		this.controller?.abort();

		const controller = new AbortController();
		this.controller = controller;
		const startedAt = Date.now();

		this.root.classList.add("is-loading");

		if (this.loadMore) {
			this.loadMore.disabled = true;
		}

		const existingCount = append ? this.grid.children.length : 0;

		if (!append) {
			this.empty?.setAttribute("hidden", "");
			this.grid.innerHTML = this.skeletonMarkup();

			if (this.loadMore) {
				this.loadMore.hidden = true;
			}
		}

		const body = new URLSearchParams();
		body.set("action", "martincv_filter_blog_posts");
		body.set("nonce", window.martincvBlog.nonce);
		body.set("search", this.search);
		body.set("category", this.category);
		body.set("page", String(page));
		body.set("exclude", this.excludeId);

		try {
			const response = await fetch(window.martincvBlog.ajaxUrl, {
				method: "POST",
				credentials: "same-origin",
				body,
				signal: controller.signal,
			});

			const result: FilterResponse = await response.json();

			if (!result.success) {
				return;
			}

			if (!append) {
				const remaining = MIN_SKELETON_MS - (Date.now() - startedAt);

				if (remaining > 0) {
					await new Promise((resolve) => window.setTimeout(resolve, remaining));
				}

				// A newer request may have taken over while we let the skeletons breathe.
				if (this.controller !== controller) {
					return;
				}
			}

			this.page = page;

			if (append) {
				this.grid.insertAdjacentHTML("beforeend", result.data.html);
			} else {
				this.grid.innerHTML = result.data.html;
			}

			this.revealNewCards(existingCount);

			if (this.loadMore) {
				this.loadMore.hidden = !result.data.hasMore;
			}

			if (this.empty) {
				this.empty.hidden = result.data.found > 0;
			}
		} catch (error) {
			// Aborted requests mean a newer one took over; anything else
			// should not leave skeletons behind.
			if (this.controller === controller && !append) {
				this.grid.innerHTML = "";
				this.empty?.removeAttribute("hidden");
			}
		} finally {
			// Only the latest request may clear the loading state.
			if (this.controller === controller) {
				this.root.classList.remove("is-loading");

				if (this.loadMore) {
					this.loadMore.disabled = false;
				}
			}
		}
	}
}

export function initializeBlogArchive(): void {
	const root = document.querySelector<HTMLElement>(".blog-archive");
	const grid = root?.querySelector<HTMLElement>(".blog-archive__grid");

	if (root && grid) {
		new BlogArchive(root, grid);
	}
}
