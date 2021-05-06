<?php

function daikinanphat_theme_support(){
    add_theme_support('title-tag');
}

add_action('after_setup_theme', 'daikinanphat_theme_support');

function daikinanphat_register_style(){
    $version = wp_get_theme()->get('Version');
    wp_enqueue_style('daikin-anphat-stylesheet', get_template_directory_uri() . '/style.css', array(), $version, 'all');
    wp_enqueue_style('daikin-anphat-stylesheet1', get_template_directory_uri() . '/assets/css/reset.css', array(), $version, 'all');
    wp_enqueue_style('daikin-anphat-stylesheet2', get_template_directory_uri() . '/assets/css/base.css', array(), $version, 'all');
    wp_enqueue_style('daikin-anphat-stylesheet3', get_template_directory_uri() . '/assets/css/fontface.css', array(), $version, 'all');
    wp_enqueue_style('daikin-anphat-stylesheet4', get_template_directory_uri() . '/assets/css/header.css', array(), $version, 'all');
    wp_enqueue_style('daikin-anphat-stylesheet5', get_template_directory_uri() . '/assets/css/globalnav.css', array(), $version, 'all');
    wp_enqueue_style('daikin-anphat-stylesheet6', get_template_directory_uri() . '/assets/css/footer.css', array(), $version, 'all');
    wp_enqueue_style('daikin-anphat-stylesheet7', get_template_directory_uri() . '/assets/css/print.css', array(), $version, 'all');
    wp_enqueue_style('daikin-anphat-stylesheet8', get_template_directory_uri() . '/assets/css/module.css', array(), $version, 'all');
    wp_enqueue_style('daikin-anphat-stylesheet9', get_template_directory_uri() . '/assets/css/en/common.css', array(), $version, 'all');
    wp_enqueue_style('daikin-anphat-stylesheet10', get_template_directory_uri() . '/assets/css/en/common/common.css', array(), $version, 'all');
    wp_enqueue_style('daikin-anphat-stylesheet11', get_template_directory_uri() . '/assets/css/en/local.css', array(), $version, 'all');
}

add_action('wp_enqueue_scripts', 'daikinanphat_register_style');

function daikinanphat_register_header_script(){
    $version = wp_get_theme()->get('Version');
    wp_enqueue_script('daikin-anphat-script-h1', get_template_directory_uri() . '/assets/js//gg-tag-mng.js', array(), $version, false);
    wp_enqueue_script('daikin-anphat-script-h2', get_template_directory_uri() . '/assets/js//satori-hashcode.js', array(), $version, false);
    wp_enqueue_script('_-s-js-_', 'https://satori.segs.jp/s.js?c=cc6d53df', array(), $version, 'all');
}

add_action('wp_enqueue_scripts', 'daikinanphat_register_header_script');

function daikinanphat_register_footer_scripts(){
    wp_enqueue_script('daikin-anphat-script-f1', get_template_directory_uri() . '/assets/js/jquery.js', array(), '3.4.1', true);
    wp_enqueue_script('daikin-anphat-script-f2', get_template_directory_uri() . '/assets/js/plugins.js', array(), '1.16.0', true);
    wp_enqueue_script('daikin-anphat-script-f3', get_template_directory_uri() . '/assets/js/scripts.js', array(), '4.4.1', true);
    wp_enqueue_script('daikin-anphat-script-f4', get_template_directory_uri() . '/assets/js/webfont.js', array(), '1.1', true);
    wp_enqueue_script('daikin-anphat-script-f5', get_template_directory_uri() . '/assets/js/lodash.js', array(), '1.1', true);
    wp_enqueue_script('daikin-anphat-script-f6', get_template_directory_uri() . '/assets/js/slick.js', array(), '1.1', true);
    wp_enqueue_script('daikin-anphat-script-f7', get_template_directory_uri() . '/assets/js/common.js', array(), '1.1', true);
    wp_enqueue_script('daikin-anphat-script-f8', get_template_directory_uri() . '/assets/js/en/common.js', array(), '1.1', true);
    wp_enqueue_script('daikin-anphat-script-f9', get_template_directory_uri() . '/assets/js/lib.js', array(), '1.1', true);
    wp_enqueue_script('daikin-anphat-script-f10', get_template_directory_uri() . '/assets/js/.js', array(), '1.1', true);
}

add_action('wp_enqueue_scripts', 'daikinanphat_register_footer_scripts');

function daikinanphat_menus(){
    $locations = array(
        'primary' => 'Primary Menu 1'
    );
    register_nav_menus($locations);
}

add_action('init', 'daikinanphat_menus');

function daikinanphat_post_type(){
    register_post_type('product', array('label'=>'product', 'public' => true));
}

add_action('init', 'daikinanphat_post_type');

?>