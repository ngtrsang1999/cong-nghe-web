<?php
	session_start();
    include_once('../../mdStory.php');	
    include_once('../../mdChapter.php');
    $output = '';
	$data_rq_chapter = $_POST['data_rq_chapter'];
    $data_rq_chapter = json_decode($data_rq_chapter);
    $ret = getPhanTrang($connect, $data_rq_chapter->id, $data_rq_chapter->chapter);
    if (!empty($ret)) {
        $output .= '
            <li class="page-item"><a class="page-link" href="read_story.php?id='.$data_rq_chapter->id.'&chapter='.$ret["left_chapter"].'"><i class="fa fa-arrow-left" aria-hidden="true"></i></a></li>
                <p class=" chapter-now mx-3 text-center">'.ucfirst($ret["name_chapter"]).'</p>
                <li class="page-item"><a class="page-link" href="read_story.php?id='.$data_rq_chapter->id.'&chapter='.$ret["right_chapter"].'"><i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>
         ';
    }
    echo $output;
?>
