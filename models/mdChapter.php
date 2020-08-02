<?php
	$dbHost = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $database = "truyen_sh";

    $connect = mysqli_connect($dbHost, $dbUsername, $dbPassword, $database) or die("Cannot connect to database");

    function getLatestChapter($connect, $story_code){
		if ($connect->connect_errno) {
		    echo "Failed to connect to MySQL: (" . $connect->connect_errno . ") " . $connect->connect_error;
		}
		if (!($stmt = $connect->prepare("SELECT * FROM chapteres WHERE story_code = ? ORDER BY chapter_number DESC LIMIT 1"))){
		     echo "Prepare failed: (" . $connect->errno . ") " . $connect->error;
		}

		/* Prepared statement, stage 2: bind and execute */
		if (!$stmt->bind_param("s", $story_code)){
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

	function getNameChapter($connect, $story_code, $chapter_number){
		if ($connect->connect_errno) {
		    echo "Failed to connect to MySQL: (" . $connect->connect_errno . ") " . $connect->connect_error;
		}
		if (!($stmt = $connect->prepare("SELECT * FROM chapteres WHERE story_code = ? AND chapter_number = ? LIMIT 1"))){
		     echo "Prepare failed: (" . $connect->errno . ") " . $connect->error;
		}

		/* Prepared statement, stage 2: bind and execute */
		if (!$stmt->bind_param("sd", $story_code, $chapter_number)){
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
			return $res[0]["chapter_name"];
		}else{
			return '';
		}
	}


	function getDataChapter($connect, $story_code, $chapter_number){
		if ($connect->connect_errno) {
		    echo "Failed to connect to MySQL: (" . $connect->connect_errno . ") " . $connect->connect_error;
		}
		if (!($stmt = $connect->prepare("SELECT * FROM chapteres WHERE (story_code = ?) AND (chapter_number >= ?) ORDER BY chapter_number ASC LIMIT 1"))){
		     echo "Prepare failed: (" . $connect->errno . ") " . $connect->error;
		}

		/* Prepared statement, stage 2: bind and execute */
		if (!$stmt->bind_param("sd", $story_code, $chapter_number)){
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
			return $res[0]['chapter_content'];
		}else{
			return '';
		}
	}

	function getInfoChapter($connect, $story_code, $chapter_number){
		if ($connect->connect_errno) {
		    echo "Failed to connect to MySQL: (" . $connect->connect_errno . ") " . $connect->connect_error;
		}
		if (!($stmt = $connect->prepare("SELECT * FROM chapteres WHERE (story_code = ?) AND (chapter_number >= ?) ORDER BY chapter_number ASC LIMIT 1"))){
		     echo "Prepare failed: (" . $connect->errno . ") " . $connect->error;
		}

		/* Prepared statement, stage 2: bind and execute */
		if (!$stmt->bind_param("sd", $story_code, $chapter_number)){
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
			return array();
		}
	}

	function getPhanTrang($connect, $story_code, $chapter_number){
		$res = array();

		if ($connect->connect_errno) {
		    echo "Failed to connect to MySQL: (" . $connect->connect_errno . ") " . $connect->connect_error;
		}
		if (!($stmt = $connect->prepare("SELECT * FROM chapteres WHERE (story_code = ?) AND (chapter_number >= ?) ORDER BY chapter_number ASC LIMIT 1"))){
		     echo "Prepare failed: (" . $connect->errno . ") " . $connect->error;
		}

		/* Prepared statement, stage 2: bind and execute */
		if (!$stmt->bind_param("sd", $story_code, $chapter_number)){
		    echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
		}

		if (!$stmt->execute()) {
		    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
		}
		if (!($thisct = $stmt->get_result())) {
		    echo "Getting result set failed: (" . $stmt->errno . ") " . $stmt->error;
		}
		// $res = $res->fetch_all(MYSQLI_ASSOC);
		if($thisct->num_rows > 0){
			$thisct = $thisct->fetch_all(MYSQLI_ASSOC);
			$res['name_chapter'] = $thisct[0]["chapter_name"];
		}

		//get chapter next
		if (!($stmt = $connect->prepare("SELECT * FROM chapteres WHERE (story_code = ?) AND (chapter_number > ?) ORDER BY chapter_number ASC LIMIT 1"))){
		     echo "Prepare failed: (" . $connect->errno . ") " . $connect->error;
		}

		/* Prepared statement, stage 2: bind and execute */
		if (!$stmt->bind_param("sd", $story_code, $thisct[0]["chapter_number"])){
		    echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
		}

		if (!$stmt->execute()) {
		    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
		}
		if (!($rightct = $stmt->get_result())) {
		    echo "Getting result set failed: (" . $stmt->errno . ") " . $stmt->error;
		}
		// $res = $res->fetch_all(MYSQLI_ASSOC);
		if($rightct->num_rows > 0){
			$rightct = $rightct->fetch_all(MYSQLI_ASSOC);
			$res['right_chapter'] = $rightct[0]['chapter_number'];
		}else{
			$res['right_chapter'] = $thisct[0]['chapter_number'];
		}

		//get left chapter

		if (!($stmt = $connect->prepare("SELECT * FROM chapteres WHERE (story_code = ?) AND (chapter_number < ?) ORDER BY chapter_number DESC LIMIT 1"))){
		     echo "Prepare failed: (" . $connect->errno . ") " . $connect->error;
		}

		/* Prepared statement, stage 2: bind and execute */
		if (!$stmt->bind_param("sd", $story_code, $thisct[0]["chapter_number"])){
		    echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
		}

		if (!$stmt->execute()) {
		    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
		}
		if (!($leftct = $stmt->get_result())) {
		    echo "Getting result set failed: (" . $stmt->errno . ") " . $stmt->error;
		}
		// $res = $res->fetch_all(MYSQLI_ASSOC);
		if($leftct->num_rows > 0){
			$leftct = $leftct->fetch_all(MYSQLI_ASSOC);
			$res['left_chapter'] = $leftct[0]['chapter_number'];
		}else{
			$res['left_chapter'] = $thisct[0]['chapter_number'];
		}

		return $res;
	}

	function getListChater_byStorycode($connect, $story_code){
		if ($connect->connect_errno) {
		    echo "Failed to connect to MySQL: (" . $connect->connect_errno . ") " . $connect->connect_error;
		}
		if (!($stmt = $connect->prepare("SELECT * FROM chapteres WHERE story_code = ? ORDER BY chapter_number DESC"))){
		     echo "Prepare failed: (" . $connect->errno . ") " . $connect->error;
		}

		/* Prepared statement, stage 2: bind and execute */
		if (!$stmt->bind_param("s", $story_code)){
		    echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
		}

		if (!$stmt->execute()) {
		    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
		}
		if (!($res = $stmt->get_result())) {
		    echo "Getting result set failed: (" . $stmt->errno . ") " . $stmt->error;
		}
		// $res = $res->fetch_all(MYSQLI_ASSOC);
		return $res = $res->fetch_all(MYSQLI_ASSOC);
	}

	function addChapter($connect, $data){
		if ($connect->connect_errno) {
		    echo "Failed to connect to MySQL: (" . $connect->connect_errno . ") " . $connect->connect_error;
		}
		if (!($stmt = $connect->prepare("
			INSERT INTO chapteres 
			(chapter_name, chapter_number, story_code, create_at, chapter_content)
			VALUES(?,?,?,?,?)
			"))){
		     echo "Prepare failed: (" . $connect->errno . ") " . $connect->error;
		}

		/* Prepared statement, stage 2: bind and execute */
		if (!$stmt->bind_param("sdsss", $data["chapter_name"], $data["chapter_number"], $data["story_code"], $data["create_at"], $data["chapter_content"])){
		    echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
		}

		return $stmt->execute();
	}

?>