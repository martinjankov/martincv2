<?php
/**
 * Services archive template
 *
 * @package MartinCV
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use MartinCV\Utility;
use MartinCV\Site_Options;

get_header();

$martincv_title    = Site_Options::get_services_title();
$martincv_intro    = Site_Options::get_services_intro();
$martincv_services = new WP_Query(
	array(
		'post_type'      => 'service',
		'posts_per_page' => -1,
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
		'no_found_rows'  => true,
	)
);
?>
<main class="wp-page-main services-archive">
	<div class="martincv-container">
		<header class="services-archive__header">
			<p class="eyebrow"><?php esc_html_e( 'Services', 'martincv' ); ?></p>
			<h1 class="services-archive__title"><?php echo esc_html( $martincv_title ? $martincv_title : post_type_archive_title( '', false ) ); ?></h1>
			<?php if ( $martincv_intro ) : ?>
				<p class="services-archive__intro"><?php echo esc_html( $martincv_intro ); ?></p>
			<?php endif; ?>
		</header>

		<?php if ( $martincv_services->have_posts() ) : ?>
			<div class="services-archive__grid">
				<?php
				while ( $martincv_services->have_posts() ) :
					$martincv_services->the_post();
					$martincv_tags = array_filter( array_map( 'trim', preg_split( '/\r\n|\r|\n/', (string) get_field( 'tags' ) ) ) );
					?>
					<article class="services-archive__card">
						<div class="services-archive__card-icon">
							<?php Utility::icon( (string) ( get_field( 'icon' ) ? get_field( 'icon' ) : 'code' ), 22 ); ?>
						</div>
						<h2 class="services-archive__card-title"><?php the_title(); ?></h2>
						<?php if ( get_field( 'short_description' ) ) : ?>
							<p class="services-archive__card-desc"><?php echo esc_html( (string) get_field( 'short_description' ) ); ?></p>
						<?php endif; ?>
						<?php if ( $martincv_tags ) : ?>
							<ul class="services-archive__tags">
								<?php foreach ( $martincv_tags as $martincv_tag ) : ?>
									<li class="services-archive__tag"><?php echo esc_html( $martincv_tag ); ?></li>
								<?php endforeach; ?>
							</ul>
						<?php endif; ?>
						<a href="<?php the_permalink(); ?>" class="services-archive__card-link">
							<?php esc_html_e( 'Learn more', 'martincv' ); ?>
							<?php Utility::icon( 'arrow-up-right', 15 ); ?>
						</a>
					</article>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			</div>
		<?php endif; ?>

		<?php if ( Site_Options::get_services_cta_title() ) : ?>
			<div class="card-elegant services-archive__cta">
				<h3 class="services-archive__cta-title"><?php echo esc_html( Site_Options::get_services_cta_title() ); ?></h3>
				<?php if ( Site_Options::get_services_cta_text() ) : ?>
					<p class="services-archive__cta-text"><?php echo esc_html( Site_Options::get_services_cta_text() ); ?></p>
				<?php endif; ?>
				<?php if ( Site_Options::get_services_cta_btn_text() ) : ?>
					<a href="<?php echo esc_url( Site_Options::get_services_cta_btn_link() ); ?>" class="btn-hero services-archive__cta-btn">
						<?php echo esc_html( Site_Options::get_services_cta_btn_text() ); ?>
					</a>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	</div>
</main>
<?php
get_footer();
