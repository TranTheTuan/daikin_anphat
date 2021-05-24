<div id="<?php echo $args['id']; ?>" class="mb-5">
    <h3><?php echo $args['name']; ?></h3>
    <div class="row">
    <?php foreach($args['attrs'] as $attr): ?>
        <div class="col-md-6 p-3 mb-2" style="display:inline-block;">
            <div class="common-border p-3">
                <div class="features-name <?php echo $args['id'] . '-name'; ?>"><?php echo $attr['title']; ?></div>
                <div class="<?php echo $args['id'] . '-content'; ?>">
                    <div class="features-title mb-4 ps-2"><?php echo $attr['description']; ?></div>
                    <div class="features-content ps-4 pb-4"><?php echo $attr['detail']; ?></div>
                </div>
                <form action="<?php echo $attr['link'] ?>">
                    <input style="display: none;" type="text" id="pid" name="pid" value="<?php echo $post->ID; ?>">
                    <button class="category-bottom-button category-product-list full-width arrow">Click here for more details</button>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
    </div>
</div>
