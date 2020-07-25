<?php
	date_default_timezone_set('Asia/Ho_Chi_Minh');

	include ('simple_html_dom.php');
	$story = array();
	$link = 'https://www.komikid.com/manga/16-life';
	// Create DOM from URL or file
	$html = file_get_html($link);

	// get avatar
	$ret = $html->find('.img-responsive', 0);
	$story["story_avatar"] =  $ret->src;

	//get id 

	$pattern = '#.*/manga/(.*)/#imsU';
    preg_match($pattern, $story["story_avatar"], $matches);
     if (!empty($matches)) {
        $story["story_code"] = trim($matches[1]);
    } else {
		$story["story_code"]  = '';
    }
	// get name

	$ret = $html->find('.widget-title', 0);
	$story["story_name"]  = $ret->plaintext;

	// get description
	$ret = $html->find('.well p', 0);
	if($ret){
		$story["story_description"]  = $ret->plaintext;
	}else{
		$story["story_description"]  = "Đang cập nhật";
	}

	$ret = $html->find('.dl-horizontal', 0);

	$pattern = '#.*Other names.*<dd>(.*)</dd>#imsU';
	preg_match($pattern, $ret, $matches);

     if (!empty($matches)) {
        $story["another_name_story"] = trim($matches[1]);
    } else {
		$story["another_name_story"]  = '';
    }
    $pattern = '#.*Views.*<dd>(.*)</dd>#imsU';
	preg_match($pattern, $ret, $matches);

     if (!empty($matches)) {
        $story["count_views"] = trim($matches[1]);
    } else {
		$story["count_views"]  = 10;
    }

     $pattern = '#.*Artist.*<dd>.*<a.*>(.*)</a.*</dd>#imsU';
	preg_match($pattern, $ret, $matches);
     if (!empty($matches)) {
        $story["story_author_name"] = trim($matches[1]);
    } else {
		$story["story_author_name"]  = 'sang nt';
    }

    $story["story_author_id"]  = 'user';
    $story["views_day"]  = 10;
    $story["views_month"]  = 10;
    $story["views_week"]  = 10;
    $story["views_year"]  = 10;
    $story["count_followes"]  = 10;
    $story["count_likes"]  = 10;
    $story["story_status"]  = 'dang-cap-nhat';

    $story["update_at"]  = date('Y-m-d H-i-s');
    $story["create_at"]  = date('Y-m-d H-i-s');
	echo '<pre>';
	print_r($story);
	echo '</pre>';



	include_once('./models/mdStory.php'); 
	//Kiểm tra kết nối

	//câu truy vấn

	if ($connect->connect_errno) {
	    echo "Failed to connect to MySQL: (" . $connect->connect_errno . ") " . $connect->connect_error;
	}
	/* Prepared statement, stage 1: prepare */
	if (!($stmt = $connect->prepare(
		"INSERT INTO stories
		(story_code , story_name, another_name_story,story_description,story_author_name,story_author_id,count_views,views_day,views_week,views_month,views_year,count_followes,count_likes,story_status,story_avatar,create_at,update_at)
		VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)"


	))) {
	     echo "Prepare failed: (" . $connect->errno . ") " . $connect->error;
	}

	/* Prepared statement, stage 2: bind and execute */
	if (!$stmt->bind_param("ssssssiiiiiiissss", $story["story_code"], $story["story_name"], $story["another_name_story"], $story["story_description"], $story["story_author_name"], $story["story_author_id"], $story["count_views"], $story["views_day"], $story["views_week"], $story["views_month"], $story["views_year"], $story["count_followes"], $story["count_likes"], $story["story_status"], $story["story_avatar"], $story["create_at"], $story["update_at"])) {
	    echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
	}

	if (!$stmt->execute()) {
	    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
	}
	$stmt->close();
	echo '</br> oke';
?>