<?php
/**
 * Contact block template.
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
use MartinCV\Site_Options;

$section = MartinCV\Sections\Contact_Section::get_instance();
$section->set_properties_from_block( $block );

$martincv_email        = Site_Options::get_email();
$martincv_codeable     = Site_Options::get_codeable_url();
$martincv_consultation = Site_Options::get_consultation_url();

$wrapper_attrs = get_block_wrapper_attributes(
	array(
		'class' => 'contact-block',
		'id'    => 'contact',
	)
);
?>

<section <?php echo $wrapper_attrs; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<div class="martincv-container martincv-container--wide">
		<div class="contact-block__header">
			<?php if ( $section->get_eyebrow() ) : ?>
				<p class="eyebrow"><?php echo esc_html( $section->get_eyebrow() ); ?></p>
			<?php endif; ?>
			<?php if ( $section->get_title() ) : ?>
				<h2 class="contact-block__title"><?php echo esc_html( $section->get_title() ); ?></h2>
			<?php endif; ?>
			<?php if ( $section->get_description() ) : ?>
				<p class="contact-block__desc"><?php echo esc_html( $section->get_description() ); ?></p>
			<?php endif; ?>
		</div>

		<div class="contact-block__grid">
			<div class="contact-block__info">
				<?php if ( $section->get_intro_title() || $section->get_intro_text() ) : ?>
					<div class="contact-block__intro">
						<?php if ( $section->get_intro_title() ) : ?>
							<h3 class="contact-block__intro-title"><?php echo esc_html( $section->get_intro_title() ); ?></h3>
						<?php endif; ?>
						<?php if ( $section->get_intro_text() ) : ?>
							<p class="contact-block__intro-text"><?php echo esc_html( $section->get_intro_text() ); ?></p>
						<?php endif; ?>
					</div>
				<?php endif; ?>

				<div class="contact-block__cards">
					<?php if ( $martincv_email ) : ?>
						<a href="mailto:<?php echo esc_attr( $martincv_email ); ?>" class="card-elegant contact-block__card">
							<span class="contact-block__card-icon"><?php Utility::icon( 'mail', 24 ); ?></span>
							<span class="contact-block__card-body">
								<span class="contact-block__card-title"><?php esc_html_e( 'Email', 'martincv' ); ?></span>
								<span class="contact-block__card-value"><?php echo esc_html( $martincv_email ); ?></span>
								<span class="contact-block__card-note"><?php esc_html_e( 'Send me an email anytime', 'martincv' ); ?></span>
							</span>
							<span class="contact-block__card-arrow"><?php Utility::icon( 'external-link', 16 ); ?></span>
						</a>
					<?php endif; ?>
					<?php if ( $martincv_codeable ) : ?>
						<a href="<?php echo esc_url( $martincv_codeable ); ?>" class="card-elegant contact-block__card" target="_blank" rel="noopener noreferrer">
							<span class="contact-block__card-icon"><?php Utility::icon( 'external-link', 24 ); ?></span>
							<span class="contact-block__card-body">
								<span class="contact-block__card-title"><?php esc_html_e( 'Codeable Profile', 'martincv' ); ?></span>
								<span class="contact-block__card-value"><?php esc_html_e( 'Hire on Codeable', 'martincv' ); ?></span>
								<span class="contact-block__card-note"><?php esc_html_e( 'Professional WordPress projects', 'martincv' ); ?></span>
							</span>
							<span class="contact-block__card-arrow"><?php Utility::icon( 'external-link', 16 ); ?></span>
						</a>
					<?php endif; ?>
					<?php if ( $martincv_consultation ) : ?>
						<a href="<?php echo esc_url( $martincv_consultation ); ?>" class="card-elegant contact-block__card" target="_blank" rel="noopener noreferrer">
							<span class="contact-block__card-icon"><?php Utility::icon( 'calendar', 24 ); ?></span>
							<span class="contact-block__card-body">
								<span class="contact-block__card-title"><?php esc_html_e( 'Consultation', 'martincv' ); ?></span>
								<span class="contact-block__card-value"><?php esc_html_e( 'Book a Call', 'martincv' ); ?></span>
								<span class="contact-block__card-note"><?php esc_html_e( 'Schedule a free consultation', 'martincv' ); ?></span>
							</span>
							<span class="contact-block__card-arrow"><?php Utility::icon( 'external-link', 16 ); ?></span>
						</a>
					<?php endif; ?>
				</div>

				<?php if ( $section->get_why_items() ) : ?>
					<div class="contact-block__why">
						<?php if ( $section->get_why_title() ) : ?>
							<h4 class="contact-block__why-title"><?php echo esc_html( $section->get_why_title() ); ?></h4>
						<?php endif; ?>
						<ul class="contact-block__why-list">
							<?php foreach ( $section->get_why_items() as $martincv_item ) : ?>
								<li class="contact-block__why-item"><?php echo esc_html( $martincv_item['text'] ?? '' ); ?></li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endif; ?>
			</div>

			<div class="card-elegant contact-block__form">
				<?php if ( $section->get_form_title() ) : ?>
					<h3 class="contact-block__form-title"><?php echo esc_html( $section->get_form_title() ); ?></h3>
				<?php endif; ?>
				<?php if ( $section->get_form_shortcode() ) : ?>
					<div class="contact-block__form-wrap">
						<?php echo do_shortcode( $section->get_form_shortcode() ); ?>
					</div>
				<?php elseif ( current_user_can( 'edit_posts' ) ) : ?>
					<p class="contact-block__form-missing"><?php esc_html_e( 'Add a form shortcode in the block settings.', 'martincv' ); ?></p>
				<?php endif; ?>
				<?php if ( $section->get_form_note() ) : ?>
					<p class="contact-block__form-note"><?php echo esc_html( $section->get_form_note() ); ?></p>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
