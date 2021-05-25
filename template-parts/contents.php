<?php
    
    
?>

<div class="contents-container">
    <div class="container-fluid contents">
        <div class="row">
            <div class="col contents-title">Contents</div>
        </div>
<?php
    $i = 0;
    $contents = query_posts('post_type=content'); 
    while ($i < FLOOR(sizeof($contents) / 3)) {
        echo '<div class="row">';
        gen_content_view($contents[3 * $i]);
        gen_content_view($contents[3 * $i + 1]);
        gen_content_view($contents[3 * $i + 2]);
        echo '</div>';
        $i = $i + 1;
    }

    if ((3 * $i + 1) == sizeof($contents)) {
        echo '<div class="row">';
        gen_content_view($contents[3 * $i]);
        echo '<div class="col-4"></div>';
        echo '<div class="col-4"></div>';
        echo '</div>';
    }

    if ((3 * $i + 2) == sizeof($contents)) {
        echo '<div class="row">';
        gen_content_view($contents[3 * $i]);
        gen_content_view($contents[3 * $i + 1]);
        echo '<div class="col-4"></div>';
        echo '</div>';
    }

?>       
    </div>
</div>

<?php

function gen_content_view($content) {
    $metas = get_post_meta($content->ID);
    echo '<div class="col-4 mb-5">
        <a href="'.get_page_link($metas['content_link'][0]).'">'
        .wp_get_attachment_image($metas['thumbnail'][0], 'full' ).
        '<div><span class="content-title arrow">'.$content->post_title.'</span></div>
            <div class="content-description">'.$content->description.'</div>
        </a>
    </div>';
}
?>
