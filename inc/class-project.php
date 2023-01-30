<?php
/**
 * Project
 *
 * @package MartinCV
 */

namespace MartinCV;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Project class
 */
class Project {
	use \MartinCV\Traits\Singleton;

	const PROJECT_CATEGORY_TAG = 'project_category';

	const PROJECT_TECHNOLOGY_TAG = 'technologies';

	/**
	 * Get projects
	 *
	 * @param  array $args WP Query arugments.
	 *
	 * @return array
	 */
	public function get( $args = array() ) {
		$default_args = array(
			'per_page'    => 15,
			'post_statys' => 'publish',
			'fields'      => 'ids',
		);

		$args = wp_parse_args( $args, $default_args );

		$args['post_type'] = 'project';

		$project_query = new \WP_Query( $args );

		$projects = array();

		if ( $project_query->have_posts() ) {
			foreach ( $project_query->posts as $project_id ) {
				$project_arr = array(
					'title' => get_the_title( $project_id ),
				);

				$categories = get_the_terms( $project_id, self::PROJECT_CATEGORY_TAG );

				$categories_slugs = array();

				if ( $categories ) {
					$categories_slugs = wp_list_pluck( $categories, 'slug' );
				}

				$project_arr['categories']        = $categories;
				$project_arr['categories_slugs']  = $categories_slugs;
				$project_arr['technologies']      = get_the_terms( $project_id, self::PROJECT_TECHNOLOGY_TAG );
				$project_arr['image']             = get_the_post_thumbnail_url( $project_id, 'large' );
				$project_arr['web_link']          = get_field( 'project_link', $project_id );
				$project_arr['short_description'] = get_field( 'project_short_description', $project_id );
				$project_arr['copyright']         = get_field( 'project_copyright', $project_id );

				$projects[] = $project_arr;
			}
		}

		return $projects;
	}

	/**
	 * Get all categories
	 *
	 * @return array
	 */
	public function get_categories() {
		$terms = get_terms(
			array(
				'taxonomy'   => self::PROJECT_CATEGORY_TAG,
				'hide_empty' => true,
			)
		);

		return $terms;
	}
}
