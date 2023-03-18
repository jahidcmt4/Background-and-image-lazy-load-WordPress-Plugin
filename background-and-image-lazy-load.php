<?php
/**
 * Plugin Name: Lazy load images and background images 
 * Plugin URI: https://themefic.com/
 * Description:  All kinds of images and background lazy loading solutions. Make your web pages fast on all devices.
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
add_action('activated_plugin', array($this,'bgimglazy_activated_deshboard_settings'));
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array($this,'bgimglazy_deshboard_settings'));
add_action('admin_enqueue_scripts', array($this,'bgimglazy_admin_page_script'));

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
* Activate Setting Page
*/

function bgimglazy_activated_deshboard_settings($plugin){
    if (plugin_basename(__FILE__)==$plugin) {
        wp_redirect(admin_url('admin.php?page=bgimglazy'));
        die();
    }
}

/**
* Activate Setting Page
*/

function bgimglazy_deshboard_settings( $links ) {

  $link = sprintf( "<a href='%s' style='color:#2271b1;'>%s</a> | <a href='%s' target='_blank' style='color:#2271b1;'>%s</a>", admin_url( 'admin.php?page=bgimglazy'), __( 'Settings', 'bgimglazy' ), 'https://wordpress.org/support/plugin/lazy-load-images-and-background-images/reviews/?filter=5/#new-post', __( 'Rate the plugin ★★★★★', 'bgimglazy' ) );
  array_push( $links, $link );

  return $links;
}

/**
* Admin Script
*/

function bgimglazy_admin_page_script(){
  wp_enqueue_style( 'bgimglazy-css', plugins_url('/admin/assets/css/admin.css', __FILE__), false, '1.1.0');
}

/**
* Plugins Script
*/

function bgimglazy_lazy_load_images_script(){
 
  wp_enqueue_script( 'bgimglazy_lazy_load_js', plugins_url('/assets/js/jh-lazy-load.js', __FILE__), array('jquery'), $this->plugin->version, true );
  wp_enqueue_script( 'bgimglazy_lazy_load_custom_js', plugins_url('/assets/js/jh-custom-lazy-load.js', __FILE__), array('jquery'), $this->plugin->version, true );

  // Settings Options
  $bgimglazy_option = get_option( 'bgimglazy_option' );
  $bgimglazy_lazy_load_preloader = plugins_url('/assets/images/preloader.gif', __FILE__);
  $bgimglazy_lazy_load_data = array(
    'bgimglazy_icon' => !empty( $bgimglazy_option['loading-icon']['background-image']['url'] ) ? $bgimglazy_option['loading-icon']['background-image']['url'] : $bgimglazy_lazy_load_preloader,
    'bgimglazy_images' => !empty( $bgimglazy_option['enable-image-loading'] ) ? $bgimglazy_option['enable-image-loading'] : '',
    'bgimglazy_bg' => !empty( $bgimglazy_option['enable-background-loading'] ) ? $bgimglazy_option['enable-background-loading'] : '',
  );
  wp_localize_script( 'bgimglazy_lazy_load_custom_js', 'bgimglazy_data', $bgimglazy_lazy_load_data );
}

}

$Bgimglazy_images_lazy_load = new Bgimglazy_images_lazy_load();