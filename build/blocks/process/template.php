<?php
/**
 * Process block template.
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

$section = MartinCV\Sections\Process_Section::get_instance();
$section->set_properties_from_block( $block );

$wrapper_attrs = get_block_wrapper_attributes(
	array(
		'class' => 'process-block',
		'id'    => 'process',
	)
);
?>

<section <?php echo $wrapper_attrs; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<div class="martincv-container">
		<header class="process-block__header">
			<?php if ( $section->get_eyebrow() ) : ?>
				<p class="eyebrow"><?php echo esc_html( $section->get_eyebrow() ); ?></p>
			<?php endif; ?>
			<?php if ( $section->get_title() ) : ?>
				<h2 class="process-block__title"><?php echo esc_html( $section->get_title() ); ?></h2>
			<?php endif; ?>
			<?php if ( $section->get_description() ) : ?>
				<p class="process-block__desc"><?php echo esc_html( $section->get_description() ); ?></p>
			<?php endif; ?>
		</header>

		<?php if ( $section->get_steps() ) : ?>
			<ol class="process-block__steps">
				<?php foreach ( $section->get_steps() as $martincv_index => $martincv_step ) : ?>
					<li class="process-block__step">
						<div class="process-block__step-visual">
							<span class="process-block__step-icon">
								<?php Utility::icon( (string) ( $martincv_step['icon'] ?? 'lightbulb' ), 22 ); ?>
								<span class="process-block__step-number"><?php echo esc_html( (string) ( $martincv_index + 1 ) ); ?></span>
							</span>
						</div>
						<h3 class="process-block__step-title"><?php echo esc_html( $martincv_step['title'] ?? '' ); ?></h3>
						<?php if ( ! empty( $martincv_step['description'] ) ) : ?>
							<p class="process-block__step-desc"><?php echo esc_html( $martincv_step['description'] ); ?></p>
						<?php endif; ?>
						<?php if ( ! empty( $martincv_step['bullets'] ) && is_array( $martincv_step['bullets'] ) ) : ?>
							<ul class="process-block__step-bullets">
								<?php foreach ( $martincv_step['bullets'] as $martincv_bullet ) : ?>
									<li><?php echo esc_html( $martincv_bullet['text'] ?? '' ); ?></li>
								<?php endforeach; ?>
							</ul>
						<?php endif; ?>
					</li>
				<?php endforeach; ?>
			</ol>
		<?php endif; ?>

		<?php if ( $section->get_cta_title() || $section->get_cta_button_text() ) : ?>
			<div class="process-block__cta">
				<?php if ( $section->get_cta_title() ) : ?>
					<h2 class="process-block__cta-title"><?php echo esc_html( $section->get_cta_title() ); ?></h2>
				<?php endif; ?>
				<?php if ( $section->get_cta_text() ) : ?>
					<p class="process-block__cta-text"><?php echo esc_html( $section->get_cta_text() ); ?></p>
				<?php endif; ?>
				<?php if ( $section->get_cta_button_text() ) : ?>
					<a href="<?php echo esc_url( $section->get_cta_button_link() ); ?>" class="btn-hero process-block__cta-btn">
						<?php echo esc_html( $section->get_cta_button_text() ); ?>
						<?php Utility::icon( 'arrow-right', 18 ); ?>
					</a>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	</div>
</section>
