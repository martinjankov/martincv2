<?php
/**
 * About Section
 *
 * @package MartinCV
 */

namespace MartinCV\Sections;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * About Section Class
 */
class About_Section {
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
	 * Content HTML
	 *
	 * @var string
	 */
	protected string $content = '';

	/**
	 * Value cards
	 *
	 * @var array
	 */
	protected array $values = array();

	/**
	 * Expertise card title
	 *
	 * @var string
	 */
	protected string $expertise_title = '';

	/**
	 * Expertise card subtitle
	 *
	 * @var string
	 */
	protected string $expertise_subtitle = '';

	/**
	 * Expertise skills
	 *
	 * @var array
	 */
	protected array $skills = array();

	/**
	 * CTA note
	 *
	 * @var string
	 */
	protected string $cta_note = '';

	/**
	 * CTA button text
	 *
	 * @var string
	 */
	protected string $cta_text = '';

	/**
	 * CTA button link
	 *
	 * @var string
	 */
	protected string $cta_link = '';

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

		$this->eyebrow            = (string) get_field( 'eyebrow' );
		$this->title              = (string) get_field( 'title' );
		$this->content            = (string) get_field( 'content' );
		$this->values             = (array) get_field( 'values' );
		$this->expertise_title    = (string) get_field( 'expertise_title' );
		$this->expertise_subtitle = (string) get_field( 'expertise_subtitle' );
		$this->skills             = (array) get_field( 'skills' );
		$this->cta_note           = (string) get_field( 'cta_note' );
		$this->cta_text           = (string) get_field( 'cta_text' );
		$this->cta_link           = (string) get_field( 'cta_link' );

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
	 * Get content HTML
	 *
	 * @return string
	 */
	public function get_content(): string {
		return $this->content;
	}

	/**
	 * Get value cards
	 *
	 * @return array
	 */
	public function get_values(): array {
		return $this->values;
	}

	/**
	 * Get expertise title
	 *
	 * @return string
	 */
	public function get_expertise_title(): string {
		return $this->expertise_title;
	}

	/**
	 * Get expertise subtitle
	 *
	 * @return string
	 */
	public function get_expertise_subtitle(): string {
		return $this->expertise_subtitle;
	}

	/**
	 * Get expertise skills
	 *
	 * @return array
	 */
	public function get_skills(): array {
		return $this->skills;
	}

	/**
	 * Get CTA note
	 *
	 * @return string
	 */
	public function get_cta_note(): string {
		return $this->cta_note;
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
	 * Get CTA link
	 *
	 * @return string
	 */
	public function get_cta_link(): string {
		return $this->cta_link ?: '#';
	}
}
