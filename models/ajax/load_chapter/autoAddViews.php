<?php
	session_start();
	include_once('../../mdStory.php');
	$data = $_POST['data'];
	$data .= '&';
	$pattern = '#id=(.*)&.*chapter=(.*)&#imsU';
	preg_match($pattern, $data, $matches);
	if(!empty($matches)){
		$story_code = $matches[1];
		$chapter_number = $matches[2];
		$key = $story_code.'>'.$chapter_number;
	}
	if(!isset($_SESSION[$key])){
		$_SESSION[$key] = 'Đã xem';
		upViews($connect, $story_code);
	}
?>