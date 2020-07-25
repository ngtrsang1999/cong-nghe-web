<?php
	session_start();
	// include_once('../connect.php');

	include_once('../mdUser.php');	
	$user_id = $_POST['user_id'];
	$user_password = $_POST['user_password'];
	if(check_login($connect, $user_id, $user_password)){
		echo "1";
	}else{
		echo "0";
	}
?>