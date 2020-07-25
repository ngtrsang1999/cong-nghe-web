<?php
	session_start();
	include_once('../../mdUser.php');
	include_once('../../mdStory.php');
	$story_code = $_POST['story_code'];
	$listLike = json_decode($_SESSION['user']['likes'], true);
	if(in_array($story_code, $listLike)){
		$key = array_search($story_code,$listLike);
		unset($listLike[$key]);
	}
	$_SESSION['user']['likes'] = json_encode($listLike);
	downLikes($connect, $story_code);
	updateLikes($connect, $_SESSION['user']['user_id'], $_SESSION['user']['likes']);
	$count_likes = getStory_byCode($connect, $story_code)['count_likes'];
	echo $count_likes;
?>