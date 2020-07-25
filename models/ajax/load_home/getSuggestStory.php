<?php
	session_start();
	include_once('../../mdStory.php');
	include_once('../../mdChapter.php');		
	$output = '';
	$order = $_POST['order_by'];
	 // $order = 'views_month';
	$listStory = getListStories($connect, $page = 1, $limit = 6, $order);
	foreach ($listStory as  $value) {
		$output .= '<li>
                            <div class="story-item">
                                <a href="story.php?id='.$value["story_code"].'" title ="'.$value["story_name"].'">
                                    <img class="lazy-img" data-src="'.$value["story_avatar"].'" alt="'.$value["story_name"].'">
                                </a>

                                <h3 class="title-story">
                                    <a href="story.php?id='.$value["story_code"].'">
                                        '.$value["story_name"].'
                                    </a>
                                 </h3>

                                 <div class="episode-story"> 
                                     <a href="read_story.php?id='.$value["story_code"].'&chapter='.getLatestChapter($connect, $value["story_code"])["chapter_number"].'">'.ucfirst(getLatestChapter($connect, $value["story_code"])["chapter_name"]).'</a>
                                 </div>
                            </div>
                        </li>';
                        
	}

	echo $output;

	
?>