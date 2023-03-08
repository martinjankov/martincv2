<?php
/**
 * Process Steps Block
 *
 * @package MartinCV
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<?php if ( have_rows( 'process_steps' ) ) : ?>
<section class="martincv-process-steps" id="process-steps">
	<h2><?php esc_html_e( 'My Workflow', 'martincv' ); ?></h2>
	<div class="martincv-process__list">
		<?php
		while ( have_rows( 'process_steps' ) ) :
			the_row();
			?>
			<div class="martincv-process__step">
				<img src="<?php the_sub_field( 'icon' ); ?>" alt="Process phase">
				<h3><?php the_sub_field( 'title' ); ?></h3>
				<div class="process-step__description"><?php the_sub_field( 'description' ); ?></div>
			</div>
		<?php endwhile; ?>
	</div>
</section>
<?php endif; ?>
