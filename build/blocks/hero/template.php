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

use MartinCV\Utility;

$section = MartinCV\Sections\Hero_Section::get_instance();
$section->set_properties_from_block( $block );

$resume_url = MartinCV\Site_Options::get_resume_url();
$skills     = $section->get_skills();

$wrapper_attrs = get_block_wrapper_attributes(
	array(
		'class' => 'hero-block',
		'id'    => 'hero',
	)
);
?>

<section <?php echo $wrapper_attrs; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<div class="hero-block__bg-grid bg-grid-pattern" aria-hidden="true"></div>
	<div class="hero-block__bg-radial" aria-hidden="true"></div>
	<div class="hero-block__bg-blob" aria-hidden="true"></div>

	<div class="martincv-container hero-block__container">
		<div class="hero-block__grid">
			<div class="hero-block__content fade-in visible">
				<?php if ( $section->get_availability_text() ) : ?>
					<div class="pill hero-block__pill">
						<span class="hero-block__pulse">
							<span class="hero-block__pulse-ping"></span>
							<span class="hero-block__pulse-dot"></span>
						</span>
						<?php echo esc_html( $section->get_availability_text() ); ?>
					</div>
				<?php endif; ?>

				<h1 class="hero-block__heading">
					<?php echo esc_html( $section->get_heading() ); ?><br>
					<?php if ( $section->get_heading_highlight() ) : ?>
						<span class="gradient-text"><?php echo esc_html( $section->get_heading_highlight() ); ?></span>
					<?php endif; ?>
				</h1>

				<?php if ( $section->get_description() ) : ?>
					<p class="hero-block__desc"><?php echo esc_html( $section->get_description() ); ?></p>
				<?php endif; ?>

				<div class="hero-block__buttons">
					<?php if ( $section->get_primary_btn_text() ) : ?>
						<a href="<?php echo esc_url( $section->get_primary_btn_link() ); ?>" class="btn-hero">
							<?php echo esc_html( $section->get_primary_btn_text() ); ?>
							<span class="hero-block__btn-icon"><?php Utility::icon( 'arrow-up-right', 18 ); ?></span>
						</a>
					<?php endif; ?>
					<?php if ( $section->show_resume() && $resume_url ) : ?>
						<a href="<?php echo esc_url( $resume_url ); ?>" class="btn-secondary" download>
							<span class="hero-block__btn-icon hero-block__btn-icon--left"><?php Utility::icon( 'download', 17 ); ?></span>
							<?php esc_html_e( 'Resume', 'martincv' ); ?>
						</a>
					<?php endif; ?>
					<?php if ( $section->get_book_call_text() && '#' !== $section->get_book_call_link() ) : ?>
						<a href="<?php echo esc_url( $section->get_book_call_link() ); ?>" class="btn-secondary" target="_blank" rel="noopener noreferrer">
							<span class="hero-block__btn-icon hero-block__btn-icon--left"><?php Utility::icon( 'calendar', 17 ); ?></span>
							<?php echo esc_html( $section->get_book_call_text() ); ?>
						</a>
					<?php endif; ?>
				</div>

				<?php if ( $section->get_stats() ) : ?>
					<div class="hero-block__stats">
						<?php foreach ( $section->get_stats() as $martincv_stat ) : ?>
							<div class="hero-block__stat">
								<div class="hero-block__stat-value"><?php echo esc_html( $martincv_stat['value'] ?? '' ); ?></div>
								<div class="hero-block__stat-label"><?php echo esc_html( $martincv_stat['label'] ?? '' ); ?></div>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>

			<?php if ( $section->get_portrait_url() ) : ?>
				<div class="hero-block__media fade-in visible">
					<div class="hero-block__media-inner">
						<div class="hero-block__photo">
							<img src="<?php echo esc_url( $section->get_portrait_url() ); ?>" alt="<?php echo esc_attr( $section->get_portrait_alt() ); ?>" loading="eager">
						</div>
						<?php if ( $section->get_based_in() ) : ?>
							<div class="hero-block__location">
								<p class="hero-block__location-label"><?php esc_html_e( 'Based in', 'martincv' ); ?></p>
								<p class="hero-block__location-text"><?php echo esc_html( $section->get_based_in() ); ?></p>
							</div>
						<?php endif; ?>
						<?php if ( $section->get_badge_text() && '#' !== $section->get_badge_link() ) : ?>
							<a href="<?php echo esc_url( $section->get_badge_link() ); ?>" class="hero-block__badge" target="_blank" rel="noopener noreferrer">
								<?php echo esc_html( $section->get_badge_text() ); ?>
								<?php Utility::icon( 'external-link', 13 ); ?>
							</a>
						<?php endif; ?>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>

	<?php if ( $skills ) : ?>
		<div class="hero-block__marquee">
			<div class="marquee-track">
				<?php
				// Repeat the set so half the track always exceeds the viewport width
				// (the loop animation translates by -50%); 6 sets cover up to ~2560px.
				for ( $martincv_i = 0; $martincv_i < 6; $martincv_i++ ) :
					?>
					<?php foreach ( $skills as $martincv_skill ) : ?>
						<span class="hero-block__marquee-item"><?php echo esc_html( $martincv_skill['name'] ?? '' ); ?></span>
					<?php endforeach; ?>
				<?php endfor; ?>
			</div>
		</div>
	<?php endif; ?>
</section>
