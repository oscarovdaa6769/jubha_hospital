<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/main.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

  <title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<header class="site-header">
      <div class="container">
            <img src="/wp-content/themes/jubha-hospital/assets/images/logo.png" alt="logo-brand" height="100px">
            <div class="cta">
                  <a href="#" class="btn"><i class="fa-solid fa-phone"></i> 920033440</a>
                  <a href="<?php echo home_url('/booking-an-appointment/'); ?>" class="btn">
                        <i class="fa-solid fa-calendar-check"></i>
                        Book an appointment
                  </a>
                  <button class="btn-cc"><i class="fa-solid fa-user"></i></button>
            </div>
      </div>
      <div class="container">
            <nav class="site-nav">
                  <?php
                  wp_nav_menu(array(
                  'theme_location' => 'navigation-menu',
                  'container' => false
                  ));
                  ?>
            </nav>
      </div>
</header>
