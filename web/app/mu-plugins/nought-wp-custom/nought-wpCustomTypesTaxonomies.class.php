<?php

defined( 'ABSPATH' ) or die( 'No direct access.' );

class noughtwpCustomTypesTaxonomies {
	function __construct(){
	}

	// Functions to be run on activation
	function activation() {

		// Flush permalinks
		flush_rewrite_rules();
	}

	// Functions to be run on deactivation
	function deactivation() {

		// Flush permalinks
		flush_rewrite_rules();

	}

	// Set up custom post type for custom
	function nought_custom_init() {
		$labels = array(
			'name'			=> 'custom',
			'singular_name'			=> 'Custom',
			'add_new'			=> 'Add New',
			'add_new_item'			=> 'Add New Custom',
			'edit_item'			=> 'Edit Custom Information',
			'new_item'			=> 'New Custom',
			'all_items'			=> 'All custom',
			'view_item'			=> 'View Custom',
			'search_items'			=> 'Search custom',
			'not_found'			=> 'No custom found',
			'not_found_in_trash'			=> 'No custom found in Trash',
			'parent_item_colon'			=> '',
			'menu_name'			=> 'custom',
			'item_published'			=> 'Custom added.',
			'item_published_privately'			=> 'Custom added privately.',
			'item_reverted_to_draft'			=> 'Custom reverted to draft.',
			'item_scheduled'			=> 'Custom scheduled.',
			'item_updated'			=> 'Custom updated.'
		);

		$args = array(
			'labels'			=> $labels,
			'public'			=> true,
			'exclude_from_search'			=> false,
			'publicly_queryable'			=> true,
			'show_ui'			=> true,
			'show_in_menu'			=> true,
			'query_var'			=> true,
			'rewrite'			=> array(
										'slug'=> 'custom',
										'with_front'=> false
									),
			'capability_type'			=> 'post',
			'has_archive'			=> true,
			'hierarchical'			=> false,
			'menu_position'			=> 5,
			'show_in_rest'			=> true,
			'rest_base'			=> 'nought-custom',
			'rest_controller_class'			=> 'WP_REST_Posts_Controller',
			'menu_icon'			=> 'dashicons-admin-users',
			'supports'			=> array( 'title', 'excerpt', 'editor', 'thumbnail', 'revisions' ),
		);
		
		register_post_type( 'nought_custom', $args );
	}
