<?php

/*
 * Template Name: Choose products from the product codes
 */
get_header();
?>

    <div class="container" id="choose-products-main-content">
        <div class="row">
            <div class="col products-by-x-header">Products (Choose from the product codes)</div>
        </div>
<?php get_template_part('/template-parts/product-search-bar') ?>
        <div class="row py-3">
            <div class="col choose-x">Choose from the product codes</div>
            <div class="col">
                <form action="<?php bloginfo('wpurl'); ?>/products-by-categories">
                    <button class="full-width choose-y-button">Choose from the product categories</button>
                </form>
            </div>
        </div>

        <div class="row pb-4 index-link-container">
            <ul>
<?php
    foreach(range('A', 'Z') as $letter) {
        echo '<li><a href="#letter-'.$letter.'" class="arrow-down">'.$letter.'</a></li>';
    }
?>
                <li><a href="#others" class="arrow-down">Others</a></li>
            </ul>
        </div>

        <div class="list-x-container p-4">

<?php

    foreach(range('A', 'Z') as $letter) {
        wp_reset_query();
        $products_query = new WP_Query(array(
            'post_type' => 'product',
            'meta_key' => 'product_code',
            'meta_query' => array(
                'key' => 'product_code',
                'value' => '^'.$letter,
                'compare' => 'REGEXP'
            )
        ));
        echo '
            <div class="letter" id="letter-'.$letter.'">
                <div class="row mt-5 mb-3">
                    <div class="col letter-title">'.$letter.'</div>
                </div>
                <div class="row letter-products">
                    <ul>';
        for ($i = 0; $i < $products_query -> post_count; $i++) {
            $post_metas = get_post_meta($products_query->posts[$i]->ID);

            $product_category_terms = get_the_terms($products_query->posts[$i]->ID, 'product-category' );
            $cid = $product_category_terms[0] -> term_id;

            echo '      <li><a href="'.home_url('/product-category').'?cid='.$cid.'&pid='.$products_query->posts[$i]->ID.'#product-'.$products_query->posts[$i]->ID.'" class="product arrow"><span>'.$post_metas['product_code'][0].'</span><span class="m-3">'. $products_query->posts[$i]->post_title .'</span></a></li>';
        }                    
        echo '      </ul>
                </div>
            </div>';

        wp_reset_postdata();
    }

    wp_reset_query();
    $products_query = new WP_Query(array(
        'post_type' => 'product',
        'meta_key' => 'product_code',
        'meta_query' => array(
            'key' => 'product_code',
            'value' => '^[a-z]',
            'compare' => 'NOT REGEXP'
        )
    ));
    echo '
    <div class="letter" id="others">
        <div class="row mt-5 mb-3">
            <div class="col letter-title">Others</div>
        </div>
        <div class="row letter-products">
            <ul>';
    for ($i = 0; $i < $products_query -> post_count; $i++) {
        $post_metas = get_post_meta($products_query->posts[$i]->ID);

        $product_category_terms = get_the_terms($products_query->posts[$i]->ID, 'product-category' );
        $cid = $product_category_terms[0] -> term_id;

        echo '      <li><a href="'.home_url('/product-category').'?cid='.$cid.'&pid='.$products_query->posts[$i]->ID.'#product-'.$products_query->posts[$i]->ID.'" class="product arrow"><span>'.$post_metas['product_code'][0].'</span><span class="m-3">'. $products_query->posts[$i]->post_title .'</span></a></li>';
    }                    
    echo '      </ul>
            </div>
        </div>';

    wp_reset_postdata();
?>

        </div>
    </div> 

<?php

get_template_part('/template-parts/product_line-list');

get_footer();
?>

