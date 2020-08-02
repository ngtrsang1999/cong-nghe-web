<?php 
	$dbHost = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $database = "truyen_sh";

    $connect = mysqli_connect($dbHost, $dbUsername, $dbPassword, $database) or die("Cannot connect to database");

    function GroupHasAct($connect, $group_code, $act_code){
		if ($connect->connect_errno) {
		    echo "Failed to connect to MySQL: (" . $connect->connect_errno . ") " . $connect->connect_error;
		}
		if (!($stmt = $connect->prepare("SELECT * FROM group_act WHERE group_code = ? AND act_code  = ?"))){
		     echo "Prepare failed: (" . $connect->errno . ") " . $connect->error;
		}

		/* Prepared statement, stage 2: bind and execute */
		if (!$stmt->bind_param("ss", $group_code, $act_code)){
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
			return true;
		}else{
			return false;
		}
	
	}

	function getListGroupAtc($connect){
		if ($connect->connect_errno) {
		    echo "Failed to connect to MySQL: (" . $connect->connect_errno . ") " . $connect->connect_error;
		}
		if (!($stmt = $connect->prepare("SELECT * FROM group_act"))){
		     echo "Prepare failed: (" . $connect->errno . ") " . $connect->error;
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

	function getActName($connect, $act_code){
		if ($connect->connect_errno) {
		    echo "Failed to connect to MySQL: (" . $connect->connect_errno . ") " . $connect->connect_error;
		}
		if (!($stmt = $connect->prepare("SELECT * FROM act where act_code = ?"))){
		     echo "Prepare failed: (" . $connect->errno . ") " . $connect->error;
		}

		if (!$stmt->bind_param("s", $act_code)){
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
			return $res[0]["act_name"];
		}else{
			return '';
		}
	
	}

	function getGroupName($connect, $group_code){
		if ($connect->connect_errno) {
		    echo "Failed to connect to MySQL: (" . $connect->connect_errno . ") " . $connect->connect_error;
		}
		if (!($stmt = $connect->prepare("SELECT * FROM group_user where group_code = ?"))){
		     echo "Prepare failed: (" . $connect->errno . ") " . $connect->error;
		}

		if (!$stmt->bind_param("s", $group_code)){
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
			return $res[0]["group_name"];
		}else{
			return '';
		}
	
	}

?>