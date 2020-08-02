<?php
	session_start();
	include_once('../../mdStory.php');
	include_once('../../mdChapter.php');		
	$output = '';
	$order = $_POST['order_by'];
	 // $order = 'views_month';
	if($order != 'views_month'){
		$listStory = getListStories($connect, $page = 1, $limit = 18, $order);
		foreach ($listStory as  $value) {
            $lastestchapter = getLatestChapter($connect, $value["story_code"]);
            if(empty($lastestchapter)){
                $lastestchapterNumber = '';
                $lastestchapterName = "chưa có chapter nào";
            }else{
                $lastestchapterName = ucfirst($lastestchapter["chapter_name"]);
                $lastestchapterNumber = $lastestchapter["chapter_number"];
            }
			$output .= '<li>
	                            <div class="story-item">
	                                <a href="story.php?id='.$value["story_code"].'" title ="'.$value["story_name"].'">
	                                    <img class="lazy-img" data-src="'.$value["story_avatar"].'"  alt="'.$value["story_name"].'">
	                                </a>

	                                <h3 class="title-story">
	                                    <a href="story.php?id='.$value["story_code"].'">
	                                        '.$value["story_name"].'
	                                    </a>
	                                 </h3>

	                                 <div class="episode-story"> 
	                                     <a href="read_story.php?id='.$value["story_code"].'&chapter='.$lastestchapterNumber.'">'.$lastestchapterName.'</a>
	                                 </div>
	                            </div>
	                        </li>';
		}

	echo $output;

	}else{
		$listStory = getListStories($connect, $page = 1, $limit = 5, $order);
		$resultArray = $listStory->fetch_all(MYSQLI_ASSOC);
		$output = '
			<div class="trend-left col-3">
                    <div class="trend-item">
                        <a href="read_story.php?id='.$resultArray[1]["story_code"].'&chapter='.getLatestChapter($connect, $resultArray[1]["story_code"])["chapter_number"].'">
                            <img src="'.$resultArray[1]["story_avatar"].'" alt="'.$resultArray[1]["story_name"].'">
                            <div class="chapter-number green">'.getLatestChapter($connect, $resultArray[1]["story_code"])["chapter_name"].'</div>
                            <div class="bottom-shadow"></div>
                            <div class="captions">
                                <h3>'.$resultArray[1]["story_name"].'</h3>
                            </div>
                        </a>
                    </div>
                    <div class="trend-item">
                        <a href="read_story.php?id='.$resultArray[2]["story_code"].'&chapter='.getLatestChapter($connect, $resultArray[2]["story_code"])["chapter_number"].'">
                            <img src="'.$resultArray[2]["story_avatar"].'" alt="'.$resultArray[2]["story_name"].'">
                            <div class="chapter-number red">'.getLatestChapter($connect, $resultArray[2]["story_code"])["chapter_name"].'</div>
                            <div class="bottom-shadow"></div>
                            <div class="captions">
                                <h3>'.$resultArray[2]["story_name"].'</h3>
                            </div>
                        </a>
                        
                        
                    </div>
                </div>

                <div class="trend-center col-6">
                    <div class="trend-center-item">
                        <a href="read_story.php?id='.$resultArray[0]["story_code"].'&chapter='.getLatestChapter($connect, $resultArray[0]["story_code"])["chapter_number"].'">
                            <img src="'.$resultArray[0]["story_avatar"].'" alt="'.$resultArray[0]["story_name"].'">
                            <div class="chapter-number blue">'.getLatestChapter($connect, $resultArray[0]["story_code"])["chapter_name"].'</div>
                            <div class="bottom-shadow"></div>
                            <div class="captions">
                                <h3>'.$resultArray[0]["story_name"].'</h3>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="trend-right col-3">
                    <div class="trend-item">
                        <a href="read_story.php?id='.$resultArray[3]["story_code"].'&chapter='.getLatestChapter($connect, $resultArray[3]["story_code"])["chapter_number"].'">
                            <img src="'.$resultArray[3]["story_avatar"].'" alt="'.$resultArray[3]["story_name"].'">
                            <div class="chapter-number violet">'.getLatestChapter($connect, $resultArray[3]["story_code"])["chapter_name"].'</div>
                            <div class="bottom-shadow"></div>
                            <div class="captions">
                                <h3>'.$resultArray[3]["story_name"].'</h3>
                            </div>
                        </a>
                    </div>
                    <div class="trend-item">
                        <a href="read_story.php?id='.$resultArray[4]["story_code"].'&chapter='.getLatestChapter($connect, $resultArray[4]["story_code"])["chapter_number"].'">
                            <img src="'.$resultArray[4]["story_avatar"].'" alt="'.$resultArray[4]["story_name"].'">
                            <div class="chapter-number violet">'.getLatestChapter($connect, $resultArray[4]["story_code"])["chapter_name"].'</div>
                            <div class="bottom-shadow"></div>
                            <div class="captions">
                                <h3>'.$resultArray[4]["story_name"].'</h3>
                            </div>
                        </a>
                    </div>
                </div>
		 ';

		echo $output;
	}
?>