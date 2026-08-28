<?php
/**
 * Page template
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
	<?php
	while ( have_posts() ) :
		the_post();

		the_content();
	endwhile;
	?>
</main>
<?php
get_footer();
