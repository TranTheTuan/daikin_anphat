<?php
/**
 * Template Name: Trang Oil-cooling-unit
 */
get_header();
?>
<?php get_template_part('/template-parts/oil-cooling-unit-header') ?>
<div class="container main-content">
    <div class="mx-auto">
        <?php the_content(); ?>

        <h2 class="dk-h2">Thiết bị làm mát</h2>
        <div class="row mb-lg-3">
        <?php
            $args = array(
            'post_type' => 'oil_cooling_unit',
            'post_status' => 'publish',
            'posts_per_page' => 8,
            'orderby' => 'title', 
            'order' => 'ASC', 
            );
            $loop = new WP_Query( $args );
            while ( $loop->have_posts() ) : $loop->the_post();?>   
                <div class="col-sm-4 mb-3">
                    <div class="dk-oil">
                        <h3 class="dk-oil-ttl"><?php echo $post->post_title ?></h3>
                        <img src="<?php echo CFS()->get('image') ?>" alt="super unit" style="max-width: 100%;">
                        <p class="dk-oil-desc">
                            <?php echo CFS()->get('description'); ?>
                        </p>
                        <ul class="dk-oil-list">
                            <li class="arrow"><a href="<?php echo get_home_url() . '/' . CFS()->get('features') . '/?pid=' . $post->ID; ?>">Tính năng</a></li>
                            <li class="arrow"><a href="<?php echo get_home_url() . '/' . CFS()->get('specifications') . '/?pid=' . $post->ID; ?>">Đặc tả</a></li>
                            <li class="arrow"><a href="<?php echo get_home_url() . '/' . CFS()->get('applications') . '/?pid=' . $post->ID; ?>">Ứng dụng</a></li>
                            <li class="arrow"><a href="<?php echo get_home_url() . '/' . CFS()->get('download') . '/?pid=' . $post->ID; ?>">Tải đặc tả</a></li>
                        </ul>
                    </div>
                </div>	
            <?php endwhile;
            wp_reset_postdata();
        ?>
        </div>
    </div>
</div>
<?php get_template_part('/template-parts/product_line-list') ?>

<?php get_footer(); ?>