<?php 
function jubha_register_menus() {
  register_nav_menus(array(
    'primary-menu' => __('Primary Menu', 'jubha'),
    'footer-menu'  => __('Footer Menu', 'jubha'),
  ));
}
add_action('after_setup_theme', 'jubha_register_menus');
