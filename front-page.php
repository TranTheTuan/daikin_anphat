<?php get_header(); ?>

  <div id="g-main" class="g-main">
    <div class="g-breadcrumbs g-breadcrumbs-white">
      <ol>
        <li><a href="http://www.daikin.com/">HOME</a></li>
        <li>Oil Hydraulics</li>
      </ol>
    </div>

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

    <div class="g-section-bg">
      <div class="g-bg g-bg-air">
        <div class="g-box">
          <h2 class="g-ttl-2">Daikin Hydraulics Products</h2>
          <div class="g-series g-grid g-grid-3 g-grid-sp g-mb-15">
            <div class="g-grid_el">
              <a href="en/special/sut/index.html" class="g-series_el g-series-r">
                <h3><img src="<?php echo get_template_directory_uri() . '/assets/images/super-unit1.png' ?>" alt="SUPER UNIT"></h3>
                <div data-height="series" class="g-series_body j-height">
                  <p>Excellent power pack system achieving dramatic factory energy-savings. Super Unit, utilizing the Daikin IPM motor has made a great contribution to preservation for global environment.</p>
                </div>
              </a>
            </div>
            <div class="g-grid_el">
              <a href="/en/special/sut_hp_hfr/index.html" class="g-series_el g-series-r">
                <h3><img src="<?php echo get_template_directory_uri() . '/assets/images/super-unit.png' ?>" alt="SUPER UNIT(Analog Command Input, High-Accuracy Type)"></h3>
                <div data-height="series" class="g-series_body j-height">
                  <p>Unparalleled energy-saving and high-accuracy servo-based pump PQ control system for press and general industrial machinery.</p>
                </div>
              </a>
            </div>
            <div class="g-grid_el">
              <a href="/en/special/ecorich/index.html" class="g-series_el g-series-a">
                <h3><img src="<?php echo get_template_directory_uri() . '/assets/images/eco.png' ?>" alt="ECORICH"></h3>
                <div data-height="series" class="g-series_body j-height">
                  <p>Excellent power pack system for a machine tools. Highly efficient IPM motors now incorporated for substantial energy savings and low heat generation.</p>
                </div>
              </a>
            </div>
          </div>
          <div class="g-series g-grid g-grid-3 g-grid-sp g-mb-30">
            <div class="g-grid_el">
              <a href="/en/special/ecorichr/index.html" class="g-series_el g-series-a">
                <h3><img src="<?php echo get_template_directory_uri() . '/assets/images/ecor.png' ?>" alt="ECORICH R"></h3>
                <div data-height="series" class="g-series_body j-height">
                  <p>A fusion of hydraulic and motor/inverter technologies Drastically improved functions on top of the energy saving features of the IPM motor.</p>
                </div>
              </a>
            </div>
            <div class="g-grid_el">
              <a href="/en/special/oilcon/index.html" class="g-series_el g-series-dx">
                <h3><img src="<?php echo get_template_directory_uri() . '/assets/images/oil-cooling-unit.png' ?>" alt="Oil Cooling Unit"></h3>
                <div data-height="series" class="g-series_body j-height">
                  <p class="g-p">Environmentally Friendly Inverter Oil Cooling Unit.</p>
                  <ul class="g-blist">
                    <li>High accurate temparture control.</li>
                    <li>High energy saving performance.</li>
                  </ul>
                </div>
              </a>
            </div>
            <div class="g-grid_el">
              <div class="g-btn g-btn-gray">
                <a href="/en/special/hou_itiran/index.html" class="g-mb-10 ">Hybrid Hydraulic Unit Model List</a>
              </div>
                  <div class="g-series g-grid g-grid-2 g-grid-sp g-mb-15">
                    <div class="g-grid_el">
                      <a href="/products00/category/index.php?lg=en" class="g-btn g-btn-gray g-mb-15 j-height" data-height="btn">
                        Products<br>
                        <sub>(Choose from the product categories)</sub></a>
                    </div>
                  <div class="g-grid_el">
                    <a href="/products00/num/index.php?lg=en" class=" g-btn g-btn-gray g-mb-15 j-height" data-height="btn">Products<br><sub>(Choose from the product codes)</sub></a>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php get_footer(); ?>
