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

$background_image = is_singular( 'post' ) ? get_the_post_thumbnail_url( get_the_ID(), 'full' ) : get_field( 'background_image_media' );

?>

<section class="martincv-hero" <?php echo wp_kses_post( 'style="background-image: url(' . $background_image . ')"' ); ?>>
	<?php if ( have_rows( 'side_buttons' ) ) : ?>
		<?php
		$counter = 0;
		while ( have_rows( 'side_buttons' ) ) :
			the_row();
			$counter++;
			?>
			<div class="martincv-hero__link <?php echo 4 === $counter ? 'social-links' : ''; ?>">
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
	<div class="martin-cv__intro">
		<?php if ( ! empty( get_field( 'sub_heading' ) ) ) : ?>
			<h2><?php the_field( 'sub_heading' ); ?></h2>
		<?php endif; ?>
		<h1><?php is_singular( 'post' ) ? the_title() : the_field( 'heading' ); ?></h1>
		<?php if ( have_rows( 'buttons' ) ) : ?>
			<div class="martincv-hero__cta">
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
