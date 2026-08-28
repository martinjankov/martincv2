<?php
/**
 * Search form template
 *
 * @package MartinCV
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="GET" class="search-form">
	<span class="search-icon">
		<svg xmlns="http://www.w3.org/2000/svg" viewBox="-1 -1 25 25" aria-hidden="true"><circle fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="square" cx="10" cy="10" r="9"></circle><line fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="square" x1="22" y1="22" x2="16.4" y2="16.4"></line></svg>
	</span>
	<input type="search" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php esc_attr_e( 'Search…', 'martincv' ); ?>" aria-label="<?php esc_attr_e( 'Search', 'martincv' ); ?>">
</form>
