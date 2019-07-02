<?php
/**
 * @package PreSelection
 */
/*
Plugin Name: PreSelection
Plugin URI: https://preselectiontest.matrixmarketers.com
Description: To manage products title tag and add robots meta dynamically.
Version: 1.0.0
Author: Savita
Text Domain: preselection
*/

// Prevent Direct Access to Plugin Directories
if ( !function_exists( 'add_action' ) ) {
    echo 'No Direct Access!';
    exit;
}
define( 'PRESELECTION_VERSION', '1.0.0' );
define( 'PRESELECTION_MINIMUM_WP_VERSION', '4.0' );
define( 'PRESELECTION_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

register_activation_hook( __FILE__, array( 'Preselection', 'plugin_activation' ) );
register_deactivation_hook( __FILE__, array( 'Preselection', 'plugin_deactivation' ) );

require_once  (PRESELECTION_PLUGIN_DIR . 'classes/preselection.php');

add_action( 'init', array( 'Preselection', 'init' ) );
