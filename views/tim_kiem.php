<!-- HTML phần nội dung --> 
<?php
    $title_timkiem = '';
    $listTimKiem = array();
    if (!empty($_GET['keyword'])){
        $listTimKiem = array();
        $title_timkiem = $_GET['keyword'];
        $keyword = trim($_GET['keyword']);
        $listTimKiem = resultSearchStoryName($connect, $keyword);
    }
    if (!empty($_GET['tacgia'])) {
        $listTimKiem = array();
        $title_timkiem = 'tác giả '. $_GET['tacgia'];
        $keyword = trim($_GET['tacgia']);
        $listTimKiem = resultSearchStoryAuthurName($connect, $keyword);
    }
?>
    <section class="main-content">
        <div class="container">
             <div class="list-story">
                <div class="title-list-story">
                   Kết quả tìm kiếm cho : <span class="text-primary"><?php echo $title_timkiem; ?></span>     
               </div>
                <ul class="grid-6 list-story" style ="min-height: 750px">
                    <?php 
                        if(!empty($listTimKiem)){
                            foreach ($listTimKiem as $key => $value){
                                $lastestchapter = getLatestChapter($connect, $value["story_code"]);
                                if(empty($lastestchapter)){
                                    $lastestchapterNumber = '';
                                    $lastestchapterName = "chưa có chapter nào";
                                }else{
                                    $lastestchapterName = ucfirst($lastestchapter["chapter_name"]);
                                    $lastestchapterNumber = $lastestchapter["chapter_number"];
                                }
                                $story = getStory_byCode($connect, $value["story_code"]);
                                echo '                             
                                    <li>
                                        <div class="story-item">
                                            <a href="story.php?id='.$value["story_code"].'" title ="'.$story["story_name"].'">
                                                <img class="lazy-img" data-src="'.$story["story_avatar"].'" alt="'.$story["story_name"].'">
                                            </a>

                                            <h3 class="title-story">
                                                <a href="story.php?id='.$key.'">
                                                    '.$story["story_name"].'
                                                </a>
                                             </h3>
                                                
                                             <div class="episode-story">
                                                 <a href="read_story.php?id='.$story["story_code"].'&chapter='.$lastestchapterNumber.'">
                                                 '.$lastestchapterName.'
                                                 </a>
                                             </div>
                                        </div>
                                    </li>
                                 ';   
                            }
                        }else{
                            echo '<p class="text-danger mt-4" style ="font-size: 30px; position: absolute;">không tìm thấy kết quả</p>';
                        }

                    ?>
                    </ul>
            </div>

        </div>
    </section>
    