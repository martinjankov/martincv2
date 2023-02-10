(function ($) {
	$(function () {
		$(".martincv-mobile-nav").on("click", function () {
			$(".martincv-header__wrapper").toggleClass("menu-open");
			$("header nav").slideToggle();
		});

		const heroHeight = $(".martincv-hero").outerHeight();

		if ($("body.home").length || $("body.single-post").length) {
			$(window).on("scroll", function () {
				if (window.outerWidth < 540) {
					if (scrollY > 10) {
						$("body > header").css({ background: "#191919" });
					} else {
						$("body > header").css({ background: "transparent" });
					}
				} else {
					if (scrollY > heroHeight) {
						$("body > header").css({ background: "#191919" });
					} else {
						$("body > header").css({ background: "transparent" });
					}
				}
			});
		}
	});
})(jQuery);
