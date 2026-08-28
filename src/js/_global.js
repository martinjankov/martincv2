import { initializeStickyNavigation } from "./modules/StickyNavigation";
import { initializeScrollToTop } from "./modules/ScrollToTop";
import { initializeSmoothScroll } from "./modules/SmoothScroll";

document.addEventListener("DOMContentLoaded", () => {
	initializeStickyNavigation();
	initializeScrollToTop();
	initializeSmoothScroll();
});
