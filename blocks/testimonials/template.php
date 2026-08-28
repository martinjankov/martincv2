<?php
/**
 * Testimonials block template.
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

$section = MartinCV\Sections\Testimonials_Section::get_instance();
$section->set_properties_from_block( $block );

$wrapper_attrs = get_block_wrapper_attributes(
	array(
		'class' => 'testimonials-block',
		'id'    => 'testimonials',
	)
);
?>

<section <?php echo $wrapper_attrs; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<div class="martincv-container martincv-container--wide">
		<div class="testimonials-block__header">
			<?php if ( $section->get_eyebrow() ) : ?>
				<p class="eyebrow"><?php echo esc_html( $section->get_eyebrow() ); ?></p>
			<?php endif; ?>
			<?php if ( $section->get_title() ) : ?>
				<h2 class="testimonials-block__title"><?php echo esc_html( $section->get_title() ); ?></h2>
			<?php endif; ?>
			<?php if ( $section->get_description() ) : ?>
				<p class="testimonials-block__desc"><?php echo esc_html( $section->get_description() ); ?></p>
			<?php endif; ?>
		</div>

		<?php if ( $section->get_testimonials() ) : ?>
			<div class="testimonials-block__carousel">
				<div class="testimonials-block__viewport">
					<div class="testimonials-block__track">
						<?php foreach ( $section->get_testimonials() as $martincv_testimonial ) : ?>
							<div class="testimonials-block__slide">
								<div class="card-elegant testimonials-block__card">
									<div class="testimonials-block__card-top">
										<span class="testimonials-block__quote-icon"><?php Utility::icon( 'quote', 32 ); ?></span>
										<span class="testimonials-block__stars" aria-label="<?php esc_attr_e( '5 stars', 'martincv' ); ?>">
											<?php for ( $martincv_i = 0; $martincv_i < 5; $martincv_i++ ) : ?>
												<?php Utility::icon( 'star', 16 ); ?>
											<?php endfor; ?>
										</span>
									</div>
									<blockquote class="testimonials-block__quote">
										&ldquo;<?php echo esc_html( $martincv_testimonial['quote'] ?? '' ); ?>&rdquo;
									</blockquote>
									<div class="testimonials-block__author">
										<span class="testimonials-block__avatar"><?php echo esc_html( $section->get_initials( (string) ( $martincv_testimonial['name'] ?? '' ) ) ); ?></span>
										<span class="testimonials-block__author-info">
											<span class="testimonials-block__author-name"><?php echo esc_html( $martincv_testimonial['name'] ?? '' ); ?></span>
											<span class="testimonials-block__author-role"><?php echo esc_html( $martincv_testimonial['role'] ?? '' ); ?></span>
										</span>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
				<button class="testimonials-block__nav testimonials-block__nav--prev" type="button" aria-label="<?php esc_attr_e( 'Previous slide', 'martincv' ); ?>">
					<?php Utility::icon( 'arrow-left', 16 ); ?>
				</button>
				<button class="testimonials-block__nav testimonials-block__nav--next" type="button" aria-label="<?php esc_attr_e( 'Next slide', 'martincv' ); ?>">
					<?php Utility::icon( 'arrow-right', 16 ); ?>
				</button>
			</div>
		<?php endif; ?>

		<?php if ( $section->get_stats() ) : ?>
			<div class="testimonials-block__stats">
				<?php foreach ( $section->get_stats() as $martincv_stat ) : ?>
					<div class="testimonials-block__stat">
						<div class="testimonials-block__stat-value"><?php echo esc_html( $martincv_stat['value'] ?? '' ); ?></div>
						<div class="testimonials-block__stat-label"><?php echo esc_html( $martincv_stat['label'] ?? '' ); ?></div>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<?php if ( $section->get_cta_title() ) : ?>
			<div class="testimonials-block__cta">
				<div class="card-elegant testimonials-block__cta-card">
					<h3 class="testimonials-block__cta-title"><?php echo esc_html( $section->get_cta_title() ); ?></h3>
					<?php if ( $section->get_cta_text() ) : ?>
						<p class="testimonials-block__cta-text"><?php echo esc_html( $section->get_cta_text() ); ?></p>
					<?php endif; ?>
					<?php if ( $section->get_cta_btn_text() ) : ?>
						<a href="<?php echo esc_url( $section->get_cta_btn_link() ); ?>" class="btn-hero testimonials-block__cta-btn">
							<?php echo esc_html( $section->get_cta_btn_text() ); ?>
						</a>
					<?php endif; ?>
				</div>
			</div>
		<?php endif; ?>
	</div>
</section>
