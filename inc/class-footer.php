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
	 * Render the footer logo.
	 *
	 * @return void
	 */
	public function render_logo(): void {
		$logo_url  = \MartinCV\Site_Options::get_footer_logo();
		$home_url  = esc_url( home_url( '/' ) );
		$site_name = get_bloginfo( 'name' );

		if ( $logo_url ) {
			printf(
				'<a href="%s" class="footer-logo" rel="home"><img src="%s" alt="%s"></a>',
				$home_url,
				esc_url( $logo_url ),
				esc_attr( $site_name )
			);
		} else {
			printf(
				'<a href="%s" class="site-name" rel="home">%s</a>',
				$home_url,
				esc_html( $site_name )
			);
		}
	}

	/**
	 * Render the about text.
	 *
	 * @return void
	 */
	public function render_about_text(): void {
		$about = \MartinCV\Site_Options::get_footer_about();

		if ( ! $about ) {
			return;
		}
		?>
		<p class="footer-about__text">
			<?php echo esc_html( $about ); ?>
		</p>
		<?php
	}

	/**
	 * Render social media icons.
	 *
	 * @return void
	 */
	public function render_social_icons(): void {
		$facebook  = \MartinCV\Site_Options::get_facebook();
		$instagram = \MartinCV\Site_Options::get_instagram();
		$linkedin  = \MartinCV\Site_Options::get_linkedin();
		$youtube   = \MartinCV\Site_Options::get_youtube();
		?>
		<div class="footer-social">
			<?php if ( $facebook ) : ?>
				<a href="<?php echo esc_url( $facebook ); ?>" class="footer-social__icon" aria-label="<?php esc_attr_e( 'Facebook', 'martincv' ); ?>" target="_blank" rel="noopener noreferrer">
					<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
						<path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
					</svg>
				</a>
			<?php endif; ?>
			<?php if ( $instagram ) : ?>
				<a href="<?php echo esc_url( $instagram ); ?>" class="footer-social__icon" aria-label="<?php esc_attr_e( 'Instagram', 'martincv' ); ?>" target="_blank" rel="noopener noreferrer">
					<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
						<rect width="20" height="20" x="2" y="2" rx="5" ry="5"/>
						<path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
						<line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/>
					</svg>
				</a>
			<?php endif; ?>
			<?php if ( $linkedin ) : ?>
				<a href="<?php echo esc_url( $linkedin ); ?>" class="footer-social__icon" aria-label="<?php esc_attr_e( 'LinkedIn', 'martincv' ); ?>" target="_blank" rel="noopener noreferrer">
					<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
						<path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/>
						<rect width="4" height="12" x="2" y="9"/>
						<circle cx="4" cy="4" r="2"/>
					</svg>
				</a>
			<?php endif; ?>
			<?php if ( $youtube ) : ?>
				<a href="<?php echo esc_url( $youtube ); ?>" class="footer-social__icon" aria-label="<?php esc_attr_e( 'YouTube', 'martincv' ); ?>" target="_blank" rel="noopener noreferrer">
					<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
						<path d="M2.5 17a24.12 24.12 0 0 1 0-10 2 2 0 0 1 1.4-1.4 49.56 49.56 0 0 1 16.2 0A2 2 0 0 1 21.5 7a24.12 24.12 0 0 1 0 10 2 2 0 0 1-1.4 1.4 49.55 49.55 0 0 1-16.2 0A2 2 0 0 1 2.5 17"/>
						<path d="m10 15 5-3-5-3z"/>
					</svg>
				</a>
			<?php endif; ?>
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
		?>
		<div class="footer-col">
			<h3 class="footer-col__title"><?php echo esc_html( $title ); ?></h3>
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
	 * Render the contact info column.
	 *
	 * @return void
	 */
	public function render_contact_column(): void {
		$phone    = \MartinCV\Site_Options::get_phone();
		$email    = \MartinCV\Site_Options::get_email();
		$location = \MartinCV\Site_Options::get_location();
		?>
		<div class="footer-col">
			<h3 class="footer-col__title"><?php esc_html_e( 'Contact', 'martincv' ); ?></h3>
			<ul class="footer-contact">
				<?php if ( $phone ) : ?>
					<li class="footer-contact__item">
						<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
							<path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
						</svg>
						<a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a>
					</li>
				<?php endif; ?>
				<?php if ( $email ) : ?>
					<li class="footer-contact__item">
						<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
							<rect width="20" height="16" x="2" y="4" rx="2"></rect>
							<path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
						</svg>
						<a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a>
					</li>
				<?php endif; ?>
				<?php if ( $location ) : ?>
					<li class="footer-contact__item">
						<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
							<path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"></path>
							<circle cx="12" cy="10" r="3"></circle>
						</svg>
						<span><?php echo esc_html( $location ); ?></span>
					</li>
				<?php endif; ?>
			</ul>
		</div>
		<?php
	}

	/**
	 * Render the copyright bar.
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
					esc_html__( '&copy; %1$s %2$s. All rights reserved.', 'martincv' ),
					esc_html( gmdate( 'Y' ) ),
					esc_html( get_bloginfo( 'name' ) )
				);
				?>
			</p>
		</div>
		<?php
	}
}
