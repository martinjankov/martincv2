<?php
/**
 * Process Section
 *
 * @package MartinCV
 */

namespace MartinCV\Sections;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Process Section Class
 */
class Process_Section {
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
	 * Workflow steps
	 *
	 * @var array
	 */
	protected array $steps = array();

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
	protected string $cta_button_text = '';

	/**
	 * CTA button link
	 *
	 * @var string
	 */
	protected string $cta_button_link = '';

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
		$this->steps           = \MartinCV\Utility::rows( get_field( 'steps' ) );
		$this->cta_title       = (string) get_field( 'cta_title' );
		$this->cta_text        = (string) get_field( 'cta_text' );
		$this->cta_button_text = (string) get_field( 'cta_button_text' );
		$this->cta_button_link = (string) get_field( 'cta_button_link' );

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
	 * Get workflow steps
	 *
	 * @return array
	 */
	public function get_steps(): array {
		return $this->steps;
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
	public function get_cta_button_text(): string {
		return $this->cta_button_text;
	}

	/**
	 * Get CTA button link
	 *
	 * @return string
	 */
	public function get_cta_button_link(): string {
		return $this->cta_button_link;
	}
}
