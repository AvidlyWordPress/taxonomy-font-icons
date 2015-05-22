=== Taxonomy Font Icons ===
Contributors: tomimaen
Tags: taxonomies, categories, tags, icons, font awesome
Requires at least: 4.1
Tested up to: 4.2.2
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Taxonomy Font Icons lets users connect Font Awesome icons to categories, tags and custom taxonomies.

== Description ==
Taxonomy Font Icons lets users connect Font Awesome icons to categories, tags and custom taxonomies.

In addition to just connecting the icons, Taxonomy Font Icons also provides few helper functions that will print a list of a single post taxonomy terms and full taxonomy term list with their corresponding icons.

By default, Taxonomy Font Icons uses Font Awesome icons served from CDN. For developers, there is a filter called `tfi_filters_default_args` which you can use, so that you may define what icon font to use, where to load it and what icons are available for selection.

= Custom Icon Font =
If you want to use a custom icon font, here is an example using a custom made icon pack from Icomoon:

~~~~
add_filter( 'tfi_filters_default_args', 'my_custom_icons' );
function my_custom_icons() {
	$args['taxonomies'] = array( 'post_tag' );
	$args['font']       = 'icomoon';
	$args['stylesheet'] = get_stylesheet_directory_uri() . '/icomoon/style.css';
	$args['icons']      = array(
		'icon-user'    => '&#xe600',
		'icon-heart'   => '&#xe601',
		'icon-grid'    => '&#xe602',
		'icon-volume'  => '&#xe603',
		'icon-home'    => '&#xf015',
		'icon-navicon' => '&#xf0c9',
		);

	return $args;
}
~~~~

== Installation ==
1. Upload `taxonomy-font-icons` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Connect icons to taxonomies on their corresponding menus
4. Use the following functions in your templates to show term lists with icons:
  * Single post: `tfi_the_taxonomies( 'post_tag' );`
  * To list taxonomies: `tfi_all_taxonomies( array( 'category', 'post_tag' ) )`;

== Screenshots ==
1. List of tags with their icons.
2. Single post with categories and tags.
3. Icons to choose from.
4. Custom icon font.

== Changelog ==

= 1.0 =
* First release.