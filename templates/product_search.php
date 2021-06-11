<?php

/*
 * Template Name: Product Search
 */
get_header();

$query = $_GET['query'];



if (isset($_GET["limit"]) && trim($_GET["limit"]) != '') {
    $limit = $_GET['limit'];    
    if($limit == 'all') {
        $limit = -1;
    }
} else {
    $limit = -1;
}

$args = array(
    'post_type' => 'product',
    'meta_query' => array(
        array(
            'key' => 'product_code',
            'value' => $query,
            'compare' => 'LIKE'
        )),
    'posts_per_page' => $limit
);

$products_query = new WP_Query($args);

?>

    <div class="container" id="product-search-main-content" style="margin-bottom: 50px;">
        <div class="row mt-3">
            <div class="col" id="product-search-header">TÌM KIẾM : <?php echo $query; ?></div>
        </div>
<?php get_template_part('/template-parts/product-search-bar') ?>
<?php
    if($products_query->post_count) {
        echo ' 
        <div class="row mt-2">
            <div class="col" id="search-result-count">
                KẾT QUẢ TÌM KIẾM : <span style="font-weight: bold;">'.$query.'</span><span class="m-3"><span style="font-weight: bold;">'.$products_query->post_count.'</span> kết quả</span>
            </div>
        </div>';
        
        genChooseLimitBar($query, $limit);

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
                                <div class="col features-title">Các tính năng</div>
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
                Không tìm thấy sản phẩm nào liên quan đến <span style="font-weight:bold;">'.$query.'</span>.
            </div>
        </div>';
    }

?>
<?php
    genChooseLimitBar($query, $limit);
?>
        
        <div class="row mt-4">
            <div class="col" id="search-from-categories">
                <div class="row">
                    <div class="col links-header">Tìm kiếm theo phân loại sản phẩm</div>
                </div>

                <div class="row mb-3 index-link-container">
                    <ul>
<?php
    $categories = get_terms('product-category');
    foreach($categories as $category) {
        echo '<li><a href="' . home_url('/product-category') . '?cid=' . $category->term_id . '" class="arrow">'.$category->name.'</a></li>';
    }
?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col" id="search-from-categories">
                <div class="row">
                    <div class="col links-header">Danh sách các sản phẩm thiết bị thủy lực</div> <!-- Hydraulic Equipment Products List -->
                </div>
                <div class="row mb-3 index-link-container">
                    <ul>
                        <li><a href="<?php echo home_url('/products-by-categories'); ?>" class="arrow">Chọn theo phân loại sản phẩm</a></li>
                        <li><a href="<?php echo home_url('/products-by-codes'); ?>" class="arrow">Chọn theo mã sản phẩm</a></li>
                    </ul>
                </div>
            </div>
        </div>

        
    </div>

<?php
get_footer();

function genChooseLimitBar($query, $limit) {
    $url = home_url('/product-search');
    echo '
    <div class="row mt-4">
        <div class="col limit">'.
            getLimitLink($limit, '10', $url, $query) . ' | ' .
            getLimitLink($limit, '20', $url, $query) . ' | ' .
            getLimitLink($limit, '50', $url, $query) . ' | ' .
            getLimitLink($limit, 'all', $url, $query) . 
        '</div>
    </div>';
}

function getLimitLink($requestedLimit, $genLimit, $url, $query) {
    if ($requestedLimit !="" && ($requestedLimit == $genLimit || ($requestedLimit == -1 && $genLimit == 'all' && isset($_GET["limit"])))) {
        return '<a id="requested-limit">'.ucfirst($genLimit).'</a>';
    } else {
        return '<a href="'.$url."/?query=".$query.'&limit='. $genLimit .'">Tất cả</a>';
    }
}

?>