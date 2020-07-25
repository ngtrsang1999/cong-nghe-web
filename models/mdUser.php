<?php
	include_once('connect.php');


	function check_login($connect,$user_id, $user_password){
		$query = "SELECT * FROM user where ( user_id='$user_id' AND user_password = '$user_password' )";
	    $result = mysqli_query($connect, $query);
	    $rowCount = mysqli_num_rows($result);
	    if($rowCount == 1){
	    	foreach ($result as $value) {
	    		$_SESSION["user"] = $value;
	    		break;
	    	}
	    	return true;
	    }else{
	    	return false;
	    }
	}

	function updateLichSu($connect, $user_id, $lich_su){
		if ($connect->connect_errno) {
		    echo "Failed to connect to MySQL: (" . $connect->connect_errno . ") " . $connect->connect_error;
		}
		if (!($stmt = $connect->prepare("UPDATE  user SET lich_su = ? where ( user_id= ? )"))){
		     echo "Prepare failed: (" . $connect->errno . ") " . $connect->error;
		}

		/* Prepared statement, stage 2: bind and execute */
		if (!$stmt->bind_param("ss", $lich_su, $user_id)){
		    echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
		}

		if (!$stmt->execute()) {
		    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
		}
	}
	function updateTheoDoi($connect, $user_id, $theo_doi){
		if ($connect->connect_errno) {
		    echo "Failed to connect to MySQL: (" . $connect->connect_errno . ") " . $connect->connect_error;
		}
		if (!($stmt = $connect->prepare("UPDATE  user SET theo_doi = ? where ( user_id= ? )"))){
		     echo "Prepare failed: (" . $connect->errno . ") " . $connect->error;
		}

		/* Prepared statement, stage 2: bind and execute */
		if (!$stmt->bind_param("ss", $theo_doi, $user_id)){
		    echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
		}

		if (!$stmt->execute()) {
		    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
		}
	}

	function updateLikes($connect, $user_id, $likes){
		if ($connect->connect_errno) {
		    echo "Failed to connect to MySQL: (" . $connect->connect_errno . ") " . $connect->connect_error;
		}
		if (!($stmt = $connect->prepare("UPDATE  user SET likes = ? where ( user_id= ? )"))){
		     echo "Prepare failed: (" . $connect->errno . ") " . $connect->error;
		}

		/* Prepared statement, stage 2: bind and execute */
		if (!$stmt->bind_param("ss", $likes, $user_id)){
		    echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
		}

		if (!$stmt->execute()) {
		    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
		}
	}


	function change_password($connect,$user_id, $new_pw){
		$query = "UPDATE  user SET user_password = '$new_pw'  where ( user_id='$user_id')";
	    $result = mysqli_query($connect, $query);
	    return $result;
	}

	function isset_user($connect,$user_id){
		$query = "SELECT * FROM user where ( user_id='$user_id')";
	    $result = mysqli_query($connect, $query);
	    $rowCount = mysqli_num_rows($result);
	    if($rowCount >= 1){
	    	return true;
	    }else{
	    	return false;
	    }
	}

	function register_user($connect,$user_id, $user_password){
		$query = "INSERT INTO user (user_id, user_password) VALUES('$user_id', '$user_password')";
	    $result = mysqli_query($connect, $query);
	    return $result;
	}
?>