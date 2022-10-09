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

<div class="martincv-hero-home" <?php echo wp_kses_post( 'style="background-image: url(' . get_field( 'background_image_media' ) . ')"' ); ?>>
	<?php if ( have_rows( 'side_buttons' ) ) : ?>
		<?php
		while ( have_rows( 'side_buttons' ) ) :
			the_row();
			?>
			<div class="martincv-hero-home__link">
				<a href="<?php the_sub_field( 'link' ); ?>"><?php the_sub_field( 'label' ); ?></a>
			</div>
		<?php endwhile; ?>
	<?php endif; ?>
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
