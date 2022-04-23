<?php
/**
 * Index template
 *
 * @package MartinCV
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>
<main id="martincv-index" class="martincv-main">
<?php
while ( have_posts() ) :
	the_post();

	get_template_part( 'template-parts/content', 'page' );
endwhile;
?>
</main>
<?php
get_footer();
