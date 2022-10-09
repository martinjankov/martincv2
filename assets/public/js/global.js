(function ($) {
	$(function () {
		$(".martincv-mobile-nav").on("click", function () {
			$(".martincv-header__wrapper").toggleClass("menu-open");
			$("header nav").slideToggle();
		});
	});
})(jQuery);
