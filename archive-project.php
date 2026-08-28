<?php
/**
 * Projects archive template
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

/**
 * Get a project's category term slugs/names.
 *
 * @param int $post_id Project ID.
 * @return array{slugs: string, name: string}
 */
function martincv_project_terms( int $post_id ): array {
	$terms = get_the_terms( $post_id, 'project_category' );

	if ( ! $terms || is_wp_error( $terms ) ) {
		return array(
			'slugs' => '',
			'name'  => '',
		);
	}

	return array(
		'slugs' => implode( ' ', wp_list_pluck( $terms, 'slug' ) ),
		'name'  => $terms[0]->name,
	);
}

/**
 * Split the tech textarea into an array.
 *
 * @param int $post_id Project ID.
 * @return array
 */
function martincv_project_tech( int $post_id ): array {
	return array_filter( array_map( 'trim', preg_split( '/\r\n|\r|\n/', (string) get_field( 'tech', $post_id ) ) ) );
}

$martincv_query = new WP_Query(
	array(
		'post_type'      => 'project',
		'posts_per_page' => -1,
		'orderby'        => array(
			'menu_order' => 'ASC',
			'date'       => 'DESC',
		),
		'no_found_rows'  => true,
	)
);

$martincv_featured = null;
$martincv_rest     = array();

foreach ( $martincv_query->posts as $martincv_project ) {
	if ( null === $martincv_featured && get_field( 'featured', $martincv_project->ID ) ) {
		$martincv_featured = $martincv_project;
	} else {
		$martincv_rest[] = $martincv_project;
	}
}

