<?php
/**
 * Single project (case study) template
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

	$martincv_terms    = get_the_terms( get_the_ID(), 'project_category' );
	$martincv_category = ( $martincv_terms && ! is_wp_error( $martincv_terms ) ) ? $martincv_terms[0]->name : '';
	$martincv_tech     = array_filter( array_map( 'trim', preg_split( '/\r\n|\r|\n/', (string) get_field( 'tech' ) ) ) );
	$martincv_stats    = Utility::rows( get_field( 'stats' ) );
	$martincv_approach = Utility::rows( get_field( 'approach' ) );

	// Next case study: following project by menu order, wrapping to the first.
	$martincv_all  = get_posts(
		array(
			'post_type'      => 'project',
			'posts_per_page' => -1,
			'orderby'        => array(
				'menu_order' => 'ASC',
				'date'       => 'DESC',
			),
			'fields'         => 'ids',
		)
	);
	$martincv_next = null;
	$martincv_pos  = array_search( get_the_ID(), $martincv_all, true );
	if ( false !== $martincv_pos && count( $martincv_all ) > 1 ) {
		$martincv_next = $martincv_all[ ( $martincv_pos + 1 ) % count( $martincv_all ) ];
	}
	?>
	<main class="wp-page-main">
		<article class="single-project">
			<div class="single-project__bg bg-dot-pattern" aria-hidden="true"></div>
			<div class="martincv-container single-project__container">
				<a href="<?php echo esc_url( get_post_type_archive_link( 'project' ) ); ?>" class="single-project__back">
					<?php Utility::icon( 'arrow-left', 16 ); ?>
					<?php esc_html_e( 'All projects', 'martincv' ); ?>
				</a>

				<header class="single-project__header">
					<div class="single-project__meta">
						<?php if ( $martincv_category ) : ?>
							<span class="pill single-project__pill--primary"><?php echo esc_html( $martincv_category ); ?></span>
						<?php endif; ?>
						<?php if ( get_field( 'client' ) ) : ?>
							<span><?php echo esc_html( (string) get_field( 'client' ) ); ?></span>
						<?php endif; ?>
						<?php if ( get_field( 'client' ) && get_field( 'year' ) ) : ?>
							<span>·</span>
						<?php endif; ?>
						<?php if ( get_field( 'year' ) ) : ?>
							<span><?php echo esc_html( (string) get_field( 'year' ) ); ?></span>
						<?php endif; ?>
					</div>
					<h1 class="single-project__title"><?php the_title(); ?></h1>
					<div class="single-project__header-row<?php echo has_post_thumbnail() ? ' single-project__header-row--has-thumb' : ''; ?>">
						<div class="single-project__header-main">
							<?php if ( get_field( 'short_description' ) ) : ?>
								<p class="single-project__intro"><?php echo esc_html( (string) get_field( 'short_description' ) ); ?></p>
							<?php endif; ?>
							<?php if ( get_field( 'project_link' ) ) : ?>
								<a href="<?php echo esc_url( (string) get_field( 'project_link' ) ); ?>" class="btn-hero single-project__live" target="_blank" rel="noopener noreferrer">
									<?php esc_html_e( 'View Live Project', 'martincv' ); ?>
									<?php Utility::icon( 'external-link', 16 ); ?>
								</a>
							<?php endif; ?>
						</div>
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="single-project__thumb">
								<?php the_post_thumbnail( 'medium_large' ); ?>
							</div>
						<?php endif; ?>
					</div>
				</header>

				<?php if ( get_field( 'role' ) || get_field( 'timeline' ) || get_field( 'services_provided' ) ) : ?>
					<div class="card-elegant single-project__facts">
						<?php if ( get_field( 'role' ) ) : ?>
							<div class="single-project__fact">
								<div class="eyebrow"><?php esc_html_e( 'Role', 'martincv' ); ?></div>
								<div class="single-project__fact-value"><?php echo esc_html( (string) get_field( 'role' ) ); ?></div>
							</div>
						<?php endif; ?>
						<?php if ( get_field( 'timeline' ) ) : ?>
							<div class="single-project__fact">
								<div class="eyebrow"><?php esc_html_e( 'Timeline', 'martincv' ); ?></div>
								<div class="single-project__fact-value"><?php echo esc_html( (string) get_field( 'timeline' ) ); ?></div>
							</div>
						<?php endif; ?>
						<?php if ( get_field( 'services_provided' ) ) : ?>
							<div class="single-project__fact">
								<div class="eyebrow"><?php esc_html_e( 'Services', 'martincv' ); ?></div>
								<div class="single-project__fact-value"><?php echo esc_html( (string) get_field( 'services_provided' ) ); ?></div>
							</div>
						<?php endif; ?>
					</div>
				<?php endif; ?>

				<?php if ( get_field( 'challenge' ) ) : ?>
					<section class="single-project__section">
						<h2 class="single-project__section-title"><?php esc_html_e( 'The challenge', 'martincv' ); ?></h2>
						<p class="single-project__challenge"><?php echo esc_html( (string) get_field( 'challenge' ) ); ?></p>
					</section>
				<?php endif; ?>

				<?php if ( $martincv_approach ) : ?>
					<section class="single-project__section">
						<h2 class="single-project__section-title"><?php esc_html_e( 'The approach', 'martincv' ); ?></h2>
						<div class="single-project__approach">
							<?php foreach ( $martincv_approach as $martincv_index => $martincv_step ) : ?>
								<div class="card-elegant single-project__step">
									<div class="single-project__step-inner">
										<span class="single-project__step-number"><?php echo esc_html( str_pad( (string) ( $martincv_index + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
										<div>
											<h3 class="single-project__step-title"><?php echo esc_html( $martincv_step['title'] ?? '' ); ?></h3>
											<p class="single-project__step-desc"><?php echo esc_html( $martincv_step['description'] ?? '' ); ?></p>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</section>
				<?php endif; ?>

				<?php $martincv_gallery = \MartinCV\Utility::rows( get_field( 'project_gallery' ) ); ?>
				<?php if ( $martincv_gallery ) : ?>
					<section class="single-project__section">
						<h2 class="single-project__section-title"><?php esc_html_e( 'Gallery', 'martincv' ); ?></h2>
						<div class="single-project__gallery">
							<?php foreach ( $martincv_gallery as $martincv_image_id ) : ?>
								<a
									href="<?php echo esc_url( (string) wp_get_attachment_image_url( (int) $martincv_image_id, 'full' ) ); ?>"
									class="single-project__gallery-item"
									target="_blank"
									rel="noopener noreferrer"
								>
									<?php echo wp_get_attachment_image( (int) $martincv_image_id, 'large' ); ?>
								</a>
							<?php endforeach; ?>
						</div>
					</section>
				<?php endif; ?>

				<?php if ( $martincv_stats ) : ?>
					<section class="single-project__section">
						<h2 class="single-project__section-title"><?php esc_html_e( 'The results', 'martincv' ); ?></h2>
						<div class="single-project__stats">
							<?php foreach ( $martincv_stats as $martincv_stat ) : ?>
								<div class="stat-tile">
									<div class="stat-tile__value"><?php echo esc_html( $martincv_stat['value'] ?? '' ); ?></div>
									<div class="stat-tile__label"><?php echo esc_html( $martincv_stat['label'] ?? '' ); ?></div>
								</div>
							<?php endforeach; ?>
						</div>
					</section>
				<?php endif; ?>

				<?php if ( $martincv_tech ) : ?>
					<section class="single-project__section">
						<h2 class="single-project__section-title"><?php esc_html_e( 'Tech stack', 'martincv' ); ?></h2>
						<div class="single-project__tech">
							<?php foreach ( $martincv_tech as $martincv_item ) : ?>
								<span class="pill"><?php echo esc_html( $martincv_item ); ?></span>
							<?php endforeach; ?>
						</div>
					</section>
				<?php endif; ?>

				<?php if ( get_field( 'quote' ) ) : ?>
					<blockquote class="card-elegant single-project__quote">
						<span class="single-project__quote-icon"><?php Utility::icon( 'quote', 28 ); ?></span>
						<p class="single-project__quote-text">&ldquo;<?php echo esc_html( (string) get_field( 'quote' ) ); ?>&rdquo;</p>
						<?php if ( get_field( 'quote_author' ) ) : ?>
							<footer class="single-project__quote-footer">
								<span class="single-project__quote-author"><?php echo esc_html( (string) get_field( 'quote_author' ) ); ?></span>
								<?php if ( get_field( 'quote_role' ) ) : ?>
									&mdash; <?php echo esc_html( (string) get_field( 'quote_role' ) ); ?>
								<?php endif; ?>
							</footer>
						<?php endif; ?>
					</blockquote>
				<?php endif; ?>

				<?php if ( $martincv_next ) : ?>
					<div class="single-project__next">
						<div class="eyebrow"><?php esc_html_e( 'Next case study', 'martincv' ); ?></div>
						<a class="single-project__next-link" href="<?php echo esc_url( get_permalink( $martincv_next ) ); ?>">
							<span class="single-project__next-title"><?php echo esc_html( get_the_title( $martincv_next ) ); ?></span>
							<span class="single-project__next-arrow"><?php Utility::icon( 'arrow-right', 22 ); ?></span>
						</a>
					</div>
				<?php endif; ?>
			</div>
		</article>
	</main>
	<?php
endwhile;

get_footer();
