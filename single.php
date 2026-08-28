<?php
/**
 * Single post template
 *
 * @package MartinCV
 */

use MartinCV\Utility;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$martincv_blog_page = (int) get_option( 'page_for_posts' );
$martincv_blog_url  = $martincv_blog_page ? get_permalink( $martincv_blog_page ) : home_url( '/' );
?>
<main class="wp-page-main">
	<?php
	while ( have_posts() ) :
		the_post();

		$martincv_categories  = get_the_category();
		$martincv_share_url   = get_permalink();
		$martincv_share_title = get_the_title();
		$martincv_prev_post   = get_previous_post();
		$martincv_next_post   = get_next_post();

		$martincv_share_links = array(
			array(
				'label' => __( 'Share on X', 'martincv' ),
				'url'   => 'https://twitter.com/intent/tweet?url=' . rawurlencode( $martincv_share_url ) . '&text=' . rawurlencode( $martincv_share_title ),
				'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"></path></svg>',
			),
			array(
				'label' => __( 'Share on LinkedIn', 'martincv' ),
				'url'   => 'https://www.linkedin.com/sharing/share-offsite/?url=' . rawurlencode( $martincv_share_url ),
				'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect width="4" height="12" x="2" y="9"></rect><circle cx="4" cy="4" r="2"></circle></svg>',
			),
			array(
				'label' => __( 'Share on Facebook', 'martincv' ),
				'url'   => 'https://www.facebook.com/sharer/sharer.php?u=' . rawurlencode( $martincv_share_url ),
				'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>',
			),
			array(
				'label' => __( 'Share on WhatsApp', 'martincv' ),
				'url'   => 'https://wa.me/?text=' . rawurlencode( $martincv_share_title . ' ' . $martincv_share_url ),
				'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.885-9.885 9.885m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"></path></svg>',
			),
		);
		?>
		<article <?php post_class( 'single-post' ); ?>>
			<div class="martincv-container single-post__container">
				<a href="<?php echo esc_url( $martincv_blog_url ); ?>" class="single-post__back">
					<?php Utility::icon( 'arrow-left', 16 ); ?>
					<?php esc_html_e( 'Back to Blog', 'martincv' ); ?>
				</a>

				<header class="single-post__header">
					<div class="single-post__meta">
						<?php if ( $martincv_categories ) : ?>
							<span class="single-post__meta-item">
								<?php Utility::icon( 'tag', 14 ); ?>
								<?php echo esc_html( $martincv_categories[0]->name ); ?>
							</span>
						<?php endif; ?>
						<span class="single-post__meta-item">
							<?php Utility::icon( 'calendar', 14 ); ?>
							<?php echo esc_html( get_the_date() ); ?>
						</span>
						<span class="single-post__meta-item">
							<?php Utility::icon( 'clock', 14 ); ?>
							<?php
							/* translators: %d: estimated reading time in minutes. */
							printf( esc_html__( '%d min read', 'martincv' ), (int) Utility::get_reading_time( get_the_ID() ) );
							?>
						</span>
					</div>

					<h1 class="single-post__title"><?php the_title(); ?></h1>

					<div class="single-post__author">
						<?php Utility::icon( 'user', 16 ); ?>
						<?php
						/* translators: %s: post author display name. */
						printf( esc_html__( 'By %s', 'martincv' ), esc_html( get_the_author() ) );
						?>
					</div>
				</header>

				<div class="single-post__thumb">
					<?php if ( has_post_thumbnail() ) : ?>
						<?php the_post_thumbnail( 'large' ); ?>
					<?php else : ?>
						<span><?php esc_html_e( 'Article Image', 'martincv' ); ?></span>
					<?php endif; ?>
				</div>

				<div class="single-post__body">
					<div class="single-post__content">
						<?php the_content(); ?>
					</div>

					<div class="single-post__share">
						<span class="single-post__share-label">
							<?php Utility::icon( 'share-2', 14 ); ?>
							<?php esc_html_e( 'Share this article', 'martincv' ); ?>
						</span>
						<div class="single-post__share-buttons">
							<?php foreach ( $martincv_share_links as $martincv_share ) : ?>
								<a
									class="single-post__share-button"
									href="<?php echo esc_url( $martincv_share['url'] ); ?>"
									target="_blank"
									rel="noopener noreferrer"
									aria-label="<?php echo esc_attr( $martincv_share['label'] ); ?>"
								>
									<?php echo wp_kses( $martincv_share['icon'], \MartinCV\Core\Theme::kses_svg() ); ?>
								</a>
							<?php endforeach; ?>
							<button
								type="button"
								class="single-post__share-button"
								data-share-copy
								data-url="<?php echo esc_url( $martincv_share_url ); ?>"
								aria-label="<?php esc_attr_e( 'Copy link', 'martincv' ); ?>"
							>
								<span class="single-post__share-icon--link"><?php Utility::icon( 'link', 16 ); ?></span>
								<span class="single-post__share-icon--check"><?php Utility::icon( 'check', 16 ); ?></span>
							</button>
						</div>
					</div>
				</div>

				<?php if ( $martincv_prev_post || $martincv_next_post ) : ?>
					<nav class="single-post__nav" aria-label="<?php esc_attr_e( 'Post navigation', 'martincv' ); ?>">
						<?php if ( $martincv_prev_post ) : ?>
							<a class="single-post__nav-card" href="<?php echo esc_url( get_permalink( $martincv_prev_post ) ); ?>">
								<span class="single-post__nav-label"><?php esc_html_e( 'Previous article', 'martincv' ); ?></span>
								<span class="single-post__nav-title"><?php echo esc_html( get_the_title( $martincv_prev_post ) ); ?></span>
								<span class="single-post__nav-more">
									<?php Utility::icon( 'arrow-left', 16 ); ?>
									<?php esc_html_e( 'Read previous', 'martincv' ); ?>
								</span>
							</a>
						<?php endif; ?>
						<?php if ( $martincv_next_post ) : ?>
							<a class="single-post__nav-card single-post__nav-card--next" href="<?php echo esc_url( get_permalink( $martincv_next_post ) ); ?>">
								<span class="single-post__nav-label"><?php esc_html_e( 'Next article', 'martincv' ); ?></span>
								<span class="single-post__nav-title"><?php echo esc_html( get_the_title( $martincv_next_post ) ); ?></span>
								<span class="single-post__nav-more">
									<?php esc_html_e( 'Read next', 'martincv' ); ?>
									<?php Utility::icon( 'arrow-right', 16 ); ?>
								</span>
							</a>
						<?php endif; ?>
					</nav>
				<?php endif; ?>

				<div class="single-post__cta">
					<h2 class="single-post__cta-title"><?php esc_html_e( 'Enjoyed this article?', 'martincv' ); ?></h2>
					<p class="single-post__cta-text"><?php esc_html_e( 'Check out more articles on web development, WordPress, and modern technologies.', 'martincv' ); ?></p>
					<a class="btn-secondary" href="<?php echo esc_url( $martincv_blog_url ); ?>"><?php esc_html_e( 'View All Articles', 'martincv' ); ?></a>
				</div>
			</div>
		</article>
	<?php endwhile; ?>
</main>
<?php
get_footer();
