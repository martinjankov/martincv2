<?php
/**
 * Blog archive post card
 *
 * Rendered in the initial grid (home.php) and by the Blog_Posts AJAX handler.
 *
 * @package MartinCV
 */

use MartinCV\Utility;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$martincv_card_terms = get_the_category();
?>
<a class="blog-archive__card-link" href="<?php the_permalink(); ?>">
	<article class="card-elegant blog-archive__card">
		<div class="blog-archive__card-thumb">
			<?php if ( has_post_thumbnail() ) : ?>
				<?php the_post_thumbnail( 'medium_large' ); ?>
			<?php else : ?>
				<span><?php esc_html_e( 'Article Image', 'martincv' ); ?></span>
			<?php endif; ?>
		</div>
		<div class="blog-archive__meta">
			<?php if ( $martincv_card_terms ) : ?>
				<span class="blog-archive__meta-item">
					<?php Utility::icon( 'tag', 14 ); ?>
					<?php echo esc_html( $martincv_card_terms[0]->name ); ?>
				</span>
			<?php endif; ?>
			<span class="blog-archive__meta-item">
				<?php Utility::icon( 'clock', 14 ); ?>
				<?php
				/* translators: %d: estimated reading time in minutes. */
				printf( esc_html__( '%d min read', 'martincv' ), (int) Utility::get_reading_time( get_the_ID() ) );
				?>
			</span>
		</div>
		<h3 class="blog-archive__card-title"><?php the_title(); ?></h3>
		<p class="blog-archive__card-desc"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 20 ) ); ?></p>
		<div class="blog-archive__card-footer">
			<span class="blog-archive__meta-item">
				<?php Utility::icon( 'calendar', 14 ); ?>
				<?php echo esc_html( get_the_date( 'M j' ) ); ?>
			</span>
			<span class="blog-archive__more">
				<?php esc_html_e( 'Read More', 'martincv' ); ?>
				<?php Utility::icon( 'arrow-right', 16 ); ?>
			</span>
		</div>
	</article>
</a>
