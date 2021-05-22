/**
*Template Name: Trang thông số
*
*
*/

<?php
get_header();
?>
<?php get_template_part('/template-parts/product_line-header') ?>
<div class="container">
    <div class="w-75 mx-auto">
        <?php the_content(); ?>
    </div>
</div>

<?php get_template_part('/template-parts/product_line-list') ?>

<?php get_footer(); ?>