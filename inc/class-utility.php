<?php
/**
 * Utility
 *
 * Static helper methods used across the theme.
 *
 * @package MartinCV
 */

namespace MartinCV;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Utility Class
 */
class Utility {

	/**
	 * Get estimated reading time for a post in minutes.
	 *
	 * Uses Unicode-aware word counting to support Cyrillic and other scripts.
	 *
	 * @param int $post_id Post ID.
	 * @return int Reading time in minutes (minimum 1).
	 */
	public static function get_reading_time( int $post_id ): int {
		$content    = get_post_field( 'post_content', $post_id );
		$text       = wp_strip_all_tags( $content );
		$word_count = preg_match_all( '/[\p{L}\p{N}]+/u', $text );

		return max( 1, (int) ceil( $word_count / 200 ) );
	}
}
