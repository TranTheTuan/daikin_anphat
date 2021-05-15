<?php get_header(); ?>
	<div class="dk-pl-bg">
		<div class="container">
			<div class="w-75 mx-auto">
				<h3>Daikin Hydraulics Products</h2>
				<div class="row mb-lg-3">
				<?php
					$args = array(
					'post_type' => 'product_line',
					'post_status' => 'publish',
					'posts_per_page' => 8,
					'orderby' => 'title', 
					'order' => 'ASC', 
					);
					$loop = new WP_Query( $args );
					while ( $loop->have_posts() ) : $loop->the_post(); 
						$meta = get_post_meta($post->ID);
						var_dump($post);?>
						<div class="col-lg-4 mb-3">
							<div class="dk-el">
								<a href="<?php echo get_post_permalink($post->ID); ?>">
									<img src="<?php echo get_template_directory_uri() . $meta['sm_image'][0] ?>" alt="super unit" style="max-width: 100%;">
									<div class="dk-el-body">
										<p>
										<?php echo $meta['description']['0']; ?>
										</p>
									</div>
								</a>
							</div>
						</div>	
					<?php endwhile;

					wp_reset_postdata();
				?>
					<!-- <div class="col-lg-4 mb-3">
						<div class="dk-el">
							<a href="#">
								<img src="<?php echo get_template_directory_uri() . '/assets/images/product-line/su1/super-unit1.png' ?>" alt="super unit" style="max-width: 100%;">
								<div class="dk-el-body">
									<p>
									Excellent power pack system achieving dramatic factory energy-savings. Super Unit, utilizing the Daikin IPM motor has made a great contribution to preservation for global environment.
									</p>
								</div>
							</a>
						</div>
					</div>
					<div class="col-lg-4 mb-3">
						<div class="dk-el">
							<a href="#">
								<img src="<?php echo get_template_directory_uri() . '/assets/images/product-line/su2/super-unit2.png' ?>" alt="super unit" style="max-width: 100%;">
								<div class="dk-el-body">
									<p>
									Unparalleled energy-saving and high-accuracy servo-based pump PQ control system for press and general industrial machinery.
									</p>
								</div>
							</a>
						</div>
					</div>
					<div class="col-lg-4 mb-3">
						<div class="dk-el">
							<a href="#">
								<img src="<?php echo get_template_directory_uri() . '/assets/images/product-line/eco/eco.png' ?>" alt="super unit" style="max-width: 100%;">
								<div class="dk-el-body">
									<p>
									Excellent power pack system for a machine tools. Highly efficient IPM motors now incorporated for substantial energy savings and low heat generation.
									</p>
								</div>
							</a>
						</div>
					</div>
					<div class="col-lg-4 mb-3">
						<div class="dk-el">
							<a href="#">
								<img src="<?php echo get_template_directory_uri() . '/assets/images/product-line/ecor/ecor.png' ?>" alt="super unit" style="max-width: 100%;">
								<div class="dk-el-body">
									<p>
									Excellent power pack system achieving dramatic factory energy-savings. Super Unit, utilizing the Daikin IPM motor has made a great contribution to preservation for global environment.
									</p>
								</div>
							</a>
						</div>
					</div>
					<div class="col-lg-4 mb-3">
						<div class="dk-el">
							<a href="#">
								<img src="<?php echo get_template_directory_uri() . '/assets/images/product-line/ocu/oil-cooling-unit.png' ?>" alt="super unit" style="max-width: 100%;">
								<div class="dk-el-body">
									<p>
									Unparalleled energy-saving and high-accuracy servo-based pump PQ control system for press and general industrial machinery.
									</p>
								</div>
							</a>
						</div>
					</div>
				</div> -->
			</div>
			

			<!-- <div class="row">
				<div class="col-lg-4 mb-3">
					<div class="dk-el">
						<a href="#">
							<img src="<?php echo get_template_directory_uri() . '/assets/images/product-line/ecor.png' ?>" alt="super unit" style="max-width: 100%;">
							<div class="dk-el-body">
								<p>
								Excellent power pack system achieving dramatic factory energy-savings. Super Unit, utilizing the Daikin IPM motor has made a great contribution to preservation for global environment.
								</p>
							</div>
						</a>
					</div>
				</div>
				<div class="col-lg-4 mb-3">
					<div class="dk-el">
						<a href="#">
							<img src="<?php echo get_template_directory_uri() . '/assets/images/product-line/oil-cooling-unit.png' ?>" alt="super unit" style="max-width: 100%;">
							<div class="dk-el-body">
								<p>
								Unparalleled energy-saving and high-accuracy servo-based pump PQ control system for press and general industrial machinery.
								</p>
							</div>
						</a>
					</div>
				</div>
			</div> -->
		</div>
	</div>

<?php get_footer(); ?>