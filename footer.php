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
		<?php esc_html_e( 'All Rights Reserved ', 'martincv' ); ?>
		&copy;
		<?php echo esc_html( gmdate( 'Y' ) ); ?>
	</footer>
	<?php wp_footer(); ?>
	</body>
</html>
