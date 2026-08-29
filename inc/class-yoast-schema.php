<?php
/**
 * Yoast Schema
 *
 * Extends the Yoast SEO schema graph with Person, ProfessionalService,
 * Service, FAQPage and case-study Article structured data, optimized
 * for the US market.
 *
 * @package MartinCV
 */

namespace MartinCV;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Yoast Schema Class
 */
class Yoast_Schema {
	use \MartinCV\Traits\Singleton;

	/**
	 * Initialize.
	 *
	 * @return void
	 */
	public function initialize(): void {
		add_filter( 'wpseo_schema_graph', array( $this, 'add_schema' ), 10, 2 );
	}

	/**
	 * Add custom schema pieces to the Yoast graph.
	 *
	 * @param array                 $graph   The schema graph array.
	 * @param \WPSEO_Schema_Context $context The schema context object.
	 * @return array
	 */
	public function add_schema( array $graph, $context ): array {
		$graph = $this->upgrade_organization( $graph );

		if ( is_front_page() ) {
			$graph[] = $this->get_person();
			$item_list = $this->get_services_item_list();
			if ( $item_list ) {
				$graph[] = $item_list;
			}
		}

		if ( is_post_type_archive( 'service' ) ) {
			$item_list = $this->get_services_item_list();
			if ( $item_list ) {
				$graph[] = $item_list;
			}
		}

		if ( is_post_type_archive( 'project' ) ) {
			$item_list = $this->get_projects_item_list();
			if ( $item_list ) {
				$graph[] = $item_list;
			}
		}

		if ( is_singular( 'service' ) ) {
			$graph[] = $this->get_single_service_schema();

			$service_faq = $this->get_service_faq_schema();
			if ( $service_faq ) {
				$graph[] = $service_faq;
			}
		}

		if ( is_singular( 'project' ) ) {
			$graph[] = $this->get_case_study_schema();
		}

		// FAQPage for any page containing the FAQ block (home included).
		$faq = $this->get_faq_schema();
		if ( $faq ) {
			$graph[] = $faq;
		}

		return $graph;
	}

	/**
	 * Social profile URLs from Site Options.
	 *
	 * @return array
	 */
	private function get_same_as(): array {
		$links = array_filter(
			array(
				Site_Options::get_linkedin(),
				Site_Options::get_github(),
				Site_Options::get_x(),
				Site_Options::get_codeable_url(),
				Site_Options::get_upwork_url(),
				Site_Options::get_facebook(),
				Site_Options::get_instagram(),
				Site_Options::get_youtube(),
			),
			function ( $url ) {
				return $url && '#' !== $url;
			}
		);

		return array_values( $links );
	}

	/**
	 * Upgrade the Yoast Organization piece to ProfessionalService
	 * with US-market details.
	 *
	 * @param array $graph The schema graph.
	 * @return array
	 */
	private function upgrade_organization( array $graph ): array {
		$email = Site_Options::get_email();

		foreach ( $graph as &$piece ) {
			if ( ! isset( $piece['@type'] ) ) {
				continue;
			}

			$type = is_array( $piece['@type'] ) ? $piece['@type'] : array( $piece['@type'] );

			if ( ! in_array( 'Organization', $type, true ) ) {
				continue;
			}

			$piece['@type'] = array( 'ProfessionalService', 'Organization' );

			if ( $email && ! isset( $piece['email'] ) ) {
				$piece['email'] = $email;
			}

			$same_as = $this->get_same_as();
			if ( $same_as ) {
				$piece['sameAs'] = $same_as;
			}

			$piece['priceRange'] = '$$';
			$piece['areaServed'] = array(
				array(
					'@type' => 'Country',
					'name'  => 'United States',
				),
				array(
					'@type' => 'AdministrativeArea',
					'name'  => 'Worldwide',
				),
			);
			$piece['knowsAbout'] = array(
				'WordPress development',
				'Custom theme development',
				'Plugin development',
				'WooCommerce',
				'Performance optimization',
				'Laravel',
				'React',
			);
		}

		return $graph;
	}

