<?php get_header(); ?>

<div class="content">
 
        <section id="main-content">
        <?php
            $args = array(  
                'post_type' => 'product',
                'post_status' => 'publish',
                'posts_per_page' => 8,
                'orderby' => 'title', 
                'order' => 'ASC', 
            );
            $loop = new WP_Query( $args );
            while ( $loop->have_posts() ) : $loop->the_post();
                var_dump($post->post_title);
                print get_post_permalink($post->ID);
                the_excerpt();
            endwhile;

            wp_reset_postdata(); 
        ?>
        </section>

</div>
 
<?php get_footer(); ?>