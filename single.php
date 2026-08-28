<?php
/**
 * Single post template
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
	<?php
	while ( have_posts() ) :
		the_post();
		?>
		<article <?php post_class( 'single-post' ); ?>>
			<div class="martincv-container">
				<header class="single-post__header">
					<h1 class="single-post__title"><?php the_title(); ?></h1>
					<div class="single-post__meta">
						<span class="single-post__date"><?php echo esc_html( get_the_date() ); ?></span>
						<span class="single-post__reading-time">
							<?php
							printf(
								/* translators: %d: reading time in minutes */
								esc_html__( '%d min read', 'martincv' ),
								(int) MartinCV\Utility::get_reading_time( get_the_ID() )
							);
							?>
						</span>
					</div>
				</header>

				<?php if ( has_post_thumbnail() ) : ?>
					<div class="single-post__thumb">
						<?php the_post_thumbnail( 'large' ); ?>
					</div>
				<?php endif; ?>

				<div class="single-post__content">
					<?php the_content(); ?>
				</div>

				<nav class="single-post__nav" aria-label="<?php esc_attr_e( 'Post navigation', 'martincv' ); ?>">
					<div class="single-post__nav-prev">
						<?php previous_post_link( '%link', esc_html__( 'Previous post', 'martincv' ) ); ?>
					</div>
					<div class="single-post__nav-next">
						<?php next_post_link( '%link', esc_html__( 'Next post', 'martincv' ) ); ?>
					</div>
				</nav>
			</div>
		</article>
	<?php endwhile; ?>
</main>
<?php
get_footer();
