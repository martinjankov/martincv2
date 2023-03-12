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

require_once MARTINCV_THEME_DIR . 'inc/core/autoloader.php';

if ( class_exists( '\ACF' ) ) {
	MartinCV\Core\ACF::get_instance();
	MartinCV\Core\ACF_Guttenberg_Blocks::get_instance();
} else {
	add_action(
		'wp',
		function() {
			// Fallback function so we don't need to check every time if it exists.
			if ( ! function_exists( 'get_field' ) ) {
				/**
				 * Return meta field
				 *
				 * @param   string $selector      The selector.
				 * @param   int    $post_id       The post id.
				 * @param   bool   $format_value  Return array or format it to single value.
				 *
				 * @return  string
				 */
				function get_field( $selector, $post_id = false, $format_value = true ) {
					return '';
				}

				/**
				 * Print meta field
				 *
				 * @param   string $selector      The selector.
				 * @param   int    $post_id       The post id.
				 * @param   bool   $format_value  Return array or format it to single value.
				 *
				 * @return  void
				 */
				function the_field( $selector, $post_id = false, $format_value = true ) {
					echo '';
				}

				/**
				 * Return sub meta field
				 *
				 * @param   string $selector      The selector.
				 * @param   int    $post_id       The post id.
				 * @param   bool   $format_value  Return array or format it to single value.
				 *
				 * @return  string
				 */
				function get_sub_field( $selector, $post_id = false, $format_value = true ) {
					return '';
				}

				/**
				 * Print sub meta field
				 *
				 * @param   string $selector      The selector.
				 * @param   int    $post_id       The post id.
				 * @param   bool   $format_value  Return array or format it to single value.
				 *
				 * @return  void
				 */
				function the_sub_field( $selector, $post_id = false, $format_value = true ) {
					echo '';
				}
			}
		}
	);
}

MartinCV\CPT\Project::get_instance();
MartinCV\CPT\Testimonial::get_instance();
