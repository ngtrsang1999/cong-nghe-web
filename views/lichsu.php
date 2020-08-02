<!-- HTML phần nội dung --> 
<?php
    if(!empty($_SESSION['user']['lich_su'])){
        $list_lichsu = json_decode($_SESSION['user']['lich_su'], true);
    }
?>
    <section class="main-content">
        <div class="container">
             <div class="list-story">
                <div class="title-list-story">
                    Lịch Sử Đọc Truyện            
               </div>
                <ul class="grid-6 list-story" style ="min-height: 750px">
                    <?php 
                        if(!empty($list_lichsu)){
                            foreach ($list_lichsu as $key => $value){
                                $story = getStory_byCode($connect, $key);
                                if(empty($story)){
                                    continue;
                                }
                                // $lastestchapter = getLatestChapter($connect, $key);
                                // if(empty($lastestchapter)){
                                //     $lastestchapterNumber = '';
                                //     $lastestchapterName = "chưa có chapter nào";
                                // }else{
                                //     $lastestchapterName = ucfirst($lastestchapter["chapter_name"]);
                                //     $lastestchapterNumber = $lastestchapter["chapter_number"];
                                // }
                                echo '                             
                                    <li>
                                        <div class="story-item">
                                            <a href="story.php?id='.$key.'" title ="'.$story["story_name"].'">
                                                <img class="lazy-img" data-src="'.$story["story_avatar"].'" alt="'.$story["story_name"].'">
                                            </a>

                                            <h3 class="title-story">
                                                <a href="story.php?id='.$key.'">
                                                    '.$story["story_name"].'
                                                </a>
                                             </h3>
                                                
                                             <div class="episode-story">
                                                 <a href="read_story.php?id='.$key.'&chapter='.$value.'">
                                                     Đọc tiếp '.ucfirst(getNameChapter($connect, $key, $value)).'
                                                 </a>
                                             </div>
                                        </div>
                                    </li>
                                 ';   
                            }
                        }else{
                            echo '<p class="text-danger mt-4" style ="font-size: 30px; position: absolute;">không có truyện nào đang đọc</p>';
                        }

                    ?>
                    </ul>
            </div>

        </div>
    </section>
    