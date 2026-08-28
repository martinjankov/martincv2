import "./scss/archive-project.scss";

// Category filter: buttons toggle project cards via data-categories.
document.addEventListener("DOMContentLoaded", function () {
	const filters = document.querySelectorAll(".projects-archive__filter");
	const cards = document.querySelectorAll("[data-categories]");

	if (!filters.length || !cards.length) {
		return;
	}

	filters.forEach(function (button) {
		button.addEventListener("click", function () {
			const filter = button.dataset.filter;

			filters.forEach(function (b) {
				b.classList.toggle("is-active", b === button);
			});

			cards.forEach(function (card) {
				const categories = (card.dataset.categories || "").split(" ");
				const show = filter === "all" || categories.indexOf(filter) !== -1;
				card.classList.toggle("is-hidden", !show);
			});
		});
	});
});
