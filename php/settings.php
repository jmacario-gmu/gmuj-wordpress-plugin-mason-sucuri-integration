<?php

/**
 * Summary: php file which sets up plugin settings
 */


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
