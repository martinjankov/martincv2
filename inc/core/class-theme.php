<?php
/**
 * Theme handlers
 *
 * @package MartinCV
 */

namespace MartinCV\Core;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Theme Class
 */
class Theme {
	use \MartinCV\Traits\Singleton;

	/**
	 * Initialize object
	 *
	 * @return void
	 */
	private function initialize(): void {
		add_action( 'init', array( $this, 'set_globals' ) );
	}

	/**
	 * Set theme globals
	 *
	 * @return void
	 */
	public function set_globals(): void {
		global $martincv_theme;
		$martincv_theme = self::get_instance();
	}

	/**
	 * Should we show debug info
	 *
	 * @return bool
	 */
	public function show_debug() {
		return current_user_can( 'manage_options' ) && defined( 'WP_DEBUG' ) && WP_DEBUG;
	}

	/**
	 * Render errors if can be shown
	 *
	 * @param  \WP_Error|string $err The WP_Error object or error string.
	 *
	 * @return void
	 */
	public function maybe_render_error( $err ): void {
		if ( ! $this->show_debug() ) {
			return;
		}

		printf( '<p class="err-msg">%s</p>', esc_html( $err instanceof \WP_Error ? $err->get_error() : $err ) );
	}

	/**
	 * Check if ACF plugins is active
	 *
	 * @return bool
	 */
	public function is_acf_active(): bool {
		return function_exists( 'get_field' );
	}

	/**
	 * Return allowed HTML tags for inline SVGs.
	 *
	 * @return array
	 */
	public static function kses_svg(): array {
		return array(
			'svg'      => array(
				'xmlns'        => true,
				'width'        => true,
				'height'       => true,
				'viewbox'      => true,
				'fill'         => true,
				'stroke'       => true,
				'stroke-width' => true,
				'class'        => true,
				'aria-hidden'  => true,
			),
			'path'     => array(
				'd'               => true,
				'fill'            => true,
				'stroke'          => true,
				'stroke-width'    => true,
				'stroke-linecap'  => true,
				'stroke-linejoin' => true,
			),
			'circle'   => array(
				'cx'              => true,
				'cy'              => true,
				'r'               => true,
				'fill'            => true,
				'stroke'          => true,
				'stroke-width'    => true,
				'stroke-linecap'  => true,
				'stroke-linejoin' => true,
			),
			'line'     => array(
				'x1'              => true,
				'y1'              => true,
				'x2'              => true,
				'y2'              => true,
				'stroke'          => true,
				'stroke-width'    => true,
				'stroke-linecap'  => true,
				'stroke-linejoin' => true,
			),
			'polyline' => array(
				'points'          => true,
				'fill'            => true,
				'stroke'          => true,
				'stroke-width'    => true,
				'stroke-linecap'  => true,
				'stroke-linejoin' => true,
			),
			'rect'     => array(
				'x'               => true,
				'y'               => true,
				'width'           => true,
				'height'          => true,
				'rx'              => true,
				'ry'              => true,
				'fill'            => true,
				'stroke'          => true,
				'stroke-width'    => true,
				'stroke-linecap'  => true,
				'stroke-linejoin' => true,
			),
			'polygon'  => array(
				'points'          => true,
				'fill'            => true,
				'stroke'          => true,
				'stroke-width'    => true,
				'stroke-linecap'  => true,
				'stroke-linejoin' => true,
			),
			'g'        => array(
				'fill'         => true,
				'stroke'       => true,
				'stroke-width' => true,
				'transform'    => true,
			),
		);
	}
}
