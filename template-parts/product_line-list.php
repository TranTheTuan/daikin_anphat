<div class="dk-pl-bg">
    <div class="container main-content">
        <div class="mx-auto">
            <h3>Daikin Hydraulics Products</h2>
            <div class="row mb-lg-3">
            <?php
                $args = array(
                'post_type' => 'product_line',
                'post_status' => 'publish',
                'posts_per_page' => 8,
                'orderby' => 'title', 
                'order' => 'ASC', 
                );
                $loop = new WP_Query( $args );
                while ( $loop->have_posts() ) : $loop->the_post();?>   
                    <div class="col-lg-4 mb-3">
                        <div class="dk-el">
                            <a href="<?php echo get_post_permalink($post->ID); ?>">
                                <img src="<?php echo CFS()->get('small_image') ?>" alt="super unit" style="max-width: 100%;">
                                <div class="dk-el-body">
                                    <p>
                                    <?php echo CFS()->get('description'); ?>
                                    </p>
                                </div>
                            </a>
                        </div>
                    </div>	
                <?php endwhile;

              

                wp_reset_postdata();
            ?>
                <div class="col-lg-4 mb-3" id="product-line-list-buttons">
                    <div class="row">
                        <div class="col">
                            <form action="<?php bloginfo('wpurl'); ?>/model-list">
                            <button id="model-list-button" class="full-width arrow">Hybrid Hydraulic Unit Model List</button>
                            </form>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6">
                            <form action="<?php bloginfo('wpurl'); ?>/products-by-categories">
                            <button class="choose-product-from-button full-width arrow">
                                Sản phẩm<sub> (Chọn theo phân loại sản phẩm)</sub>
                            </button>
                            </form>
                        </div>
                        <div class="col-6">
                            <form action="<?php bloginfo('wpurl'); ?>/products-by-codes">
                            <button class="choose-product-from-button full-width arrow">
                                Sản phẩm<sub> (Chọn theo mã sản phẩm)</sub>
                            </button>
                            </form>
                        </div>
                    </div>
                </div>
             </div>
        </div>
    </div>
</div>