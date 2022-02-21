<?php
/*
 * Plugin Name: WordPress Ajax Example Plugin
 * Version: 1.0
 * Plugin URI: https://www.webdata.fi/
 * Description: Example plugin for WordPress to create ajax requests.
 * Author: WebData Oy
 * Author URI: https://www.webdata.fi/
 * Requires at least: 4.0
 * Tested up to: 5.9
 *
 * Text Domain: wp-example-ajax-plugin
 * Domain Path: /lang/
 *
 * @package WordPress
 * @author WebData Oy
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// Define required constants
define('WP_EXAMPLE_PLUGIN_DIR', plugin_dir_url( __FILE__ ) . 'assets/');

// Load plugin class files
require_once( 'inc/ajax.php');