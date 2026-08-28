<?php
/**
 * 404 template
 *
 * @package MartinCV
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>
<main class="wp-page-main">
	<section class="error-404">
		<div class="martincv-container">
			<p class="error-404__code">404</p>
			<h1 class="error-404__title"><?php esc_html_e( 'Page not found', 'martincv' ); ?></h1>
			<p class="error-404__desc"><?php esc_html_e( 'The page you are looking for does not exist or has been moved.', 'martincv' ); ?></p>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="error-404__btn">
				<?php esc_html_e( 'Back to home', 'martincv' ); ?>
			</a>
		</div>
	</section>
</main>
<?php
get_footer();
