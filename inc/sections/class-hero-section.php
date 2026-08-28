<?php
/**
 * Hero Section
 *
 * @package MartinCV
 */

namespace MartinCV\Sections;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Hero Section Class
 */
class Hero_Section {
	use \MartinCV\Traits\Singleton;

	/**
	 * Background image URL
	 *
	 * @var string
	 */
	protected string $bg_url = '';

	/**
	 * Heading text
	 *
	 * @var string
	 */
	protected string $heading = '';

	/**
	 * Subheading text
	 *
	 * @var string
	 */
	protected string $subheading = '';

	/**
	 * Button label
	 *
	 * @var string
	 */
	protected string $button_label = '';

	/**
	 * Button link
	 *
	 * @var string
	 */
	protected string $button_link = '';

	/**
	 * Is the section initialized
	 *
	 * @var boolean
	 */
	protected bool $is_initialized = false;

	/**
	 * Set properties from block context
	 *
	 * @param array $block The block array from ACF.
	 * @return void
	 */
	public function set_properties_from_block( array $block = array() ): void {
		if ( $this->is_initialized ) {
			return;
		}

		$bg_image = get_field( 'background_image' );

		if ( $bg_image ) {
			$this->bg_url = is_array( $bg_image ) ? $bg_image['url'] : wp_get_attachment_url( $bg_image );
		}

		$this->heading      = (string) get_field( 'heading' );
		$this->subheading   = (string) get_field( 'subheading' );
		$this->button_label = (string) get_field( 'button_label' );
		$this->button_link  = (string) get_field( 'button_link' );

		$this->is_initialized = true;
	}

	/**
	 * Get background image URL
	 *
	 * @return string
	 */
	public function get_bg_url(): string {
		return $this->bg_url;
	}

	/**
	 * Get heading
	 *
	 * @return string
	 */
	public function get_heading(): string {
		return $this->heading;
	}

	/**
	 * Get subheading
	 *
	 * @return string
	 */
	public function get_subheading(): string {
		return $this->subheading;
	}

	/**
	 * Get button label
	 *
	 * @return string
	 */
	public function get_button_label(): string {
		return $this->button_label;
	}

	/**
	 * Get button link
	 *
	 * @return string
	 */
	public function get_button_link(): string {
		return $this->button_link ?: '#';
	}
}
