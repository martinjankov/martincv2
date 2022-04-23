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

if ( ! defined( 'MARTINCV_THEME_VERSION' ) ) {
	define( 'MARTINCV_THEME_VERSION', '1.0.0' );
}

if ( ! function_exists( 'wpdd' ) ) {
	/**
	 * Print Debug information
	 *
	 * @param   mixed $data  The data to be printed.
	 *
	 * @return  void
	 */
	function wpdd( $data ) {
		echo '<pre>' . print_r( $data, true ) . '</pre>'; // phpcs:ignore
		die;
	}
}

// Require modules.
require_once MARTINCV_THEME_DIR . 'inc/init.php';

/**
 * Sets up theme defaults and registers the various WordPress features
 */
function martincv_setup() {
	/*
	 * Makes theme available for translation.
	 * Translations can be added to the /languages/ directory.
	 */
	load_theme_textdomain( 'martincv', get_template_directory() . '/languages' );

	// Enable support for a custom logo.
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	add_image_size( 'post-size', 770, 465 );
	add_image_size( 'post-recent-sidebar-size', 80, 80, true );

	// Enable plugins and themes to manage the document title tag.
	add_theme_support( 'title-tag' );

	register_nav_menu( 'primary', esc_html__( 'Main Menu', 'martincv' ) );
	register_nav_menu( 'header-top', esc_html__( 'Header Top Menu', 'martincv' ) );
	register_nav_menu( 'footer', esc_html__( 'Footer Menu', 'martincv' ) );
	register_nav_menu( 'footer-secondary', esc_html__( 'Footer Secondary Menu', 'martincv' ) );
	register_nav_menu( 'primary-mob', esc_html__( 'Main Menu for Mobile', 'martincv' ) );

	/* This theme uses a custom image size for featured images, displayed on "standard" posts. */
	add_theme_support( 'post-thumbnails' );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'search-form',
		)
	);

	/* Third-party plugins */
}
add_action( 'after_setup_theme', 'martincv_setup' );


/**
 * Register sidebars
 */
function martincv_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Post Sidebar', 'martincv' ),
			'id'            => 'post-sidebar',
			'before_widget' => '<div class="widget">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'martincv_widgets_init' );

/**
 * Enqueue JS & CSS front-end files
 */
function martincv_frontend_assets() {
	wp_enqueue_style(
		'martincv-global',
		MARTINCV_THEME_URL . 'assets/public/css/common.css',
		array(),
		MARTINCV_THEME_VERSION
	);

	wp_enqueue_script(
		'martincv-global',
		MARTINCV_THEME_URL . 'assets/public/js/global.js',
		array( 'jquery' ),
		MARTINCV_THEME_VERSION,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'martincv_frontend_assets' );
