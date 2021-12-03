<?php
/**
 * Template Name: Trang Công thức
 */
get_header();
?>

<div class="container main-content">
    <div class="mx-auto">
        <h2 class="mt-3 mb-2">Fulid power, pump, system and pipework calculations</h2>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                    role="tab" aria-controls="home" aria-selected="true">
                    Hydraulic Power
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button"
                    role="tab" aria-controls="profile" aria-selected="false">
                    Accumulator
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button"
                    role="tab" aria-controls="contact" aria-selected="false">
                    Pneumatic Flow
                </button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active m-4" id="home" role="tabpanel" aria-labelledby="home-tab">
                <?php get_template_part('/template-parts/calculator-hydraulic-power'); ?>
            </div>
            <div class="tab-pane fade m-4" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <?php get_template_part('/template-parts/calculator-accumulator'); ?>
            </div>
            <div class="tab-pane fade m-4" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <?php get_template_part('/template-parts/calculator-pneumatic-flow'); ?>
            </div>
        </div>
    </div>
</div>

<?php get_template_part('/template-parts/product_line-list') ?>

<?php get_footer(); ?>