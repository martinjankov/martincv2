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
	<?php wp_head(); ?>
</head>
<body>
	<?php wp_body_open(); ?>
	<header>
		<div class="martincv-logo">
			<?php echo wp_kses_post( get_custom_logo() ); ?>
			<span class="martincv-logo__dot"></span>
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
