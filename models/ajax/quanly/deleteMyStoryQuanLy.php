<?php 
	session_start();
    include_once('../../mdStory.php');
    $story_code = $_POST['story_code'];
    $rs = deleteStoryByID($connect, $story_code);
    // $rs = true;
    if($rs){
    	echo "1";
    }else{
    	echo "Xoá thất bại";
    }
?>