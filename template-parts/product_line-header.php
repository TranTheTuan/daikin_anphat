<?php
if(isset($_GET['pid'])) {
    $post_id = $_GET['pid'];
    $args = array(
        'p' => $post_id,
        'post_type' => 'product_line',
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
                <h1><?php echo $post->post_title ?></h1>
                <p class="lead"><?php echo CFS()->get('description') ?></p>
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
        <img src="<?php echo CFS()->get('large_image') ?>" alt="">
    <?php endif; ?>
</div>
