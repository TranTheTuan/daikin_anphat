<?php

/*
 * Template Name: Product Category
 */

$cid = $_GET['cid'];
$pid = $_GET['pid'];

if($cid == '') {
    wp_redirect(home_url('/products-by-categories'));
    exit;
}

$category = get_term_by('id', $cid, 'product-category');

wp_reset_query();
$products_query = new WP_Query(array(
    'post_type' => 'product',
    'tax_query' => array(
        array(
            'taxonomy' => 'product-category',
            'field' => 'term_id',
            'terms' => $category->term_id
        )
    )
));

$term_metas = get_term_meta($cid);

get_header();

?>
    <div class="container" id="choose-products-main-content">
        <div class="row">
            <div class="col products-by-x-header"><?php echo $category->name; ?></div>
        </div>
<?php get_template_part('/template-parts/product-search-bar') ?>
        <div class="row py-3">
             <div class="col">
                <form action="<?php bloginfo('wpurl'); ?>/products-by-categories">
                    <button class="full-width choose-y-button">Choose from the product categories</button>
                </form>
            </div>
            <div class="col">
                <form action="<?php bloginfo('wpurl'); ?>/products-by-codes">
                    <button class="full-width choose-y-button">Choose from the product codes</button>
                </form>
            </div>
        </div>
        <div class="row mt-5" id="model-no">
            <div class="col">Model No.</div>
        </div>
        <div class="row mb-3 index-link-container">
            <ul>
<?php
    foreach($products_query->posts as $product) {
        echo '<li><a href="#product-'.$product->ID.'" class="my-5 arrow-down">'.$product->post_title.'</a></li>';
    }

?>
            </ul>
        </div>

        <div class="row mb-5" id="major-specs">
            <div class="col">
<?php
            if(wp_get_attachment_url($term_metas['major_specs'][0]) != "") {
                echo '<a href="'.wp_get_attachment_url($term_metas['major_specs'][0]).'" class="arrow pdf">Major specifications: '.$category->name.'</a>';

            }
?>
            </div>
        </div>

<?php
    foreach($products_query->posts as $product) {
        $product_metas = get_post_meta($product->ID);
        echo '
        <div class="row mt-5" id="product-'.$product->ID.'">
            <div class="col">
                <div class="row">
                    <div class="col fullwidth product-title"><span class="product-name">'.$product->post_title.'</span><span class="product-code">'.$product_metas['product_code'][0].'</span></div>
                </div>
                <div class="row">
                    <div class="col-4 image-container">'.wp_get_attachment_image($product_metas['product_image'][0], 'full').'</div>
                    <div class="col-8">
                        <div class="row my-4">
                            <div class="col features-title">Features</div>
                        </div>
                        <div class="row features-content mb-4">
                            <div class="col">'.$product_metas['features'][0].'</div>
                        </div>';
        if($product_metas['electronic_catalog'][0] != '') {

            echo '      <div class="row refs my-1">
                            <div class="col"><a href="'.wp_get_attachment_url($product_metas['electronic_catalog'][0]).'" class="arrow pdf ref-link">Electronic Catalog</a><span class="ref-size">('.size_format(filesize(get_attached_file($product_metas['electronic_catalog'][0]))).')</span><br/></div>
                        </div>';
        }
        if($product_metas['model_change_chart'][0] != '') {

            echo '      <div class="row refs my-1">
                            <div class="col"><a href="'.wp_get_attachment_url($product_metas['model_change_chart'][0]).'" class="arrow pdf ref-link">Model Change Chart</a><span class="ref-size">('.size_format(filesize(get_attached_file($product_metas['model_change_chart'][0]))).')</span><br/></div>
                        </div>';
        }
        if($product_metas['sectional_view_sealing_parts'][0] != '') {

            echo '      <div class="row refs my-1">
                            <div class="col"><a href="'.wp_get_attachment_url($product_metas['sectional_view_sealing_parts'][0]).'" class="arrow pdf ref-link">Sectional view/sealing parts</a><span class="ref-size">('.size_format(filesize(get_attached_file($product_metas['sectional_view_sealing_parts'][0]))).')</span><br/></div>
                        </div>';
        }
                    
        echo '      </div>
                </div>
            </div>
        </div>';
    }

?>
    </div> 

<?php
wp_reset_postdata();

get_template_part('/template-parts/product_line-list');

get_footer();
?>
