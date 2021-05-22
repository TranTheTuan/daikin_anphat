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
        <?php if (CFS()->get('features') != ""): ?>
            <li><a href="#ft-block">Features</a></li>
        <?php endif ?>
        <?php if (CFS()->get('functions') != ""): ?>
            <li><a href="#func-block">Functions</a></li>
        <?php endif ?>
        <?php if (CFS()->get('function_options') != ""): ?>
            <li><a href=#fo-block">Function Options</a></li>
        <?php endif ?>
        <?php if (CFS()->get('unit_options') != ""): ?>
            <li><a href="#uo-block">Unit Options</a></li>
        <?php endif ?>
        <?php if (CFS()->get('hardware_options') != ""): ?>
            <li><a href="#ho-block">Hardware Options</a></li>
        <?php endif ?>
        <?php if (CFS()->get('case_studies') != ""): ?>
            <li><a href="#cs-block">Case Study of energy-saving</a></li>
        <?php endif ?>
        </ul>
    </div>

    <div class="dk-body w-75 mx-auto">
        <?php if (CFS()->get('features') != ""):?>
            <?php get_template_part('/template-parts/product_line', 'features', array('attrs' => CFS()->get('features'), 'id' => 'ft-block', 'name' => 'Features')); ?>
        <?php endif; ?>

        <?php if (CFS()->get('functions') != ""):?>
            <?php get_template_part('/template-parts/product_line', 'features', array('attrs' => CFS()->get('functions'), 'id' => 'func-block', 'name' => 'Functions')); ?>
        <?php endif; ?>

        <?php if (CFS()->get('function_options') != ""):?>
            <?php get_template_part('/template-parts/product_line', 'features', array('attrs' => CFS()->get('function_options'), 'id' => 'fo-block', 'name' => 'Function Options')); ?>
        <?php endif; ?>

        <?php if (CFS()->get('hardware_options') != ""): ?>
            <div id="ho-block">
                <h3>Hardware Options</h3>
                <?php foreach(CFS()->get('hardware_options') as $ft): ?>
                    <div><?php echo $ft['ho_name']; ?></div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if (CFS()->get('case_studies') != ""): ?>
            <div id="ho-block">
                <h3>Case studies of energy-saving</h3>
                <div>
                    <h4>Various case studies of energy-saving such as the power consumption reductions in 72%.</h4>
                    <?php foreach(CFS()->get('case_studies') as $ft): ?>
                        <div><a href="<?php echo $ft['link'] ?>"><?php echo $ft['name']; ?></a></div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php get_template_part('/template-parts/product_line-list') ?>

<?php get_footer(); ?>