import "./style.scss";

// Accordion: one item open at a time, animated via max-height.
document.addEventListener("DOMContentLoaded", function () {
	document.querySelectorAll(".faq-block__item").forEach(function (item) {
		const button = item.querySelector(".faq-block__question");
		const answer = item.querySelector(".faq-block__answer");

		if (!button || !answer) {
			return;
		}

		button.addEventListener("click", function () {
			const isOpen = item.classList.contains("is-open");

			// Close siblings.
			const list = item.closest(".faq-block__list");
			if (list) {
				list.querySelectorAll(".faq-block__item.is-open").forEach(function (open) {
					open.classList.remove("is-open");
					open.querySelector(".faq-block__question").setAttribute("aria-expanded", "false");
					open.querySelector(".faq-block__answer").style.maxHeight = "";
				});
			}

			if (!isOpen) {
				item.classList.add("is-open");
				button.setAttribute("aria-expanded", "true");
				answer.style.maxHeight = answer.scrollHeight + "px";
			}
		});
	});
});