	/**
	 * Person piece for the site owner.
	 *
	 * @return array
	 */
	private function get_person(): array {
		$person = array(
			'@type'    => 'Person',
			'@id'      => home_url( '/#person' ),
			'name'     => get_bloginfo( 'name' ),
			'url'      => home_url( '/' ),
			'jobTitle' => __( 'WordPress Developer', 'martincv' ),
			'worksFor' => array( '@id' => home_url( '/#organization' ) ),
		);

		$email = Site_Options::get_email();
		if ( $email ) {
			$person['email'] = $email;
		}

		$same_as = $this->get_same_as();
		if ( $same_as ) {
			$person['sameAs'] = $same_as;
		}

		return $person;
	}

	/**
	 * ItemList of services for sitelinks.
	 *
	 * @return array|null
	 */
	private function get_services_item_list(): ?array {
		$services = get_posts(
			array(
				'post_type'      => 'service',
				'posts_per_page' => -1,
				'orderby'        => 'menu_order',
				'order'          => 'ASC',
			)
		);

		if ( ! $services ) {
			return null;
		}

		$items = array();
		foreach ( $services as $index => $service ) {
			$items[] = array(
				'@type'    => 'ListItem',
				'position' => $index + 1,
				'url'      => get_permalink( $service ),
				'name'     => get_the_title( $service ),
			);
		}

		return array(
			'@type'           => 'ItemList',
			'@id'             => get_post_type_archive_link( 'service' ) . '#services-list',
			'name'            => __( 'Services', 'martincv' ),
			'itemListElement' => $items,
		);
	}

	/**
	 * ItemList of project case studies for sitelinks.
	 *
	 * @return array|null
	 */
	private function get_projects_item_list(): ?array {
		$projects = get_posts(
			array(
				'post_type'      => 'project',
				'posts_per_page' => -1,
				'orderby'        => array(
					'menu_order' => 'ASC',
					'date'       => 'DESC',
				),
			)
		);

		if ( ! $projects ) {
			return null;
		}

		$items = array();
		foreach ( $projects as $index => $project ) {
			$items[] = array(
				'@type'    => 'ListItem',
				'position' => $index + 1,
				'url'      => get_permalink( $project ),
				'name'     => get_the_title( $project ),
			);
		}

		return array(
			'@type'           => 'ItemList',
			'@id'             => get_post_type_archive_link( 'project' ) . '#projects-list',
			'name'            => __( 'Projects & Case Studies', 'martincv' ),
			'itemListElement' => $items,
		);
	}

	/**
	 * Service schema for a single service page.
	 *
	 * @return array
	 */
	private function get_single_service_schema(): array {
		$description = (string) get_field( 'short_description' );
		if ( ! $description ) {
			$description = (string) get_field( 'intro' );
		}

		$schema = array(
			'@type'       => 'Service',
			'@id'         => get_permalink() . '#service',
			'name'        => get_the_title(),
			'url'         => get_permalink(),
			'description' => wp_strip_all_tags( $description ),
			'serviceType' => get_the_title(),
			'provider'    => array( '@id' => home_url( '/#organization' ) ),
			'areaServed'  => array(
				'@type' => 'Country',
				'name'  => 'United States',
			),
		);

		return $schema;
	}

	/**
	 * Article schema for a project case study.
	 *
	 * @return array
	 */
	private function get_case_study_schema(): array {
		$schema = array(
			'@type'            => 'Article',
			'@id'              => get_permalink() . '#case-study',
			'headline'         => get_the_title(),
			'url'              => get_permalink(),
			'description'      => wp_strip_all_tags( (string) get_field( 'short_description' ) ),
			'datePublished'    => get_the_date( 'c' ),
			'dateModified'     => get_the_modified_date( 'c' ),
			'author'           => array( '@id' => home_url( '/#person' ) ),
			'publisher'        => array( '@id' => home_url( '/#organization' ) ),
			'mainEntityOfPage' => get_permalink(),
			'articleSection'   => 'Case Study',
		);

		if ( has_post_thumbnail() ) {
			$schema['image'] = (string) get_the_post_thumbnail_url( null, 'large' );
		}

		$tech = array_filter( array_map( 'trim', preg_split( '/\r\n|\r|\n/', (string) get_field( 'tech' ) ) ) );
		if ( $tech ) {
			$schema['keywords'] = implode( ', ', $tech );
		}

		$client = (string) get_field( 'client' );
		if ( $client ) {
			$schema['about'] = array(
				'@type' => 'Organization',
				'name'  => $client,
			);
		}

		return $schema;
	}

