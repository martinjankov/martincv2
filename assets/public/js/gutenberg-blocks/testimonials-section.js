document.addEventListener("DOMContentLoaded", () => {
	let interval;

	const slider = document.querySelector(".martincv-testimonials__wrapper");
	const testimonials = Array.from(
		document.querySelectorAll(".martincv-testimonials__testimonial")
	);
	const leftButton = document.querySelector(
		".martincv-testimonials--slider__left"
	);
	const rightButton = document.querySelector(
		".martincv-testimonials--slider__right"
	);

	let currentSlideIndex = 0;

	const updateSlides = () => {
		testimonials.forEach((testimonial, index) => {
			testimonial.style.left = index === currentSlideIndex ? 0 : "100%";
		});
	};

	updateSlides();

	if (leftButton) {
		leftButton.addEventListener("click", () => {
			currentSlideIndex =
				(currentSlideIndex + testimonials.length - 1) % testimonials.length;
			updateSlides();
			clearInterval(interval);
		});
	}

	if (rightButton) {
		rightButton.addEventListener("click", () => {
			currentSlideIndex = (currentSlideIndex + 1) % testimonials.length;
			updateSlides();
			clearInterval(interval);
		});
	}

	const startX = 0;
	let currentX = 0;
	let isSwiping = false;

	if (slider) {
		slider.addEventListener("touchstart", (e) => {
			startX = e.touches[0].pageX;
			isSwiping = true;
		});

		slider.addEventListener("touchmove", (e) => {
			if (!isSwiping) return;
			currentX = e.touches[0].pageX - startX;
		});

		slider.addEventListener("touchend", (e) => {
			isSwiping = false;
			if (currentX < -50) {
				currentSlideIndex = (currentSlideIndex + 1) % testimonials.length;
			} else if (currentX > 50) {
				currentSlideIndex =
					(currentSlideIndex + testimonials.length - 1) % testimonials.length;
			}
			updateSlides();
		});
	}

	interval = setInterval(() => {
		currentSlideIndex = (currentSlideIndex + 1) % testimonials.length;
		updateSlides();
	}, 5000);
});
