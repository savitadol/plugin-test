<?php
/*
Plugin Name: MSP
Plugin URI:www.google.com
Author:Dummy
Description:This is a Dummy Plugin
Version:1.0.0
*/
defined('ABSPATH') or die('Direct File Access not allowed!');

if(file_exists(dirname(__FILE__).'/vendor/autoload.php') ){
	require_once(dirname(__FILE__).'/vendor/autoload.php');
}

define('PLUGIN_URL',plugin_dir_url(__FILE__));
define('PLUGIN_PATH',plugin_dir_path( __FILE__ ));
define('PLUGIN',plugin_basename( __FILE__ ));

function activate_msp(){
	Inc\Base\Activate::activate();
}

function deactivate_msp(){
	Inc\Base\Deactivate::deactivate();
}

register_activation_hook(__FILE__,'activate_msp');
register_deactivation_hook(__FILE__,'deactivate_msp');

if(class_exists( 'Inc\\Init' ) ){
	Inc\Init::register_services();
}