<?php 
	session_start();
    include_once('../../mdUser.php');
    $userID = $_POST['userID'];
    unLockUser($connect, $userID);

?>