/**
 * Smooth Scroll Module
 *
 * Handles smooth animated scrolling for anchor links,
 * accounting for the fixed header height.
 */

export class SmoothScroll {
	private headerOffset: number;

	constructor() {
		this.headerOffset = 80;
		this.init();
	}

	private init(): void {
		document.addEventListener("click", (e: Event) => {
			const target = e.target as HTMLElement;
			const link = target.closest('a[href*="#"]') as HTMLAnchorElement | null;

			if (!link) return;

			const href = link.getAttribute("href");
			if (!href) return;

			// Handle both "/#section" and "#section" formats.
			const hash = href.includes("#") ? `#${href.split("#")[1]}` : null;
			if (!hash || hash === "#") return;

			const section = document.querySelector(hash) as HTMLElement | null;
			if (!section) return;

			e.preventDefault();

			const header = document.querySelector(
				"header.site-header",
			) as HTMLElement | null;
			this.headerOffset = header ? header.offsetHeight + 20 : 80;

			const top =
				section.getBoundingClientRect().top +
				window.scrollY -
				this.headerOffset;

			window.scrollTo({ top, behavior: "smooth" });

			// Update URL hash without jumping.
			history.pushState(null, "", hash);
		});
	}
}

export function initializeSmoothScroll(): void {
	new SmoothScroll();
}
