<?php
defined( 'ABSPATH' ) || exit;

$badge_up     = '<div class="lazy-up-badge"><span class="lazy-upcoming">' .__("Upcoming", "bgimglazy"). '</span></div>';

if( class_exists( 'CSF' ) ) {

  $prefix = 'bgimglazy_option';

  CSF::createOptions( $prefix, array(
    'framework_title'         =>   __( 'LazyLoad Settings <small>by <a style="color: #bfbfbf;text-decoration:none;" href="https://profiles.wordpress.org/jahidcse/" target="_blank">Jahid Hasan</a></small>', 'bgimglazy' ),
    'menu_title'              =>   __( 'LazyLoad Settings', 'bgimglazy' ),
    'menu_slug'               =>   'bgimglazy',
    'menu_icon'               =>   'dashicons-image-rotate',
    'menu_position'           =>   25,
    'show_sub_menu'           =>   false,
    'theme'                   =>   'dark',
    'footer_text'             =>   'Thanks for Active our Plugin',
  ) );

  // Images and Content Protection

  CSF::createSection( $prefix, array(
    'title'  => __( 'Images and Content', 'bgimglazy' ),
    'fields' => array(
      array(
        'id'    => 'enable-image-loading',
        'type'  => 'switcher',
        'title' => __( 'Enable Image Loading', 'bgimglazy' ),
        'default' => true,
      ),
      array(
        'id'    => 'enable-background-loading',
        'type'  => 'switcher',
        'title' => __( 'Enable Background Loading', 'bgimglazy' ),
        'default' => true,
      ),
      array(
        'id'    => 'loading-icon',
        'type'  => 'background',
        'title' => __( 'Your Custom Loader Image', 'bgimglazy' ),
        'subtitle' => __( 'You are able to add your custom Loader Image.', 'bgimglazy' ),
        'background_color' => false,
        'background_position' => false,
        'background_repeat' => false,
        'background_attachment' => false,
        'background_size' => false,
      ),
      array(
        'id'    => 'enable-iframe-loading',
        'type'  => 'switcher',
        'title' => __( 'Enable Iframe Loading', 'bgimglazy' ),
        'default' => true,
        'subtitle' => $badge_up,
      ),
    )
  ) );
}