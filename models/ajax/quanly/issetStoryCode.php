<?php 
	session_start();
    include_once('../../mdStory.php');
    $story_code = $_POST['story_code'];
    if(isset_Story($connect, $story_code)){
    	echo '1';
    }else{
    	echo '0';
    }

?>