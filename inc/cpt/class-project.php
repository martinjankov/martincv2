<?php
/**
 * Projects CPT Class
 *
 * @package MartinCV
 */

namespace MartinCV\CPT;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Project CPT
 */
class Project {
	use \MartinCV\Traits\Singleton;

	/**
	 * Initialize
	 *
	 * @return  void
	 */
	private function initialize() {
		add_action( 'init', array( $this, 'register_custom_taxonomies' ), 0 );
		add_action( 'init', array( $this, 'register_custom_post_types' ), 1 );
	}

	/**
	 * Register custom post types
	 *
	 * @return  void
	 */
	public function register_custom_post_types() {
		$labels = array(
			'name'               => _x( 'Projects', 'post type general name', 'martincv' ),
			'singular_name'      => _x( 'Request', 'post type singular name', 'martincv' ),
			'menu_name'          => _x( 'Projects', 'admin menu', 'martincv' ),
			'name_admin_bar'     => _x( 'Projects', 'add new on admin bar', 'martincv' ),
			'add_new'            => _x( 'Add New Request', 'add new', 'martincv' ),
			'add_new_item'       => __( 'Add New Request', 'martincv' ),
			'new_item'           => __( 'New Request', 'martincv' ),
			'edit_item'          => __( 'Edit Request', 'martincv' ),
			'view_item'          => __( 'View Projects', 'martincv' ),
			'all_items'          => __( 'Projects', 'martincv' ),
			'search_items'       => __( 'Search Request', 'martincv' ),
			'parent_item_colon'  => __( 'ParentRequest:', 'martincv' ),
			'not_found'          => __( 'No Projects found.', 'martincv' ),
			'not_found_in_trash' => __( 'No Projects found in Trash.', 'martincv' ),
		);

		$args = array(
			'labels'              => $labels,
			'description'         => __( 'Projects', 'martincv' ),
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
				'slug'       => 'project',
				'with_front' => false,
			),
			'menu_icon'           => 'dashicons-format-aside',
		);

		register_post_type( 'project', $args );
	}

	/**
	 * Register customt taxonomies
	 *
	 * @return  void
	 */
	public function register_custom_taxonomies() {
		$labels = array(
			'name'              => _x( 'Project Category', 'taxonomy general name', 'martincv' ),
			'singular_name'     => _x( 'Project Category', 'taxonomy singular name', 'martincv' ),
			'search_items'      => __( 'Search Project Categories', 'martincv' ),
			'all_items'         => __( 'All Project Categories', 'martincv' ),
			'parent_item'       => __( 'Parent Project Categories', 'martincv' ),
			'parent_item_colon' => __( 'Parent Project Category:', 'martincv' ),
			'edit_item'         => __( 'Edit Project Category', 'martincv' ),
			'update_item'       => __( 'Update Project Category', 'martincv' ),
			'add_new_item'      => __( 'Add New Project Category', 'martincv' ),
			'new_item_name'     => __( 'New Project Category Name', 'martincv' ),
			'menu_name'         => __( 'Project Categories', 'martincv' ),
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'show_in_rest'      => true,
			'rewrite'           => array(
				'slug'       => 'project_category',
				'with_front' => false,
			),
		);

		register_taxonomy( 'project_category', array( 'project' ), $args );

		$labels = array(
			'name'              => _x( 'Technology', 'taxonomy general name', 'martincv' ),
			'singular_name'     => _x( 'Technology', 'taxonomy singular name', 'martincv' ),
			'search_items'      => __( 'Search Technologies', 'martincv' ),
			'all_items'         => __( 'All Technologies', 'martincv' ),
			'parent_item'       => __( 'Parent Technologies', 'martincv' ),
			'parent_item_colon' => __( 'Parent Technology:', 'martincv' ),
			'edit_item'         => __( 'Edit Technology', 'martincv' ),
			'update_item'       => __( 'Update Technology', 'martincv' ),
			'add_new_item'      => __( 'Add New Technology', 'martincv' ),
			'new_item_name'     => __( 'New Technology Name', 'martincv' ),
			'menu_name'         => __( 'Technologies', 'martincv' ),
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'show_in_rest'      => true,
			'rewrite'           => array(
				'slug'       => 'technologies',
				'with_front' => false,
			),
		);

		register_taxonomy( 'technologies', array( 'project' ), $args );
	}
}
