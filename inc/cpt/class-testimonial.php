<?php
/**
 * Testimonial CPT Class
 *
 * @package MartinCV
 */

namespace MartinCV\CPT;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Testimonial CPT
 */
class Testimonial {
	use \MartinCV\Traits\Singleton;

	/**
	 * Initialize
	 *
	 * @return  void
	 */
	private function initialize() {
		add_action( 'init', array( $this, 'register_custom_post_types' ), 1 );
	}

	/**
	 * Register custom post types
	 *
	 * @return  void
	 */
	public function register_custom_post_types() {
		$labels = array(
			'name'               => _x( 'Testimonials', 'post type general name', 'martincv' ),
			'singular_name'      => _x( 'Testimonial', 'post type singular name', 'martincv' ),
			'menu_name'          => _x( 'Testimonials', 'admin menu', 'martincv' ),
			'name_admin_bar'     => _x( 'Testimonials', 'add new on admin bar', 'martincv' ),
			'add_new'            => _x( 'Add New Testimonial', 'add new', 'martincv' ),
			'add_new_item'       => __( 'Add New Testimonial', 'martincv' ),
			'new_item'           => __( 'New Testimonial', 'martincv' ),
			'edit_item'          => __( 'Edit Testimonial', 'martincv' ),
			'view_item'          => __( 'View Testimonials', 'martincv' ),
			'all_items'          => __( 'Testimonials', 'martincv' ),
			'search_items'       => __( 'Search Testimonial', 'martincv' ),
			'parent_item_colon'  => __( 'ParentTestimonial:', 'martincv' ),
			'not_found'          => __( 'No Testimonials found.', 'martincv' ),
			'not_found_in_trash' => __( 'No Testimonials found in Trash.', 'martincv' ),
		);

		$args = array(
			'labels'              => $labels,
			'description'         => __( 'Testimonials', 'martincv' ),
			'public'              => false,
			'publicly_queryable'  => false,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'query_var'           => true,
			'has_archive'         => true,
			'hierarchical'        => false,
			'menu_position'       => null,
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'exclude_from_search' => true,
			'map_meta_cap'        => true,
			'capability_type'     => array( 'post', 'posts' ),
			'supports'            => array( 'title', 'thumbnail' ),
			'rewrite'             => array(
				'slug'       => 'testimonial',
				'with_front' => false,
			),
			'menu_icon'           => 'dashicons-buddicons-pm',
		);

		register_post_type( 'testimonial', $args );
	}
}
