<?php
get_header();
?>
<?php get_template_part('/template-parts/product_line-header') ?>
<div class="container mb-5">
    <div class="w-75 mx-auto">
        <div class="main-header d-flex justify-content-between text-center">
        <?php if (CFS()->get('applications') != ""): ?>
            <div class="header-box flex-fill"><a href="<?php echo get_template_directory_uri() . '/' . CFS()->get('applications') ?>">Applications</a></div>
        <?php endif ?>
        <?php if (CFS()->get('specifications') != ""): ?>
            <div class="header-box flex-fill"><a href="<?php echo get_template_directory_uri() . '/' . CFS()->get('specifications') ?>">Specifications</a></div>
        <?php endif ?>
        <?php if (CFS()->get('rate_characteristics') != ""): ?>
            <div class="header-box flex-fill"><a href="<?php echo get_template_directory_uri() . '/' . CFS()->get('rate_characteristics') ?>">Pressure - Flow rate characteristics</a></div>
        <?php endif ?>
        <?php if (CFS()->get('rating_range') != ""): ?>
            <div class="header-box flex-fill"><a href="<?php echo get_template_directory_uri() . '/' . CFS()->get('rating_range') ?>">Continuous and Short-time Rating Range</a></div>
        <?php endif ?>
        <?php if (CFS()->get('download') != ""): ?>
            <div class="header-box flex-fill"><a href="<?php echo CFS()->get('download') ?>" target="_blank">Download</a></div>
        <?php endif ?>
        </div>
        <ul class="spec-headers">
        <?php if (count(CFS()->get('features')) > 0): ?>
            <li><a href="#ft-block">Features</a></li>
        <?php endif ?>
        <?php if (count(CFS()->get('functions')) > 0): ?>
            <li><a href="#func-block">Functions</a></li>
        <?php endif ?>
        <?php if (count(CFS()->get('function_options')) > 0): ?>
            <li><a href=#fo-block">Function Options</a></li>
        <?php endif ?>
        <?php if (CFS()->get('unit_options') != ""): ?>
            <li><a href="#uo-block">Unit Options</a></li>
        <?php endif ?>
        <?php if (count(CFS()->get('hardware_options')) > 0): ?>
            <li><a href="#ho-block">Hardware Options</a></li>
        <?php endif ?>
        <?php if (count(CFS()->get('case_studies')) > 0): ?>
            <li><a href="#cs-block">Case Study of energy-saving</a></li>
        <?php endif ?>
        </ul>
    </div>

    <div class="dk-body w-75 mx-auto">
        <?php if (count(CFS()->get('features')) > 0): ?>
        <div id="ft-block">
            <h3>Features</h3>
            <?php foreach(CFS()->get('features') as $key => $ft): ?>
                <div><?php echo $ft['ft_title']; ?></div>
                <div><?php echo $ft['ft_description']; ?></div>
                <div><?php echo $ft['ft_detail']; ?></div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <?php if (count(CFS()->get('functions')) > 0): ?>
        <div id="func-block">
            <h3>Functions</h3>
            <?php foreach(CFS()->get('functions') as $ft): ?>
                <div><?php echo $ft['func_title']; ?></div>
                <div><?php echo $ft['func_description']; ?></div>
                <div><?php echo $ft['func_detail']; ?></div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <?php if (count(CFS()->get('function_options')) > 0): ?>
        <div id="fo-block">
            <h3>Functions Options</h3>
            <?php foreach(CFS()->get('function_options') as $ft): ?>
                <div><?php echo $ft['fo_title']; ?></div>
                <div><?php echo $ft['fo_description']; ?></div>
                <div><?php echo $ft['fo_detail']; ?></div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <?php if (count(CFS()->get('hardware_options')) > 0): ?>
        <div id="ho-block">
            <h3>Hardware Options</h3>
            <?php foreach(CFS()->get('hardware_options') as $ft): ?>
                <div><?php echo $ft['ho_name']; ?></div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php get_template_part('/template-parts/product_line-list') ?>

<?php get_footer(); ?>