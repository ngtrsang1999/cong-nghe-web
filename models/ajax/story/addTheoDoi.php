<?php
	session_start();
	include_once('../../mdUser.php');
	include_once('../../mdStory.php');
	$story_code = $_POST['story_code'];
	if(isset($_SESSION['user'])){
		if(empty($_SESSION['user']['theo_doi'])){
			$listTheoDoi = array();
			$listTheoDoi[] = $story_code;
		}else{
			$listTheoDoi = json_decode($_SESSION['user']['theo_doi'], true);
			if(!in_array($story_code, $listTheoDoi)){
				array_unshift($listTheoDoi, $story_code);
				// $listTheoDoi[] = $story_code;
			}	
		}
		$_SESSION['user']['theo_doi'] = json_encode($listTheoDoi);
		upFollowes($connect, $story_code);
		updateTheoDoi($connect, $_SESSION['user']['user_id'], $_SESSION['user']['theo_doi']);
		$count_followes = getStory_byCode($connect, $story_code)['count_followes'];
		echo $count_followes;
	}else{
		// chưa đăng nhập nên bỏ qua
		echo '0';
	}
?>