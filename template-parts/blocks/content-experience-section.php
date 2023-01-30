<?php
/**
 * Experience Block
 *
 * @package MartinCV
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$start_date = date_create( '2014-06-03' );
$end_date   = date_create( gmdate( 'Y-m-d' ) );
$interval   = date_diff( $start_date, $end_date );

$backgroud_img = get_field( 'experience_background_image' );
?>

<section class="martincv-experience" id="experience" <?php echo $backgroud_img ? 'style="background-image: url(' . esc_url( $backgroud_img ) . ')"' : ''; ?>>
	<div class="martincv-experience__data">
		<div class="martincv-experience__years">
			<div><?php echo esc_html( $interval->format( '%y+' ) ); ?></div>
			<div><?php esc_html_e( 'Years of Experience', 'martincv' ); ?></div>
		</div>
		<div class="martincv-experience__projects">
			<div><?php printf( '%s+', esc_html( get_field( 'projects_done' ) ) ); ?></div>
			<div><?php esc_html_e( 'Projects Done', 'martincv' ); ?></div>
		</div>
		<div class="martincv-experience__clients">
			<div><?php printf( '%s+', esc_html( get_field( 'number_of_clients' ) ) ); ?></div>
			<div><?php esc_html_e( 'Happy Clients', 'martincv' ); ?></div>
		</div>
	</div>
</section>
