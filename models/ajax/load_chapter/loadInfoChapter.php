<?php
	session_start();
    include_once('../../mdStory.php');	
    include_once('../../mdChapter.php');
    $output = '';
	$data_rq_chapter = $_POST['data_rq_chapter'];
    $data_rq_chapter = json_decode($data_rq_chapter);
    $ret = getInfoChapter($connect, $data_rq_chapter->id, $data_rq_chapter->chapter);
    if (!empty($ret)){
        $output .='
            <div class="path-top col-12 p-0">
                    <ul class="p-0">
                        <li><a href="home.php">Trang Chủ</a></li>
                        <li>    <i class="fa fa-angle-right" aria-hidden="true"></i>    <a href="story.php?id='.$ret["story_code"].'">'.getStory_byCode($connect, $data_rq_chapter->id)["story_name"].'</a></li>
                        <li>    <i class="fa fa-angle-right" aria-hidden="true"></i>    <a href="read_story.php?id='.$ret["story_code"].'&chapter='.$ret["chapter_number"].'" id = "linkOfChapter">'.ucfirst($ret["chapter_name"]).'</a></li>
                    </ul>
                </div>
                <div class="col-12 p-0 path-bottom d-md-flex">
                    <h1><a href="story.php?id='.$ret["story_code"].'">'.getStory_byCode($connect, $data_rq_chapter->id)["story_name"].'</a> '.ucfirst($ret["chapter_name"]).'</h1>
                    <div class="ml-md-2">
                      <time >(Cập nhật lúc: '.$ret["create_at"].')</time>
                    </div>
                </div>
         ';
    }
    echo $output;
?>
