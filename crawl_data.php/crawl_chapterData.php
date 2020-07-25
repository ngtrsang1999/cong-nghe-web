<?php

	include_once('../models/mdStory.php'); 
	include ('simple_html_dom.php');

	date_default_timezone_set('Asia/Ho_Chi_Minh');

	// hàm lấy id của truyện chưa lấy story_category
	function getUrlChapterCrawl($connect){
		if ($connect->connect_errno) {
		    echo "Failed to connect to MySQL: (" . $connect->connect_errno . ") " . $connect->connect_error;
		}
		if (!($stmt = $connect->prepare("SELECT * FROM chapteres WHERE chapter_content IS NULL LIMIT 1"))){
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
			return $res[0]["url_sourceData"];
		}else{
			return NULL;
		}
	}

	function insert_Chapter_data($connect, $chapter_content, $url_sourceData){
		if ($connect->connect_errno) {
		    echo "Failed to connect to MySQL: (" . $connect->connect_errno . ") " . $connect->connect_error;
		}
		if (!($stmt = $connect->prepare("UPDATE chapteres SET chapter_content = ? WHERE url_sourceData = ?"))) {
		     echo "Prepare failed: (" . $connect->errno . ") " . $connect->error;
		}

		/* Prepared statement, stage 2: bind and execute */
		if (!$stmt->bind_param("ss", $chapter_content, $url_sourceData)){
		    echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
		}

		if (!$stmt->execute()) {
		    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
		}
		$stmt->close();
	}

	if( ($url_sourceData = getUrlChapterCrawl($connect)) == null){
		echo 'Đã cập nhật hết';
		exit();
	}else{
		echo $url_sourceData.'<hr/>';
	}

	// $url_sourceData = 'https://www.komikid.com/manga/one-piece/985/2';
	$link = $url_sourceData;

	$html = file_get_html($link);
    $data_chap = array();
    foreach ($html->find('div#all>img.img-responsive') as $key_c => $element1){
        $pattern = "#data-src='(.*)'#imsU";
        preg_match($pattern, $element1, $matches);
        if (!empty($matches)) {
            $data_chap[$key_c] = trim($matches[1]);
        }
    }
    $chapter_content = json_encode($data_chap);
	insert_Chapter_data($connect, $chapter_content, $url_sourceData);
	echo 'Đã crawl chapter data thành công<hr/>';
	echo("<meta http-equiv='refresh' content='1'>");
?>