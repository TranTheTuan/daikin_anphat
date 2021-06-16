<?php
    
    /*
    * Template Name: Model List
    */

    get_header();
?>
    <div class="container model-list-text-content">
        <div class="row">
            <div class="col mt-5" id="model-list-title">
                Danh sách các mẫu thiết bị thủy lực
            </div>
        </div>
        <div class="row">
            <div class="col mt-4 mb-5" id="model-list-description">
                Thông số kỹ thuật khác nhau tùy thuộc vào loại thiết bị.<br/>
                Dòng sản phẩm Daikin cung cấp các chức năng và công suất khác nhau tùy theo loại thiết bị.
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
                <li>Công suất động cơ trên chỉ được đưa ra để hướng dẫn và không đại diện cho công suất tiêu chuẩn của động cơ nói chung.</li>
                <!-- <li>When selecting a SUPER UNIT, verify the specifications of each model by referring to “Pressure – Flow rate Characteristics (Typical)” on Pages 13 and 14 and “How to Select a SUPER UNIT” on Page 49. For the purpose of making improvements, the specifications given in this catalog are subject to change without prior notice. Be sure to see the latest model chart.</li> -->
                <li>Khi chọn SUPER UNIT, hãy xác minh các thông số kỹ thuật của từng kiểu máy bằng cách tham khảo tài liệu "Pressure – Flow rate Characteristics (Typical)" ở trang 13 và 14 và "How to Select a SUPER UNIT" trang 49. Với mục đích cải tiến, các thông số kỹ thuật đưa ra trong danh mục này có thể thay đổi mà không cần thông báo trước. Hãy đảm bảo rằng bạn đang xem biểu đồ mới nhất.</li>
            </ol>
        </div>
    </div>
    

<?php

    get_footer();
?>
