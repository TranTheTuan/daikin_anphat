<?php

/*
 * Template Name: Product Search
 */
get_header();

$query = $_GET['query'];

$args = array(
    'post_type' => 'product',
    'meta_query' => array(
        array(
            'key' => 'product_code',
            'value' => $query,
            'compare' => 'LIKE'
        )
    )
);

$products_query = new WP_Query($args);

?>

    <div class="container" id="product-search-main-content">
        <div class="row">
            <div class="col" id="product-search-header">SEARCH RESULT : <?php echo $query; ?></div>
        </div>
        <form action="<?php echo home_url('/product-search'); ?>">
        <div class="row pb-3">
            <div class="col-8">
                <input type="text" placeholder="Example: SUPER UNIT, SUT" class="full-width product-search-input" name="query">
            </div>
            <div class="col-4">
                <button value="Search" class="full-width product-search-button">Search</button>
            </div>
        </div>
        </form>     

<?php
    if($products_query->post_count) {
        echo ' 
        <div class="row mt-2">
            <div class="col" id="search-result-count">
                SEARCH RESULT : <span style="font-weight: bold;">'.$query.'</span><span class="m-3"><span style="font-weight: bold;">'.$products_query->post_count.'</span> results</span>
            </div>
        </div>
        
        <div class="row mt-4">
                <div class="col limit">
                    <a href="# limit-10">10</a> |
                    <a href="# limit-20">20</a> |
                    <a href="# limit-50">50</a> |
                    <a href="# limit-all">All</a>
                </div>
            </div>';

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
    } else {
        echo '
        <div class="row mt-4">
            <div class="col" id="not-found">
                Products relevant to <span style="font-weight:bold;">'.$query.'</span> not found.
            </div>
        </div>';
    }

?>
       
        <div class="row mt-4">
            <div class="col limit">
                <a href="# limit-10">10</a> |
                <a href="# limit-20">20</a> |
                <a href="# limit-50">50</a> |
                <a href="# limit-all">All</a>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col" id="search-from-categories">
                Search from Product Categories
            </div>
        </div>
        <div class="row mt-4">
            <div class="col" id="products-list">

            </div>
        </div>


        
    </div>

<?php
get_footer();
?>