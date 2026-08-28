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
	 * Availability pill text
	 *
	 * @var string
	 */
	protected string $availability_text = '';

	/**
	 * Heading text
	 *
	 * @var string
	 */
	protected string $heading = '';

	/**
	 * Heading gradient part
	 *
	 * @var string
	 */
	protected string $heading_highlight = '';

	/**
	 * Description text
	 *
	 * @var string
	 */
	protected string $description = '';

	/**
	 * Primary button text
	 *
	 * @var string
	 */
	protected string $primary_btn_text = '';

	/**
	 * Primary button link
	 *
	 * @var string
	 */
	protected string $primary_btn_link = '';

	/**
	 * Show resume button
	 *
	 * @var bool
	 */
	protected bool $show_resume = false;

	/**
	 * Book a call text
	 *
	 * @var string
	 */
	protected string $book_call_text = '';

	/**
	 * Book a call link
	 *
	 * @var string
	 */
	protected string $book_call_link = '';

	/**
	 * Stats rows
	 *
	 * @var array
	 */
	protected array $stats = array();

	/**
	 * Portrait image (ACF array)
	 *
	 * @var array
	 */
	protected array $portrait = array();

	/**
	 * Based in text
	 *
	 * @var string
	 */
	protected string $based_in = '';

	/**
	 * Floating badge text
	 *
	 * @var string
	 */
	protected string $badge_text = '';

	/**
	 * Floating badge link
	 *
	 * @var string
	 */
	protected string $badge_link = '';

	/**
	 * Skills marquee rows
	 *
	 * @var array
	 */
	protected array $skills = array();

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

		$this->availability_text = (string) get_field( 'availability_text' );
		$this->heading           = (string) get_field( 'heading' );
		$this->heading_highlight = (string) get_field( 'heading_highlight' );
		$this->description       = (string) get_field( 'description' );
		$this->primary_btn_text  = (string) get_field( 'primary_btn_text' );
		$this->primary_btn_link  = (string) get_field( 'primary_btn_link' );
		$this->show_resume       = (bool) get_field( 'show_resume' );
		$this->book_call_text    = (string) get_field( 'book_call_text' );
		$this->book_call_link    = (string) get_field( 'book_call_link' );
		$this->stats             = (array) get_field( 'stats' );
		$this->portrait          = (array) get_field( 'portrait' );
		$this->based_in          = (string) get_field( 'based_in' );
		$this->badge_text        = (string) get_field( 'badge_text' );
		$this->badge_link        = (string) get_field( 'badge_link' );
		$this->skills            = (array) get_field( 'skills' );

		$this->is_initialized = true;
	}

	/**
	 * Get availability pill text
	 *
	 * @return string
	 */
	public function get_availability_text(): string {
		return $this->availability_text;
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
	 * Get heading gradient part
	 *
	 * @return string
	 */
	public function get_heading_highlight(): string {
		return $this->heading_highlight;
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
	 * Get primary button text
	 *
	 * @return string
	 */
	public function get_primary_btn_text(): string {
		return $this->primary_btn_text;
	}

	/**
	 * Get primary button link
	 *
	 * @return string
	 */
	public function get_primary_btn_link(): string {
		return $this->primary_btn_link ?: '#';
	}

	/**
	 * Should the resume button show
	 *
	 * @return bool
	 */
	public function show_resume(): bool {
		return $this->show_resume;
	}

	/**
	 * Get book a call text
	 *
	 * @return string
	 */
	public function get_book_call_text(): string {
		return $this->book_call_text;
	}

	/**
	 * Get book a call link
	 *
	 * @return string
	 */
	public function get_book_call_link(): string {
		return $this->book_call_link ?: '#';
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
	 * Get portrait URL
	 *
	 * @return string
	 */
	public function get_portrait_url(): string {
		return (string) ( $this->portrait['url'] ?? '' );
	}

	/**
	 * Get portrait alt text
	 *
	 * @return string
	 */
	public function get_portrait_alt(): string {
		return (string) ( $this->portrait['alt'] ?? '' );
	}

	/**
	 * Get based in text
	 *
	 * @return string
	 */
	public function get_based_in(): string {
		return $this->based_in;
	}

	/**
	 * Get floating badge text
	 *
	 * @return string
	 */
	public function get_badge_text(): string {
		return $this->badge_text;
	}

	/**
	 * Get floating badge link
	 *
	 * @return string
	 */
	public function get_badge_link(): string {
		return $this->badge_link ?: '#';
	}

	/**
	 * Get skills marquee rows
	 *
	 * @return array
	 */
	public function get_skills(): array {
		return $this->skills;
	}
}
