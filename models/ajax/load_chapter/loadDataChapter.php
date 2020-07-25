<?php
	session_start();
    include_once('../../mdStory.php');	
    include_once('../../mdChapter.php');
    $output = '';
	$data_rq_chapter = $_POST['data_rq_chapter'];
    $data_rq_chapter = json_decode($data_rq_chapter);
    $ret = getDataChapter($connect, $data_rq_chapter->id, $data_rq_chapter->chapter);
    if (!empty($ret)) {
        $list_img = json_decode($ret);
        foreach ($list_img as $value) {
            $output .='
                <li>
                        <img class="lazy-img" data-src="'.$value.'" alt="'.getStory_byCode($connect, $data_rq_chapter->id)["story_name"].'">
                   </li> 
             ';
        }
    }
    if($output ==''){
        $output =false;
    }
    echo $output;
?>
