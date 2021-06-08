<?php

// Set up taxonomy-term-image module
include_once(get_template_directory() . '/lib/taxonomy-term-image/taxonomy-term-image.php');
function taxonomy_term_image_custom_js_dir_url($option_name) {
    return get_template_directory_uri() . '/lib/taxonomy-term-image/js';
}
add_filter('taxonomy-term-image-js-dir-url', 'taxonomy_term_image_custom_js_dir_url');

// Product (custom post type)
include_once(get_template_directory() . '/product.php');
// Product category (custom taxonomy for Product)
include_once(get_template_directory() . '/product-category.php');
// Content (custom post type)
include_once(get_template_directory() . '/content-custom-post-type.php');

function daikinanphat_theme_support(){
    add_theme_support('title-tag');
}

add_action('after_setup_theme', 'daikinanphat_theme_support');

function daikinanphat_register_style(){
    $version = wp_get_theme()->get('Version');
    wp_enqueue_style('daikin-anphat-stylesheet1', get_template_directory_uri() . '/style.css', array('daikin-anphat-bootstrap'), $version, 'all');
    wp_enqueue_style('daikin-anphat-stylesheet2', get_template_directory_uri() . '/assets/css/common.css', array('daikin-anphat-bootstrap'), $version, 'all');
    wp_enqueue_style('daikin-anphat-stylesheet3', get_template_directory_uri() . '/assets/css/product_category.css', array('daikin-anphat-bootstrap'), $version, 'all');
    wp_enqueue_style('daikin-anphat-stylesheet4', get_template_directory_uri() . '/assets/css/products_by_categories.css', array('daikin-anphat-bootstrap'), $version, 'all');
    wp_enqueue_style('daikin-anphat-stylesheet5', get_template_directory_uri() . '/assets/css/products_by_codes.css', array('daikin-anphat-bootstrap'), $version, 'all');
    wp_enqueue_style('daikin-anphat-stylesheet6', get_template_directory_uri() . '/assets/css/bootstrap-grid.css', array('daikin-anphat-bootstrap'), $version, 'all');
    wp_enqueue_style('daikin-anphat-stylesheet7', get_template_directory_uri() . '/assets/css/single.css', array('daikin-anphat-bootstrap'), $version, 'all');
    wp_enqueue_style('daikin-anphat-stylesheet8', get_template_directory_uri() . '/assets/css/product_search.css', array('daikin-anphat-bootstrap'), $version, 'all');
    wp_enqueue_style('daikin-anphat-stylesheet9', get_template_directory_uri() . '/assets/css/footer.css', array('daikin-anphat-bootstrap'), $version, 'all');
    wp_enqueue_style('daikin-anphat-stylesheet10', get_template_directory_uri() . '/assets/css/model_list.css', array('daikin-anphat-bootstrap'), $version, 'all');
    wp_enqueue_style('daikin-anphat-stylesheet11', get_template_directory_uri() . '/assets/css/about.css', array('daikin-anphat-bootstrap'), $version, 'all');
    wp_enqueue_style('daikin-anphat-stylesheet12', get_template_directory_uri() . '/assets/css/contents.css', array('daikin-anphat-bootstrap'), $version, 'all');
    wp_enqueue_style('daikin-anphat-stylesheet13', get_template_directory_uri() . '/assets/css/product_line-list.css', array('daikin-anphat-bootstrap'), $version, 'all');
    wp_enqueue_style('daikin-anphat-stylesheet14', get_template_directory_uri() . '/assets/css/partners.css', array('daikin-anphat-bootstrap'), $version, 'all');
    wp_enqueue_style('daikin-anphat-bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '5.0.0', 'all');
    wp_enqueue_style('daikin-anphat-fontawesome', get_template_directory_uri() . '/assets/css/all.min.css', array(), '5.13.0', 'all');
}

add_action('wp_enqueue_scripts', 'daikinanphat_register_style');

function daikinanphat_register_scripts(){
    wp_enqueue_script('daikin-anphat-bundle', get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js', array(), '5.0.0', true);
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
    register_post_type('slideshow', array('label' => 'Slideshow', 'public' => true));
    register_post_type('product_line', array('label'=>'Product Line', 'public' => true));
}

add_action('init', 'daikinanphat_post_type');
?>