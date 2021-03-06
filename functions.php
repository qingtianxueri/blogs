<?php
/**
 * Created by PhpStorm.
 * User: chenpeiqing
 * Date: 2016/4/14
 * Time: 15:18
 */

/*
 *to extend the ad theme
 */
add_action('wp_enqueue_scripts', 'child_enqueue_styles', 99);

function child_enqueue_styles() {
  wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/css/custom.css');

  wp_dequeue_style('sydney-fonts');
}

if (get_stylesheet() !== get_template() ) {
  add_filter( 'pre_update_option_theme_mods_' . get_stylesheet(), function ( $value, $old_value ) {
    update_option( 'theme_mods_' . get_template(), $value );
    return $old_value; // prevent update to child theme mods
  }, 10, 2 );
  add_filter( 'pre_option_theme_mods_' . get_stylesheet(), function ( $default ) {
    return get_option( 'theme_mods_' . get_template(), $default );
  } );
}
