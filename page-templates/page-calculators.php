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
                <button class="nav-link active" id="hydraulic-power-tab" data-bs-toggle="tab" data-bs-target="#hydraulic-power" type="button"
                    role="tab" aria-controls="hydraulic-power" aria-selected="true">
                    Hydraulic Power
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="hydraulic-pipes-tab" data-bs-toggle="tab" data-bs-target="#hydraulic-pipes" type="button"
                    role="tab" aria-controls="hydraulic-pipes" aria-selected="true">
                    Hydraulic Pipes
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="temp-control-tab" data-bs-toggle="tab" data-bs-target="#temp-control" type="button"
                    role="tab" aria-controls="temp-control" aria-selected="false">
                    Temp. Control
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="accumulator-tab" data-bs-toggle="tab" data-bs-target="#accumulator" type="button"
                    role="tab" aria-controls="accumulator" aria-selected="false">
                    Accumulator
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pneumatic-flow-tab" data-bs-toggle="tab" data-bs-target="#pneumatic-flow" type="button"
                    role="tab" aria-controls="pneumatic-flow" aria-selected="false">
                    Pneumatic Flow
                </button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active m-4" id="hydraulic-power" role="tabpanel" aria-labelledby="hydraulic-power-tab">
                <?php get_template_part('/template-parts/calculator-hydraulic-power'); ?>
            </div>
            <div class="tab-pane fade m-4" id="hydraulic-pipes" role="tabpanel" aria-labelledby="hydraulic-pipes-tab">
                <?php get_template_part('/template-parts/calculator-hydraulic-pipes'); ?>
            </div>
            <div class="tab-pane fade m-4" id="temp-control" role="tabpanel" aria-labelledby="temp-control-tab">
                <?php get_template_part('/template-parts/calculator-temp-control'); ?>
            </div>
            <div class="tab-pane fade m-4" id="accumulator" role="tabpanel" aria-labelledby="accumulator-tab">
                <?php get_template_part('/template-parts/calculator-accumulator'); ?>
            </div>
            <div class="tab-pane fade m-4" id="pneumatic-flow" role="tabpanel" aria-labelledby="pneumatic-flow-tab">
                <?php get_template_part('/template-parts/calculator-pneumatic-flow'); ?>
            </div>
        </div>
    </div>
</div>

<?php get_template_part('/template-parts/product_line-list') ?>

<?php get_footer(); ?>