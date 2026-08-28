<?php
/**
 * About block template.
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block inner HTML (empty).
 * @param bool   $is_preview True during backend preview render.
 * @param int    $post_id    The post ID the block is rendering content against.
 * @param array  $context    The context provided to the block by the post or its parent block.
 *
 * @package MartinCV
 */

use MartinCV\Utility;

$section = MartinCV\Sections\About_Section::get_instance();
$section->set_properties_from_block( $block );

$wrapper_attrs = get_block_wrapper_attributes(
	array(
		'class' => 'about-block',
		'id'    => 'about',
	)
);
?>

<section <?php echo $wrapper_attrs; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<div class="martincv-container">
		<div class="about-block__header">
			<?php if ( $section->get_eyebrow() ) : ?>
				<p class="eyebrow"><?php echo esc_html( $section->get_eyebrow() ); ?></p>
			<?php endif; ?>
			<?php if ( $section->get_title() ) : ?>
				<h2 class="about-block__title"><?php echo esc_html( $section->get_title() ); ?></h2>
			<?php endif; ?>
		</div>

		<div class="about-block__grid">
			<div class="about-block__main">
				<?php if ( $section->get_content() ) : ?>
					<div class="about-block__content">
						<?php echo wp_kses_post( $section->get_content() ); ?>
					</div>
				<?php endif; ?>

				<?php if ( $section->get_values() ) : ?>
					<div class="about-block__values">
						<?php foreach ( $section->get_values() as $martincv_value ) : ?>
							<div class="about-block__value">
								<div class="about-block__value-icon">
									<?php Utility::icon( (string) ( $martincv_value['icon'] ?? 'star' ), 20 ); ?>
								</div>
								<h3 class="about-block__value-title"><?php echo esc_html( $martincv_value['title'] ?? '' ); ?></h3>
								<p class="about-block__value-desc"><?php echo esc_html( $martincv_value['description'] ?? '' ); ?></p>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>

			<div class="about-block__side">
				<div class="card-elegant about-block__expertise">
					<?php if ( $section->get_expertise_title() ) : ?>
						<h3 class="about-block__expertise-title"><?php echo esc_html( $section->get_expertise_title() ); ?></h3>
					<?php endif; ?>
					<?php if ( $section->get_expertise_subtitle() ) : ?>
						<p class="about-block__expertise-subtitle"><?php echo esc_html( $section->get_expertise_subtitle() ); ?></p>
					<?php endif; ?>

					<?php if ( $section->get_skills() ) : ?>
						<div class="about-block__skills">
							<?php foreach ( $section->get_skills() as $martincv_skill ) : ?>
								<div class="about-block__skill">
									<span class="about-block__skill-icon"><?php Utility::icon( (string) ( $martincv_skill['icon'] ?? 'code' ), 18 ); ?></span>
									<span class="about-block__skill-label"><?php echo esc_html( $martincv_skill['label'] ?? '' ); ?></span>
								</div>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>

					<?php if ( $section->get_cta_text() ) : ?>
						<div class="about-block__cta">
							<?php if ( $section->get_cta_note() ) : ?>
								<p class="about-block__cta-note"><?php echo esc_html( $section->get_cta_note() ); ?></p>
							<?php endif; ?>
							<a href="<?php echo esc_url( $section->get_cta_link() ); ?>" class="btn-hero about-block__cta-btn">
								<?php echo esc_html( $section->get_cta_text() ); ?>
							</a>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</section>
