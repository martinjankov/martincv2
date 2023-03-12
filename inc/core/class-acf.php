<?php
/**
 * ACF Class
 *
 * @package MartinCV
 */

namespace MartinCV\Core;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * ACF
 */
class ACF {
	use \MartinCV\Traits\Singleton;

	/**
	 * Initialize
	 *
	 * @return  void
	 */
	private function initialize() {
		acf_add_options_page(
			array(
				'page_title' => __( 'Theme Settings', 'secondowelfare' ),
				'menu_title' => __( 'Theme Settings', 'secondowelfare' ),
				'menu_slug'  => 'theme-settings',
				'capability' => 'administrator',
				'redirect'   => false,
			)
		);
	}
}
