<?php
/**
 * Register ACF Guttenberg Blocks
 *
 * @package MartinCV
 */

namespace MartinCV\Core;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * ACF Guttenberg Blocks Class
 */
class ACF_Guttenberg_Blocks {
	use \MartinCV\Traits\Singleton;

	/**
	 * Initialize
	 *
	 * @return  void
	 */
	private function initialize() {
		add_action( 'acf/init', array( $this, 'register_blocks' ) );
	}

	/**
	 * Register ACF Guttenberg Blocks
	 *
	 * @return  void
	 */
	public function register_blocks() {
		if ( ! function_exists( 'acf_register_block' ) ) {
			return;
		}

		acf_register_block(
			array(
				'name'            => 'hero-home-section',
				'title'           => __( 'Hero Home Section', 'martincv' ),
				'description'     => __( 'A custom block.', 'martincv' ),
				'render_callback' => array( $this, 'render_block' ),
				'enqueue_assets'  => array( $this, 'load_assets' ),
				'category'        => 'formatting',
				'icon'            => 'laptop',
				'keywords'        => array( 'hero' ),
			)
		);

		acf_register_block(
			array(
				'name'            => 'about-section',
				'title'           => __( 'About Section', 'martincv' ),
				'description'     => __( 'A custom block.', 'martincv' ),
				'render_callback' => array( $this, 'render_block' ),
				'enqueue_assets'  => array( $this, 'load_assets' ),
				'category'        => 'formatting',
				'icon'            => 'user',
				'keywords'        => array( 'about' ),
			)
		);

		acf_register_block(
			array(
				'name'            => 'services-section',
				'title'           => __( 'Services Section', 'martincv' ),
				'description'     => __( 'A custom block.', 'martincv' ),
				'render_callback' => array( $this, 'render_block' ),
				'enqueue_assets'  => array( $this, 'load_assets' ),
				'category'        => 'formatting',
				'icon'            => 'cogs',
				'keywords'        => array( 'services' ),
			)
		);

		acf_register_block(
			array(
				'name'            => 'experience-section',
				'title'           => __( 'Experience Section', 'martincv' ),
				'description'     => __( 'A custom block.', 'martincv' ),
				'render_callback' => array( $this, 'render_block' ),
				'enqueue_assets'  => array( $this, 'load_assets' ),
				'category'        => 'formatting',
				'icon'            => 'cogs',
				'keywords'        => array( 'experience' ),
			)
		);

		acf_register_block(
			array(
				'name'            => 'portfolio-section',
				'title'           => __( 'Portfolio Section', 'martincv' ),
				'description'     => __( 'A custom block.', 'martincv' ),
				'render_callback' => array( $this, 'render_block' ),
				'enqueue_assets'  => array( $this, 'load_assets' ),
				'category'        => 'formatting',
				'icon'            => 'cogs',
				'keywords'        => array( 'portfolio' ),
			)
		);
	}

	/**
	 * Render the ACF Guttenberg block
	 *
	 * @param   array $block  Block data.
	 *
	 * @return  void
	 */
	public function render_block( $block ) {
		$slug = str_replace( 'acf/', '', $block['name'] );

		if ( file_exists( MARTINCV_THEME_DIR . "template-parts/blocks/content-{$slug}.php" ) ) {
			require MARTINCV_THEME_DIR . "template-parts/blocks/content-{$slug}.php";
		}
	}

	/**
	 * Load block assets
	 *
	 * @param   array $block  Block data.
	 *
	 * @return  void
	 */
	public function load_assets( $block ) {
		$slug = str_replace( 'acf/', '', $block['name'] );

		wp_enqueue_style(
			$slug,
			MARTINCV_THEME_URL . 'assets/public/css/gutenberg-blocks/' . $slug . '.css',
			array(),
			MARTINCV_THEME_VERSION
		);
	}
}
