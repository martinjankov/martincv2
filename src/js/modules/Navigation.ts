/**
 * Navigation Module
 *
 * Handles burger toggle for the slide-down nav panel on mobile,
 * accordion submenus, and Escape key to close.
 * CSS media queries handle desktop vs mobile display.
 */

export class Navigation {
	private burger: HTMLElement | null;
	private nav: HTMLElement | null;
	private isOpen = false;

	constructor() {
		this.burger = document.querySelector("#burger");
		this.nav = document.querySelector("#header-nav");

		if (!this.burger || !this.nav) {
			return;
		}

		this.init();
	}

	private init(): void {
		this.burger!.addEventListener("click", (e: Event) => {
			e.preventDefault();
			this.toggle();
		});

		document.addEventListener("keydown", (e: KeyboardEvent) => {
			if (e.key === "Escape" && this.isOpen) {
				this.close();
			}
		});

		this.injectSubmenuToggles();
	}

	private toggle(): void {
		this.isOpen ? this.close() : this.open();
	}

	private open(): void {
		this.nav!.classList.add("header-nav--open");
		this.burger!.classList.add("open");
		this.burger!.setAttribute("aria-expanded", "true");
		document.body.classList.add("mobile-nav-open");
		this.isOpen = true;
	}

	private close(): void {
		this.nav!.classList.remove("header-nav--open");
		this.burger!.classList.remove("open");
		this.burger!.setAttribute("aria-expanded", "false");
		document.body.classList.remove("mobile-nav-open");
		this.isOpen = false;
	}

	private static CHEVRON_SVG =
		'<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m6 9 6 6 6-6"></path></svg>';

	/**
	 * Inject accordion toggle buttons into .menu-item-has-children items.
	 * Also injects a desktop chevron SVG into the parent link.
	 */
	private injectSubmenuToggles(): void {
		const menu = this.nav!.querySelector(".header-menu");
		if (!menu) return;

		const parents = menu.querySelectorAll(".menu-item-has-children");

		parents.forEach((item) => {
			const link = item.querySelector(":scope > a");
			const subMenu = item.querySelector(":scope > .sub-menu");
			if (!link || !subMenu) return;

			// Inject desktop chevron into the link
			const chevron = document.createElement("span");
			chevron.className = "menu-chevron";
			chevron.innerHTML = Navigation.CHEVRON_SVG;
			link.appendChild(chevron);

			// Create wrapper for link + toggle button
			const wrap = document.createElement("div");
			wrap.className = "submenu-toggle-wrap";

			// Create toggle button
			const toggle = document.createElement("button");
			toggle.type = "button";
			toggle.className = "submenu-toggle";
			toggle.setAttribute("aria-expanded", "false");
			toggle.innerHTML = Navigation.CHEVRON_SVG;

			// Move link into wrapper, add toggle
			item.insertBefore(wrap, link);
			wrap.appendChild(link);
			wrap.appendChild(toggle);

			// Accordion click handler
			toggle.addEventListener("click", (e: Event) => {
				e.preventDefault();
				const isExpanded = toggle.classList.contains("open");

				toggle.classList.toggle("open");
				subMenu.classList.toggle("open");
				toggle.setAttribute(
					"aria-expanded",
					isExpanded ? "false" : "true"
				);
			});
		});
	}
}

/**
 * Initialize Navigation
 */
export function initializeNavigation(): void {
	new Navigation();
}
