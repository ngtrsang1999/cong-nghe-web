<?php
	session_start();
	// include_once('../connect.php');

	include_once('../mdUser.php');	
	$user_id = $_SESSION["user"]["user_id"];
	$user_password = $_POST['user_password'];
	$new_password = $_POST['new_password'];
	if($_SESSION["user"]["user_password"] != $user_password){
		echo 'Mật khẩu không đúng';
	}else{
		change_password($connect,$user_id, $new_password);
		$_SESSION["user"]["user_password"] = $new_password;
		echo '1';
	}
?>