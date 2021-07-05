<?php
/**
 * Template Name: Trang thông số
 */
get_header();
?>
<?php get_template_part('/template-parts/product_line-header') ?>
<div class="container main-content">
    <div class="mx-auto">
        <?php the_content(); ?>
    </div>
</div>

<?php get_template_part('/template-parts/product_line-list') ?>

<?php get_footer(); ?>