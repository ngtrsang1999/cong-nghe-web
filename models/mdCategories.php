<?php
	$dbHost = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $database = "truyen_sh";

    $connect = mysqli_connect($dbHost, $dbUsername, $dbPassword, $database) or die("Cannot connect to database");

	function getListCategories($connect){
		$query = "SELECT * FROM categories ";
	    $result = mysqli_query($connect, $query);

	    return $result;
	}

	function getNameCategory($connect, $category_code){
		$category_name = '';
		$query = "SELECT * FROM categories WHERE (category_code = '$category_code')";
	    $result = mysqli_query($connect, $query);
	    $rowCount = mysqli_num_rows($result);
	    if($rowCount == 1){
	    	foreach ($result as $value) {
	    		$category_name =  $value["category_name"];
	    	}
	    }
	    	return $category_name;
	}
?>