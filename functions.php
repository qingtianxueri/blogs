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
add_action( 'wp_enqueue_scripts', 'child_enqueue_styles',99);
function child_enqueue_styles() {
  $parent_style = 'parent-style';
  //To remove the parent style css
  // wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
  wp_enqueue_style( 'child-style',get_stylesheet_directory_uri() . '/custom.css', array( $parent_style ));
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

/**
 * Footer contact
 */
if ( ! function_exists( 'astrid_footer_contact' ) ) :
function astrid_footer_contact() {
  $footer_contact_address = get_theme_mod('footer_contact_address');
  $footer_contact_email   = antispambot(get_theme_mod('footer_contact_email'));
  $footer_contact_phone   = get_theme_mod('footer_contact_phone');

  echo '<div class="footer-contact">';
  if ($footer_contact_address) {
    echo '<div class="footer-contact-block">';
    echo  '<i class="fa fa-home"></i>';
    echo  '<span>' . esc_html($footer_contact_address) . '</span>';
    echo '</div>';
  }
  if ($footer_contact_email) {
    echo '<div class="footer-contact-block">';
    echo  '<a href="mailto:' . esc_attr($footer_contact_email) . '"><i class="fa fa-envelope"></i></a>';
    echo  '<span><a href="mailto:' . esc_attr($footer_contact_email) . '">' . esc_html($footer_contact_email) . '</a></span>';
    echo '</div>';
  }
  if ($footer_contact_phone) {
    echo '<div class="footer-contact-block">';
    echo  '<i class="fa fa-phone"></i>';
    echo  '<span>' . esc_html($footer_contact_phone) . '</span>';
    echo '</div>';
  } 
  echo '</div>';

}
endif;
