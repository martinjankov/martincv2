(function ($) {
	$(function () {
		const $portfolioFilters = $(".martincv-portfolio ul li.filter");
		const $projectsList = $(
			".martincv-portfolio .martincv-portfolio__projects"
		);

		$portfolioFilters.on("click", function () {
			$portfolioFilters.removeClass("active");
			$(this).addClass("active");

			$projectsList.find(".martincv-portfolio__item").hide();

			if ($(this).data("filter") === "all") {
				$projectsList.find(".martincv-portfolio__item").show();
			} else {
				$projectsList
					.find(".martincv-portfolio__item." + $(this).data("filter"))
					.show();
			}
		});
	});
})(jQuery);
