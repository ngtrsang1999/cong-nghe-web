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
	function login($connect,$user_id, $user_password){
		$query = "SELECT * FROM user where ( user_id='$user_id' AND user_password = '$user_password')";
	    $result = mysqli_query($connect, $query);
	    $rowCount = mysqli_num_rows($result);
	    if($rowCount == 1){
	    	foreach ($result as $value){
	    		if($value["user_status"] != 'lock'){
	    			$_SESSION["user"] = $value;
	    			$res = '1';
	    		}else{
	    			$res = 'Tài khoản này đã bị khóa';
	    		}
	    		break;
	    	}
	    }else{
	    	$res = 'Tên đăng nhập hoặc mật khẩu không đúng !';
	    }
	    return $res;
	}

	function getUserByID($connect, $user_id){
		if ($connect->connect_errno) {
		    echo "Failed to connect to MySQL: (" . $connect->connect_errno . ") " . $connect->connect_error;
		}
		if (!($stmt = $connect->prepare("SELECT * FROM user WHERE (user_id = ?)"))){
		     echo "Prepare failed: (" . $connect->errno . ") " . $connect->error;
		}
		/* Prepared statement, stage 2: bind and execute */
		if (!$stmt->bind_param("s",  $user_id)){
		    echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
		}

		if (!$stmt->execute()) {
		    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
		}
		if (!($res = $stmt->get_result())) {
		    echo "Getting result set failed: (" . $stmt->errno . ") " . $stmt->error;
		}
		// $res = $res->fetch_all(MYSQLI_ASSOC);
		if($res->num_rows > 0){
			$res = $res->fetch_all(MYSQLI_ASSOC);
			return $res[0];
		}else{
			return NULL;
		}
	}

	function getListUserSearchQuanLy($connect ,$user_id, $user_group){
		$user_id = "%".trim($user_id)."%";
		$sql = "SELECT * FROM user 
			 WHERE (user_id LIKE ?) ";
		if($user_group != 'all' && !empty($user_group)){
			$sql .= " AND (user_group = '$user_group')";
		}
		if ($connect->connect_errno) {
		    echo "Failed to connect to MySQL: (" . $connect->connect_errno . ") " . $connect->connect_error;
		}
		if (!($stmt = $connect->prepare($sql))){
		     echo "Prepare failed: (" . $connect->errno . ") " . $connect->error;
		}
		/* Prepared statement, stage 2: bind and execute */
		if (!$stmt->bind_param("s",  $user_id)){
		    echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
		}

		if (!$stmt->execute()) {
		    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
		}
		if (!($res = $stmt->get_result())) {
		    echo "Getting result set failed: (" . $stmt->errno . ") " . $stmt->error;
		}
		// $res = $res->fetch_all(MYSQLI_ASSOC);
		if($res->num_rows > 0){
			$res = $res->fetch_all(MYSQLI_ASSOC);
			return $res;
		}else{
			return array();
		}
	}

	function updateThongTin($connect, $user_id, $data){
		if ($connect->connect_errno) {
		    echo "Failed to connect to MySQL: (" . $connect->connect_errno . ") " . $connect->connect_error;
		}
		if (!($stmt = $connect->prepare("UPDATE user SET user_name= ?, user_email= ?, user_birthday= ?, user_address=?,user_numberphone= ?, gioi_tinh= ? where ( user_id= ? )"))){
		     echo "Prepare failed: (" . $connect->errno . ") " . $connect->error;
		}

		/* Prepared statement, stage 2: bind and execute */
		if (!$stmt->bind_param("sssssss", $data["user_name"], $data["user_email"], $data["user_birthday"], $data["user_address"], $data["user_numberphone"], $data["gioi_tinh"], $user_id)){
		    echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
		}

		if (!$stmt->execute()) {
		    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
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

	function updateUserGroup($connect, $user_id, $new_group){
		if ($connect->connect_errno) {
		    echo "Failed to connect to MySQL: (" . $connect->connect_errno . ") " . $connect->connect_error;
		}
		if (!($stmt = $connect->prepare("UPDATE  user SET user_group = ? where ( user_id= ? )"))){
		     echo "Prepare failed: (" . $connect->errno . ") " . $connect->error;
		}

		/* Prepared statement, stage 2: bind and execute */
		if (!$stmt->bind_param("ss", $new_group, $user_id)){
		    echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
		}

		if (!$stmt->execute()) {
		    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
		}
	}

	function lockUser($connect, $user_id){
		if ($connect->connect_errno) {
		    echo "Failed to connect to MySQL: (" . $connect->connect_errno . ") " . $connect->connect_error;
		}
		if (!($stmt = $connect->prepare("UPDATE  user SET user_status = 'lock' where ( user_id= ? )"))){
		     echo "Prepare failed: (" . $connect->errno . ") " . $connect->error;
		}

		/* Prepared statement, stage 2: bind and execute */
		if (!$stmt->bind_param("s", $user_id)){
		    echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
		}

		if (!$stmt->execute()) {
		    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
		}
	}

	function unLockUser($connect, $user_id){
		if ($connect->connect_errno) {
		    echo "Failed to connect to MySQL: (" . $connect->connect_errno . ") " . $connect->connect_error;
		}
		if (!($stmt = $connect->prepare("UPDATE  user SET user_status = 'open' where ( user_id= ? )"))){
		     echo "Prepare failed: (" . $connect->errno . ") " . $connect->error;
		}

		/* Prepared statement, stage 2: bind and execute */
		if (!$stmt->bind_param("s", $user_id)){
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

	function register_user($connect,$user_id, $user_password, $user_group='user'){
		$query = "INSERT INTO user (user_id, user_password, user_group) VALUES('$user_id', '$user_password', '$user_group')";
	    $result = mysqli_query($connect, $query);
	    return $result;
	}
?>