<?php
/**
 * Blog Block
 *
 * @package MartinCV
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$blog_posts = new \WP_Query(
	array(
		'post_type'      => 'post',
		'posts_per_page' => 3,
		'post_status'    => 'publish',
	)
);

?>

<?php if ( $blog_posts->have_posts() ) : ?>
<section class="martincv-blog" id="blog">
	<h2><?php esc_html_e( 'Blog', 'martincv' ); ?></h2>
	<div class="martincv-blog__posts">
		<?php
		while ( $blog_posts->have_posts() ) :
			$blog_posts->the_post();
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
		wp_reset_postdata();
		?>
	</div>
	<a href="/blog/"><?php esc_html_e( 'View All', 'martincv' ); ?></a>
</section>
<?php endif; ?>
