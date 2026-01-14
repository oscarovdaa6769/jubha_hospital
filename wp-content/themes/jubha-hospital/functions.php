<?php 
function jubha_register_menus() {
  register_nav_menus(array(
    'primary-menu' => __('Primary Menu', 'jubha'),
    'footer-menu'  => __('Footer Menu', 'jubha'),
  ));
}
add_action('after_setup_theme', 'jubha_register_menus');




function jubha_enqueue_scripts() {
    wp_enqueue_style('swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');
    wp_enqueue_script('swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), null, true);
    wp_enqueue_script('main-js', get_template_directory_uri() . '/assets/js/main.js', array('swiper-js'), null, true);
}
add_action('wp_enqueue_scripts', 'jubha_enqueue_scripts');


register_nav_menus( array(
    'navigation-menu' => __( 'Primary Navigation', 'textdomain' ),
) );