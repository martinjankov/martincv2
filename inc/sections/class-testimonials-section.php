<?php
/**
 * Testimonials Section
 *
 * @package MartinCV
 */

namespace MartinCV\Sections;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Testimonials Section Class
 */
class Testimonials_Section {
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
	 * Testimonials rows
	 *
	 * @var array
	 */
	protected array $testimonials = array();

	/**
	 * Stats rows
	 *
	 * @var array
	 */
	protected array $stats = array();

	/**
	 * CTA title
	 *
	 * @var string
	 */
	protected string $cta_title = '';

	/**
	 * CTA text
	 *
	 * @var string
	 */
	protected string $cta_text = '';

	/**
	 * CTA button text
	 *
	 * @var string
	 */
	protected string $cta_btn_text = '';

	/**
	 * CTA button link
	 *
	 * @var string
	 */
	protected string $cta_btn_link = '';

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

		$this->eyebrow      = (string) get_field( 'eyebrow' );
		$this->title        = (string) get_field( 'title' );
		$this->description  = (string) get_field( 'description' );
		$this->testimonials = \MartinCV\Utility::rows( get_field( 'testimonials' ) );
		$this->stats        = \MartinCV\Utility::rows( get_field( 'stats' ) );
		$this->cta_title    = (string) get_field( 'cta_title' );
		$this->cta_text     = (string) get_field( 'cta_text' );
		$this->cta_btn_text = (string) get_field( 'cta_btn_text' );
		$this->cta_btn_link = (string) get_field( 'cta_btn_link' );

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
	 * Get testimonials rows
	 *
	 * @return array
	 */
	public function get_testimonials(): array {
		return $this->testimonials;
	}

	/**
	 * Get initials from an author name.
	 *
	 * @param string $name Author name.
	 * @return string
	 */
	public function get_initials( string $name ): string {
		$words    = preg_split( '/\s+/', trim( $name ) );
		$initials = '';

		foreach ( array_slice( (array) $words, 0, 2 ) as $word ) {
			if ( '' !== $word ) {
				$initials .= mb_strtoupper( mb_substr( $word, 0, 1 ) );
			}
		}

		return $initials;
	}

	/**
	 * Get stats rows
	 *
	 * @return array
	 */
	public function get_stats(): array {
		return $this->stats;
	}

	/**
	 * Get CTA title
	 *
	 * @return string
	 */
	public function get_cta_title(): string {
		return $this->cta_title;
	}

	/**
	 * Get CTA text
	 *
	 * @return string
	 */
	public function get_cta_text(): string {
		return $this->cta_text;
	}

	/**
	 * Get CTA button text
	 *
	 * @return string
	 */
	public function get_cta_btn_text(): string {
		return $this->cta_btn_text;
	}

	/**
	 * Get CTA button link
	 *
	 * @return string
	 */
	public function get_cta_btn_link(): string {
		return $this->cta_btn_link ?: '#';
	}
}
