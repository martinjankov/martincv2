import "./scss/single-project.scss";
import { initializeProjectAbout } from "./js/modules/ProjectAbout";
import { wireLightboxGroup } from "./js/modules/Lightbox";

document.addEventListener("DOMContentLoaded", () => {
	initializeProjectAbout();

	// Gallery slides as one group; the featured image opens on its own.
	wireLightboxGroup(
		Array.from(document.querySelectorAll(".single-project__gallery img"))
	);

	const thumb = document.querySelector(".single-project__thumb img");
	if (thumb) {
		wireLightboxGroup([thumb]);
	}
});
