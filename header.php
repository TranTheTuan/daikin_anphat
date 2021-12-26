<!DOCTYPE html>
<html lang="en"> 
<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="An Phat - Nha phan phoi chinh hang cua Daikin tai Viet Nam">  
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri() . '/assets/images/favicon.ico'?>"> 
    
	<?php wp_head(); ?>

</head> 

<body>
    
    <!-- <header class="header text-center"> -->

	<nav class="navbar nav-custom navbar-expand-lg navbar-light bg-light">
		<div class="container main-content">
			<a class="navbar-brand" href="<?php echo get_home_url() ?>">
				<img class="py-auto" src="<?php echo get_template_directory_uri() . '/assets/images/logo-anphat.png' ?>" alt="" width="" height="66"></a>
			<!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button> -->
			<!-- <div class="" id="navbarSupportedContent">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<a class="nav-link" aria-current="page" href="<?php echo get_home_url() . '/about'; ?>">About</a>
					</li>
				</ul> -->
				<?php
					// wp_nav_menu(
					// 	array(
					// 	'menu' => 'primary',
					// 	'container' => '',
					// 	'theme_location' => 'primary',
					// 	'items_wrap' => '<ul class="navbar-nav me-auto mb-2 mb-lg-0">%3$s</ul>'
					// 	)
					// );
				?>
				
			<!-- </div> -->
			<a class="navbar-brand" href="<?php echo get_home_url() ?>">
				<img src="<?php echo get_template_directory_uri() . '/assets/images/logo-daikin.png' ?>" alt="" height="36"></a>
		</div>
	</nav>

	<nav class="navbar navbar-expand-lg navbar-light sub-nav">
		<!-- <div class="sub-nav"> -->
			<div class="container main-content">
				<!-- <div class="row">
					<a class="nav-link" aria-current="page" href="<?php echo get_home_url() . '/about'; ?>">Giới thiệu</a>
					<a class="nav-link" aria-current="page" href="https://thietbicongnghiep.net/tin-tuc-2-2-10687.html">News</a>
				</div> -->
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#subNav" aria-controls="subNav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<?php
					wp_nav_menu(array(
						'menu' => 'Menu 1',
						'menu_class' => 'navbar-nav me-auto mb-2 mb-lg-0',
						'container' => 'div',
						'container_class' => 'collapse navbar-collapse',
						'container_id' => 'subNav',
					))
				?>
			</div>
		<!-- </div> -->

	</nav>
		
    <!-- </header> -->