/**
 * Scroll to Top Module
 *
 * Shows the scroll-to-top button after scrolling past a threshold
 * and smooth-scrolls back to the top on click.
 */

const SCROLL_THRESHOLD = 300;

export class ScrollToTop {
	private button: HTMLElement | null;

	constructor() {
		this.button = document.getElementById("scroll-to-top");

		if (!this.button) {
			return;
		}

		this.init();
	}

	private init(): void {
		window.addEventListener("scroll", () => this.toggleVisibility(), {
			passive: true,
		});
		this.button!.addEventListener("click", () => this.scrollToTop());
		this.toggleVisibility();
	}

	private toggleVisibility(): void {
		if (window.scrollY > SCROLL_THRESHOLD) {
			this.button!.classList.add("is-visible");
		} else {
			this.button!.classList.remove("is-visible");
		}
	}

	private scrollToTop(): void {
		window.scrollTo({ top: 0, behavior: "smooth" });
	}
}

export function initializeScrollToTop(): void {
	new ScrollToTop();
}
