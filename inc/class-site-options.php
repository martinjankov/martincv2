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

		// Replace the {years} token with the computed years of experience
		// in any formatted ACF text value (options, blocks, repeaters).
		add_filter( 'acf/format_value/type=text', array( $this, 'replace_years_token' ) );
		add_filter( 'acf/format_value/type=textarea', array( $this, 'replace_years_token' ) );
		add_filter( 'acf/format_value/type=wysiwyg', array( $this, 'replace_years_token' ) );
	}

	/**
	 * Replace the {years} token with the computed years of experience.
	 *
	 * @param mixed $value Formatted field value.
	 * @return mixed
	 */
	public function replace_years_token( $value ) {
		if ( is_string( $value ) && false !== strpos( $value, '{years}' ) ) {
			$value = str_replace( '{years}', (string) self::get_years_experience(), $value );
		}

		return $value;
	}

	/**
	 * Get full years of experience since the career start date option.
	 *
	 * Month-aware: the number only bumps once the anniversary month passes.
	 *
	 * @return int
	 */
	public static function get_years_experience(): int {
		$start = (string) get_field( 'career_start', 'option', false );

		if ( ! $start ) {
			$start = '2014-06-01';
		}

		$start_date = date_create( $start, wp_timezone() );

		if ( ! $start_date ) {
			return 0;
		}

		return max( 0, (int) $start_date->diff( date_create( 'now', wp_timezone() ) )->y );
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
	 * Get GitHub URL.
	 *
	 * @return string
	 */
	public static function get_github(): string {
		return (string) get_field( 'github_url', 'option' );
	}

	/**
	 * Get X (Twitter) URL.
	 *
	 * @return string
	 */
	public static function get_x(): string {
		return (string) get_field( 'x_url', 'option' );
	}

	/**
	 * Get Codeable profile URL.
	 *
	 * @return string
	 */
	public static function get_codeable_url(): string {
		return (string) get_field( 'codeable_url', 'option' );
	}

	/**
	 * Get Upwork profile URL.
	 *
	 * @return string
	 */
	public static function get_upwork_url(): string {
		return (string) get_field( 'upwork_url', 'option' );
	}

	/**
	 * Get consultation booking URL.
	 *
	 * @return string
	 */
	public static function get_consultation_url(): string {
		return (string) get_field( 'consultation_url', 'option' );
	}

	/**
	 * Get resume file URL.
	 *
	 * @return string
	 */
	public static function get_resume_url(): string {
		return (string) get_field( 'resume_file', 'option' );
	}

	/**
	 * Get header CTA label. Defaults to "Let's Talk".
	 *
	 * @return string
	 */
	public static function get_header_cta_label(): string {
		$label = (string) get_field( 'header_cta_label', 'option' );

		return $label ? $label : __( "Let's Talk", 'martincv' );
	}

	/**
	 * Get header CTA link. Defaults to the #contact anchor.
	 *
	 * @return string
	 */
	public static function get_header_cta_link(): string {
		$link = (string) get_field( 'header_cta_link', 'option' );

		return $link ? $link : '#contact';
	}

	/**
	 * Get services archive title.
	 *
	 * @return string
	 */
	public static function get_services_title(): string {
		return (string) get_field( 'services_title', 'option' );
	}

	/**
	 * Get services archive intro text.
	 *
	 * @return string
	 */
	public static function get_services_intro(): string {
		return (string) get_field( 'services_intro', 'option' );
	}

	/**
	 * Get services archive CTA title.
	 *
	 * @return string
	 */
	public static function get_services_cta_title(): string {
		return (string) get_field( 'services_cta_title', 'option' );
	}

	/**
	 * Get services archive CTA text.
	 *
	 * @return string
	 */
	public static function get_services_cta_text(): string {
		return (string) get_field( 'services_cta_text', 'option' );
	}

	/**
	 * Get services archive CTA button text.
	 *
	 * @return string
	 */
	public static function get_services_cta_btn_text(): string {
		return (string) get_field( 'services_cta_btn_text', 'option' );
	}

	/**
	 * Get services archive CTA button link.
	 *
	 * @return string
	 */
	public static function get_services_cta_btn_link(): string {
		$link = (string) get_field( 'services_cta_btn_link', 'option' );

		return $link ? $link : '/#contact';
	}

	/**
	 * Get projects archive title.
	 *
	 * @return string
	 */
	public static function get_projects_title(): string {
		return (string) get_field( 'projects_title', 'option' );
	}

	/**
	 * Get projects archive title gradient part.
	 *
	 * @return string
	 */
	public static function get_projects_title_highlight(): string {
		return (string) get_field( 'projects_title_highlight', 'option' );
	}

	/**
	 * Get projects archive intro text.
	 *
	 * @return string
	 */
	public static function get_projects_intro(): string {
		return (string) get_field( 'projects_intro', 'option' );
	}

	/**
	 * Get projects archive CTA title.
	 *
	 * @return string
	 */
	public static function get_projects_cta_title(): string {
		return (string) get_field( 'projects_cta_title', 'option' );
	}

	/**
	 * Get projects archive CTA text.
	 *
	 * @return string
	 */
	public static function get_projects_cta_text(): string {
		return (string) get_field( 'projects_cta_text', 'option' );
	}

	/**
	 * Get projects archive CTA button text.
	 *
	 * @return string
	 */
	public static function get_projects_cta_btn_text(): string {
		return (string) get_field( 'projects_cta_btn_text', 'option' );
	}

	/**
	 * Get projects archive CTA button link.
	 *
	 * @return string
	 */
	public static function get_projects_cta_btn_link(): string {
		$link = (string) get_field( 'projects_cta_btn_link', 'option' );

		return $link ? $link : '/#contact';
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
	/**
	 * Get blog archive title (non-gradient part).
	 *
	 * @return string
	 */
	public static function get_blog_title(): string {
		return (string) get_field( 'blog_title', 'option' );
	}

	/**
	 * Get blog archive title gradient part.
	 *
	 * @return string
	 */
	public static function get_blog_title_highlight(): string {
		return (string) get_field( 'blog_title_highlight', 'option' );
	}

	/**
	 * Get blog archive intro text.
	 *
	 * @return string
	 */
	public static function get_blog_intro(): string {
		return (string) get_field( 'blog_intro', 'option' );
	}
}
