<?php 
	session_start();
    include_once('../../mdStory.php');	
    include_once('../../mdChapter.php');
	$data_request = $_POST['data_request'];
    $data_request = json_decode($data_request);
    $page_max = getPageMax($connect ,$limit = 24, $data_request);
    echo $page_max;
?>
