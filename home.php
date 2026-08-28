<?php
/**
 * Blog posts index template
 *
 * @package MartinCV
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use MartinCV\Utility;
use MartinCV\Site_Options;
use MartinCV\AJAX\Blog_Posts;

get_header();

// Featured post: newest sticky, or the latest post as a fallback.
$martincv_sticky_ids    = array_map( 'absint', (array) get_option( 'sticky_posts' ) );
$martincv_featured_args = array(
	'post_type'           => 'post',
	'post_status'         => 'publish',
	'posts_per_page'      => 1,
	'ignore_sticky_posts' => true,
	'no_found_rows'       => true,
);

if ( $martincv_sticky_ids ) {
	$martincv_featured_args['post__in'] = $martincv_sticky_ids;
}

$martincv_featured_query = new WP_Query( $martincv_featured_args );
$martincv_featured       = $martincv_featured_query->posts ? $martincv_featured_query->posts[0] : null;
$martincv_featured_id    = $martincv_featured ? $martincv_featured->ID : 0;

// First page of the grid — same query the AJAX endpoint uses.
$martincv_grid_query = new WP_Query( Blog_Posts::query_args( '', '', 1, $martincv_featured_id ) );

$martincv_filter_terms = get_categories( array( 'hide_empty' => true ) );
?>
<main class="wp-page-main">
	<section class="blog-archive" data-exclude="<?php echo esc_attr( (string) $martincv_featured_id ); ?>">
	<div class="blog-archive__bg bg-dot-pattern" aria-hidden="true"></div>
	<div class="martincv-container martincv-container--wide blog-archive__container">
		<div class="blog-archive__header">
			<p class="eyebrow blog-archive__eyebrow"><?php esc_html_e( 'Insights & Expertise', 'martincv' ); ?></p>
			<h1 class="blog-archive__title gradient-text">
				<?php
				$martincv_title = trim( Site_Options::get_blog_title() . ' ' . Site_Options::get_blog_title_highlight() );
				echo esc_html( $martincv_title ? $martincv_title : __( 'Blog & Articles', 'martincv' ) );
				?>
			</h1>
			<p class="blog-archive__intro">
				<?php echo esc_html( Site_Options::get_blog_intro() ? Site_Options::get_blog_intro() : __( 'Sharing knowledge about web development, WordPress, and modern technologies to help developers and businesses succeed online.', 'martincv' ) ); ?>
			</p>
		</div>

		<div class="blog-archive__search-row">
			<?php if ( $martincv_filter_terms ) : ?>
				<button type="button" class="blog-archive__filter-toggle" aria-label="<?php esc_attr_e( 'Filter articles', 'martincv' ); ?>" aria-expanded="false">
					<?php Utility::icon( 'filter', 18 ); ?>
				</button>
			<?php endif; ?>
			<div class="blog-archive__search">
				<span class="blog-archive__search-icon"><?php Utility::icon( 'search', 20 ); ?></span>
				<span class="blog-archive__search-spinner" aria-hidden="true"></span>
				<input
					type="search"
					class="blog-archive__search-input"
					placeholder="<?php esc_attr_e( 'Search articles by title, topic, or keyword...', 'martincv' ); ?>"
					aria-label="<?php esc_attr_e( 'Search articles', 'martincv' ); ?>"
				>
			</div>
		</div>

		<?php if ( $martincv_filter_terms ) : ?>
			<div class="blog-archive__filters-backdrop" aria-hidden="true"></div>
			<div class="blog-archive__filters">
				<p class="blog-archive__filters-title"><?php esc_html_e( 'Filter by category', 'martincv' ); ?></p>
				<button type="button" class="blog-archive__filter is-active" data-filter=""><?php esc_html_e( 'All', 'martincv' ); ?></button>
				<?php foreach ( $martincv_filter_terms as $martincv_term ) : ?>
					<button type="button" class="blog-archive__filter" data-filter="<?php echo esc_attr( $martincv_term->slug ); ?>"><?php echo esc_html( $martincv_term->name ); ?></button>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<div class="blog-archive__list">
			<?php
			if ( $martincv_featured ) :
				$martincv_terms = get_the_category( $martincv_featured->ID );
				?>
				<a class="blog-archive__featured-link" href="<?php echo esc_url( get_permalink( $martincv_featured ) ); ?>">
					<article class="card-elegant blog-archive__featured">
						<div class="blog-archive__featured-grid">
							<div class="blog-archive__featured-main">
								<div class="blog-archive__meta">
									<span class="blog-archive__badge"><?php esc_html_e( 'Featured', 'martincv' ); ?></span>
									<?php if ( $martincv_terms ) : ?>
										<span class="blog-archive__meta-item">
											<?php Utility::icon( 'tag', 16 ); ?>
											<?php echo esc_html( $martincv_terms[0]->name ); ?>
										</span>
									<?php endif; ?>
								</div>
								<h2 class="blog-archive__featured-title"><?php echo esc_html( get_the_title( $martincv_featured ) ); ?></h2>
								<p class="blog-archive__featured-desc"><?php echo esc_html( wp_trim_words( get_the_excerpt( $martincv_featured ), 30 ) ); ?></p>
								<div class="blog-archive__featured-footer">
									<div class="blog-archive__meta">
										<span class="blog-archive__meta-item">
											<?php Utility::icon( 'calendar', 16 ); ?>
											<?php echo esc_html( get_the_date( '', $martincv_featured ) ); ?>
										</span>
										<span class="blog-archive__meta-item">
											<?php Utility::icon( 'clock', 16 ); ?>
											<?php
											/* translators: %d: estimated reading time in minutes. */
											printf( esc_html__( '%d min read', 'martincv' ), (int) Utility::get_reading_time( $martincv_featured->ID ) );
											?>
										</span>
									</div>
									<span class="blog-archive__cta">
										<?php esc_html_e( 'Read Article', 'martincv' ); ?>
										<?php Utility::icon( 'arrow-right', 18 ); ?>
									</span>
								</div>
							</div>
							<div class="blog-archive__featured-thumb">
								<?php if ( has_post_thumbnail( $martincv_featured ) ) : ?>
									<?php echo get_the_post_thumbnail( $martincv_featured, 'large' ); ?>
								<?php else : ?>
									<span><?php esc_html_e( 'Featured Article', 'martincv' ); ?></span>
								<?php endif; ?>
							</div>
						</div>
					</article>
				</a>
			<?php endif; ?>

			<div class="blog-archive__grid">
				<?php
				while ( $martincv_grid_query->have_posts() ) :
					$martincv_grid_query->the_post();
					get_template_part( 'template-parts/blog-card' );
				endwhile;
				wp_reset_postdata();
				?>
			</div>
		</div>

		<p class="blog-archive__empty" <?php echo ( $martincv_featured || $martincv_grid_query->post_count > 0 ) ? 'hidden' : ''; ?>>
			<?php esc_html_e( 'No articles matched your search. Try a different keyword or category.', 'martincv' ); ?>
		</p>

		<div class="blog-archive__actions">
			<button type="button" class="btn-secondary blog-archive__load-more" <?php echo $martincv_grid_query->max_num_pages > 1 ? '' : 'hidden'; ?>>
				<?php esc_html_e( 'Load More Articles', 'martincv' ); ?>
				<?php Utility::icon( 'arrow-right', 18 ); ?>
			</button>
		</div>
	</div>
	</section>
</main>
<?php
get_footer();
