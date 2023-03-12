<?php
/**
 * Testimonials Block
 *
 * @package MartinCV
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$backgroud_img = get_field( 'testimonials_background_image' );

$testimonials = MartinCV\Testimonial::get_instance()->get();

?>
<?php if ( ! empty( $testimonials ) ) : ?>
<section class="martincv-testimonials" id="testimonial" <?php echo $backgroud_img ? 'style="background-image: url(' . esc_url( $backgroud_img ) . ')"' : ''; ?>>
	<h2><?php esc_html_e( 'Testimonials', 'martincv' ); ?></h2>
	<div class="martincv-testimonials__list">
		<div class="martincv-testimonials__wrapper">
			<?php foreach ( $testimonials as $testimonial ) : ?>
			<div class="martincv-testimonials__testimonial">
				<h3><?php echo esc_html( $testimonial['title'] ); ?></h3>
				<div class="martincv-testimonials--content"><?php echo wp_kses_post( $testimonial['review'] ); ?></div>
			</div>
			<?php endforeach; ?>
		</div>
		<div class="martincv-testimonials__controls">
			<button type="button" class="martincv-testimonials--slider__left"><img src="<?php echo esc_url( MARTINCV_THEME_URL ) . 'assets/public/images/arrow-left.svg'; ?>" alt="&lt;" width="24" height="37"></button>
			<button type="button" class="martincv-testimonials--slider__right"><img src="<?php echo esc_url( MARTINCV_THEME_URL ) . 'assets/public/images/arrow-right.svg'; ?>" alt="&gt;" width="24" height="37"></button>
		</div>
	</div>
</section>
<?php endif; ?>
