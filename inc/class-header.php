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
	 * Render the site logo: custom logo if set, otherwise the initials mark + site name.
	 *
	 * @return void
	 */
	public function render_logo(): void {
		$home_url  = esc_url( home_url( '/' ) );
		$site_name = get_bloginfo( 'name' );

		if ( has_custom_logo() ) {
			the_custom_logo();
			return;
		}

		printf(
			'<a href="%s" class="header-logo__link" rel="home"><span class="header-logo__mark">%s</span><span class="header-logo__name">%s</span></a>',
			$home_url,
			esc_html( $this->get_site_initials( $site_name ) ),
			esc_html( $site_name )
		);
	}

	/**
	 * Get initials from the site name (first letter of the first two words).
	 *
	 * @param string $site_name Site name.
	 * @return string
	 */
	private function get_site_initials( string $site_name ): string {
		$words    = preg_split( '/\s+/', trim( $site_name ) );
		$initials = '';

		foreach ( array_slice( (array) $words, 0, 2 ) as $word ) {
			if ( '' !== $word ) {
				$initials .= mb_strtoupper( mb_substr( $word, 0, 1 ) );
			}
		}

		return $initials ? $initials : 'M';
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
	 * Render the header actions: Resume download link + CTA button.
	 *
	 * @return void
	 */
	public function render_actions(): void {
		$resume_url = \MartinCV\Site_Options::get_resume_url();
		$cta_label  = \MartinCV\Site_Options::get_header_cta_label();
		$cta_link   = \MartinCV\Site_Options::get_header_cta_link();
		?>
		<div class="header-actions">
			<?php if ( $resume_url ) : ?>
				<a href="<?php echo esc_url( $resume_url ); ?>" class="header-resume" target="_blank" rel="noopener noreferrer">
					<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
						<path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
						<polyline points="7 10 12 15 17 10"></polyline>
						<line x1="12" x2="12" y1="15" y2="3"></line>
					</svg>
					<span><?php esc_html_e( 'Resume', 'martincv' ); ?></span>
				</a>
			<?php endif; ?>
			<a href="<?php echo esc_url( $cta_link ); ?>" class="header-cta">
				<?php echo esc_html( $cta_label ); ?>
			</a>
		</div>
		<?php
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
