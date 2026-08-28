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

$martincv_header = MartinCV\Header::get_instance();

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
	<?php wp_head(); ?>
</head>
<body <?php body_class( $post ? $post->post_name : '' ); ?>>
<?php wp_body_open(); ?>
<header class="site-header">
	<div class="header-inner">
		<div class="header-logo">
			<?php $martincv_header->render_logo(); ?>
		</div>
		<nav class="header-nav" id="header-nav" aria-label="<?php esc_attr_e( 'Primary Navigation', 'martincv' ); ?>">
			<?php $martincv_header->render_desktop_nav(); ?>
		</nav>
		<?php $martincv_header->render_burger(); ?>
	</div>
</header>
