<?php
get_header();
$meta = get_post_meta($post->ID);
?>
<?php get_template_part('/template-parts/product_line-header', NULL, array('meta' => $meta)) ?>
<div class="container">
    <div class="w-75 mx-auto">
        <ul class="spec-headers">
            <li><a href="#block1">Specifications by Product (Single pump 200 V/400 V specifications)</a></li>
            <li><a href="#block2">Specifications by Product (Double pump 200 V/400 V specifications)</a></li>
            <li><a href="#block3">Common Specifications (30 L/min to 200 L/min, single/double pump, 200V/400V specifications)</a></li>
            <li><a href="#block4">Performance Specification</a></li>
        </ul>
        <?php echo $meta['specifications'][0]; ?>
    </div>
</div>

<?php get_footer(); ?>