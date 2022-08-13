<?php

/**
 * Summary: php file which implements the plugin WP admin menu changes
 */


/**
 * Adds link to plugin settings page to Wordpress admin menu as a top-level item
 */
add_action('admin_menu', 'gmuj_msi_add_toplevel_menu');
function gmuj_msi_add_toplevel_menu() {

	// Add Wordpress admin menu item for this plugin's settings
	/*
	Code example:
	add_menu_page(
		string   $page_title, // title of page
		string   $menu_title, // title of menu item
		string   $capability, // capability needed for user to access this menu item
		string   $menu_slug, // unique string used to identify the plugins settings page - use plugin name
		callable $function = '', // function that displays the plugin page
		string   $icon_url = '', // menu icon
		int      $position = null // position in menu sidebar - the lower the number the higher it will appear
	)
	*/
	add_menu_page(
		'Mason Sucuri Integration',
		'Mason Sucuri Integration',
		'manage_options',
		'gmuj_msi',
		'gmuj_msi_display_settings_page',
		'dashicons-admin-generic',
		1
	);

}

/**
 * Adds link to plugin settings page to Wordpress admin menu as a sub-menu item under settings
 */
add_action('admin_menu', 'gmuj_msi_add_sublevel_menu');
function gmuj_msi_add_sublevel_menu() {
	
	// Add Wordpress admin menu item under settings for this plugin's settings
	/*
	add_submenu_page(
		string   $parent_slug, // under which admin page should this sub-menu item appear
		string   $page_title, // title of admin page
		string   $menu_title, // title of menu item
		string   $capability, // capability needed for user to access this menu item
		string   $menu_slug, // unique string used to identify the plugins settings page - use plugin name
		callable $function = '', // function that displays the plugin page
		int 	$position // the position in the menu order this item should appear
	);
	*/
	add_submenu_page(
		'options-general.php',
		'Mason Sucuri Integration',
		'Mason Sucuri Integration',
		'manage_options',
		'gmuj_msi',
		'gmuj_msi_display_settings_page',
		0
	);
	
}
