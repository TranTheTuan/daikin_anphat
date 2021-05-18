<?php
function create_product_post_type() {
    $labels = array('name' => 'Products', 'singular_name' => 'Product');
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
    register_post_type('product', $args);
}
add_action('init', 'create_product_post_type');

function starts_with_posts_where( $where, $query ) {
    global $wpdb;

    $starts_with = esc_sql( $query->get( 'starts_with' ) );

    if ( $starts_with ) {
        $where .= " AND $wpdb->posts.post_title LIKE '$starts_with%'";
    }

    return $where;
}
add_filter('posts_where', 'starts_with_posts_where', 10, 2);


?>