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
	<?php wp_head(); ?>
</head>
<body <?php body_class( $post ? $post->post_name : '' ); ?>>
<?php wp_body_open(); ?>
<header class="site-header">
	<div class="site-header__pill">
		<div class="header-inner">
			<div class="header-logo">
				<?php $martincv_header->render_logo(); ?>
			</div>
			<nav class="header-nav" id="header-nav" aria-label="<?php esc_attr_e( 'Primary Navigation', 'martincv' ); ?>">
				<?php $martincv_header->render_desktop_nav(); ?>
				<div class="header-nav__actions">
					<?php $martincv_header->render_actions(); ?>
				</div>
			</nav>
			<?php $martincv_header->render_actions(); ?>
			<?php $martincv_header->render_burger(); ?>
		</div>
	</div>
</header>
