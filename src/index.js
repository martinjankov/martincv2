import "./scss/main.scss";
import "./js/_global.js";
import { initializeNavigation } from "./js/modules/Navigation";
import { initializeMobileSliders } from "./js/modules/MobileSlider";

document.addEventListener("DOMContentLoaded", () => {
	initializeNavigation();
	initializeMobileSliders();
});
