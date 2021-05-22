<?php
    
    /*
    * Template Name: Model List
    */

    get_header();
?>
    <div class="container model-list-text-content">
        <div class="row">
            <div class="col mt-5" id="model-list-title">
                Hybrid Hydraulic Unit Model List
            </div>
        </div>
        <div class="row">
            <div class="col mt-4 mb-5" id="model-list-description">
                Specifications vary depending on the machine type.<br/>
                The Daikin product lineup provides various functions and capacities according to the machine type.
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
            <img class="mx-auto d-block" src="<?php echo get_template_directory_uri() . '/assets/images/model-list.png' ?>" alt="Model list">
            </div>
        </div>
    </div>

    <div class="container model-list-text-content">
        <div class="col my-5">
            <ol class="model-list-img-caption">
                <li>The above motor capacities are given for guidance only and do not represent the standard capacities of general motors.</li>
                <li>When selecting a SUPER UNIT, verify the specifications of each model by referring to “Pressure – Flow rate Characteristics (Typical)” on Pages 13 and 14 and “How to Select a SUPER UNIT” on Page 49. For the purpose of making improvements, the specifications given in this catalog are subject to change without prior notice. Be sure to see the latest model chart.</li>
            </ol>
        </div>
    </div>
    

<?php

    get_footer();
?>