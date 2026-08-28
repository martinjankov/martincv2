<?php
/**
 * FAQ block template.
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

$section = MartinCV\Sections\FAQ_Section::get_instance();
$section->set_properties_from_block( $block );

$wrapper_attrs = get_block_wrapper_attributes(
	array(
		'class' => 'faq-block',
		'id'    => 'faq',
	)
);
?>

<section <?php echo $wrapper_attrs; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<div class="martincv-container">
		<div class="faq-block__grid">
			<div class="faq-block__intro">
				<?php if ( $section->get_eyebrow() ) : ?>
					<p class="eyebrow"><?php echo esc_html( $section->get_eyebrow() ); ?></p>
				<?php endif; ?>
				<?php if ( $section->get_title() ) : ?>
					<h2 class="faq-block__title"><?php echo esc_html( $section->get_title() ); ?></h2>
				<?php endif; ?>
				<?php if ( $section->get_description() ) : ?>
					<p class="faq-block__desc"><?php echo esc_html( $section->get_description() ); ?></p>
				<?php endif; ?>
				<?php if ( $section->get_cta_text() ) : ?>
					<a href="<?php echo esc_url( $section->get_cta_link() ); ?>" class="btn-secondary faq-block__cta">
						<span class="faq-block__cta-icon"><?php Utility::icon( 'circle-help', 17 ); ?></span>
						<?php echo esc_html( $section->get_cta_text() ); ?>
					</a>
				<?php endif; ?>
			</div>

			<?php if ( $section->get_faqs() ) : ?>
				<div class="faq-block__list">
					<?php foreach ( $section->get_faqs() as $martincv_index => $martincv_faq ) : ?>
						<div class="faq-block__item">
							<h3 class="faq-block__question-wrap">
								<button type="button" class="faq-block__question" aria-expanded="false">
									<?php echo esc_html( $martincv_faq['question'] ?? '' ); ?>
									<span class="faq-block__chevron"><?php Utility::icon( 'chevron-down', 16 ); ?></span>
								</button>
							</h3>
							<div class="faq-block__answer">
								<div class="faq-block__answer-inner">
									<?php echo wp_kses_post( $martincv_faq['answer'] ?? '' ); ?>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
