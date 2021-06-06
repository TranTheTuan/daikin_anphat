<?php
/**
 * Template Name: Trang Nội dung
 */
get_header();
?>

<div class="container main-content">
    <div class="mx-auto">
        <?php the_content(); ?>
    </div>
</div>

<?php get_template_part('/template-parts/product_line-list') ?>

<?php get_footer(); ?>