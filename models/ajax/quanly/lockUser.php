<?php 
	session_start();
    include_once('../../mdUser.php');
    $userID = $_POST['userID'];
    lockUser($connect, $userID);

?>