<?php
/**
 * Template Name: Super Unit
 */
get_header();
?>

<div id="g-main" class="g-main">
    <div class="g-breadcrumbs g-breadcrumbs-white">
      <ol>
        <li><a href="http://www.daikin.com/">HOME</a></li>
        <li>Oil Hydraulics</li>
      </ol>
    </div>

    <?php
        get_template_part('/template-parts/content/super-unit/header');
        get_template_part('/template-parts/content/super-unit/nav');
        get_template_part('/template-parts/content/super-unit/body');
        get_template_part('/template-parts/content/super-unit/footer');
        get_template_part('template-parts/content/content', 'productline');
    ?>

</div>

<?php get_footer(); ?>
