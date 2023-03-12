<?php
/**
 * Services Block
 *
 * @package MartinCV
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<?php if ( have_rows( 'services' ) ) : ?>
<section class="martincv-services" id="services">
	<div class="martincv-services__list">
		<div class="martincv-services__item">
			<div class="martincv-services__label martincv-label"><?php esc_html_e( 'Services', 'martincv' ); ?></div>
			<h2><?php the_field( 'services_section_title' ); ?></h2>
		</div>
		<?php
		while ( have_rows( 'services' ) ) :
			the_row();
			?>
			<div class="martincv-services__item">
				<img
					src="<?php echo esc_url( get_sub_field( 'image' ) ); ?>"
					alt="<?php echo esc_attr( get_sub_field( 'name' ) ); ?>"
					<?php echo get_sub_field( 'width' ) ? 'width="' . esc_attr( get_sub_field( 'width' ) ) . '"' : ''; ?>
					<?php echo get_sub_field( 'height' ) ? 'height="' . esc_attr( get_sub_field( 'height' ) ) . '"' : ''; ?>
					>
			</div>
		<?php endwhile; ?>
	</div>
</section>
<?php endif; ?>
