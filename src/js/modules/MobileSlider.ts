/**
 * Mobile Slider Module
 *
 * Turns a horizontally scroll-snapping container into a dot-navigated
 * slider on mobile. The scrolling itself is native CSS scroll-snap —
 * this module only renders the dots and keeps them in sync.
 */

const MOBILE_QUERY = "(max-width: 767px)";

interface SliderDefinition {
	scroller: string;
	slide: string;
}

const SLIDERS: SliderDefinition[] = [
	{ scroller: ".services-block__grid", slide: ".services-block__card" },
	{ scroller: ".testimonials-block__viewport", slide: ".testimonials-block__slide" },
];

class MobileSlider {
	private scroller: HTMLElement;
	private slides: HTMLElement[];
	private dots: HTMLButtonElement[] = [];

	constructor(scroller: HTMLElement, slides: HTMLElement[]) {
		this.scroller = scroller;
		this.slides = slides;

		this.renderDots();
		this.scroller.addEventListener("scroll", () => this.syncActiveDot(), {
			passive: true,
		});
		this.syncActiveDot();
	}

	private renderDots(): void {
		const wrap = document.createElement("div");
		wrap.className = "mobile-slider__dots";
		wrap.setAttribute("role", "tablist");

		this.slides.forEach((slide, i) => {
			const dot = document.createElement("button");
			dot.type = "button";
			dot.className = "mobile-slider__dot";
			dot.setAttribute("aria-label", `Slide ${i + 1}`);
			dot.addEventListener("click", () => {
				this.scroller.scrollTo({
					left: slide.offsetLeft - this.slides[0].offsetLeft,
					behavior: "smooth",
				});
			});
			wrap.appendChild(dot);
			this.dots.push(dot);
		});

		this.scroller.insertAdjacentElement("afterend", wrap);
	}

	private syncActiveDot(): void {
		const base = this.slides[0].offsetLeft;
		const position = this.scroller.scrollLeft;
		let active = 0;
		let closest = Infinity;

		this.slides.forEach((slide, i) => {
			const distance = Math.abs(slide.offsetLeft - base - position);
			if (distance < closest) {
				closest = distance;
				active = i;
			}
		});

		this.dots.forEach((dot, i) => {
			dot.classList.toggle("is-active", i === active);
		});
	}
}

export function initializeMobileSliders(): void {
	if (!window.matchMedia(MOBILE_QUERY).matches) {
		return;
	}

	SLIDERS.forEach(({ scroller, slide }) => {
		document.querySelectorAll<HTMLElement>(scroller).forEach((el) => {
			const slides = Array.from(el.querySelectorAll<HTMLElement>(slide));
			if (slides.length > 1) {
				new MobileSlider(el, slides);
			}
		});
	});
}
