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
?>
	<footer>
		<div class="copyright">
			<?php esc_html_e( 'All Rights Reserved ', 'martincv' ); ?>
			&copy;
			<?php echo esc_html( gmdate( 'Y' ) ); ?>
		</div>
		<div class="privaty-policy-link">
			<a href="/privacy-policy/"><?php esc_html_e( 'Privacy Policy', 'martincv' ); ?></a>
		</div>
	</footer>
	<?php wp_footer(); ?>
	</body>
</html>
