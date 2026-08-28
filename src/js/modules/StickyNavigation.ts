/**
 * Sticky Navigation Module
 *
 * Adds a scrolled class to the header after scrolling past a threshold.
 * This triggers the transparent → solid background transition.
 */

const SCROLL_THRESHOLD = 50;

export class StickyNavigation {
	private header: HTMLElement | null;

	constructor() {
		this.header = document.querySelector("header.site-header");

		if (!this.header) {
			return;
		}

		this.init();
	}

	private init(): void {
		this.checkScroll();

		window.addEventListener("scroll", () => this.checkScroll(), {
			passive: true,
		});
	}

	private checkScroll(): void {
		if (!this.header) return;

		if (window.scrollY > SCROLL_THRESHOLD) {
			this.header.classList.add("site-header--scrolled");
		} else {
			this.header.classList.remove("site-header--scrolled");
		}
	}
}

/**
 * Initialize Sticky Navigation
 */
export function initializeStickyNavigation(): void {
	new StickyNavigation();
}
