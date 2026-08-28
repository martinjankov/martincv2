<?php
/**
 * Enqueue Assets
 *
 * Loads the global and per-template asset bundles built by wp-scripts.
 *
 * @package MartinCV
 */

namespace MartinCV;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue Assets Class
 */
class Enqueue_Assets {
	use \MartinCV\Traits\Singleton;

	/**
	 * Initialize object
	 *
	 * @return void
	 */
	private function initialize(): void {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_assets' ) );
	}

	/**
	 * Load global and per-template assets
	 *
	 * @return void
	 */
	public function enqueue_assets(): void {
		wp_enqueue_style( 'wp-block-library' );

		$this->enqueue_bundle( 'wp-theme-main', 'index' );

		if ( is_404() ) {
			$this->enqueue_bundle( 'wp-theme-404', '404' );
		}

		if ( is_archive() || is_search() ) {
			$this->enqueue_bundle( 'wp-theme-archive', 'archive' );
		}

		if ( is_home() ) {
			$this->enqueue_bundle( 'wp-theme-home', 'home' );

			wp_localize_script(
				'wp-theme-home',
				'martincvBlog',
				array(
					'ajaxUrl' => admin_url( 'admin-ajax.php' ),
					'nonce'   => wp_create_nonce( 'martincv_blog' ),
				)
			);
		}

		if ( is_post_type_archive( 'service' ) ) {
			$this->enqueue_bundle( 'wp-theme-archive-service', 'archive-service' );
		}

		if ( is_post_type_archive( 'project' ) ) {
			$this->enqueue_bundle( 'wp-theme-archive-project', 'archive-project' );
		}

		if ( is_singular( 'project' ) ) {
			$this->enqueue_bundle( 'wp-theme-single-project', 'single-project' );
		}

		if ( is_singular( 'service' ) ) {
			$this->enqueue_bundle( 'wp-theme-single-service', 'single-service' );
		}

		if ( is_singular( 'post' ) ) {
			$this->enqueue_bundle( 'wp-theme-single-post', 'single' );
		}
	}

	/**
	 * Enqueue one wp-scripts bundle (style + script) by build entry name.
	 *
	 * @param string $handle Asset handle.
	 * @param string $entry  Build entry name inside build/theme/.
	 *
	 * @return void
	 */
	private function enqueue_bundle( string $handle, string $entry ): void {
		$asset_file = MARTINCV_THEME_DIR . 'build/theme/' . $entry . '.asset.php';

		if ( ! file_exists( $asset_file ) ) {
			return;
		}

		$assets_info = include $asset_file;

		wp_enqueue_style( $handle, MARTINCV_THEME_URL . 'build/theme/' . $entry . '.css', array(), $assets_info['version'] );
		wp_enqueue_script( $handle, MARTINCV_THEME_URL . 'build/theme/' . $entry . '.js', $assets_info['dependencies'], $assets_info['version'], true );
	}
}
