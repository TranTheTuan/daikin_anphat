<?php
get_header();
?>
<?php get_template_part('/template-parts/product_line-header', NULL, array('meta' => $meta)) ?>
<div class="container">
    <div class="w-75 mx-auto">
        <ul class="main-header">
        <?php if (CFS()->get('applications') != ""): ?>
            <li><a href="#block1">Applications</a></li>
        <?php endif ?>
        <?php if (CFS()->get('specifications') != ""): ?>
            <li><a href="#block1">Specifications</a></li>
        <?php endif ?>
        <?php if (CFS()->get('pressure') != ""): ?>
            <li><a href="#block1">Pressure - Flow rate characteristics</a></li>
        <?php endif ?>
        <?php if (CFS()->get('rating-range') != ""): ?>
            <li><a href="#block1">Specifications</a></li>
        <?php endif ?>
        <?php if (CFS()->get('downloads') != ""): ?>
            <li><a href="#block1">Download</a></li>
        <?php endif ?>
        </ul>
        <ul class="sub-header">
        <?php if (count(CFS()->get('features')) > 0): ?>
            <li><a href="#block1">Feature</a></li>
        <?php endif ?>
        <?php if (count(CFS()->get('functions')) > 0): ?>
            <li><a href="#block1">Functions</a></li>
        <?php endif ?>
        <?php if (count(CFS()->get('function-options')) > 0): ?>
            <li><a href="#block1">Function Options</a></li>
        <?php endif ?>
        <?php if (count(CFS()->get('unit-options')) > 0): ?>
            <li><a href="#block1">Unit Options</a></li>
        <?php endif ?>
        <?php if (count(CFS()->get('hardware-options')) > 0): ?>
            <li><a href="#block1">Hardware Options</a></li>
        <?php endif ?>
        <?php if (count(CFS()->get('case-study')) > 0): ?>
            <li><a href="#block1">Case Study of energy-saving</a></li>
        <?php endif ?>
        </ul>
    </div>

    <div class="dk-body">
        <?php if (count(CFS()->get('features')) > 0): ?>
            <h3>Features</h3>
            <?php foreach($ft of CFS()->get('features')): ?>
                <div><?php echo $ft['ft-title']; ?></div>
                <div><?php echo $ft['ft-description']; ?></div>
                <div><?php echo $ft['ft-detail']; ?></div>
        <?php endforeach; endif; ?>

        <?php if (count(CFS()->get('functions')) > 0): ?>
            <h3>Functions</h3>
            <?php foreach($ft of CFS()->get('functions')): ?>
                <div><?php echo $ft['func-title']; ?></div>
                <div><?php echo $ft['func-description']; ?></div>
                <div><?php echo $ft['func-detail']; ?></div>
        <?php endforeach; endif; ?>

        <?php if (count(CFS()->get('function-options')) > 0): ?>
            <h3>Functions Options</h3>
            <?php foreach($ft of CFS()->get('function-options')): ?>
                <div><?php echo $ft['fo-title']; ?></div>
                <div><?php echo $ft['fo-description']; ?></div>
                <div><?php echo $ft['fo-detail']; ?></div>
        <?php endforeach; endif; ?>

        <?php if (count(CFS()->get('hardware-options')) > 0): ?>
            <h3>Hardware Options</h3>
            <?php foreach($ft of CFS()->get('hardware-options')): ?>
                <div><?php echo $ft['hw-title']; ?></div>
        <?php endforeach; endif; ?>
    </div>
</div>

<?php get_template_part('/template-parts/product_line-list') ?>

<?php get_footer(); ?>