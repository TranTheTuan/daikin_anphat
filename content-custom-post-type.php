<?php
function create_content_post_type() {
    $labels = array('name' => 'Content Posts', 'singular_name' => 'Content Post');
    $args = array(
        'labels' => $labels,
        'description' => '',
        'supports' => array(
            'title',
            'thumbnail',
            'custom-fields' 
        ),
        'taxonomy' => array('category'),
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_menus' => true,
        'show_in_admin_bar' => true,
        'menu_position' => 1,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'public_queryable' => true,
        'capability_type' => 'post',
        'show_in_rest' => true
    );
    register_post_type('content', $args);
}
add_action('init', 'create_content_post_type');


?>