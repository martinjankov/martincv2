<?php
/**
 * About Block
 *
 * @package MartinCV
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<section class="martincv-about" id="about">
	<?php if ( get_field( 'portfolio_photo' ) ) : ?>
	<div class="martincv-about__left">
		<img src="<?php echo esc_url( get_field( 'portfolio_photo' ) ); ?>" alt="<?php echo esc_attr( 'Martin' ); ?>">
	</div>
	<?php endif; ?>
	<div class="martincv-about__right">
		<div class="martincv-about__label martincv-label"><?php esc_html_e( 'About', 'martincv' ); ?></div>
		<h2><?php the_field( 'about_section_title' ); ?></h2>
		<div class="martincv-about__description"><?php echo wp_kses_post( wpautop( get_field( 'about_description' ) ) ); ?></div>
	</div>
</section>
