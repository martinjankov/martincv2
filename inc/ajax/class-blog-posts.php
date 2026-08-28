<?php
/**
 * Blog Posts AJAX
 *
 * Serves filtered, searched and paginated blog cards for the blog archive.
 *
 * @package MartinCV
 */

namespace MartinCV\AJAX;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Blog Posts AJAX Class
 */
class Blog_Posts {
	use \MartinCV\Traits\Singleton;

	const POSTS_PER_PAGE = 6;

	/**
	 * Initialize object
	 *
	 * @return void
	 */
	private function initialize(): void {
		add_action( 'wp_ajax_martincv_filter_blog_posts', array( $this, 'filter_posts' ) );
		add_action( 'wp_ajax_nopriv_martincv_filter_blog_posts', array( $this, 'filter_posts' ) );
	}

	/**
	 * Return one page of blog cards for the requested search/category.
	 *
	 * @return void
	 */
	public function filter_posts(): void {
		check_ajax_referer( 'martincv_blog', 'nonce' );

		$search   = isset( $_POST['search'] ) ? sanitize_text_field( wp_unslash( $_POST['search'] ) ) : '';
		$category = isset( $_POST['category'] ) ? sanitize_title( wp_unslash( $_POST['category'] ) ) : '';
		$page     = isset( $_POST['page'] ) ? max( 1, absint( $_POST['page'] ) ) : 1;
		$exclude  = isset( $_POST['exclude'] ) ? absint( $_POST['exclude'] ) : 0;

		$posts_query = new \WP_Query( self::query_args( $search, $category, $page, $exclude ) );

		ob_start();

		while ( $posts_query->have_posts() ) :
			$posts_query->the_post();
			get_template_part( 'template-parts/blog-card' );
		endwhile;

		wp_reset_postdata();

		wp_send_json_success(
			array(
				'html'    => ob_get_clean(),
				'hasMore' => $page < (int) $posts_query->max_num_pages,
				'found'   => (int) $posts_query->found_posts,
			)
		);
	}

	/**
	 * Build the grid query args. Shared with the initial render in home.php
	 * so the first page and AJAX pages always agree.
	 *
	 * @param string $search   Search term.
	 * @param string $category Category slug.
	 * @param int    $page     Page number (1-based).
	 * @param int    $exclude  Post ID to exclude (the featured post).
	 *
	 * @return array
	 */
	public static function query_args( string $search, string $category, int $page, int $exclude ): array {
		$args = array(
			'post_type'           => 'post',
			'post_status'         => 'publish',
			'posts_per_page'      => self::POSTS_PER_PAGE,
			'paged'               => $page,
			'ignore_sticky_posts' => true,
		);

		if ( $exclude ) {
			$args['post__not_in'] = array( $exclude );
		}

		if ( $search ) {
			$args['s'] = $search;
		}

		if ( $category ) {
			$args['category_name'] = $category;
		}

		return $args;
	}
}
