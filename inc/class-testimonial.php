<?php
/**
 * Testimonial
 *
 * @package MartinCV
 */

namespace MartinCV;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Testimonial class
 */
class Testimonial {
	use \MartinCV\Traits\Singleton;

	/**
	 * Get testimonials
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
			'orderby'     => 'rand',
		);

		$args = wp_parse_args( $args, $default_args );

		$args['post_type'] = 'testimonial';

		$testimonial_query = new \WP_Query( $args );

		$testimonials = array();

		if ( $testimonial_query->have_posts() ) {
			foreach ( $testimonial_query->posts as $testimonial_id ) {
				$testimonials[] = array(
					'title'  => get_the_title( $testimonial_id ),
					'image'  => get_the_post_thumbnail_url( $testimonial_id, 'thumbnail' ),
					'review' => get_field( 'review', $testimonial_id ),
				);
			}
		}

		return $testimonials;
	}
}
