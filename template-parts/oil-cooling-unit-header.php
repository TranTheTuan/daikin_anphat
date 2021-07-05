<?php
if(isset($_GET['pid'])) {
    $post_id = $_GET['pid'];
    $args = array(
        'p' => $post_id,
        'post_type' => 'oil_cooling_unit',
    );
    $loop = new WP_Query( $args );
}
?>
<div class="dk-poster">
    <div class="dk-poster-title">
        <div class="dk-poster-title-box">
            <?php if(isset($loop)): ?>
                <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
                    <h1><?php echo $post->post_title ?></h1>
                    <p class="lead"><?php echo CFS()->get('description') ?></p>
                <?php endwhile;
                    wp_reset_postdata();
                ?>
            <?php else: ?>
                <h1>Bộ làm mát dầu</h1>
                <p class="lead">Bộ làm mát dầu biến tần đã cải thiện lớn về khả năng tiết kiệm năng lượng, công nghệ điều khiển trung tâm của Daikin đã phát triển cho hệ điều hòa không khí</p>
            <?php endif; ?>
        </div>
    </div>
    <?php if(isset($loop)): ?>
        <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
            <img src="<?php echo CFS()->get('large_image') ?>" alt="">
        <?php endwhile;
            wp_reset_postdata();
        ?>
    <?php else: ?>
        <img src="<?php echo get_template_directory_uri() . '/assets/images/oil_cooling_unit_cover.png' ?>" alt="">
    <?php endif; ?>
</div>
