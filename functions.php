<?php

function daikinanphat_register_style(){
    $version = wp_get_theme()->get('Version');
    wp_enqueue_style('daikin-anphat-stylesheet', get_template_directory_uri() . '/style.css', array('daikin-anphat-bootstrap'), $version, 'all');
    wp_enqueue_style('daikin-anphat-bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css', array(), '4.4.1', 'all');
    wp_enqueue_style('daikin-anphat-fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css', array(), '5.13.0', 'all');

}

add_action('wp_enqueue_scripts', 'daikinanphat_register_style');

function daikinanphat_register_scripts(){
    wp_enqueue_script('daikin-anphat-jquery', 'https://code.jquery.com/jquery-3.4.1.slim.min.js', array(), '3.4.1', true);
    wp_enqueue_script('daikin-anphat-popper', 'https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js', array(), '1.16.0', true);
    wp_enqueue_script('daikin-anphat-bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js', array(), '4.4.1', true);
    wp_enqueue_script('daikin-anphat-script', get_template_directory_uri() . '/assets/main.js', array(), '1.1', true);
}

add_action('wp_enqueue_scripts', 'daikinanphat_register_scripts');
?>