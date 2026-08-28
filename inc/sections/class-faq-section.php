<?php
/**
 * FAQ Section
 *
 * @package MartinCV
 */

namespace MartinCV\Sections;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * FAQ Section Class
 */
class FAQ_Section {
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
	 * CTA text
	 *
	 * @var string
	 */
	protected string $cta_text = '';

	/**
	 * CTA link
	 *
	 * @var string
	 */
	protected string $cta_link = '';

	/**
	 * FAQ rows
	 *
	 * @var array
	 */
	protected array $faqs = array();

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

		$this->eyebrow     = (string) get_field( 'eyebrow' );
		$this->title       = (string) get_field( 'title' );
		$this->description = (string) get_field( 'description' );
		$this->cta_text    = (string) get_field( 'cta_text' );
		$this->cta_link    = (string) get_field( 'cta_link' );
		$this->faqs        = (array) get_field( 'faqs' );

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

	/**
	 * Get FAQ rows
	 *
	 * @return array
	 */
	public function get_faqs(): array {
		return $this->faqs;
	}
}
