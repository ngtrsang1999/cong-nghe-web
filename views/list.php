
<!-- get data request -->
<?php
    $data_request = array();
    if (!empty($_GET)) {
        if(isset($_GET['category'])){
            $data_request['category'] = trim($_GET['category']);
            $title_list_story = 'Truyện '.trim(getNameCategory($connect, $_GET['category']));
        }else{
            $title_list_story = 'Danh sách tất cả các truyện';
        }
        if(isset($_GET['order'])){
            $data_request['order'] = trim($_GET['order']);
            $sap_xep = $_GET['order'];
        }else{
            $sap_xep = 'Mới cập nhật';
        }
        if(isset($_GET['status'])){
            $data_request['status'] = trim($_GET['status']);
            $trang_thai = $_GET['status'];
            if($_GET['status'] == 'dang-cap-nhat'){
                $trang_thai = 'Đang cập nhật';
            }
            if($_GET['status'] == 'da-hoan-thanh'){
                $trang_thai = 'Đã hoàn thành';
            }
        }else{
            $trang_thai = 'Tất cả';
        }

        // if(isset($_GET['page'])){
        //     $data_request['page'] = (int)@trim($_GET['page']);
        // }else{
        //      $data_request['page'] = 1 ;
        // }
        // if($data_request['page'] < 1){
        //      $data_request['page'] = 1 ;
        // }
        $page_index = 1;
    }else{
        $title_list_story = 'Danh sách tất cả các truyện';
        $trang_thai = 'Tất cả';
        $sap_xep = 'Mới cập nhật';
    }
    $data_request = json_encode($data_request);
?>

<!-- end get data request -->
    <section class="main-content">
        <div class="container">
             <div class="list-story">
                <div class="title-list-story">
                    <p><?php
                        echo $title_list_story.'<span class="ml-md-3 d-block d-md-inline" style="font-size: 15px;">(Sắp xếp theo: '.$sap_xep.' &nbsp;&nbsp;&nbsp;&nbsp;  Trạng thái: '.$trang_thai.')</span>';  
                    ?>
                    </p>          
               </div>
                <ul class="grid-6 list-story" id ="data-request" data-request='<?php echo $data_request; ?>'>
                        
                    </ul>
            </div>

            <ul class="pagination d-flex justify-content-center">
                <li class="page-item"><a class="page-link" data-page="1"><i class="fa fa-angle-double-left" aria-hidden="true"></i></a></li>
                <li class="page-item"><a class="page-link" data-page="1" id="page-left"><i class="fa fa-angle-left" aria-hidden="true"></i></a></li>
                <li class="page-item"><a class="page-link" data-page="1" id= "page-now">1</a></li>
                <li class="page-item"><a class="page-link" data-page="1" id = "page-right"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
                <li class="page-item"><a class="page-link" data-page="1" id="page-max"><i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
             </ul>
        </div>
    </section>
    