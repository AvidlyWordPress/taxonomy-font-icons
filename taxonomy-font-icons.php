<?php
/**
 * Plugin Name: Taxonomy Font Icons
 * Plugin URI: https://github.com/H1FI/taxonomy-font-icons
 * Description: Connect Font Awesome icons to taxonomies (categories, tags and custom taxonomies).
 * Version: 1.0
 * Author: Tomi Mäenpää / H1
 * Author URI: https://h1.fi
 * License: GPL2
 */

/*  Copyright 2015  Tomi Mäenpää / H1  (email : tomi@h1.fi)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/**
 * Exit if accessed directly
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

/**
 * Require the main class and functions.
 */
require_once( 'includes/taxonomy-font-icons-class.php' );
require_once( 'includes/taxonomy-font-icons-functions.php' );

/**
 * Activation and uninstall hooks.
 */
register_activation_hook( __FILE__, array( 'Taxonomy_Font_Icons', 'plugin_activation' ) );
register_uninstall_hook( __FILE__, array( 'Taxonomy_Font_Icons', 'plugin_uninstall' ) );

$taxonomy_font_icons = new Taxonomy_Font_Icons();