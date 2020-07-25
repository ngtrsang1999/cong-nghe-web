<?php
	session_start();
	// include_once('../connect.php');

	include_once('../mdUser.php');	
	$user_id = $_POST['user_id'];
	if(isset_user($connect,$user_id)){
		echo "1";
	}else{
		echo "0";
	}
?>