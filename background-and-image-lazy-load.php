<?php
/**
 * Plugin Name: Lazy load images and background images 
 * Plugin URI: https://themefic.com/
 * Description: Lazy load images and background images plugin to boost page load time
 * Version: 1.0.1
 * Requires at least: 4.7
 * Tested up to: 6.1.1
 * Requires PHP: 5.3
 * Text Domain: bgimglazy
 * Author: jahidcse
 * Author URI: https://profiles.wordpress.org/jahidcse/
*/

/**
* Class Bgimglazy_images_lazy_load
*/

class Bgimglazy_images_lazy_load {

public function __construct() {

$file_data = get_file_data( __FILE__, array( 'Version' => 'Version' ) );

$this->plugin                           = new stdClass;
$this->plugin->name                     = 'background-and-image-lazy-load';
$this->plugin->version                  = $file_data['Version'];
$this->plugin->folder                   = plugin_dir_path( __FILE__ );
$this->plugin->url                      = plugin_dir_url( __FILE__ );

/**
* Hooks
*/

add_action('wp_enqueue_scripts', array($this,'bgimglazy_lazy_load_images_script'), 100);

/**
 * Codestar Framework Integrate
*/
require_once $this->plugin->folder . 'admin/framework/codestar-framework.php';

/**
 * Settings Integrate
*/
require_once $this->plugin->folder . 'admin/options/global.php';

}



/**
* Plugins Script
*/

function bgimglazy_lazy_load_images_script(){
 
  wp_enqueue_script( 'bgimglazy_lazy_load_js', plugins_url('/assets/js/jh-lazy-load.js', __FILE__), array('jquery'), $this->plugin->version, true );
  wp_enqueue_script( 'bgimglazy_lazy_load_custom_js', plugins_url('/assets/js/jh-custom-lazy-load.js', __FILE__), array('jquery'), $this->plugin->version, true );

  $bgimglazy_lazy_load_preloader= plugins_url('/assets/images/preloader.gif', __FILE__);
  $bgimglazy_lazy_load_data = array(
    'jh_lazy_load_images' => $bgimglazy_lazy_load_preloader
  );
  wp_localize_script( 'bgimglazy_lazy_load_custom_js', 'bgimglazy_data', $bgimglazy_lazy_load_data );
}


}

$Bgimglazy_images_lazy_load = new Bgimglazy_images_lazy_load();