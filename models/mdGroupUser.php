<?php
include_once('connect.php');
function getNameGroup($connect ,$group_code){
		if ($connect->connect_errno) {
		    echo "Failed to connect to MySQL: (" . $connect->connect_errno . ") " . $connect->connect_error;
		}
		if (!($stmt = $connect->prepare("SELECT * FROM group_user 
			 WHERE (group_code = ?)"))){
		     echo "Prepare failed: (" . $connect->errno . ") " . $connect->error;
		}
		/* Prepared statement, stage 2: bind and execute */
		if (!$stmt->bind_param("s",  $group_code)){
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
			return Null;
		}
	}

?>