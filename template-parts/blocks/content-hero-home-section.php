<?php
/**
 * Hero Home Block
 *
 * @package MartinCV
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<section class="martincv-hero-home" <?php echo wp_kses_post( 'style="background-image: url(' . get_field( 'background_image_media' ) . ')"' ); ?>>
	<?php if ( have_rows( 'side_buttons' ) ) : ?>
		<?php
		$counter = 0;
		while ( have_rows( 'side_buttons' ) ) :
			the_row();
			$counter++;
			?>
			<div class="martincv-hero-home__link <?php echo 4 === $counter ? 'social-links' : ''; ?>">
				<?php if ( 4 === $counter ) : ?>
					<div class="martincv-hero__social">
						<a href="https://www.facebook.com/martincvagency" target="_blank"><img src="<?php echo esc_url( MARTINCV_THEME_URL . 'assets/public/images/facebook-icon-white.svg' ); ?>" alt="Facebook MartinCV"></a>
						<a href="https://twitter.com/MartinCVAgency" target="_blank"><img src="<?php echo esc_url( MARTINCV_THEME_URL . 'assets/public/images/twitter-icon-white.svg' ); ?>" alt="Twitter MartinCV"></a>
						<a href="https://www.linkedin.com/in/martinjankov/" target="_blank"><img src="<?php echo esc_url( MARTINCV_THEME_URL . 'assets/public/images/linkedin-icon-white.svg' ); ?>" alt="LinkedIn MartinCV"></a>
					</div>
				<?php endif; ?>
				<a href="<?php the_sub_field( 'link' ); ?>"><?php the_sub_field( 'label' ); ?></a>
			</div>
		<?php endwhile; ?>
	<?php endif; ?>
	<div class="martin-cv-home__intro">
		<h2><?php the_field( 'sub_heading' ); ?></h2>
		<h1><?php the_field( 'heading' ); ?></h1>
		<?php if ( have_rows( 'buttons' ) ) : ?>
			<div class="martincv-hero-home__cta">
			<?php
			while ( have_rows( 'buttons' ) ) :
				the_row();
				?>
					<a href="<?php the_sub_field( 'link' ); ?>">
						<span><?php the_sub_field( 'label' ); ?></span>
						<?php if ( get_sub_field( 'icon' ) ) : ?>
							<img src="<?php the_sub_field( 'icon' ); ?>" alt="<?php esc_attr_e( 'Icon', 'martincv' ); ?>">
						<?php endif; ?>
					</a>
				<?php endwhile; ?>
			</div>
		<?php endif; ?>
	</div>
</section>
