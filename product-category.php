<?php

function product_category_columns($columns) {
    $new_columns = array(
        'cb' => '<input type="checkbox" />',
        'slug' => __('Slug'),
        'name' => __('Name'),
        'description' => __('Description'),
        'posts' => __('Posts')
    );
    return $new_columns;
}
add_filter('manage_edit-product-category_columns', 'product_category_columns');

function product_category_add_image_uploader( $taxonomy ) {
    return 'product-category';
}
add_filter( 'taxonomy-term-image-taxonomy', 'product_category_add_image_uploader' );

function product_category_image_labels($labels) {
    $labels['fieldTitle'] = __('Image');
    $labels['fieldDescription'] = __('');
    return $labels;
}
add_filter('taxonomy-term-image-labels', 'product_category_image_labels');

function product_category_image_meta_key($option_name) {
    return 'product_category_image';
}
add_filter('taxonomy-term-image-meta-key', 'product_category_image_meta_key');

function create_product_category_taxonomy() {
    $labels = array('name' => 'Product Categories', 'singular_name' => 'Product Category', 'menu_name' => 'Product Categories');
    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true
    );
    register_taxonomy('product-category', 'product', $args);
}
add_action('init', 'create_product_category_taxonomy');

?>