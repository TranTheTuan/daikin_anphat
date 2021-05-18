/**
*Template Name: Trang thông số
*
*
*/

<?php
get_header();
?>
<?php get_template_part('/template-parts/product_line-header', NULL, array('meta' => $meta)) ?>
<div class="container">
    <div class="w-75 mx-auto">
        <?php if(count(CFS()->get('specifications')) > 0): ?>
            <ul class="spec-headers">
                <?php foreach($spec of CFS()->get('specifications')): ?>
                    <li><a href="#block1"><?php echo $spec['sp-title'] ?></a></li>
                <?php endforeach; ?>
            </ul>
        <? endif; ?>
        <?php echo $meta['specifications'][0]; ?>
        <div>
            <?php foreach($spec of CFS()->get('specifications')): ?>
                <div>
                    <div><?php echo $spec['sp-title'] ?></div>
                    <img src="<?php echo $spec['sp-image'] ?>">
                    <div><?php echo $spec['sp-notes'] ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php get_template_part('/template-parts/product_line-list') ?>

<?php get_footer(); ?>