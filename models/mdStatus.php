<?php
	$dbHost = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $database = "truyen_sh";

    $connect = mysqli_connect($dbHost, $dbUsername, $dbPassword, $database) or die("Cannot connect to database");

	function getListStatus($connect){
		$query = "SELECT * FROM status ";
	    $result = mysqli_query($connect, $query);

	    return $result;
	}
?>