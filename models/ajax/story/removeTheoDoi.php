<?php
	session_start();
	include_once('../../mdUser.php');
	include_once('../../mdStory.php');
	$story_code = $_POST['story_code'];
	$listTheoDoi = json_decode($_SESSION['user']['theo_doi'], true);
	if(in_array($story_code, $listTheoDoi)){
		$key = array_search($story_code,$listTheoDoi);
		unset($listTheoDoi[$key]);
	}
	
	$_SESSION['user']['theo_doi'] = json_encode($listTheoDoi);
	downFollowes($connect, $story_code);
	updateTheoDoi($connect, $_SESSION['user']['user_id'], $_SESSION['user']['theo_doi']);
	$count_followes = getStory_byCode($connect, $story_code)['count_followes'];
	echo $count_followes;
?>