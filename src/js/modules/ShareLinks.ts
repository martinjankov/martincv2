/**
 * Share Links Module
 *
 * Handles the copy-link button in the single post share row:
 * copies the post URL and briefly shows a check icon as feedback.
 */

const COPIED_FEEDBACK_MS = 2000;

export class ShareLinks {
	private buttons: NodeListOf<HTMLButtonElement>;

	constructor() {
		this.buttons = document.querySelectorAll<HTMLButtonElement>("[data-share-copy]");

		if (!this.buttons.length) {
			return;
		}

		this.init();
	}

	private init(): void {
		this.buttons.forEach((button) => {
			button.addEventListener("click", () => this.copy(button));
		});
	}

	private async copy(button: HTMLButtonElement): Promise<void> {
		const url = button.dataset.url || window.location.href;

		try {
			await navigator.clipboard.writeText(url);
		} catch {
			// Clipboard API unavailable (insecure context) — fall back to a temp input.
			const input = document.createElement("input");
			input.value = url;
			document.body.appendChild(input);
			input.select();
			document.execCommand("copy");
			input.remove();
		}

		button.classList.add("is-copied");
		window.setTimeout(() => button.classList.remove("is-copied"), COPIED_FEEDBACK_MS);
	}
}

export function initializeShareLinks(): void {
	new ShareLinks();
}
