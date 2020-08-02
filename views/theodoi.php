<?php
    if(!empty($_SESSION['user']['theo_doi'])){
        $list_theodoi = json_decode($_SESSION['user']['theo_doi'], true);
    }
?>
    <section class="main-content">
        <div class="container">
             <div class="list-story">
                <div class="title-list-story">
                    Truyện Đang Theo Dõi        
               </div>
                <ul class="grid-6 list-story" style ="min-height: 750px">
                    <?php 
                        if(!empty($list_theodoi)){
                            foreach ($list_theodoi as $value){
                                $story = getStory_byCode($connect, $value);
                                $lastestchapter = getLatestChapter($connect, $value);
                                if(empty($lastestchapter)){
                                    $lastestchapterNumber = '';
                                    $lastestchapterName = "chưa có chapter nào";
                                }else{
                                    $lastestchapterName = ucfirst($lastestchapter["chapter_name"]);
                                    $lastestchapterNumber = $lastestchapter["chapter_number"];
                                }
                                echo '                             
                                    <li>
                                        <div class="story-item">
                                         <span data-story ="'.$value.'" class="btn-close-theodoi"><i class="fa fa-2x fa-times-circle" aria-hidden="true"></i></span>
                                            <a href="story.php?id='.$value.'" title ="'.$story["story_name"].'">
                                                <img class="lazy-img" data-src="'.$story["story_avatar"].'" alt="'.$story["story_name"].'">
                                            </a>

                                            <h3 class="title-story">
                                                <a href="story.php?id='.$value.'">
                                                    '.$story["story_name"].'
                                                </a>
                                             </h3>
                                                
                                             <div class="episode-story">
                                                 <a href="read_story.php?id='.$value.'&chapter='.$lastestchapterNumber.'">
                                                 '.$lastestchapterName.'
                                                 </a>
                                             </div>
                                        </div>
                                    </li>
                                 ';   
                            }
                        }else{
                            echo '<p class="text-danger mt-4" style ="font-size: 30px; position: absolute;"> Bạn chưa theo dõi truyện nào</p>';
                        }

                    ?>
                       <!--  <li>
                            <div class="story-item">
                                <a href="" title ="Hoạn Phi Hoàn Triều">
                                    <img src="img/story1.jpg" alt="Hoạn Phi Hoàn Triều">
                                </a>

                                <h3 class="title-story">
                                    <a href="">
                                        Hoạn phi hoàn triều
                                    </a>
                                 </h3>

                                 <div class="episode-story">
                                     <a href="">
                                         Chương 59
                                     </a>
                                 </div>
                            </div>
                        </li> -->

                    </ul>
            </div>
        </div>
    </section>
    