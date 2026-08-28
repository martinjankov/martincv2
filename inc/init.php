<?php
/**
 * Init file
 *
 * @package MartinCV
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( file_exists( MARTINCV_THEME_DIR . 'inc/core/autoloader.php' ) ) {
	require_once MARTINCV_THEME_DIR . 'inc/core/autoloader.php';
}

// Set theme first always.
MartinCV\Core\Theme::get_instance();
MartinCV\Core\Register_Blocks::get_instance();
MartinCV\Site_Options::get_instance();
MartinCV\Header::get_instance();
MartinCV\Footer::get_instance();

// Admin-only classes (admin-ajax requests also satisfy is_admin()).
if ( is_admin() ) {
	// Future admin classes go here.
}
