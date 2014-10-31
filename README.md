# Taxonomy Icons

This plugin lets you connect icon fonts to taxonomies (categories, tags and custom taxonomies).

## How to Use

After installing the plugin, you're ready to start connecting icons to taxonomies! By default, this plugin uses Font Awesome for the icons.

The connection between the taxonomies and icons are stored in a `wp_options` -table in `_taxonomy_icons` -option. The connection is following: `term_id => icon_class`.

### Example function

This is a example function that creates a HTML-list of the taxonomies with their corresponding icons.

```
/**
 * Print the list of the taxonomies with icons.
 */
function taxonomy_icons_print_taxonomies( $id, $taxonomy ) {

	global $taxonomy_icons;

	// Get the terms
	$terms = get_the_terms( $id, $taxonomy );

	// Get the icons
	$icons = get_option( $taxonomy_icons->taxonomy_icons_option );

	?>

	<?php if ( false != $terms ) : ?>

		<ul>
		<?php foreach ( $terms as $term ) : ?>

			<li>
				<a href="<?php echo get_term_link( $term ); ?>">
				<?php if ( is_array( $icons ) ) : ?>
					<?php if ( array_key_exists( $term->term_id, $icons ) ) : ?>
						<span class="<?php echo $icons[ $term->term_id ]; ?>" 
						style="font-family:<?php echo $taxonomy_icons->font; ?>;"></span> 
					<?php endif; ?>
				<?php endif; ?>

				<?php echo $term->name; ?>
				</a>
			</li>

		<?php endforeach; ?>
		</ul>

	<?php endif; ?>

	<?php
}
```

## Developers

This is where things start getting fun. You can use `add_filter( 'taxonomy_icon_args', '' );` to modify the taxonomies where to show the icons, and the used icon font itself. 

This filter takes the following arguments:

```
	$args['taxonomies'] = array() of taxonomies
    $args['font']       = font-family for the icons
    $args['stylesheet'] = the location for the icons stylesheet
    $args['icons']      = array() of the icons that are available for selection, this is key => value pair with 
                          css-class and unicode character for the icon.

```

Example for using custom icon selection made with Icomoon:

```
add_filter( 'taxonomy_icons_args', 'my_custom_font' );

function my_custom_font( $args ) {

	$args['taxonomies'] = array( 'category', 'my_custom_taxonomy' );
	$args['font']       = 'icomoon';
	$args['stylesheet'] = get_stylesheet_directory_uri() . '/assets/styles/css/icons.css';
	$args['icons']      = array(
			'icon-glass'      => '&#xf000;',
			'icon-music'      => '&#xf001;',
			'icon-search'     => '&#xf002;',
			'icon-envelope-o' => '&#xf003;',
			'icon-heart'      => '&#xf004;',
			'icon-star'       => '&#xf005;',
		);
        
	return $args;
}
```