<?php
/**
 * Services block template.
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

$section = MartinCV\Sections\Services_Section::get_instance();
$section->set_properties_from_block( $block );

$wrapper_attrs = get_block_wrapper_attributes(
	array(
		'class' => 'services-block',
		'id'    => 'services',
	)
);
?>

<section <?php echo $wrapper_attrs; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<div class="services-block__bg bg-dot-pattern" aria-hidden="true"></div>
	<div class="martincv-container services-block__container">
		<div class="services-block__header">
			<div class="services-block__intro">
				<?php if ( $section->get_eyebrow() ) : ?>
					<p class="eyebrow"><?php echo esc_html( $section->get_eyebrow() ); ?></p>
				<?php endif; ?>
				<?php if ( $section->get_title() ) : ?>
					<h2 class="services-block__title"><?php echo esc_html( $section->get_title() ); ?></h2>
				<?php endif; ?>
				<?php if ( $section->get_description() ) : ?>
					<p class="services-block__desc"><?php echo esc_html( $section->get_description() ); ?></p>
				<?php endif; ?>
			</div>
			<?php if ( $section->get_top_cta_text() ) : ?>
				<a href="<?php echo esc_url( $section->get_top_cta_link() ); ?>" class="btn-secondary services-block__top-cta">
					<?php echo esc_html( $section->get_top_cta_text() ); ?>
					<span class="services-block__cta-icon"><?php Utility::icon( 'arrow-up-right', 17 ); ?></span>
				</a>
			<?php endif; ?>
		</div>

		<?php if ( $section->get_services() ) : ?>
			<div class="services-block__grid">
				<?php foreach ( $section->get_services() as $martincv_service ) : ?>
					<div class="services-block__card">
						<div class="services-block__card-icon">
							<?php Utility::icon( (string) ( $martincv_service['icon'] ?? 'code' ), 22 ); ?>
						</div>
						<h3 class="services-block__card-title"><?php echo esc_html( $martincv_service['title'] ?? '' ); ?></h3>
						<p class="services-block__card-desc"><?php echo esc_html( $martincv_service['description'] ?? '' ); ?></p>
						<?php
						$martincv_tags = $section->get_tags_list( (string) ( $martincv_service['tags'] ?? '' ) );
						if ( $martincv_tags ) :
							?>
							<ul class="services-block__tags">
								<?php foreach ( $martincv_tags as $martincv_tag ) : ?>
									<li class="services-block__tag"><?php echo esc_html( $martincv_tag ); ?></li>
								<?php endforeach; ?>
							</ul>
						<?php endif; ?>
						<?php if ( ! empty( $martincv_service['link'] ) ) : ?>
							<a href="<?php echo esc_url( $martincv_service['link'] ); ?>" class="services-block__card-link">
								<?php esc_html_e( 'Learn more', 'martincv' ); ?>
								<?php Utility::icon( 'arrow-up-right', 15 ); ?>
							</a>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<?php if ( $section->get_bottom_title() ) : ?>
			<div class="services-block__banner">
				<h3 class="services-block__banner-title"><?php echo esc_html( $section->get_bottom_title() ); ?></h3>
				<?php if ( $section->get_bottom_text() ) : ?>
					<p class="services-block__banner-text"><?php echo esc_html( $section->get_bottom_text() ); ?></p>
				<?php endif; ?>
				<?php if ( $section->get_bottom_btn_text() ) : ?>
					<a href="<?php echo esc_url( $section->get_bottom_btn_link() ); ?>" class="btn-hero services-block__banner-btn">
						<?php echo esc_html( $section->get_bottom_btn_text() ); ?>
					</a>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	</div>
</section>
