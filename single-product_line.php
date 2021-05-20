<?php
get_header();
var_dump(CFS()->get('features'));
var_dump(get_post_meta($post->ID));
// var_dump($post);a
?>
<?php get_template_part('/template-parts/product_line-header') ?>
<div class="container">
    <div class="w-75 mx-auto">
        <ul class="main-header">
        <?php if (CFS()->get('applications') != ""): ?>
            <li><a href="<?php get_template_directory_uri() . CFS()->get('applications') ?>">Applications</a></li>
        <?php endif ?>
        <?php if (CFS()->get('specifications') != ""): ?>
            <li><a href="<?php get_template_directory_uri() . CFS()->get('specifications') ?>">Specifications</a></li>
        <?php endif ?>
        <?php if (CFS()->get('rate_characteristics') != ""): ?>
            <li><a href="<?php get_template_directory_uri() . CFS()->get('rate_characteristics') ?>">Pressure - Flow rate characteristics</a></li>
        <?php endif ?>
        <?php if (CFS()->get('rating_range') != ""): ?>
            <li><a href="<?php get_template_directory_uri() . CFS()->get('rating_range') ?>">Continuous and Short-time Rating Range</a></li>
        <?php endif ?>
        <?php if (CFS()->get('download') != ""): ?>
            <li><a href="<?php get_template_directory_uri() . CFS()->get('download') ?>">Download</a></li>
        <?php endif ?>
        </ul>
        <ul class="sub-header">
        <?php if (count(CFS()->get('features')) > 0): ?>
            <li><a href="#ft-block">Feature</a></li>
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

    <div class="dk-body">
        <?php if (count(CFS()->get('features')) > 0): ?>
            <h3>Features</h3>
            <?php foreach(CFS()->get('features') as $key => $ft): ?>
                <div><?php echo $ft; ?></div>
                <div><?php echo CFS()->get('ft_description')[$key]; ?></div>
                <div><?php echo CFS()->get('ft_detail')[$key]; ?></div>
        <?php endforeach; endif; ?>

        <?php if (count(CFS()->get('functions')) > 0): ?>
            <h3>Functions</h3>
            <?php foreach(CFS()->get('functions') as $ft): ?>
                <div><?php echo $ft['func_title']; ?></div>
                <div><?php echo $ft['func_description']; ?></div>
                <div><?php echo $ft['func_detail']; ?></div>
        <?php endforeach; endif; ?>

        <?php if (count(CFS()->get('function_options')) > 0): ?>
            <h3>Functions Options</h3>
            <?php foreach(CFS()->get('function_options') as $ft): ?>
                <div><?php echo $ft['fo_title']; ?></div>
                <div><?php echo $ft['fo_description']; ?></div>
                <div><?php echo $ft['fo_detail']; ?></div>
        <?php endforeach; endif; ?>

        <?php if (count(CFS()->get('hardware_options')) > 0): ?>
            <h3>Hardware Options</h3>
            <?php foreach(CFS()->get('ho_options') as $ft): ?>
                <div><?php echo $ft['ho_name']; ?></div>
        <?php endforeach; endif; ?>
    </div>
</div>

<?php get_template_part('/template-parts/product_line-list') ?>

<?php get_footer(); ?>