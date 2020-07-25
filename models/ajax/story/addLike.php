<?php
	session_start();
	include_once('../../mdUser.php');
	include_once('../../mdStory.php');
	$story_code = $_POST['story_code'];
	if(isset($_SESSION['user'])){
		if(empty($_SESSION['user']['likes'])){
			$listLike = array();
			$listLike[] = $story_code;
		}else{
			$listLike = json_decode($_SESSION['user']['likes'], true);
			if(!in_array($story_code, $listLike)){
				$listLike[] = $story_code;
			}
		}
		$_SESSION['user']['likes'] = json_encode($listLike);
		upLikes($connect, $story_code);
		updateLikes($connect, $_SESSION['user']['user_id'], $_SESSION['user']['likes']);
		$count_likes = getStory_byCode($connect, $story_code)['count_likes'];
		echo $count_likes;
	}else{
		// chưa đăng nhập nên bỏ qua
		echo '0';
	}
?>