<?php

/**
 * Summary: php file which implements the plugin WP admin page interface
 */


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
 * Generates content for caching settings section
 */
function gmuj_msi_callback_section_settings_caching() {

	// Get plugin options
	$gmuj_mmi_options = get_option('gmuj_msi_options');

	// Provide section introductory information
	echo '<p>This section contains settings related to caching in Sucuri web application firewall.</p>';

	// Provide cache clearing link

		// Introduce cache clearing link
		if (empty($gmuj_mmi_options['cache_clear_url'])) {
			echo '<p>Please provide a Sucuri cache-clearing URL below.</p>';
		} else {
			echo '<p>You can clear the Sucuri cache now by using the button below:</p>';
		}

		// Output cache clear button, if cache clear url is not empty
		if (!empty($gmuj_mmi_options['cache_clear_url'])) {
			echo '<p><a class="button button-primary" href="'.$gmuj_mmi_options['cache_clear_url'].'" target="_blank">Clear Cache Now</a></p>'.PHP_EOL;
		}

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

	// Does the cache clear URL field value violate our criteria (which is that it must be a link to waf.sucuri.net)? For user convenience, we make the protocol optional.
	if (!preg_match('/^(https:\/\/)?waf.sucuri.net\//i',$input['cache_clear_url'])) {
		// If this value does violate our criteria, clear the variable, and therefore save nothing
		$input['cache_clear_url'] = '';
	}

	// If the provided field value is valid (hasn't been cleared above)...
	if (!empty($input['cache_clear_url'])) {
		// If the provided field value doesn't start with "https://", add it
		if (!preg_match('/^https:\/\//i',$input['cache_clear_url'])) {
			$input['cache_clear_url'] = 'https://' . $input['cache_clear_url'];
		}
	}

	// Filter the resulting value as a clean URL
	$input['cache_clear_url'] = filter_var($input['cache_clear_url'], FILTER_SANITIZE_URL);

	// Return value
	return $input;
	
}
