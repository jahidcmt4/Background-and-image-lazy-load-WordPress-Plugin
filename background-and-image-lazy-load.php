<?php
/**
 * Plugin Name:       Lazy load images and background images 
 * Plugin URI:        https://viserx.com/
 * Description:       Lazy load images and background images plugin to boost page load time
 * Version:           1.0
 * Requires at least: 4.7
 * Tested up to: 5.8.2
 * Requires PHP:      5.3
 * Text Domain: jh_baild
 * Author:            jahidcse
 * Author URI:        https://profiles.wordpress.org/jahidcse/


 */

/**
* Class jh_baild_images_lazy_load
*/

class jh_baild_images_lazy_load {

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

add_action('wp_enqueue_scripts', array($this,'jh_baild_lazy_load_images_script'), 100);

}


/**
* Plugins Script
*/

function jh_baild_lazy_load_images_script(){
 
  wp_enqueue_script( 'jh_baild_lazy_load_js', plugins_url('/assets/js/jh-lazy-load.js', __FILE__), array('jquery'), $this->plugin->version, true );
  wp_enqueue_script( 'jh_baild_lazy_load_custom_js', plugins_url('/assets/js/jh-custom-lazy-load.js', __FILE__), array('jquery'), $this->plugin->version, true );

  $jh_baild_lazy_load_preloader= plugins_url('/assets/images/preloader.gif', __FILE__);
  $jh_baild_lazy_load_data = array(
    'jh_lazy_load_images' => $jh_baild_lazy_load_preloader
  );
  wp_localize_script( 'jh_baild_lazy_load_custom_js', 'jh_baild_data', $jh_baild_lazy_load_data );
}


}

$jh_baild_images_lazy_load = new jh_baild_images_lazy_load();