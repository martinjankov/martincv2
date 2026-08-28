<?php
/**
 * Services Section
 *
 * @package MartinCV
 */

namespace MartinCV\Sections;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Services Section Class
 */
class Services_Section {
	use \MartinCV\Traits\Singleton;

	/**
	 * Eyebrow text
	 *
	 * @var string
	 */
	protected string $eyebrow = '';

	/**
	 * Title
	 *
	 * @var string
	 */
	protected string $title = '';

	/**
	 * Description
	 *
	 * @var string
	 */
	protected string $description = '';

	/**
	 * Top CTA text
	 *
	 * @var string
	 */
	protected string $top_cta_text = '';

	/**
	 * Top CTA link
	 *
	 * @var string
	 */
	protected string $top_cta_link = '';

	/**
	 * Services rows
	 *
	 * @var array
	 */
	protected array $services = array();

	/**
	 * Bottom CTA title
	 *
	 * @var string
	 */
	protected string $bottom_title = '';

	/**
	 * Bottom CTA text
	 *
	 * @var string
	 */
	protected string $bottom_text = '';

	/**
	 * Bottom CTA button text
	 *
	 * @var string
	 */
	protected string $bottom_btn_text = '';

	/**
	 * Bottom CTA button link
	 *
	 * @var string
	 */
	protected string $bottom_btn_link = '';

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

		$this->eyebrow         = (string) get_field( 'eyebrow' );
		$this->title           = (string) get_field( 'title' );
		$this->description     = (string) get_field( 'description' );
		$this->top_cta_text    = (string) get_field( 'top_cta_text' );
		$this->top_cta_link    = (string) get_field( 'top_cta_link' );
		$this->services        = \MartinCV\Utility::rows( get_field( 'services' ) );
		$this->bottom_title    = (string) get_field( 'bottom_title' );
		$this->bottom_text     = (string) get_field( 'bottom_text' );
		$this->bottom_btn_text = (string) get_field( 'bottom_btn_text' );
		$this->bottom_btn_link = (string) get_field( 'bottom_btn_link' );

		$this->is_initialized = true;
	}

	/**
	 * Get eyebrow
	 *
	 * @return string
	 */
	public function get_eyebrow(): string {
		return $this->eyebrow;
	}

	/**
	 * Get title
	 *
	 * @return string
	 */
	public function get_title(): string {
		return $this->title;
	}

	/**
	 * Get description
	 *
	 * @return string
	 */
	public function get_description(): string {
		return $this->description;
	}

	/**
	 * Get top CTA text
	 *
	 * @return string
	 */
	public function get_top_cta_text(): string {
		return $this->top_cta_text;
	}

	/**
	 * Get top CTA link
	 *
	 * @return string
	 */
	public function get_top_cta_link(): string {
		return $this->top_cta_link ?: '#';
	}

	/**
	 * Get services rows
	 *
	 * @return array
	 */
	public function get_services(): array {
		return $this->services;
	}

	/**
	 * Split a service tags textarea into an array of tags.
	 *
	 * @param string $tags Raw tags value.
	 * @return array
	 */
	public function get_tags_list( string $tags ): array {
		return array_filter( array_map( 'trim', preg_split( '/\r\n|\r|\n/', $tags ) ) );
	}

	/**
	 * Get bottom CTA title
	 *
	 * @return string
	 */
	public function get_bottom_title(): string {
		return $this->bottom_title;
	}

	/**
	 * Get bottom CTA text
	 *
	 * @return string
	 */
	public function get_bottom_text(): string {
		return $this->bottom_text;
	}

	/**
	 * Get bottom CTA button text
	 *
	 * @return string
	 */
	public function get_bottom_btn_text(): string {
		return $this->bottom_btn_text;
	}

	/**
	 * Get bottom CTA button link
	 *
	 * @return string
	 */
	public function get_bottom_btn_link(): string {
		return $this->bottom_btn_link ?: '#';
	}
}
