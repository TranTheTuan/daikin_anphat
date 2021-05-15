<?php

function daikinanphat_theme_support(){
    add_theme_support('title-tag');
}

add_action('after_setup_theme', 'daikinanphat_theme_support');

function daikinanphat_register_style(){
    $version = wp_get_theme()->get('Version');
    wp_enqueue_style('daikin-anphat-stylesheet', get_template_directory_uri() . '/style.css', array('daikin-anphat-bootstrap'), $version, 'all');
    wp_enqueue_style('daikin-anphat-bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css', array(), '5.0.0', 'all');
    wp_enqueue_style('daikin-anphat-fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css', array(), '5.13.0', 'all');
}

add_action('wp_enqueue_scripts', 'daikinanphat_register_style');

function daikinanphat_register_scripts(){
    wp_enqueue_script('daikin-anphat-bundle', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js', array(), '5.0.0', true);
    wp_enqueue_script('daikin-anphat-script', get_template_directory_uri() . '/assets/js/main.js', array(), '1.1', true);
}

add_action('wp_enqueue_scripts', 'daikinanphat_register_scripts');

function daikinanphat_menus(){
    $locations = array(
        'primary' => 'Primary Menu 1'
    );
    register_nav_menus($locations);
}

add_action('init', 'daikinanphat_menus');

function daikinanphat_post_type(){
    register_post_type('product_line', array('label'=>'Product Line', 'public' => true));
}

add_action('init', 'daikinanphat_post_type');
?>