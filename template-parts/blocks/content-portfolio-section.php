<?php
/**
 * Portfolio Block
 *
 * @package MartinCV
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$project_obj = MartinCV\Project::get_instance();

$categories = $project_obj->get_categories();
$projects   = $project_obj->get();

?>

<?php if ( ! empty( $projects ) ) : ?>
<section class="martincv-portfolio" id="portfolio">
	<div class="martincv-portfolio__categories">
		<div class="martincv-portfolio__heading">
			<div class="martincv-portfolio__label martincv-label"><?php esc_html_e( 'Portfolio', 'martincv' ); ?></div>
			<h2><?php the_field( 'portfolio_section_title' ); ?></h2>
		</div>
		<?php if ( ! empty( $categories ) ) : ?>
			<ul class="martincv-portfolio__categories">
				<li class="filter active" data-filter="all"><?php esc_html_e( 'All', 'martincv' ); ?></li>
				<?php foreach ( $categories as $project_category ) : ?>
					<li class="filter" data-filter="<?php echo esc_attr( $project_category->slug ); ?>">
						<?php echo esc_html( $project_category->name ); ?>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>
	</div>
	<div class="martincv-portfolio__projects">
		<?php
		foreach ( $projects as $project ) :
			$backgroud_img = $project['image'];
			?>
			<div class="martincv-portfolio__item <?php echo esc_attr( implode( ' ', $project['categories_slugs'] ) ); ?>" <?php echo $backgroud_img ? 'style="background-image: url(' . esc_url( $backgroud_img ) . ')"' : ''; ?>>
				<div class="martincv-portfolio__item-meta">
					<h3><a href="<?php echo esc_html( $project['web_link'] ); ?>" target="_blank"><?php echo esc_html( $project['title'] ); ?></a></h3>
					<div class="martincv-portfolio__item-short-desc"><?php echo wp_kses_post( $project['short_description'] ); ?></div>
					<div class="martincv-portfolio__item-technologies"><?php echo esc_html( implode( ', ', wp_list_pluck( $project['technologies'], 'name' ) ) ); ?></div>
					<div class="martincv-portfolio__item-copyright"><?php echo wp_kses_post( $project['copyright'] ); ?></div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</section>
<?php endif; ?>
