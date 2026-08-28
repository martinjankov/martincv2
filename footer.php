<?php
/**
 * Footer template
 *
 * @package MartinCV
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$martincv_footer = MartinCV\Footer::get_instance();

?>
	<footer class="site-footer">
		<div class="footer-main">
			<div class="footer-main__inner">
				<div class="footer-col footer-col--about">
					<div class="footer-col__logo">
						<?php $martincv_footer->render_logo(); ?>
					</div>
					<?php $martincv_footer->render_about_text(); ?>
					<?php $martincv_footer->render_social_icons(); ?>
				</div>

				<?php $martincv_footer->render_menu_column( __( 'Links', 'martincv' ), 'footer' ); ?>
				<?php $martincv_footer->render_contact_column(); ?>
			</div>
		</div>

		<?php $martincv_footer->render_copyright(); ?>
	</footer>
	<button class="scroll-to-top" id="scroll-to-top" type="button" aria-label="<?php esc_attr_e( 'Scroll to top', 'martincv' ); ?>">
		<svg class="scroll-to-top__icon" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
			<path d="m18 15-6-6-6 6"/>
		</svg>
	</button>
	<?php wp_footer(); ?>
	</body>
</html>
