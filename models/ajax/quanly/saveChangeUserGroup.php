<?php
	session_start();
    include_once('../../mdUser.php');	
    include_once('../../mdGroupUser.php');
    $new_group = $_POST['new_group'];
    $userID = $_POST['userID'];
    updateUserGroup($connect, $userID, $new_group);
    $groupName =  getNameGroup($connect ,$new_group);
    echo $groupName;

?>