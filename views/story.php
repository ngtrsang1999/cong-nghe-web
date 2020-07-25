    <!-- Phần nội dung --> 
<?php   
    $action_theodoi = 'add';
    $text_btn_theodoi = 'Theo dõi';

    $action_like = 'add';
    $text_btn_like = 'Thích';

    if(isset($_SESSION['user'])){
        if(!empty($_SESSION['user']['theo_doi'])){
            $listTheoDoi = json_decode($_SESSION['user']['theo_doi'], true);
            if(in_array($story_code, $listTheoDoi)){
                $action_theodoi = 'remove';
                $text_btn_theodoi = 'Bỏ theo dõi';
            }
        }

        if(!empty($_SESSION['user']['likes'])){
            $listLike = json_decode($_SESSION['user']['likes'], true);
            if(in_array($story_code, $listLike)){
                $action_like = 'remove';
                $text_btn_like = 'Bỏ thích';
            }
        }
    }
?>
    <section class="main-content-story">
        <div class="container">
            <div class="infor-story row">

                <div class="if-left ">
                    <img src="<?php echo $thisStory["story_avatar"] ?>" alt = "<?php echo $thisStory["story_name"] ?>">
                </div>
                <div class="if-right ">
                    <h1 class="name-story"><?php echo $thisStory["story_name"] ?></h1>
                    <div class="txt">
                        <span class="info-item">Tên Khác: <?php echo $thisStory["another_name_story"] ?></span>
                        <p class="info-item">Tác giả: 
                            <?php 
                                foreach ($listAuthor as $key => $value) {
                                    if($key != 0){
                                        echo' ; ';
                                    }
                                    echo '<a class="org" href="timkiem.php?value='.trim($value).'">'.ucwords($value).'</a>';
                                }
                            ?>
                        <p class="info-item">Tình trạng: <?php echo $status_name ?></p>

                        <div class="info-item">
                            <span>Thống kê:</span>
                            <span class="sp01"><i class="fa fa-thumbs-up" aria-hidden="true"></i> <span class="sp02 number-like"><?php echo $thisStory["count_likes"] ?></span></span>
                            <span class="sp01"><i class="fa fa-heart" aria-hidden="true"></i> <span class="sp02 number-followes"><?php echo $thisStory["count_followes"] ?></span></span>
                            <span class="sp01"><i class="fa fa-eye" aria-hidden="true"></i> <span class="sp02"><?php echo $thisStory["count_views"] ?></span></span>
                        </div>
        
                     </div>
                    
                    <ul class="list-categories ">
                        <?php
                            foreach ($categories_code as $value) {
                                echo '<li class="category-item"><a href="liststory.php?category='.$value["category_code"].'">'.
                                     getNameCategory($connect, $value["category_code"])
                                .'</a></li>';
                            }
                         ?>
                    </ul>

                    <ul class="story-detail-menu">
                        <li class="li01">
                            <a href="<?php echo 'read_story.php?id='.$story_code; ?>"> 
                            <i class="fa fa-book" aria-hidden="true"></i> Đọc từ đầu
                            </a>
                        </li>
                        <li class="li02">
                            <a data-storycode ="<?php echo $story_code; ?>" id= "btn-theodoi" data-action ="<?php echo $action_theodoi; ?>"> <i class="fa fa-heart" aria-hidden="true"></i> <?php echo $text_btn_theodoi; ?>
                            </a>
                        </li>
                        <li class="li03">
                            <a data-storycode ="<?php echo $story_code; ?>" id= "btn-like" data-action ="<?php echo $action_like; ?>"> <i class="fa fa-thumbs-up" aria-hidden="true"></i> <?php echo $text_btn_like; ?>
                            </a>
                        </li>
                    </ul>

                    <div class="story-descripstion">
                        <p>
                            <?php echo $thisStory["story_description"] ?>
                        </p>
                    </div>
                    <div class="clearbt">
                        <button>Xem thêm</button>
                    </div>
                </div>
            </div>

            <div class="ds-chuong-story">
                <div class="title-ds-chuong">

                    <h2 class="story-detail-title">
                    <i class="fa fa-list-alt" aria-hidden="true"></i>
                    Danh sách chương</h2>
                </div>
                <div class="box">
                    <div>
                        <ul>
                            <?php
                                foreach ($listChapteres as  $value) {
                                    echo '
                                        <li class="d-flex"> 
                                            <a href="read_story.php?id='.$value["story_code"].'&chapter='.$value["chapter_number"].'">'.ucfirst($value["chapter_name"]).'</a>
                                            <p class="ml-auto">'.$value["create_at"].'</p>
                                        </li>
                                    ';
                                }
                            ?>
                        </ul>
                    </div>
                </div>
                <div>
                    
                </div>
            </div>

            <div class="cung-the-loai row">
                <div class="title-cung-theloai col-12 p-0">
                    <h2><i class="fa fa-calendar-check-o" aria-hidden="true"></i>  Truyện Hot</h2>
                </div>
                <ul class="grid-6 list-story px-lg-5 px-sm-2 mt-4" id="suggest-story">
                    </ul>
            </div>
        </div>
    </section>
    