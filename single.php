<?php
/**
 * Single template
 *
 * @package MartinCV
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>
<main id="martincv-single" class="martincv-main martincv-single">
<?php
while ( have_posts() ) :
	the_post();

	get_template_part( 'template-parts/blocks/content', 'hero-home-section' );
	?>
	<div class="martincv-single__content">
		<?php the_content(); ?>
	</div>
	<?php
endwhile;
?>
</main>
<?php
get_footer();
