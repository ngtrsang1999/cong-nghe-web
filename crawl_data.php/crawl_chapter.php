<?php	
	include_once('../models/mdStory.php'); 
	include ('simple_html_dom.php');

	date_default_timezone_set('Asia/Ho_Chi_Minh');

	// hàm lấy id của truyện chưa lấy story_category
	function getIdToCrawlChapter($connect){
		if ($connect->connect_errno) {
		    echo "Failed to connect to MySQL: (" . $connect->connect_errno . ") " . $connect->connect_error;
		}
		if (!($stmt = $connect->prepare("SELECT * FROM stories WHERE story_categories = '1' LIMIT 1"))){
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
			return $res[0]["story_code"];
		}else{
			return NULL;
		}
	}

	// Kiểm tra xem thể loại id $category_code đã tồn tại chưa
	function isset_Chapter($connect, $story_code, $chapter_number){
		if ($connect->connect_errno) {
		    echo "Failed to connect to MySQL: (" . $connect->connect_errno . ") " . $connect->connect_error;
		}
		if (!($stmt = $connect->prepare("SELECT * FROM chapteres WHERE (story_code = ?) AND (chapter_number = ?)"))) {
		     echo "Prepare failed: (" . $connect->errno . ") " . $connect->error;
		}

		/* Prepared statement, stage 2: bind and execute */
		if (!$stmt->bind_param("sd", $story_code, $chapter_number)){
		    echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
		}

		if (!$stmt->execute()) {
		    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
		}
		if (!($res = $stmt->get_result())){
		    echo "Getting result set failed: (" . $stmt->errno . ") " . $stmt->error;
		}
		// $res = $res->fetch_all(MYSQLI_ASSOC);
		if($res->num_rows > 0){
			return true;
		}else{
			return false;
		}
	}
	// Thêm thể loại
	function insert_info_Chapter($connect, $data){
		if ($connect->connect_errno) {
		    echo "Failed to connect to MySQL: (" . $connect->connect_errno . ") " . $connect->connect_error;
		}
		if (!($stmt = $connect->prepare("INSERT INTO chapteres (chapter_name , chapter_number, story_code, create_at, url_sourceData)
		 VALUES(?, ?, ?, ?, ?)"))) {
		     echo "Prepare failed: (" . $connect->errno . ") " . $connect->error;
		}

		/* Prepared statement, stage 2: bind and execute */
		if (!$stmt->bind_param("sdsss", $data["chapter_name"], $data["chapter_number"], $data["story_code"], $data["create_at"], $data["url_sourceData"])){
		    echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
		}

		if (!$stmt->execute()) {
		    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
		}
		$stmt->close();
	}

	function setGeted_info_Chapter($connect, $story_code){
		if ($connect->connect_errno) {
		    echo "Failed to connect to MySQL: (" . $connect->connect_errno . ") " . $connect->connect_error;
		}
		if (!($stmt = $connect->prepare("UPDATE stories SET story_categories = '2' WHERE story_code = ?"))) {
		     echo "Prepare failed: (" . $connect->errno . ") " . $connect->error;
		}

		/* Prepared statement, stage 2: bind and execute */
		if (!$stmt->bind_param("s", $story_code)){
		    echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
		}

		if (!$stmt->execute()) {
		    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
		}
		$stmt->close();
	}

	if( ($story_code = getIdToCrawlChapter($connect)) == null){
		echo 'Đã cập nhật hết';
		exit();
	}else{
		echo $story_code.'<hr/>';
	}

	// $story_code = '14-sai-no-koi';
	$link = 'https://www.komikid.com/manga/'.$story_code;

	$html = file_get_html($link);

	// Lấy thông tin chapter 

	$ret = $html->find('.chapters .chapter-title-rtl');
	foreach ($ret as $key =>  $value){
		$chapter = array();
		$pattern = '#href.*'.$story_code.'/(.*)">.*<em>(.*)</e#imsU';
		preg_match($pattern, $value, $matches);
		if (!empty($matches)){
			$chapter["chapter_name"] =trim($matches[2]);
			$chapter["url_sourceData"] =$link.'/'.trim($matches[1]);
			$chapter["chapter_number"] =trim($matches[1]);
			$chapter["chapter_number"] = explode(',', $chapter["chapter_number"]);
			$chapter["chapter_number"] = implode('.', $chapter["chapter_number"]);
			$chapter["story_code"] =$story_code;
			$chapter["create_at"] =date('Y-m-d H-i-s');

			if(!isset_Chapter($connect, $story_code, $chapter["chapter_number"])){
				insert_info_Chapter($connect, $chapter);
				echo '<pre>';
				print_r($chapter);
				echo '</pre>';
				echo 'Đã thêm chapter<hr/>';
			}else{
				echo 'Đã có chapter<hr/>';
			}
		}
	}

	setGeted_info_Chapter($connect, $story_code);
	echo("<meta http-equiv='refresh' content='1'>");
?>