<?php
/**
 * Header
 *
 * @package MartinCV
 */

namespace MartinCV;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Header Class
 */
class Header {
	use \MartinCV\Traits\Singleton;

	/**
	 * Initialize.
	 *
	 * @return void
	 */
	public function initialize(): void {
		add_filter( 'nav_menu_css_class', array( $this, 'fix_hash_menu_active_class' ), 10, 2 );
	}

	/**
	 * Remove current-menu-item class from hash-based links on the homepage.
	 * Only the item with href="/" should be active.
	 *
	 * @param array    $classes CSS classes.
	 * @param \WP_Post $item   Menu item.
	 * @return array
	 */
	public function fix_hash_menu_active_class( array $classes, \WP_Post $item ): array {
		if ( ! is_front_page() ) {
			return $classes;
		}

		$url = $item->url;

		// If the URL contains a # fragment (e.g. /#services), remove active classes.
		if ( strpos( $url, '#' ) !== false ) {
			$classes = array_diff(
				$classes,
				array( 'current-menu-item', 'current_page_item', 'current-menu-ancestor', 'current_page_parent' )
			);
		}

		return $classes;
	}

	/**
	 * Render the site logo or fallback site name.
	 *
	 * @return void
	 */
	public function render_logo(): void {
		$home_url  = esc_url( home_url( '/' ) );
		$site_name = get_bloginfo( 'name' );

		if ( has_custom_logo() ) {
			the_custom_logo();
		} else {
			printf(
				'<a href="%s" class="site-name" rel="home">%s</a>',
				$home_url,
				esc_html( $site_name )
			);
		}
	}

	/**
	 * Render the desktop navigation menu.
	 *
	 * @return void
	 */
	public function render_desktop_nav(): void {
		wp_nav_menu(
			array(
				'theme_location' => 'primary',
				'container'      => false,
				'menu_class'     => 'header-menu',
				'depth'          => 2,
				'fallback_cb'    => false,
			)
		);
	}

	/**
	 * Render the burger menu button.
	 *
	 * @return void
	 */
	public function render_burger(): void {
		?>
		<button class="burger" id="burger" type="button" aria-label="<?php esc_attr_e( 'Open menu', 'martincv' ); ?>" aria-expanded="false" aria-controls="header-nav">
			<span></span>
			<span></span>
			<span></span>
		</button>
		<?php
	}
}
