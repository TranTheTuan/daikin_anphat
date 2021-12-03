<div class="container main-content">
    <div class="mx-auto">
        <?php if ( is_active_sidebar( 'home-slide-widget' ) ) : ?>
        <div id="header-widget-area" class="chw-widget-area widget-area" role="complementary">
            <?php dynamic_sidebar( 'home-slide-widget' ); ?>
        </div>
        <?php endif; ?>
    </div>
</div>
