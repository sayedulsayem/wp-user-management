<?php

defined( 'ABSPATH' ) || exit;

/**
 * Plugin Name: WP User Management
 * Plugin URI:  http://sayedulsayem.com/wp-user-management/
 * Description: WP User Management plugin.
 * Version: 1.0.0
 * Author: sayedulsayem
 * Author URI:  http://sayedulsayem.com
 * Text Domain: wp-user-management
 * License:  GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

 // run auto loader
require 'autoloader.php';

// run plugin initialization file
require 'plugin.php';

// run global function file
require_once 'core/global.php';

/**
 * plugin activation hooks, need to do to something during plugin activation
 */
register_activation_hook( __FILE__, [ WpUserManagement\Plugin::instance(), 'active_plugin_action'] );

/**
 * load plugin after initialize wordpress core
 */
add_action( 'plugins_loaded', function(){
    do_action('wp-user-management/before_load');
    WpUserManagement\Plugin::instance()->init();
    do_action('wp-user-management/after_load');
});
