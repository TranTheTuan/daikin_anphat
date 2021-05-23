<?php
get_header();
?>
<?php get_template_part('/template-parts/product_line-header') ?>
<div class="container mb-5 main-content">
    <div class="mx-auto">
        <div class="main-header row text-center">
        <?php if (CFS()->get('applications') != ""): ?>
            <div class="col">
                <form action="<?php echo get_home_url() . '/' . CFS()->get('applications') ?>">
                    <input style="display: none;" type="text" id="pid" name="pid" value="<?php echo $post->ID; ?>">
                    <button class="category-bottom-button category-product-list full-width arrow">Applications</button>
                </form>
            </div>
        <?php endif ?>
        <?php if (CFS()->get('specifications') != ""): ?>
            <div class="col">
                <form action="<?php echo get_home_url() . '/' . CFS()->get('specifications') ?>">
                    <input style="display: none;" type="text" id="pid" name="pid" value="<?php echo $post->ID; ?>">
                    <button class="category-bottom-button category-product-list full-width arrow">Specifications</button>
                </form>
            </div>
        <?php endif ?>
        <?php if (CFS()->get('rate_characteristics') != ""): ?>
            <div class="col">
                <form action="<?php echo get_home_url() . '/' . CFS()->get('rate_characteristics') ?>">
                    <input style="display: none;" type="text" id="pid" name="pid" value="<?php echo $post->ID; ?>">
                    <button class="category-bottom-button category-product-list full-width arrow">Pressure - Flow rate characteristics</button>
                </form>
            </div>
        <?php endif ?>
        <?php if (CFS()->get('rating_range') != ""): ?>
            <div class="col">
                <form action="<?php echo get_home_url() . '/' . CFS()->get('rating_range') ?>">
                    <input style="display: none;" type="text" id="pid" name="pid" value="<?php echo $post->ID; ?>">
                    <button class="category-bottom-button category-product-list full-width arrow">Continuous and Short-time Rating Range</button>
                </form>
            </div>
        <?php endif ?>
        <?php if (CFS()->get('download') != ""): ?>
            <div class="col">
                <form action="<?php echo get_home_url() . '/' . CFS()->get('download') ?>">
                    <input style="display: none;" type="text" id="pid" name="pid" value="<?php echo $post->ID; ?>">
                    <button class="category-bottom-button category-product-list full-width arrow">Click here for downloading the cataloguePDF</button>
                </form>
            </div>
        <?php endif ?>
        </div>
        <ul class="spec-headers">
        <?php if (CFS()->get('features') != ""): ?>
            <li class="category-typical-product arrow-down"><a href="#ft-block">Features</a></li>
        <?php endif ?>
        <?php if (CFS()->get('functions') != ""): ?>
            <li class="category-typical-product arrow-down"><a href="#func-block">Functions</a></li>
        <?php endif ?>
        <?php if (CFS()->get('function_options') != ""): ?>
            <li class="category-typical-product arrow-down"><a href=#fo-block">Function Options</a></li>
        <?php endif ?>
        <?php if (CFS()->get('unit_options') != ""): ?>
            <li class="category-typical-product arrow-down"><a href="#uo-block">Unit Options</a></li>
        <?php endif ?>
        <?php if (CFS()->get('hardware_options') != ""): ?>
            <li class="category-typical-product arrow-down"><a href="#ho-block">Hardware Options</a></li>
        <?php endif ?>
        <?php if (CFS()->get('case_studies') != ""): ?>
            <li class="category-typical-product arrow-down"><a href="#cs-block">Case Study of energy-saving</a></li>
        <?php endif ?>
        </ul>
    </div>

    <div class="dk-body mx-auto">
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
            <div id="ho-block"  class="mb-5">
                <h3>Hardware Options</h3>
                <div class="row">
                <?php foreach(CFS()->get('hardware_options') as $ft): ?>
                    <div class="col-md-6 p-3 mb-2" style="display:inline-block">
                        <form action="<?php echo $ft['link'] ?>">
                            <input style="display: none;" type="text" id="pid" name="pid" value="<?php echo $post->ID; ?>">
                            <button class="category-bottom-button category-product-list full-width arrow"><?php echo $ft['name']; ?></button>
                        </form>
                    </div>
                <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if (CFS()->get('case_studies') != ""): ?>
            <div id="cs-block" class="mb-5">
                <h3>Case studies of energy-saving</h3>
                <div class="common-border p-3">
                    <!-- <div class="p-3"></div> -->
                    <h4 class="features-name">Various case studies of energy-saving such as the power consumption reductions in 72%.</h4>
                    <div class="case-study-name">
                        <?php foreach(CFS()->get('case_studies') as $ft): ?>
                            <a class="category-typical-product arrow" href="<?php echo $ft['link']  . '/?pid=' . $post->ID  ?>"><?php echo $ft['name']; ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php get_template_part('/template-parts/product_line-list') ?>

<?php get_footer(); ?>