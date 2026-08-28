<?php
/**
 * Archive template
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
	<section class="archive-page">
		<div class="martincv-container">
			<header class="archive-page__header">
				<h1 class="archive-page__title"><?php the_archive_title(); ?></h1>
				<?php the_archive_description( '<div class="archive-page__description">', '</div>' ); ?>
			</header>

			<?php if ( have_posts() ) : ?>
				<div class="archive-page__grid">
					<?php
					while ( have_posts() ) :
						the_post();
						?>
						<article <?php post_class( 'post-card' ); ?>>
							<?php if ( has_post_thumbnail() ) : ?>
								<a href="<?php the_permalink(); ?>" class="post-card__thumb">
									<?php the_post_thumbnail( 'medium_large' ); ?>
								</a>
							<?php endif; ?>
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
				<p class="archive-page__empty"><?php esc_html_e( 'No posts found.', 'martincv' ); ?></p>
			<?php endif; ?>
		</div>
	</section>
</main>
<?php
get_footer();
