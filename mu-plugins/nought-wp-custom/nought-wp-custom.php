<?php
/*
Plugin name: Nought WP WordPress Customizations
Description: Extends functionality for the Nought WP Boilerplate, such as ading custom post types, taxonomies, and extending the WordPress REST API.
Version: 	 1.0.0
Author: 	 Aleph
License: 	 GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

namespace noughtwp\Custom;

defined( 'ABSPATH' ) or die( 'No direct access.' );

require_once('nought-wpCustomTypesTaxonomies.class.php');

// Instantiate Classes and set up hooks
$noughtwpCustomTypesTaxonomies = new \noughtwpCustomTypesTaxonomies();
register_activation_hook( __FILE__, array($noughtwpCustomTypesTaxonomies, 'activation') );
register_deactivation_hook( __FILE__, array($noughtwpCustomTypesTaxonomies, 'deactivation') );
add_filter( 'rest_page_query', array($noughtwpCustomTypesTaxonomies, 'modify_rest_query'), 10, 2);
/**
 * Hook: after_setup_theme.
 *
 * @uses add_action() https://developer.wordpress.org/reference/functions/add_action/
 * @uses rest_api_init https://developer.wordpress.org/reference/hooks/rest_api_init/
 */

// Set ACF load and save points
add_filter('acf/settings/load_json', function ($paths) {
	$paths[] = plugin_dir_path(__FILE__) . 'acf-json';
	return $paths;
});

add_filter('acf/settings/save_json', function ($path) {
	$path = plugin_dir_path(__FILE__) . 'acf-json';
	return $path;
});
