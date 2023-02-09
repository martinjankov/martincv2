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

$posts_per_page = get_field( 'number_of_blog_posts' );

if ( empty( $posts_per_page ) ) {
	$posts_per_page = 3;
}

$blog_posts = new \WP_Query(
	array(
		'post_type'      => 'post',
		'posts_per_page' => (int) $posts_per_page,
		'post_status'    => 'publish',
	)
);

?>

<?php if ( $blog_posts->have_posts() ) : ?>
<section class="martincv-blog" id="blog">
	<?php if ( ! get_field( 'hide_section_title' ) ) : ?>
		<h2><?php esc_html_e( 'Blog', 'martincv' ); ?></h2>
	<?php endif; ?>
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
	<?php if ( ! get_field( 'hide_view_more_button' ) ) : ?>
	<a href="/blog/"><?php esc_html_e( 'View All', 'martincv' ); ?></a>
	<?php endif; ?>
	<?php if ( get_field( 'show_load_more_button' ) && $blog_posts->found_posts > $posts_per_page ) : ?>
		<a href="javascript:void(0)"><?php esc_html_e( 'Load More', 'martincv' ); ?></a>
	<?php endif; ?>
</section>
<?php endif; ?>
