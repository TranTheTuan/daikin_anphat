<?php

/*
 * Template Name: Choose products from the product categories
 */
get_header();
?>

    <div id="main-content" class="container" style="margin-bottom: 50px;">
        <div class="row mt-5">
            <div class="col" id="products-by-categories-header">Products (Choose from the product categories)</div>
        </div>
<?php get_template_part('/template-parts/product-search-bar') ?>
        <div class="row py-3">
            <div class="col" id="choose-categories">Choose from the product categories</div>
            <div class="col">
                <form action="<?php bloginfo('wpurl'); ?>/products-by-codes">
                    <button id="choose-codes-button" class="full-width">Choose from the product codes</button>
                </form>
                
            </div>
        </div>
        <div class="common-border p-4">
<?php
    $i = 0;
    $terms = get_terms('product-category', array('hide_empty' => false));
    while ($i < FLOOR(sizeof($terms) / 2)) {
        echo '<div class="row pb-5">';
        genProductCategoryView($terms[2 * $i]);
        genProductCategoryView($terms[2 * $i + 1]);
        echo '</div>';
        $i = $i + 1;
    }
    if ((2 * $i + 1) == sizeof($terms)) {
        echo '<div class="row pb-5">';
        genProductCategoryView($terms[2 * $i]);
        echo '</div>';
    }
?>
        </div>
    </div> 
<!-- </body>
</html> -->

<?php
get_template_part('/template-parts/product_line-list');
get_footer();

function genProductCategoryView($term) {
    $term_metas = get_term_meta($term->term_id);

    wp_reset_query();
    $products_query = new WP_Query(array(
        'post_type' => 'product',
        'tax_query' => array(
            array(
                'taxonomy' => 'product-category',
                'field' => 'slug',
                'terms' => $term->slug
            )
        )
    ));

    echo '
        <div class="category col-6" id="category-' . $term->term_id . '">
            <div class="row">
                <div class="category-title arrow">' . $term->name . '</div>
            </div>
            <div class="row mb-5 left-category-content">
                <div class="col">
                    <div class="row mb-3"><div class="col category-description">' . $term->description . '</div></div>
                    <div class="row">';
    if($products_query -> post_count >= 1) {        
        echo '          <a href="'.home_url('/product-category').'?cid='.$term->term_id.'&pid='.$products_query->posts[0]->ID.'" class="category-typical-product arrow">' . $products_query->posts[0]->post_title . '</a><br/>';
    }
    if($products_query -> post_count >= 2) {
        echo '          <a href="'.home_url('/product-category').'?cid='.$term->term_id.'&pid='.$products_query->posts[1]->ID.'" class="category-typical-product arrow">' . $products_query->posts[1]->post_title . '</a><br/>';
    };
    if($products_query -> post_count >= 3) {
        echo '          <a href="'.home_url('/product-category').'?cid='.$term->term_id.'" class="category-typical-product">・・・</a>';
    }
    echo '          </div>
                </div>
                <div class="col">'. wp_get_attachment_image( $term->term_image, 'full' ) .'</div>
            </div>
            <div class="row mb-4">
                <div class="col-6">
                    <form action="'.home_url('/product-category').'">
                        <input style="display: none;" type="text" id="cid" name="cid" value="'.$term->term_id.'">
                        <button class="category-bottom-button category-product-list full-width arrow">Product List</button>
                    </form>
                </div>
                <div class="col-6">';
    if(wp_get_attachment_url($term_metas['major_specs'][0]) != "") {
        echo '      <form action="'. wp_get_attachment_url($term_metas['major_specs'][0]) .'">
                        <input style="display: none;" type="text" id="cid" name="cid" value="'.$term->term_id.'">
                        <button class="category-bottom-button category-product-list full-width arrow pdf">Major Specifications</button>
                    </form>';
    }
    echo '
                </div>                
            </div>
        </div>';

    wp_reset_postdata();
}

?>