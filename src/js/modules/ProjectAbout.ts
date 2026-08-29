/**
 * Project About Module
 *
 * Clamps a long case-study description in the header and opens the
 * full text in a modal via the "Read more" button.
 */

const CLAMP_HEIGHT = 220;

export function initializeProjectAbout(): void {
	const content = document.querySelector<HTMLElement>("[data-about-content]");
	const openButton = document.querySelector<HTMLButtonElement>("[data-about-open]");
	const modal = document.querySelector<HTMLElement>("[data-about-modal]");

	if (!content || !openButton || !modal) {
		return;
	}

	if (content.scrollHeight > CLAMP_HEIGHT) {
		content.classList.add("is-clamped");
		openButton.hidden = false;
	}

	const setOpen = (open: boolean): void => {
		modal.hidden = !open;
		document.body.classList.toggle("about-modal-open", open);
	};

	openButton.addEventListener("click", () => setOpen(true));

	modal.querySelectorAll("[data-about-close]").forEach((el) => {
		el.addEventListener("click", () => setOpen(false));
	});

	document.addEventListener("keydown", (e: KeyboardEvent) => {
		if (e.key === "Escape" && !modal.hidden) {
			setOpen(false);
		}
	});
}
