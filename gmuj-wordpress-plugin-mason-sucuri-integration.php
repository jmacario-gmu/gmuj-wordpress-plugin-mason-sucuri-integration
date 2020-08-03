<?php

/**
 * Main plugin file for the Mason Sucuri Integration plugin
 */

/**
 * Plugin Name:       Mason WordPress: Mason Sucuri Integration
 * Author:            Jan Macario
 * Plugin URI:        https://github.com/jmacario-gmu/gmuj-wordpress-plugin-mason-sucuri-integration
 * Description:       Mason WordPress plugin which provides integration with Sucuri web application firewall.
 * Version:           0.0.1
 */


// Exit if this file is not called directly.
	if (!defined('WPINC')) {
		die;
	}

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

/**
 * Generates the plugin settings page
 */
function gmuj_msi_display_settings_page() {
	
	// Only continue if this user has the 'manage options' capability
	if (!current_user_can('manage_options')) return;

	// Begin HTML output
	echo "<div class='wrap'>";

	// Page title
	echo "<h1>" . esc_html(get_admin_page_title()) . "</h1>";

	// Output basic plugin info
	echo "<p>This plugin provides integration with Sucuri web application firewall.</p>";

	// Begin form
	echo "<form action='options.php' method='post'>";

	// output settings fields - outputs required security fields - parameter specifes name of settings group
	settings_fields('gmuj_msi_options');

	// output setting sections - parameter specifies name of menu slug
	do_settings_sections('gmuj_msi');

	// submit button
	submit_button();

	// Close form
	echo "</form>";

	// Finish HTML output
	echo "</div>";
	
}

/**
 * Register plugin settings
 */
add_action('admin_init', 'gmuj_msi_register_settings');
function gmuj_msi_register_settings() {
	
	/*
	Code reference:

	register_setting( 
		string   $option_group, // name of option group - should match the parameter used in the settings_fields function in the display_settings_page function
		string   $option_name, // name of the particular option
		callable $sanitize_callback = '' // function used to validate settings
	);

	add_settings_section( 
		string   $id, // section id
		string   $title, // title/heading of section
		callable $callback, // function that displays section
		string   $page // admin page (slug) on which this section should be displayed
	);

	add_settings_field(
    	string   $id, // setting id
		string   $title, // title of setting
		callable $callback, // outputs markup required to display the setting
		string   $page, // page on which setting should be displayed, same as menu slug of the menu item
		string   $section = 'default', // section id in which this setting is placed
		array    $args = [] // array the contains data to be passed to the callback function. by convention I pass back the setting id and label to make things easier
	);
	*/

	// Register serialized options setting to store this plugin's options
	register_setting(
		'gmuj_msi_options',
		'gmuj_msi_options',
		'gmuj_msi_callback_validate_options'
	);

	// Add section: website caching
	add_settings_section(
		'gmuj_msi_section_settings_caching',
		'Caching',
		'gmuj_msi_callback_section_settings_caching',
		'gmuj_msi'
	);

	// Add field: mason unit
	add_settings_field(
		'cache_clear_url',
		'Cache-clearing URL',
		'gmuj_msi_callback_field_text',
		'gmuj_msi',
		'gmuj_msi_section_settings_caching',
		['id' => 'cache_clear_url', 'label' => 'Cache-clearing URL']
	);

} 

/**
 * Generates content for caching settings section
 */
function gmuj_msi_callback_section_settings_caching() {

	// Get plugin options
	$gmuj_mmi_options = get_option('gmuj_msi_options');

	// Provide section introductory information
	echo '<p>This section contains settings related to caching in Sucuri web application firewall. You can clear the cache now bu using the button below:</p>';

	// Provide cache clearing link
	echo '<p>';
	// Output cache clear button, if cache clear url is not empty
	if (!empty($gmuj_mmi_options['cache_clear_url'])) {
		echo '<a class="button button-primary" href="'.$gmuj_mmi_options['cache_clear_url'].'">Clear Cache Now</a>'.PHP_EOL;
	}
	echo '</p>';

}

/**
 * Generates text field for plugin settings option
 */
function gmuj_msi_callback_field_text($args) {
	
	//Get array of options. If the specified option does not exist, get default options from a function
	$options = get_option('gmuj_msi_options', gmuj_msi_options_default());
	
	//Extract field id and label from arguments array
	$id    = isset($args['id'])    ? $args['id']    : '';
	$label = isset($args['label']) ? $args['label'] : '';
	
	//Get setting value
	$value = isset($options[$id]) ? sanitize_text_field($options[$id]) : '';
	
	//Output field markup
	echo '<input id="gmuj_msi_options_'. $id .'" name="gmuj_msi_options['. $id .']" type="text" size="40" value="'. $value .'">';
	echo "<br />";
	echo '<label for="gmuj_msi_options_'. $id .'">'. $label .'</label>';
	
}

/**
 * Sets default plugin options
 */
function gmuj_msi_options_default() {

	return array(
		'cache_clear_url'   => '',
	);

}

/**
 * Validate plugin options
 */
function gmuj_msi_callback_validate_options($input) {
	
	// Cache clear URL
	if (isset($input['cache_clear_url'])) {
		//$input['cache_clear_url'] = sanitize_text_field($input['cache_clear_url']);
		$input['cache_clear_url'] = filter_var($input['cache_clear_url'], FILTER_SANITIZE_URL);
	}

	return $input;
	
}
