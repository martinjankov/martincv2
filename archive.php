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
<main id="martincv-archive" class="martincv-archive">
	<section class="martincv-archive__heading">
		<h1><?php the_archive_title(); ?></h1>
	</section>
	<section class="martincv-blog">
		<div class="martincv-blog__posts">
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<article>
					<?php if ( has_post_thumbnail() ) : ?>
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail( 'large' ); ?>
						</a>
					<?php endif; ?>
					<div class="marticv-blog__meta">
						<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<div class="martincv-blog__excerpt"><a href="<?php the_permalink(); ?>"><?php the_excerpt(); ?></a></div>
					</div>
				</article>
				<?php
			endwhile;
			?>
		</div>
		<?php if ( $wp_query->found_posts > 9 ) : ?>
			<a href="javascript:void(0)"><?php esc_html_e( 'Load More', 'martincv' ); ?></a>
		<?php endif; ?>
	</section>
</main>
<?php
get_footer();
