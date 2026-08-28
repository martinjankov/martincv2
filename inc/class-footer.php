<?php
/**
 * Footer
 *
 * @package MartinCV
 */

namespace MartinCV;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Footer Class
 */
class Footer {
	use \MartinCV\Traits\Singleton;

	/**
	 * Render the footer brand: logo image if set, otherwise gradient site name; plus about text.
	 *
	 * @return void
	 */
	public function render_brand(): void {
		$logo_url  = \MartinCV\Site_Options::get_footer_logo();
		$home_url  = esc_url( home_url( '/' ) );
		$site_name = get_bloginfo( 'name' );
		$about     = \MartinCV\Site_Options::get_footer_about();

		if ( $logo_url ) {
			printf(
				'<a href="%s" class="footer-logo" rel="home"><img src="%s" alt="%s"></a>',
				$home_url,
				esc_url( $logo_url ),
				esc_attr( $site_name )
			);
		} else {
			printf(
				'<h3 class="footer-brand__name gradient-text">%s</h3>',
				esc_html( $site_name )
			);
		}

		if ( $about ) {
			printf( '<p class="footer-brand__about">%s</p>', esc_html( $about ) );
		}
	}

	/**
	 * Render the contact link list: email, Codeable profile, consultation booking.
	 *
	 * @return void
	 */
	public function render_contact_links(): void {
		$email        = \MartinCV\Site_Options::get_email();
		$codeable     = \MartinCV\Site_Options::get_codeable_url();
		$consultation = \MartinCV\Site_Options::get_consultation_url();

		if ( ! $email && ! $codeable && ! $consultation ) {
			return;
		}
		?>
		<div class="footer-links">
			<?php if ( $email ) : ?>
				<a href="mailto:<?php echo esc_attr( $email ); ?>" class="footer-links__item">
					<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
						<rect width="20" height="16" x="2" y="4" rx="2"></rect>
						<path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
					</svg>
					<span><?php echo esc_html( $email ); ?></span>
				</a>
			<?php endif; ?>
			<?php if ( $codeable ) : ?>
				<a href="<?php echo esc_url( $codeable ); ?>" class="footer-links__item" target="_blank" rel="noopener noreferrer">
					<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
						<path d="M15 3h6v6"></path>
						<path d="M10 14 21 3"></path>
						<path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
					</svg>
					<span><?php esc_html_e( 'Codeable Profile', 'martincv' ); ?></span>
				</a>
			<?php endif; ?>
			<?php if ( $consultation ) : ?>
				<a href="<?php echo esc_url( $consultation ); ?>" class="footer-links__item" target="_blank" rel="noopener noreferrer">
					<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
						<path d="M8 2v4"></path>
						<path d="M16 2v4"></path>
						<rect width="18" height="18" x="3" y="4" rx="2"></rect>
						<path d="M3 10h18"></path>
					</svg>
					<span><?php esc_html_e( 'Book Consultation', 'martincv' ); ?></span>
				</a>
			<?php endif; ?>
		</div>
		<?php
	}

	/**
	 * Render social media icon squares.
	 *
	 * @return void
	 */
	public function render_social_icons(): void {
		$socials = array(
			array(
				'url'   => \MartinCV\Site_Options::get_linkedin(),
				'label' => 'LinkedIn',
				'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect width="4" height="12" x="2" y="9"></rect><circle cx="4" cy="4" r="2"></circle></svg>',
			),
			array(
				'url'   => \MartinCV\Site_Options::get_github(),
				'label' => 'GitHub',
				'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M15 22v-4a4.8 4.8 0 0 0-1-3.5c3 0 6-2 6-5.5.08-1.25-.27-2.48-1-3.5.28-1.15.28-2.35 0-3.5 0 0-1 0-3 1.5-2.64-.5-5.36-.5-8 0C6 2 5 2 5 2c-.3 1.15-.3 2.35 0 3.5A5.403 5.403 0 0 0 4 9c0 3.5 3 5.5 6 5.5-.39.49-.68 1.05-.85 1.65-.17.6-.22 1.23-.15 1.85v4"></path><path d="M9 18c-4.51 2-5-2-7-2"></path></svg>',
			),
			array(
				'url'   => \MartinCV\Site_Options::get_x(),
				'label' => 'X',
				'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg>',
			),
			array(
				'url'   => \MartinCV\Site_Options::get_facebook(),
				'label' => 'Facebook',
				'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>',
			),
			array(
				'url'   => \MartinCV\Site_Options::get_instagram(),
				'label' => 'Instagram',
				'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"></line></svg>',
			),
			array(
				'url'   => \MartinCV\Site_Options::get_youtube(),
				'label' => 'YouTube',
				'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2.5 17a24.12 24.12 0 0 1 0-10 2 2 0 0 1 1.4-1.4 49.56 49.56 0 0 1 16.2 0A2 2 0 0 1 21.5 7a24.12 24.12 0 0 1 0 10 2 2 0 0 1-1.4 1.4 49.55 49.55 0 0 1-16.2 0A2 2 0 0 1 2.5 17"></path><path d="m10 15 5-3-5-3z"></path></svg>',
			),
		);

		$socials = array_filter(
			$socials,
			function ( $social ) {
				return ! empty( $social['url'] );
			}
		);

		if ( ! $socials ) {
			return;
		}
		?>
		<div class="footer-social">
			<?php foreach ( $socials as $social ) : ?>
				<a href="<?php echo esc_url( $social['url'] ); ?>" class="footer-social__icon" aria-label="<?php echo esc_attr( $social['label'] ); ?>" target="_blank" rel="noopener noreferrer">
					<?php echo wp_kses( $social['icon'], \MartinCV\Core\Theme::kses_svg() ); ?>
				</a>
			<?php endforeach; ?>
		</div>
		<?php
	}

	/**
	 * Render a footer menu column.
	 *
	 * @param string $title    Column heading.
	 * @param string $location Menu theme location.
	 * @return void
	 */
	public function render_menu_column( string $title, string $location ): void {
		if ( ! has_nav_menu( $location ) ) {
			return;
		}
		?>
		<div class="footer-col">
			<h4 class="footer-col__title"><?php echo esc_html( $title ); ?></h4>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => $location,
					'container'      => false,
					'menu_class'     => 'footer-col__menu',
					'depth'          => 1,
					'fallback_cb'    => false,
				)
			);
			?>
		</div>
		<?php
	}

	/**
	 * Render the copyright bar with the legal menu.
	 *
	 * @return void
	 */
	public function render_copyright(): void {
		?>
		<div class="footer-bottom">
			<p class="footer-bottom__copy">
				<?php
				printf(
					/* translators: 1: current year, 2: site name */
					esc_html__( '© %1$s %2$s. All rights reserved.', 'martincv' ),
					esc_html( gmdate( 'Y' ) ),
					esc_html( get_bloginfo( 'name' ) )
				);
				?>
			</p>
			<?php
			if ( has_nav_menu( 'footer-legal' ) ) {
				wp_nav_menu(
					array(
						'theme_location' => 'footer-legal',
						'container'      => false,
						'menu_class'     => 'footer-bottom__menu',
						'depth'          => 1,
						'fallback_cb'    => false,
					)
				);
			}
			?>
		</div>
		<?php
	}
}
