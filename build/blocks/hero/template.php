<?php
/**
 * Hero block template.
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block inner HTML (empty).
 * @param bool   $is_preview True during backend preview render.
 * @param int    $post_id    The post ID the block is rendering content against.
 * @param array  $context    The context provided to the block by the post or its parent block.
 *
 * @package MartinCV
 */

$section = MartinCV\Sections\Hero_Section::get_instance();
$section->set_properties_from_block( $block );

$wrapper_attrs = get_block_wrapper_attributes(
	array(
		'class' => 'hero-block',
		'id'    => 'hero',
	)
);
?>

<section <?php echo $wrapper_attrs; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<?php if ( $section->get_bg_url() ) : ?>
		<div class="hero-block__bg" style="background-image: url('<?php echo esc_url( $section->get_bg_url() ); ?>');" aria-hidden="true"></div>
		<div class="hero-block__overlay" aria-hidden="true"></div>
	<?php endif; ?>

	<div class="hero-block__content">
		<?php if ( $section->get_heading() ) : ?>
			<h1 class="hero-block__heading"><?php echo esc_html( $section->get_heading() ); ?></h1>
		<?php endif; ?>

		<?php if ( $section->get_subheading() ) : ?>
			<p class="hero-block__subheading"><?php echo esc_html( $section->get_subheading() ); ?></p>
		<?php endif; ?>

		<?php if ( $section->get_button_label() ) : ?>
			<a href="<?php echo esc_url( $section->get_button_link() ); ?>" class="hero-block__btn">
				<?php echo esc_html( $section->get_button_label() ); ?>
			</a>
		<?php endif; ?>
	</div>
</section>
