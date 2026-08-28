<?php
/**
 * Contact Section
 *
 * @package MartinCV
 */

namespace MartinCV\Sections;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Contact Section Class
 */
class Contact_Section {
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
	 * Intro title
	 *
	 * @var string
	 */
	protected string $intro_title = '';

	/**
	 * Intro text
	 *
	 * @var string
	 */
	protected string $intro_text = '';

	/**
	 * Why card title
	 *
	 * @var string
	 */
	protected string $why_title = '';

	/**
	 * Why card items
	 *
	 * @var array
	 */
	protected array $why_items = array();

	/**
	 * Form title
	 *
	 * @var string
	 */
	protected string $form_title = '';

	/**
	 * Form shortcode
	 *
	 * @var string
	 */
	protected string $form_shortcode = '';

	/**
	 * Form note
	 *
	 * @var string
	 */
	protected string $form_note = '';

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

		$this->eyebrow        = (string) get_field( 'eyebrow' );
		$this->title          = (string) get_field( 'title' );
		$this->description    = (string) get_field( 'description' );
		$this->intro_title    = (string) get_field( 'intro_title' );
		$this->intro_text     = (string) get_field( 'intro_text' );
		$this->why_title      = (string) get_field( 'why_title' );
		$this->why_items      = (array) get_field( 'why_items' );
		$this->form_title     = (string) get_field( 'form_title' );
		$this->form_shortcode = (string) get_field( 'form_shortcode' );
		$this->form_note      = (string) get_field( 'form_note' );

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
	 * Get intro title
	 *
	 * @return string
	 */
	public function get_intro_title(): string {
		return $this->intro_title;
	}

	/**
	 * Get intro text
	 *
	 * @return string
	 */
	public function get_intro_text(): string {
		return $this->intro_text;
	}

	/**
	 * Get why card title
	 *
	 * @return string
	 */
	public function get_why_title(): string {
		return $this->why_title;
	}

	/**
	 * Get why card items
	 *
	 * @return array
	 */
	public function get_why_items(): array {
		return $this->why_items;
	}

	/**
	 * Get form title
	 *
	 * @return string
	 */
	public function get_form_title(): string {
		return $this->form_title;
	}

	/**
	 * Get form shortcode
	 *
	 * @return string
	 */
	public function get_form_shortcode(): string {
		return $this->form_shortcode;
	}

	/**
	 * Get form note
	 *
	 * @return string
	 */
	public function get_form_note(): string {
		return $this->form_note;
	}
}
