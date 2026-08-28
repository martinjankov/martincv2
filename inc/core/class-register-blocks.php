<?php
/**
 * Register Gutenberg Blocks
 *
 * @package MartinCV
 */

namespace MartinCV\Core;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Gutenberg Blocks Class
 */
class Register_Blocks {
	use \MartinCV\Traits\Singleton;

	/**
	 * Initialize
	 *
	 * @return void
	 */
	private function initialize() {
		add_action( 'init', array( $this, 'register_blocks' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'dequeue_unused_block_assets' ), 100 );
	}

	/**
	 * Dequeue unused block assets
	 *
	 * Dequeues block styles and scripts for blocks that are not used on the current page.
	 * This improves performance by only loading assets for blocks that are actually present.
	 *
	 * @return void
	 */
	public function dequeue_unused_block_assets() {
		if ( ! is_singular() ) {
			return;
		}

		global $post;

		if ( ! $post ) {
			return;
		}

		$block_directories = glob( MARTINCV_THEME_DIR . 'build/blocks/*', GLOB_ONLYDIR );

		foreach ( $block_directories as $block_dir ) {
			$block_name = 'acf/' . basename( $block_dir );
			if ( ! has_block( $block_name, $post ) ) {
				$style_handle  = str_replace( 'acf/', '', $block_name ) . '-style-index';
				$script_handle = str_replace( 'acf/', '', $block_name ) . '-script-index';

				wp_dequeue_style( $style_handle );
				wp_dequeue_script( $script_handle );
				wp_dequeue_style( 'wp-block-' . str_replace( '/', '-', $block_name ) );
				wp_dequeue_script( 'wp-block-' . str_replace( '/', '-', $block_name ) );
				wp_dequeue_style( str_replace( '/', '-', $block_name ) . '-style' );
				wp_dequeue_script( str_replace( '/', '-', $block_name ) . '-script' );
			}
		}
	}

	/**
	 * Register Gutenberg Blocks
	 *
	 * @return  void
	 */
	public function register_blocks() {
		$block_directories = glob( MARTINCV_THEME_DIR . 'build/blocks/*', GLOB_ONLYDIR );

		foreach ( $block_directories as $block ) {
			register_block_type( $block );
		}
	}
}
