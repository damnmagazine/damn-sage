<?php

namespace Roots\Sage\Init;

use Roots\Sage\Assets;

/**
 * Theme setup
 */
function setup() {
  // Make theme available for translation
  // Community translations can be found at https://github.com/roots/sage-translations
  load_theme_textdomain('sage', get_template_directory() . '/lang');

  // Enable plugins to manage the document title
  // http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
  add_theme_support('title-tag');

  // Register wp_nav_menu() menus
  // http://codex.wordpress.org/Function_Reference/register_nav_menus
  register_nav_menus([
    'primary_navigation' => __('Primary Navigation', 'sage'),
    'header_socials' => __('Header Socials', 'sage'),
    'footer_navigation' => __('Footer Navigation', 'sage'),
    'footer_socials' => __('Footer Socials', 'sage'),
    'colophon' => __('Colophon', 'sage')
  ]);

  // Add post thumbnails
  // http://codex.wordpress.org/Post_Thumbnails
  // http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
  // http://codex.wordpress.org/Function_Reference/add_image_size

  // include post thumbnails
  add_theme_support( 'post-thumbnails' );

  // set_post_thumbnail_size(125, 125, true);
  add_image_size( 'news-image', 1000, 610, true );

  // Add post formats
  // http://codex.wordpress.org/Post_Formats
  add_theme_support('post-formats', ['aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio']);

  // Add HTML5 markup for captions
  // http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
  add_theme_support('html5', ['caption', 'comment-form', 'comment-list']);

  // Tell the TinyMCE editor to use a custom stylesheet
  add_editor_style(Assets\asset_path('styles/editor-style.css'));
}
add_action('after_setup_theme', __NAMESPACE__ . '\\setup');

/**
 * Register sidebars
 */
function widgets_init() {
  register_sidebar([
    'name'          => __('Primary', 'sage'),
    'id'            => 'sidebar-primary',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>'
  ]);

  register_sidebar([
    'name'          => __('Footer', 'sage'),
    'id'            => 'sidebar-footer',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>'
  ]);

  register_sidebar([
    'name'          => __('Homepage - Socials (Instagram, etc)', 'sage'),
    'id'            => 'sidebar-homepage-socials',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>'
  ]);

  register_sidebar([
    'name'          => __('Homepage - Agenda Feed', 'sage'),
    'id'            => 'sidebar-homepage-agenda',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>'
  ]);

  register_sidebar([
    'name'          => __('DAMN Plus login/summary', 'sage'),
    'id'            => 'sidebar-damn-plus-widget',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>'
  ]);

  register_sidebar([
    'name'          => __('Calendar Page', 'sage'),
    'id'            => 'sidebar-calendar-page-filter',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '<span class="back-to-calendar pull-right"><a href="/calendar" title="Back to all Calendar events" class="btn btn-primary text-uppercase"><i class="fa fa-arrow-left"></i> Back To All</a></span><div class="clearthis"></div></section>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>'
  ]);

  register_sidebar([
    'name'          => __('Tag Cloud Topics Page', 'sage'),
    'id'            => 'widget-tag-cloud-topics',
    'before_widget' => '',
    'after_widget'  => '',
    'before_title'  => '',
    'after_title'   => ''
  ]);

  register_sidebar([
    'name'          => __('Magazine Detail Page', 'sage'),
    'id'            => 'magazine-detail-widget',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>'
  ]);

  register_sidebar([
    'name'          => __('Calendar Detail Page', 'sage'),
    'id'            => 'calendar-detail-widget',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>'
  ]);

  register_sidebar([
    'name'          => __('Event Detail Page', 'sage'),
    'id'            => 'event-detail-widget',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>'
  ]);

  register_sidebar([
    'name'          => __('Product Detail Page', 'sage'),
    'id'            => 'product-detail-widget',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>'
  ]);
}
add_action('widgets_init', __NAMESPACE__ . '\\widgets_init');


/**
 * Custom taxonomies
 */
// add_action( 'init', __NAMESPACE__ . '\\build_taxonomies', 0 );

// function build_taxonomies() {
//   register_taxonomy( 'Year', array('issues'), array( 'hierarchical' => false, 'label' => 'Year', 'query_var' => true, 'rewrite' => true ) );
// }

if( function_exists('acf_add_options_page') ) {

  acf_add_options_page(array(
    'page_title'  => 'Theme General Settings',
    'menu_title'  => 'DAMN Global Settings',
    'menu_slug'   => 'theme-general-settings',
    'capability'  => 'create_users',
    'redirect'    => false
  ));
}