	/**
	 * FAQPage schema built from the "Common questions" repeater on a service.
	 *
	 * @return array|null
	 */
	private function get_service_faq_schema(): ?array {
		$faqs = \MartinCV\Utility::rows( get_field( 'faqs' ) );

		$entities = array();
		foreach ( $faqs as $faq ) {
			$question = trim( (string) ( $faq['question'] ?? '' ) );
			$answer   = trim( (string) ( $faq['answer'] ?? '' ) );

			if ( '' === $question || '' === $answer ) {
				continue;
			}

			$entities[] = array(
				'@type'          => 'Question',
				'name'           => $question,
				'acceptedAnswer' => array(
					'@type' => 'Answer',
					'text'  => $answer,
				),
			);
		}

		if ( ! $entities ) {
			return null;
		}

		return array(
			'@type'      => 'FAQPage',
			'@id'        => get_permalink() . '#faq',
			'mainEntity' => $entities,
		);
	}

	/**
	 * FAQPage schema built from the FAQ block on the current page.
	 *
	 * @return array|null
	 */
	private function get_faq_schema(): ?array {
		if ( ! is_singular() ) {
			return null;
		}

		$post = get_post();
		if ( ! $post || ! has_block( 'acf/faq', $post ) ) {
			return null;
		}

		$faqs = $this->extract_faq_items( parse_blocks( $post->post_content ) );

		if ( ! $faqs ) {
			return null;
		}

		$entities = array();
		foreach ( $faqs as $faq ) {
			$entities[] = array(
				'@type'          => 'Question',
				'name'           => $faq['question'],
				'acceptedAnswer' => array(
					'@type' => 'Answer',
					'text'  => $faq['answer'],
				),
			);
		}

		return array(
			'@type'      => 'FAQPage',
			'@id'        => get_permalink( $post ) . '#faq',
			'mainEntity' => $entities,
		);
	}

	/**
	 * Extract question/answer pairs from parsed blocks (recursively).
	 *
	 * Handles both key-based (field_faq_item_*) and name-based row data.
	 *
	 * @param array $blocks Parsed blocks.
	 * @return array
	 */
	private function extract_faq_items( array $blocks ): array {
		$faqs = array();

		foreach ( $blocks as $block ) {
			if ( 'acf/faq' === ( $block['blockName'] ?? '' ) ) {
				$data = $block['attrs']['data'] ?? array();
				$rows = $data['field_faq_items'] ?? $data['faqs'] ?? array();

				if ( is_array( $rows ) ) {
					// Nested rows (key-based or name-based sub fields).
					foreach ( $rows as $row ) {
						if ( ! is_array( $row ) ) {
							continue;
						}
						$question = $row['field_faq_item_question'] ?? $row['question'] ?? '';
						$answer   = $row['field_faq_item_answer'] ?? $row['answer'] ?? '';
						if ( $question && $answer ) {
							$faqs[] = array(
								'question' => wp_strip_all_tags( (string) $question ),
								'answer'   => wp_strip_all_tags( (string) $answer ),
							);
						}
					}
				} elseif ( is_numeric( $rows ) ) {
					// Flat ACF format: faqs = row count, values at faqs_{i}_question.
					$count = (int) $rows;
					for ( $i = 0; $i < $count; $i++ ) {
						$question = $data[ "faqs_{$i}_question" ] ?? '';
						$answer   = $data[ "faqs_{$i}_answer" ] ?? '';
						if ( $question && $answer ) {
							$faqs[] = array(
								'question' => wp_strip_all_tags( (string) $question ),
								'answer'   => wp_strip_all_tags( (string) $answer ),
							);
						}
					}
				}
			}

			if ( ! empty( $block['innerBlocks'] ) ) {
				$faqs = array_merge( $faqs, $this->extract_faq_items( $block['innerBlocks'] ) );
			}
		}

		return $faqs;
	}
}
