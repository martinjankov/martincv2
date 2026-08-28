<?php
/**
 * Single service (case study) template
 *
 * @package MartinCV
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use MartinCV\Utility;

get_header();

while ( have_posts() ) :
	the_post();

	$martincv_tags  = array_filter( array_map( 'trim', preg_split( '/\r\n|\r|\n/', (string) get_field( 'tags' ) ) ) );
	$martincv_who   = (array) get_field( 'who_items' );
	$martincv_gets  = (array) get_field( 'benefits' );
	$martincv_steps = (array) get_field( 'steps' );
	$martincv_faqs  = (array) get_field( 'faqs' );

	$martincv_others = new WP_Query(
		array(
			'post_type'      => 'service',
			'posts_per_page' => 3,
			'post__not_in'   => array( get_the_ID() ),
			'orderby'        => 'menu_order',
			'order'          => 'ASC',
			'no_found_rows'  => true,
		)
	);
	?>
	<main class="wp-page-main single-service">
		<div class="martincv-container single-service__container">
			<a href="<?php echo esc_url( get_post_type_archive_link( 'service' ) ); ?>" class="single-service__back">
				<?php Utility::icon( 'arrow-left', 14 ); ?>
				<?php esc_html_e( 'All services', 'martincv' ); ?>
			</a>

			<div class="single-service__hero">
				<div class="single-service__hero-main">
					<div class="single-service__icon">
						<?php Utility::icon( (string) ( get_field( 'icon' ) ? get_field( 'icon' ) : 'code' ), 24 ); ?>
					</div>
					<?php if ( get_field( 'tagline' ) ) : ?>
						<p class="eyebrow single-service__tagline"><?php echo esc_html( (string) get_field( 'tagline' ) ); ?></p>
					<?php endif; ?>
					<h1 class="single-service__title"><?php the_title(); ?></h1>
					<?php if ( get_field( 'intro' ) ) : ?>
						<p class="single-service__intro"><?php echo esc_html( (string) get_field( 'intro' ) ); ?></p>
					<?php endif; ?>
					<?php if ( $martincv_tags ) : ?>
						<ul class="single-service__tags">
							<?php foreach ( $martincv_tags as $martincv_tag ) : ?>
								<li class="single-service__tag"><?php echo esc_html( $martincv_tag ); ?></li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				</div>

				<?php if ( get_field( 'timeline' ) || get_field( 'investment' ) || get_field( 'quote_btn_text' ) ) : ?>
					<aside class="card-elegant single-service__meta">
						<?php if ( get_field( 'timeline' ) ) : ?>
							<div class="single-service__meta-row">
								<p class="single-service__meta-label"><?php esc_html_e( 'Typical timeline', 'martincv' ); ?></p>
								<p class="single-service__meta-value"><?php echo esc_html( (string) get_field( 'timeline' ) ); ?></p>
							</div>
						<?php endif; ?>
						<?php if ( get_field( 'investment' ) ) : ?>
							<div class="single-service__meta-row">
								<p class="single-service__meta-label"><?php esc_html_e( 'Investment', 'martincv' ); ?></p>
								<p class="single-service__meta-value"><?php echo esc_html( (string) get_field( 'investment' ) ); ?></p>
							</div>
						<?php endif; ?>
						<?php if ( get_field( 'quote_btn_text' ) ) : ?>
							<a href="<?php echo esc_url( (string) get_field( 'quote_btn_link' ) ? (string) get_field( 'quote_btn_link' ) : '/#contact' ); ?>" class="btn-hero single-service__meta-btn">
								<?php echo esc_html( (string) get_field( 'quote_btn_text' ) ); ?>
							</a>
						<?php endif; ?>
					</aside>
				<?php endif; ?>
			</div>

			<?php if ( $martincv_who || $martincv_gets ) : ?>
				<div class="single-service__columns">
					<?php if ( $martincv_who ) : ?>
						<div class="single-service__panel">
							<h2 class="single-service__panel-title"><?php esc_html_e( 'Who this is for', 'martincv' ); ?></h2>
							<ul class="single-service__checklist">
								<?php foreach ( $martincv_who as $martincv_item ) : ?>
									<li><?php echo esc_html( $martincv_item['text'] ?? '' ); ?></li>
								<?php endforeach; ?>
							</ul>
						</div>
					<?php endif; ?>
					<?php if ( $martincv_gets ) : ?>
						<div class="single-service__panel">
							<h2 class="single-service__panel-title"><?php esc_html_e( 'What you get', 'martincv' ); ?></h2>
							<ul class="single-service__checklist">
								<?php foreach ( $martincv_gets as $martincv_item ) : ?>
									<li><?php echo esc_html( $martincv_item['text'] ?? '' ); ?></li>
								<?php endforeach; ?>
							</ul>
						</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>

			<?php if ( $martincv_steps ) : ?>
				<div class="single-service__steps">
					<p class="eyebrow"><?php esc_html_e( 'Step by step', 'martincv' ); ?></p>
					<h2 class="single-service__section-title"><?php esc_html_e( 'How this service works', 'martincv' ); ?></h2>
					<div class="single-service__steps-list">
						<?php foreach ( $martincv_steps as $martincv_index => $martincv_step ) : ?>
							<div class="single-service__step">
								<span class="single-service__step-number"><?php echo esc_html( str_pad( (string) ( $martincv_index + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
								<div class="single-service__step-body">
									<h3 class="single-service__step-title"><?php echo esc_html( $martincv_step['title'] ?? '' ); ?></h3>
									<p class="single-service__step-desc"><?php echo esc_html( $martincv_step['description'] ?? '' ); ?></p>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			<?php endif; ?>

			<?php if ( $martincv_faqs ) : ?>
				<div class="single-service__faqs">
					<h2 class="single-service__section-title"><?php esc_html_e( 'Common questions', 'martincv' ); ?></h2>
					<div class="single-service__faqs-list">
						<?php foreach ( $martincv_faqs as $martincv_faq ) : ?>
							<div class="single-service__faq">
								<h3 class="single-service__faq-question"><?php echo esc_html( $martincv_faq['question'] ?? '' ); ?></h3>
								<p class="single-service__faq-answer"><?php echo esc_html( $martincv_faq['answer'] ?? '' ); ?></p>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			<?php endif; ?>

			<?php if ( $martincv_others->have_posts() ) : ?>
				<div class="single-service__others">
					<h2 class="single-service__section-title"><?php esc_html_e( 'Other services', 'martincv' ); ?></h2>
					<div class="single-service__others-grid">
						<?php
						while ( $martincv_others->have_posts() ) :
							$martincv_others->the_post();
							?>
							<a href="<?php the_permalink(); ?>" class="single-service__other">
								<span class="single-service__other-icon"><?php Utility::icon( (string) ( get_field( 'icon' ) ? get_field( 'icon' ) : 'code' ), 18 ); ?></span>
								<span class="single-service__other-title"><?php the_title(); ?></span>
								<?php if ( get_field( 'short_description' ) ) : ?>
									<span class="single-service__other-desc"><?php echo esc_html( (string) get_field( 'short_description' ) ); ?></span>
								<?php endif; ?>
							</a>
						<?php endwhile; ?>
						<?php wp_reset_postdata(); ?>
					</div>
				</div>
			<?php endif; ?>

			<?php if ( get_field( 'cta_title' ) ) : ?>
				<div class="card-elegant single-service__cta">
					<h2 class="single-service__cta-title"><?php echo esc_html( (string) get_field( 'cta_title' ) ); ?></h2>
					<?php if ( get_field( 'cta_text' ) ) : ?>
						<p class="single-service__cta-text"><?php echo esc_html( (string) get_field( 'cta_text' ) ); ?></p>
					<?php endif; ?>
					<?php if ( get_field( 'cta_btn_text' ) ) : ?>
						<a href="<?php echo esc_url( (string) get_field( 'cta_btn_link' ) ? (string) get_field( 'cta_btn_link' ) : '/#contact' ); ?>" class="btn-hero single-service__cta-btn">
							<?php echo esc_html( (string) get_field( 'cta_btn_text' ) ); ?>
							<span class="single-service__cta-icon"><?php Utility::icon( 'arrow-right', 16 ); ?></span>
						</a>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>
	</main>
	<?php
endwhile;

get_footer();
