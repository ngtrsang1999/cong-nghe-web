<?php
    $data_rq_chapter = array(); 
    if(isset($_GET['id'])){
        $data_rq_chapter['id'] = trim($_GET['id']);
        $thisNameStory = trim($_GET['id']);
    }else{
        $data_rq_chapter['id'] ='';
    }
    if(isset($_GET['chapter'])){
        $data_rq_chapter['chapter'] = (double)@trim($_GET['chapter']);
    }else{
        $data_rq_chapter['chapter'] = 0;
    }
    $data_rq_chapter = json_encode($data_rq_chapter);
?>
    <!-- Phần nội dung -->

    <section class="main-content-readstory" style="background-color: #424242;">
        <div class="container row mx-auto">
            <div class="title-readstory col-12">
            </div>

            <div class="story-see-content col-12 mt-5  p-0 p-lg-5 text-center">
                <ul class="p-0" id="content-chapter" data-request = '<?php echo $data_rq_chapter; ?>'>
                  <!-- Content chapter -->
                </ul>
            </div>
        </div>

    </section>
    <!-- end nội dung -->

    <!-- phần footer -->
    <section class="story-see-footer fixed-bottom">
        <div class="container d-flex">
            <ul class="pagination mx-auto m-0">

            </ul>
         </div>
    </section>

    <!-- end footer -->
</div>
     <script type="text/javascript" src="./js/jquery.lazy.min.js"></script>
     <script src="js/js.js"></script>
     <script src="js/load_readStory.js"></script>
     
</body>
</html>