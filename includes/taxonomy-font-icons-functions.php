<?php
/**
 * Functions for displaying taxonomy terms with their icons.
 */

if ( ! function_exists( 'tfi_the_taxonomies' ) ) {
	/**
	 * Current post taxonomies.
	 *
	 * @param int $post_id   The post ID.
	 * @param string $term   The term for the post.
	 * @param string $prefix Prefix for the HTML list.
	 *
	 * @since 1.0
	 */
	function tfi_the_taxonomies( $term, $post_id = null, $prefix = null ) {
		if ( ! is_numeric( $post_id ) ) {
			$post_id = get_the_id();
		}

		$terms = get_the_terms( $post_id, $term );
		echo tfi_create_list( $terms, $prefix );
	}
}

if ( ! function_exists( 'tfi_all_taxonomies' ) ) {
	/**
	 * All taxonomies.
	 *
	 * Creates a list of terms inside taxonomies.
	 *
	 * @param array $taxonomies The taxonomies.
	 * @param array $args       Arguments for get_terms().
	 *
	 * @since 1.0
	 */
	function tfi_all_taxonomies( $taxonomies, $args = null, $prefix = null ) {
		$terms = get_terms( $taxonomies, $args );
		echo tfi_create_list( $terms, $prefix );
	}
}

if ( ! function_exists( 'tfi_create_list' ) ) {
	/**
	 * Create a list of the taxonomies.
	 *
	 * @param array $terms Terms for the list.
	 * @return string HTML list.
	 *
	 * @since 1.0
	 */
	function tfi_create_list( $terms, $prefix ) {

		// Make sure we have something we can use
		if ( $terms && ! is_wp_error( $terms ) ) {

			// Default to 'term' if $prefix is not defined
			if ( empty( $prefix ) ) {
				$prefix = 'term';
			}

			// Get the icons
			$icons = get_option( '_taxonomy_font_icons' );

			if ( empty( $icons ) ) {
				// This prevent's PHP warnings in case no icons have been added.
				$icons = array();
			}

			$html = "<ul class='{$prefix}-list'>";
				foreach ( $terms as $term ) {
					$link = get_term_link( $term );
					$name = $term->name;
					$id   = $term->term_id;

					$html .= "<li class='{$prefix}-list-item'>";
						$html .= "<a class='{$prefix}-list-link' href='{$link}'>";
							if ( array_key_exists( $id, $icons ) ) {
								$html .= "<span class='{$prefix}-list-icon {$icons[ $id ]}'></span> ";
							}
						$html .= $name;
						$html .= "</a>";
					$html .= "</li>";
				}
			$html .= '</ul>';

			return $html;
		}
	}
}