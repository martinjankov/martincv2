import "./scss/single.scss";
import { initializeShareLinks } from "./js/modules/ShareLinks";
import { initializeLightbox } from "./js/modules/Lightbox";

document.addEventListener("DOMContentLoaded", () => {
	initializeShareLinks();
	initializeLightbox(".single-post__content");
});
