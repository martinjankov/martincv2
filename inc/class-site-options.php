<?php
/**
 * Site Options
 *
 * Registers the ACF Options page for global site settings.
 *
 * @package MartinCV
 */

namespace MartinCV;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Site Options Class
 */
class Site_Options {
	use \MartinCV\Traits\Singleton;

	/**
	 * Initialize
	 *
	 * @return void
	 */
	public function initialize(): void {
		add_action( 'acf/init', array( $this, 'register_options_page' ) );
	}

	/**
	 * Register the ACF options page.
	 *
	 * @return void
	 */
	public function register_options_page(): void {
		if ( ! function_exists( 'acf_add_options_page' ) ) {
			return;
		}

		acf_add_options_page(
			array(
				'page_title' => __( 'Site Options', 'martincv' ),
				'menu_title' => __( 'Site Options', 'martincv' ),
				'menu_slug'  => 'site-options',
				'capability' => 'manage_options',
				'icon_url'   => 'dashicons-admin-settings',
				'position'   => 30,
				'redirect'   => false,
			)
		);
	}

	/**
	 * Get phone number.
	 *
	 * @return string
	 */
	public static function get_phone(): string {
		return (string) get_field( 'phone', 'option' );
	}

	/**
	 * Get email address.
	 *
	 * @return string
	 */
	public static function get_email(): string {
		return (string) get_field( 'email', 'option' );
	}

	/**
	 * Get location.
	 *
	 * @return string
	 */
	public static function get_location(): string {
		return (string) get_field( 'location', 'option' );
	}

	/**
	 * Get Facebook URL.
	 *
	 * @return string
	 */
	public static function get_facebook(): string {
		return (string) get_field( 'facebook_url', 'option' );
	}

	/**
	 * Get Instagram URL.
	 *
	 * @return string
	 */
	public static function get_instagram(): string {
		return (string) get_field( 'instagram_url', 'option' );
	}

	/**
	 * Get LinkedIn URL.
	 *
	 * @return string
	 */
	public static function get_linkedin(): string {
		return (string) get_field( 'linkedin_url', 'option' );
	}

	/**
	 * Get YouTube URL.
	 *
	 * @return string
	 */
	public static function get_youtube(): string {
		return (string) get_field( 'youtube_url', 'option' );
	}

	/**
	 * Get footer about text.
	 *
	 * @return string
	 */
	public static function get_footer_about(): string {
		return (string) get_field( 'footer_about', 'option' );
	}

	/**
	 * Get footer logo URL. Falls back to the default custom logo.
	 *
	 * @return string
	 */
	public static function get_footer_logo(): string {
		$footer_logo = get_field( 'footer_logo', 'option' );

		if ( $footer_logo ) {
			return (string) $footer_logo;
		}

		$custom_logo_id = get_theme_mod( 'custom_logo' );

		if ( $custom_logo_id ) {
			return (string) wp_get_attachment_image_url( $custom_logo_id, 'medium' );
		}

		return '';
	}
}
