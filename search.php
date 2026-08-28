<?php
/**
 * Search results template
 *
 * @package MartinCV
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>
<main class="wp-page-main">
	<section class="archive-page archive-page--search">
		<div class="martincv-container">
			<header class="archive-page__header">
				<h1 class="archive-page__title">
					<?php
					printf(
						/* translators: %s: search query */
						esc_html__( 'Search results for: %s', 'martincv' ),
						'<span>' . esc_html( get_search_query() ) . '</span>'
					);
					?>
				</h1>
				<?php get_search_form(); ?>
			</header>

			<?php if ( have_posts() ) : ?>
				<div class="archive-page__grid">
					<?php
					while ( have_posts() ) :
						the_post();
						?>
						<article <?php post_class( 'post-card' ); ?>>
							<div class="post-card__body">
								<p class="post-card__date"><?php echo esc_html( get_the_date() ); ?></p>
								<h2 class="post-card__title">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h2>
								<div class="post-card__excerpt">
									<?php the_excerpt(); ?>
								</div>
							</div>
						</article>
					<?php endwhile; ?>
				</div>

				<?php
				the_posts_pagination(
					array(
						'prev_text' => esc_html__( 'Previous', 'martincv' ),
						'next_text' => esc_html__( 'Next', 'martincv' ),
					)
				);
				?>
			<?php else : ?>
				<p class="archive-page__empty"><?php esc_html_e( 'Nothing found. Try a different search.', 'martincv' ); ?></p>
			<?php endif; ?>
		</div>
	</section>
</main>
<?php
get_footer();
