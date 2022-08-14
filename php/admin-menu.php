<?php

/**
 * Summary: php file which implements the plugin WP admin menu changes
 */


/**
 * Adds Mason admin menu item to Wordpress admin menu as a top-level item
 */
add_action('admin_menu', 'gmuj_add_admin_menu_mason');

// Function to add Mason admin menu item. If this shared function does not exist already, define it now.
if (!function_exists('gmuj_add_admin_menu_mason')) {

	function gmuj_add_admin_menu_mason() {

		// Add Wordpress admin menu item for mason stuff

		// If the Mason top-level admin menu item does not exist already, add it.
		if (menu_page_url('gmuw', false) == false) {

			// Add top admin menu page
			add_menu_page(
				'Mason WordPress',
				'Mason WordPress',
				'manage_options',
				'gmuw',
				function(){
					echo "<div class='wrap'>";
					echo '<h1>' . esc_html(get_admin_page_title()) . '</h1>';
					echo '<p>Please use the links at left to access Mason WordPress platform features.</p>';
					echo "</div>";
				},
				gmuj_mason_svg_icon(),
				1
			);

		}

	}

}

/**
 * Adds link to plugin settings page to Wordpress admin menu as a sub-menu item under Mason
 */
add_action('admin_menu', 'gmuj_msi_add_sublevel_menu');
function gmuj_msi_add_sublevel_menu() {
	
	// Add Wordpress admin menu item under Mason for this plugin's settings
	add_submenu_page(
		'gmuw',
		'Mason Sucuri Integration',
		'Mason Sucuri Integration',
		'manage_options',
		'gmuj_msi',
		'gmuj_msi_display_settings_page',
		3
	);
	
}
