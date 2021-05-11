<?php get_header(); ?>

  <div id="g-main" class="g-main">
    <div class="g-breadcrumbs g-breadcrumbs-white">
      <ol>
        <li><a href="http://www.daikin.com/">HOME</a></li>
        <li>Oil Hydraulics</li>
      </ol>
    </div>

    <?php
      // $args = array(  
      //   'post_type' => 'product',
      //   'post_status' => 'publish',
      //   'posts_per_page' => 8,
      //   'orderby' => 'title', 
      //   'order' => 'ASC', 
      // );
      // $loop = new WP_Query( $args );
      // while ( $loop->have_posts() ) : $loop->the_post();
      //     var_dump($post->post_title);
      //     print get_post_permalink($post->ID);
      //     the_excerpt();
      // endwhile;

      // wp_reset_postdata(); 
    ?>
    <?php get_template_part('template-parts/content/content', 'productline') ?>
  </div>

<?php get_footer(); ?>
