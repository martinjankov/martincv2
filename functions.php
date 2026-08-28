<?php
/**
 * Theme functions
 *
 * @package MartinCV
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'MARTINCV_THEME_DIR' ) ) {
	define( 'MARTINCV_THEME_DIR', trailingslashit( get_template_directory() ) );
}

if ( ! defined( 'MARTINCV_THEME_URL' ) ) {
	define( 'MARTINCV_THEME_URL', trailingslashit( get_template_directory_uri() ) );
}

if ( ! defined( 'MARTINCV_THEME_ASSETS' ) ) {
	define( 'MARTINCV_THEME_ASSETS', trailingslashit( get_template_directory_uri() ) . 'assets/' );
}

if ( ! defined( 'MARTINCV_THEME_VERSION' ) ) {
	define( 'MARTINCV_THEME_VERSION', '1.0.0' );
}

if ( ! function_exists( 'wpdd' ) ) {
	/**
	 * Print Debug information
	 *
	 * @param   mixed $data  The data to be printed.
	 * @param   bool  $exit  Should it die or not.
	 *
	 * @return  void
	 */
	function wpdd( $data, $exit = true ) {
		echo '<pre>' . print_r( $data, true ) . '</pre>'; // phpcs:ignore

		if ( $exit ) {
			die;
		}
	}
}

// Require modules.
require_once MARTINCV_THEME_DIR . 'inc/init.php';

/**
 * Sets up theme defaults and registers the various WordPress features
 */
function martincv_theme_setup() {
	load_theme_textdomain( 'martincv', MARTINCV_THEME_DIR . '/languages' );

	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	add_theme_support( 'title-tag' );

	register_nav_menu( 'primary', esc_html__( 'Main Menu', 'martincv' ) );
	register_nav_menu( 'footer', esc_html__( 'Footer Quick Links', 'martincv' ) );
	register_nav_menu( 'footer-services', esc_html__( 'Footer Services Menu', 'martincv' ) );
	register_nav_menu( 'footer-legal', esc_html__( 'Footer Legal Menu', 'martincv' ) );

	add_theme_support( 'post-thumbnails' );

	add_theme_support(
		'html5',
		array(
			'search-form',
		)
	);

	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'editor-styles' );
}
add_action( 'after_setup_theme', 'martincv_theme_setup' );

/**
 * Remove the default prefix from archive titles.
 *
 * @param string $title Archive title.
 * @return string
 */
function martincv_archive_title( string $title ): string {
	if ( is_category() || is_tag() || is_tax() ) {
		$title = single_term_title( '', false );
	} elseif ( is_author() ) {
		$title = get_the_author();
	} elseif ( is_year() ) {
		$title = get_the_date( 'Y' );
	} elseif ( is_month() ) {
		$title = get_the_date( 'F Y' );
	} elseif ( is_day() ) {
		$title = get_the_date( 'F j, Y' );
	} elseif ( is_post_type_archive() ) {
		$title = post_type_archive_title( '', false );
	}

	return $title;
}
add_filter( 'get_the_archive_title', 'martincv_archive_title' );
