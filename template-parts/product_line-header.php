
<div class="dk-poster">
    <div class="dk-poster-title">
        <div class="dk-poster-title-box">
            <h1><?php echo $post->post_title ?></h1>
            <p class="lead"><?php echo $args['meta']['description'][0] ?></p>
        </div>
    </div>
    <img src="<?php echo get_template_directory_uri() . $args['meta']['lg_image'][0] ?>" alt="">
</div>
