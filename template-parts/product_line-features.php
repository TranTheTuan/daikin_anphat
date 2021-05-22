<div id="<?php echo $args['id']; ?>">
    <h3><?php echo $args['name']; ?></h3>
    <?php foreach($args['attrs'] as $attr): ?>
        <div style="display:inline-block">
            <div><?php echo $attr['title']; ?></div>
            <div><?php echo $attr['description']; ?></div>
            <div><?php echo $attr['detail']; ?></div>
            <div><a href="<?php echo $attr['link'] . '/?pid=' . $post->ID; ?>">Click here for more details</a></div>
        </div>
    <?php endforeach; ?>
</div>
