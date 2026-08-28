import "./style.scss";

// Simple carousel: translate the track by slide width, one slide per step.
document.addEventListener("DOMContentLoaded", function () {
	document.querySelectorAll(".testimonials-block__carousel").forEach(function (carousel) {
		const track = carousel.querySelector(".testimonials-block__track");
		const slides = carousel.querySelectorAll(".testimonials-block__slide");
		const prev = carousel.querySelector(".testimonials-block__nav--prev");
		const next = carousel.querySelector(".testimonials-block__nav--next");

		if (!track || slides.length === 0) {
			return;
		}

		let index = 0;

		const perView = function () {
			return window.matchMedia("(min-width: 768px)").matches ? 2 : 1;
		};

		const maxIndex = function () {
			return Math.max(0, slides.length - perView());
		};

		const update = function () {
			index = Math.min(index, maxIndex());
			const offset = slides[index] ? slides[index].offsetLeft - slides[0].offsetLeft : 0;
			track.style.transform = "translateX(-" + offset + "px)";

			if (prev) {
				prev.disabled = index <= 0;
			}
			if (next) {
				next.disabled = index >= maxIndex();
			}
		};

		if (prev) {
			prev.addEventListener("click", function () {
				index = Math.max(0, index - 1);
				update();
			});
		}

		if (next) {
			next.addEventListener("click", function () {
				index = Math.min(maxIndex(), index + 1);
				update();
			});
		}

		window.addEventListener("resize", update, { passive: true });
		update();
	});
});