$martincv_filter_terms = get_terms(
	array(
		'taxonomy'   => 'project_category',
		'hide_empty' => true,
	)
);
?>
<main class="wp-page-main projects-archive">
	<div class="projects-archive__bg bg-dot-pattern" aria-hidden="true"></div>
	<div class="martincv-container martincv-container--wide projects-archive__container">
		<div class="projects-archive__header">
			<p class="eyebrow"><?php esc_html_e( 'Selected work', 'martincv' ); ?></p>
			<h1 class="projects-archive__title">
				<?php echo esc_html( Site_Options::get_projects_title() ? Site_Options::get_projects_title() : __( 'Projects &', 'martincv' ) ); ?>
				<?php if ( Site_Options::get_projects_title_highlight() ) : ?>
					<span class="gradient-text"><?php echo esc_html( Site_Options::get_projects_title_highlight() ); ?></span>
				<?php endif; ?>
			</h1>
			<?php if ( Site_Options::get_projects_intro() ) : ?>
				<p class="projects-archive__intro"><?php echo esc_html( Site_Options::get_projects_intro() ); ?></p>
			<?php endif; ?>
		</div>

		<?php if ( $martincv_filter_terms && ! is_wp_error( $martincv_filter_terms ) ) : ?>
			<div class="projects-archive__filters">
				<button type="button" class="projects-archive__filter is-active" data-filter="all"><?php esc_html_e( 'All', 'martincv' ); ?></button>
				<?php foreach ( $martincv_filter_terms as $martincv_term ) : ?>
					<button type="button" class="projects-archive__filter" data-filter="<?php echo esc_attr( $martincv_term->slug ); ?>"><?php echo esc_html( $martincv_term->name ); ?></button>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<div class="projects-archive__list">
			<?php
			if ( $martincv_featured ) :
				$martincv_terms = martincv_project_terms( $martincv_featured->ID );
				$martincv_stats = (array) get_field( 'stats', $martincv_featured->ID );
				?>
				<a class="projects-archive__featured-link" href="<?php echo esc_url( get_permalink( $martincv_featured ) ); ?>" data-categories="<?php echo esc_attr( $martincv_terms['slugs'] ); ?>">
					<article class="card-elegant projects-archive__featured">
						<div class="projects-archive__featured-grid">
							<div class="projects-archive__featured-main">
								<div class="projects-archive__meta">
									<span class="pill projects-archive__pill--primary"><?php esc_html_e( 'Featured', 'martincv' ); ?></span>
									<?php if ( $martincv_terms['name'] ) : ?>
										<span><?php echo esc_html( $martincv_terms['name'] ); ?></span>
									<?php endif; ?>
									<?php if ( get_field( 'year', $martincv_featured->ID ) ) : ?>
										<span class="projects-archive__meta-year">
											<?php Utility::icon( 'calendar', 14 ); ?>
											<?php echo esc_html( (string) get_field( 'year', $martincv_featured->ID ) ); ?>
										</span>
									<?php endif; ?>
								</div>
								<h2 class="projects-archive__featured-title"><?php echo esc_html( get_the_title( $martincv_featured ) ); ?></h2>
								<?php if ( get_field( 'short_description', $martincv_featured->ID ) ) : ?>
									<p class="projects-archive__featured-desc"><?php echo esc_html( (string) get_field( 'short_description', $martincv_featured->ID ) ); ?></p>
								<?php endif; ?>
								<?php $martincv_tech = martincv_project_tech( $martincv_featured->ID ); ?>
								<?php if ( $martincv_tech ) : ?>
									<div class="projects-archive__tech">
										<?php foreach ( $martincv_tech as $martincv_item ) : ?>
											<span class="pill"><?php echo esc_html( $martincv_item ); ?></span>
										<?php endforeach; ?>
									</div>
								<?php endif; ?>
								<span class="projects-archive__featured-cta">
									<?php esc_html_e( 'Read the case study', 'martincv' ); ?>
									<?php Utility::icon( 'arrow-right', 18 ); ?>
								</span>
							</div>
							<?php if ( $martincv_stats ) : ?>
								<div class="projects-archive__stats">
									<?php foreach ( array_slice( $martincv_stats, 0, 4 ) as $martincv_stat ) : ?>
										<div class="stat-tile">
											<div class="stat-tile__value"><?php echo esc_html( $martincv_stat['value'] ?? '' ); ?></div>
											<div class="stat-tile__label"><?php echo esc_html( $martincv_stat['label'] ?? '' ); ?></div>
										</div>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>
						</div>
					</article>
				</a>
			<?php endif; ?>

			<?php if ( $martincv_rest ) : ?>
				<div class="projects-archive__grid">
					<?php
					foreach ( $martincv_rest as $martincv_project ) :
						$martincv_terms = martincv_project_terms( $martincv_project->ID );
						$martincv_tech  = martincv_project_tech( $martincv_project->ID );
						?>
						<a class="projects-archive__card-link" href="<?php echo esc_url( get_permalink( $martincv_project ) ); ?>" data-categories="<?php echo esc_attr( $martincv_terms['slugs'] ); ?>">
							<article class="card-elegant projects-archive__card">
								<div class="projects-archive__card-top">
									<?php if ( $martincv_terms['name'] ) : ?>
										<span class="pill"><?php echo esc_html( $martincv_terms['name'] ); ?></span>
									<?php else : ?>
										<span></span>
									<?php endif; ?>
									<span class="projects-archive__card-arrow"><?php Utility::icon( 'arrow-up-right', 20 ); ?></span>
								</div>
								<h3 class="projects-archive__card-title"><?php echo esc_html( get_the_title( $martincv_project ) ); ?></h3>
								<?php if ( get_field( 'short_description', $martincv_project->ID ) ) : ?>
									<p class="projects-archive__card-desc"><?php echo esc_html( (string) get_field( 'short_description', $martincv_project->ID ) ); ?></p>
								<?php endif; ?>
								<?php if ( $martincv_tech ) : ?>
									<div class="projects-archive__tech">
										<?php foreach ( array_slice( $martincv_tech, 0, 3 ) as $martincv_item ) : ?>
											<span class="pill"><?php echo esc_html( $martincv_item ); ?></span>
										<?php endforeach; ?>
									</div>
								<?php endif; ?>
								<div class="projects-archive__card-footer">
									<span><?php echo esc_html( (string) get_field( 'client', $martincv_project->ID ) ); ?></span>
									<span><?php echo esc_html( (string) get_field( 'year', $martincv_project->ID ) ); ?></span>
								</div>
							</article>
						</a>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>

		<?php if ( Site_Options::get_projects_cta_title() ) : ?>
			<div class="card-elegant projects-archive__cta">
				<h2 class="projects-archive__cta-title"><?php echo esc_html( Site_Options::get_projects_cta_title() ); ?></h2>
				<?php if ( Site_Options::get_projects_cta_text() ) : ?>
					<p class="projects-archive__cta-text"><?php echo esc_html( Site_Options::get_projects_cta_text() ); ?></p>
				<?php endif; ?>
				<?php if ( Site_Options::get_projects_cta_btn_text() ) : ?>
					<a href="<?php echo esc_url( Site_Options::get_projects_cta_btn_link() ); ?>" class="btn-hero projects-archive__cta-btn">
						<?php echo esc_html( Site_Options::get_projects_cta_btn_text() ); ?>
						<span class="projects-archive__cta-icon"><?php Utility::icon( 'arrow-right', 18 ); ?></span>
					</a>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	</div>
</main>
<?php
get_footer();
