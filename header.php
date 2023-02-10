<?php
/**
 * Header template
 *
 * @package MartinCV
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/public/images/favicon.png">
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-XFD2VJ05V3"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'G-XFD2VJ05V3');
	</script>
	<?php wp_head(); ?>
</head>
<body <?php body_class( $post->post_name ); ?>>
	<?php wp_body_open(); ?>
	<header>
		<div class="martincv-header__wrapper">
			<div class="martincv-logo">
				<?php echo wp_kses_post( get_custom_logo() ); ?>
				<span class="martincv-logo__dot"></span>
			</div>
			<button type="button" class="martincv-mobile-nav">
				<img src="<?php echo esc_url( MARTINCV_THEME_URL . 'assets/public/images/menu-icon.svg' ); ?>" alt="<?php esc_html_e( 'Menu', 'martincv' ); ?>" width="30" height="30">
			</button>
		</div>
		<nav>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
				)
			);
			?>
		</nav>
	</header>
