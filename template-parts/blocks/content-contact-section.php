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

?>

<section class="martincv-contact" id="contact">
	<div class="martincv-contact__area">
		<div class="martincv-contact__form">
			<div class="martincv-contact__heading">
				<div class="martincv-about__label martincv-label"><?php esc_html_e( 'Contact', 'martincv' ); ?></div>
				<h2><?php the_field( 'contact_section_title' ); ?></h2>
				<div class="martincv-contact__description"><?php echo esc_html( get_field( 'contact_section_description' ) ); ?></div>
			</div>
			<?php echo do_shortcode( get_field( 'contact_form_7_shortcode' ) ); ?>
		</div>
		<div class="martincv-contact__links-area">
			<?php if ( have_rows( 'contact_links' ) ) : ?>
			<div class="martincv-contact__links">
				<?php
				while ( have_rows( 'contact_links' ) ) :
					the_row();
					?>
					<div class="martincv-contact__link">
						<div class="martincv-contact__link-label"><?php the_sub_field( 'label' ); ?></div>
						<a href="<?php the_sub_field( 'link' ); ?>" target="_blank"><?php the_sub_field( 'link_label' ); ?></a>
					</div>
				<?php endwhile; ?>
			</div>
			<?php endif; ?>
			<?php if ( get_field( 'show_social_buttons' ) ) : ?>
				<div class="martincv-contact__social">
					<a href="https://www.facebook.com/martincvagency" target="_blank"><img src="<?php echo esc_url( MARTINCV_THEME_URL . 'assets/public/images/facebook-icon.svg' ); ?>" alt="Facebook MartinCV"></a>
					<a href="https://twitter.com/MartinCVAgency" target="_blank"><img src="<?php echo esc_url( MARTINCV_THEME_URL . 'assets/public/images/twitter-icon.svg' ); ?>" alt="Twitter MartinCV"></a>
					<a href="https://www.linkedin.com/in/martinjankov/" target="_blank"><img src="<?php echo esc_url( MARTINCV_THEME_URL . 'assets/public/images/linkedin-icon.svg' ); ?>" alt="LinkedIn MartinCV"></a>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
