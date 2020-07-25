<?php 
	session_start();
    include_once('../../mdStory.php');	
    include_once('../../mdChapter.php');
    $data_request = $_POST['data_request'];
	$page = $_POST['page'];
    $data_request = json_decode($data_request);
    $ret = getListStoriesForPageList($connect ,$limit = 24, $data_request, $page);
    $output = '';

    foreach ($ret as $value) {
        $output .= '
                    <li>
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
                                 <a href="read_story.php?id='.$value["story_code"].'&chapter='.getLatestChapter($connect, $value["story_code"])["chapter_number"].'">
                                     '.ucfirst(getLatestChapter($connect, $value["story_code"])["chapter_name"]).'
                                 </a>
                             </div>
                        </div>
                    </li>
                         ';
    }

    if($output == ''){
        echo '<p class="text-danger text-center mt-4" style ="font-size: 30px; position: absolute;">Không tìm thấy truyện phù hợp</p>';
    }else{
        echo $output;
    }
?>
