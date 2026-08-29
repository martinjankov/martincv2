/**
 * Lightbox Module
 *
 * Opens content images in a fullscreen modal. Adjacent images (a gallery
 * block, or consecutive image blocks) form one group that can be paged
 * through with arrows, counter and keyboard.
 */

interface LightboxImage {
	src: string;
	caption: string;
}

const ICONS = {
	close:
		'<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg>',
	prev:
		'<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m12 19-7-7 7-7"></path><path d="M19 12H5"></path></svg>',
	next:
		'<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>',
};

/** Largest candidate from srcset (or the plain src), skipping placeholders. */
function fullSizeSrc(img: HTMLImageElement): string {
	const srcset = img.getAttribute("srcset") || img.getAttribute("data-lazy-srcset") || "";
	let best = "";
	let bestWidth = 0;

	srcset.split(",").forEach((candidate) => {
		const parts = candidate.trim().split(/\s+/);
		const width = parseInt(parts[1] || "0", 10);
		if (parts[0] && width > bestWidth) {
			bestWidth = width;
			best = parts[0];
		}
	});

	if (best) {
		return best;
	}

	const src = img.currentSrc || img.src;
	if (src && !src.startsWith("data:")) {
		return src;
	}

	return img.getAttribute("data-lazy-src") || src;
}

function captionFor(img: HTMLImageElement): string {
	const figure = img.closest("figure");
	const figcaption = figure?.querySelector("figcaption");
	return figcaption?.textContent?.trim() || img.alt || "";
}

class Lightbox {
	private overlay!: HTMLElement;
	private image!: HTMLImageElement;
	private caption!: HTMLElement;
	private counter!: HTMLElement;
	private prev!: HTMLButtonElement;
	private next!: HTMLButtonElement;

	private group: LightboxImage[] = [];
	private index = 0;

	constructor() {
		this.build();
	}

	private build(): void {
		this.overlay = document.createElement("div");
		this.overlay.className = "mcv-lightbox";
		this.overlay.hidden = true;
		this.overlay.innerHTML = `
			<div class="mcv-lightbox__backdrop" data-lightbox-close></div>
			<figure class="mcv-lightbox__figure">
				<img class="mcv-lightbox__img" alt="">
				<figcaption class="mcv-lightbox__caption"></figcaption>
			</figure>
			<button type="button" class="mcv-lightbox__close" data-lightbox-close aria-label="Close">${ICONS.close}</button>
			<button type="button" class="mcv-lightbox__nav mcv-lightbox__nav--prev" aria-label="Previous image">${ICONS.prev}</button>
			<button type="button" class="mcv-lightbox__nav mcv-lightbox__nav--next" aria-label="Next image">${ICONS.next}</button>
			<div class="mcv-lightbox__counter"></div>
		`;
		document.body.appendChild(this.overlay);

		this.image = this.overlay.querySelector(".mcv-lightbox__img") as HTMLImageElement;
		this.caption = this.overlay.querySelector(".mcv-lightbox__caption") as HTMLElement;
		this.counter = this.overlay.querySelector(".mcv-lightbox__counter") as HTMLElement;
		this.prev = this.overlay.querySelector(".mcv-lightbox__nav--prev") as HTMLButtonElement;
		this.next = this.overlay.querySelector(".mcv-lightbox__nav--next") as HTMLButtonElement;

		this.overlay.querySelectorAll("[data-lightbox-close]").forEach((el) => {
			el.addEventListener("click", () => this.close());
		});
		this.prev.addEventListener("click", () => this.step(-1));
		this.next.addEventListener("click", () => this.step(1));

		document.addEventListener("keydown", (e: KeyboardEvent) => {
			if (this.overlay.hidden) {
				return;
			}
			if (e.key === "Escape") {
				this.close();
			} else if (e.key === "ArrowLeft") {
				this.step(-1);
			} else if (e.key === "ArrowRight") {
				this.step(1);
			}
		});
	}

	open(group: LightboxImage[], index: number): void {
		this.group = group;
		this.index = index;
		this.overlay.hidden = false;
		document.body.classList.add("lightbox-open");
		this.render();
	}

	private close(): void {
		this.overlay.hidden = true;
		this.image.src = "";
		document.body.classList.remove("lightbox-open");
	}

	private step(delta: number): void {
		const count = this.group.length;
		this.index = (this.index + delta + count) % count;
		this.render();
	}

	private render(): void {
		const current = this.group[this.index];
		this.image.src = current.src;
		this.caption.textContent = current.caption;
		this.caption.hidden = !current.caption;

		const multiple = this.group.length > 1;
		this.prev.hidden = !multiple;
		this.next.hidden = !multiple;
		this.counter.hidden = !multiple;
		this.counter.textContent = `${this.index + 1} / ${this.group.length}`;
	}
}

/** True when an element renders one or more content images. */
function holdsImages(el: Element): boolean {
	return el.matches("figure, img") || el.classList.contains("wp-block-gallery")
		? null !== el.querySelector("img") || el.matches("img")
		: false;
}

/**
 * Cluster the container's direct children: consecutive image-bearing
 * blocks merge into one slidable group; anything else breaks the chain.
 */
function collectGroups(root: HTMLElement): HTMLImageElement[][] {
	const clusters: HTMLImageElement[][] = [];
	let current: HTMLImageElement[] = [];

	Array.from(root.children).forEach((child) => {
		if (holdsImages(child)) {
			const imgs = child.matches("img")
				? [child as HTMLImageElement]
				: Array.from(child.querySelectorAll<HTMLImageElement>("img"));
			current.push(...imgs);
		} else if (current.length) {
			clusters.push(current);
			current = [];
		}
	});

	if (current.length) {
		clusters.push(current);
	}

	return clusters;
}

export function initializeLightbox(rootSelector: string): void {
	const root = document.querySelector<HTMLElement>(rootSelector);
	if (!root) {
		return;
	}

	const clusters = collectGroups(root);
	if (!clusters.length) {
		return;
	}

	const lightbox = new Lightbox();

	clusters.forEach((imgs) => {
		const group: LightboxImage[] = imgs.map((img) => ({
			src: fullSizeSrc(img),
			caption: captionFor(img),
		}));

		imgs.forEach((img, i) => {
			img.classList.add("mcv-zoomable");
			img.addEventListener("click", (e: Event) => {
				e.preventDefault();
				lightbox.open(group, i);
			});
		});
	});
}
