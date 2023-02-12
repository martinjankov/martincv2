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

$query_args = array(
	'post_type'      => 'post',
	'posts_per_page' => (int) $posts_per_page,
	'post_status'    => 'publish',
);

$blog_section_title = __( 'Blog', 'martincv' );

if ( is_singular( 'post' ) ) {
	$query_args['orderby']      = 'rand';
	$query_args['post__not_in'] = array( get_the_ID() );
	$blog_section_title         = __( 'You Might Be Interested In', 'martincv' );
}

$blog_posts = new \WP_Query( $query_args );

?>

<?php if ( $blog_posts->have_posts() ) : ?>
<section class="martincv-blog" id="blog">
	<?php if ( ! get_field( 'hide_section_title' ) || is_singular( 'post' ) ) : ?>
		<h2><?php echo esc_html( $blog_section_title ); ?></h2>
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
	<?php if ( ! is_singular( 'post' ) ) : ?>
		<?php if ( ! get_field( 'hide_view_more_button' ) ) : ?>
		<a href="/blog/"><?php esc_html_e( 'View All', 'martincv' ); ?></a>
		<?php endif; ?>
		<?php if ( get_field( 'show_load_more_button' ) && $blog_posts->found_posts > $posts_per_page ) : ?>
			<a href="javascript:void(0)"><?php esc_html_e( 'Load More', 'martincv' ); ?></a>
		<?php endif; ?>
	<?php endif; ?>
</section>
<?php endif; ?>
