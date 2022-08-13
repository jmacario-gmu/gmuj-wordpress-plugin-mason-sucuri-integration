<?php

/**
 * Main plugin file for the Mason Sucuri Integration plugin
 */

/**
 * Plugin Name:       Mason WordPress: Mason Sucuri Integration
 * Author:            Jan Macario
 * Plugin URI:        https://github.com/jmacario-gmu/gmuj-wordpress-plugin-mason-sucuri-integration
 * Description:       Mason WordPress plugin which provides integration with Sucuri web application firewall.
 * Version:           1.0
 */


// Exit if this file is not called directly.
	if (!defined('WPINC')) {
		die;
	}

// Set up auto-updates
	require 'plugin-update-checker/plugin-update-checker.php';
	$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/jmacario-gmu/gmuj-wordpress-plugin-mason-sucuri-integration/',
	__FILE__,
	'gmuj-wordpress-plugin-mason-sucuri-integration'
	);

// Include files
	// Branding
		include('php/fnsBranding.php');
	// Admin menu
		include('php/admin-menu.php');
	// Admin page
		include('php/admin-page.php');
	// Plugin settings
		include('php/settings.php');
