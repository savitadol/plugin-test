<?php 
/**
 * @package MSP
 */
namespace Inc\Base;

class Enqueue
{
	public function register(){
		add_action('admin_enqueue_scripts',[$this,'enqueue']);		
	}

	function enqueue(){
		wp_enqueue_style('msp_style',PLUGIN_URL.'assets/style.css',true);
		wp_enqueue_script('msp_script',PLUGIN_URL.'assets/custom.js',true);
	}
}