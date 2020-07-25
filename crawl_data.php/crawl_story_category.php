<?php	
	include_once('../models/mdStory.php'); 
	include ('simple_html_dom.php');

	date_default_timezone_set('Asia/Ho_Chi_Minh');

	// hàm lấy id của truyện chưa lấy story_category
	function getIdToGetCategories($connect){
		if ($connect->connect_errno) {
		    echo "Failed to connect to MySQL: (" . $connect->connect_errno . ") " . $connect->connect_error;
		}
		if (!($stmt = $connect->prepare("SELECT * FROM stories WHERE story_categories IS NULL LIMIT 1"))){
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
	function isset_Categories($connect, $category_code){
		if ($connect->connect_errno) {
		    echo "Failed to connect to MySQL: (" . $connect->connect_errno . ") " . $connect->connect_error;
		}
		if (!($stmt = $connect->prepare("SELECT * FROM categories WHERE (category_code = ?)"))) {
		     echo "Prepare failed: (" . $connect->errno . ") " . $connect->error;
		}

		/* Prepared statement, stage 2: bind and execute */
		if (!$stmt->bind_param("s", $category_code)){
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

	// Kiểm tra story_category đã tồn tại chưa
	function isset_Story_Category($connect, $story_code, $category_code){
		if ($connect->connect_errno) {
		    echo "Failed to connect to MySQL: (" . $connect->connect_errno . ") " . $connect->connect_error;
		}
		if (!($stmt = $connect->prepare("SELECT * FROM story_category WHERE (story_code = ?) AND (category_code = ?)"))) {
		     echo "Prepare failed: (" . $connect->errno . ") " . $connect->error;
		}

		/* Prepared statement, stage 2: bind and execute */
		if (!$stmt->bind_param("ss", $story_code, $category_code)){
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

	// Thêm thể loại
	function insert_Categories($connect, $data){
		if ($connect->connect_errno) {
		    echo "Failed to connect to MySQL: (" . $connect->connect_errno . ") " . $connect->connect_error;
		}
		if (!($stmt = $connect->prepare("INSERT INTO categories (category_code , category_name, category_description, create_at, update_at, editer)
		 VALUES(?, ?, ?, ?, ?, ?)"))) {
		     echo "Prepare failed: (" . $connect->errno . ") " . $connect->error;
		}

		/* Prepared statement, stage 2: bind and execute */
		if (!$stmt->bind_param("ssssss", $data["category_code"], $data["category_name"], $data["category_description"], $data["create_at"], $data["update_at"], $data["editer"])){
		    echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
		}

		if (!$stmt->execute()) {
		    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
		}
		$stmt->close();
	}

	//Đánh dấu đã lấy story_category
	function setUpdated_story_category($connect, $story_code){
		if ($connect->connect_errno) {
		    echo "Failed to connect to MySQL: (" . $connect->connect_errno . ") " . $connect->connect_error;
		}
		if (!($stmt = $connect->prepare("UPDATE stories SET story_categories = '1' WHERE story_code = ?"))) {
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

	// Thêm story_category
	function insert_Story_Category($connect, $story_code, $category_code){
		if ($connect->connect_errno) {
		    echo "Failed to connect to MySQL: (" . $connect->connect_errno . ") " . $connect->connect_error;
		}
		if (!($stmt = $connect->prepare("INSERT INTO story_category (story_code , category_code) VALUES(?, ?)"))) {
		     echo "Prepare failed: (" . $connect->errno . ") " . $connect->error;
		}

		/* Prepared statement, stage 2: bind and execute */
		if (!$stmt->bind_param("ss", $story_code, $category_code)){
		    echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
		}

		if (!$stmt->execute()) {
		    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
		}
		$stmt->close();
	}

	if( ($story_code = getIdToGetCategories($connect)) == null){
		echo 'Đã cập nhật hết';
		exit();
	}
	echo $story_code.'<hr/>';
	// $story_code = 'agravity-boys';
	$link = 'https://www.komikid.com/manga/'.$story_code;

	$html = file_get_html($link);

	// Lấy dữ liệu category và story_category

	$ret = $html->find('.dl-horizontal', 0);

	$pattern = '#.*Categories.*<dd>(.*)</dd>#imsU';
	preg_match($pattern, $ret, $matches);
     if (!empty($matches)) {
     	$categories = explode(',', trim($matches[1]));
   		foreach ($categories as $key => $value) {
			$pattern = '#.*href="https://www.komikid.com/manga-list/category/(.*)">(.*)</a#imsU';
			preg_match($pattern, $value, $matches);
            $categories[$key] = array();
            $categories[$key]['category_name'] = trim($matches[2]);
            $categories[$key]['category_code'] = trim($matches[1]);
            $categories[$key]["create_at"]  = date('Y-m-d H-i-s');
            $categories[$key]["update_at"]  = date('Y-m-d H-i-s');
            $categories[$key]["editer"]  = 'user';
            $categories[$key]["category_description"]  = 'Các truyện '.trim($matches[2]);

            // Thêm categories
            if(!isset_Categories($connect, $categories[$key]['category_code'])){
            	insert_Categories($connect, $categories[$key]);
			    echo '<pre>';
			    print_r($categories[$key]);
			    echo '</pre><hr>';
            }else{
            	echo 'đã có<hr>';
            }

            // end thêm categories

            // Thêm story_category
            if(!isset_Story_Category($connect, $story_code, $categories[$key]['category_code'])){
            	insert_Story_Category($connect, $story_code, $categories[$key]['category_code']);
            	echo 'đã thêm story_category<hr>';
            }else{
            	echo 'đã có story_category<hr>';
            }
            // end thêm story_category
        }   	
        setUpdated_story_category($connect, $story_code);
    } else {
    	echo "Không lấy được categories";   	
        setUpdated_story_category($connect, $story_code);
    }
    
	echo("<meta http-equiv='refresh' content='1'>");

	// End Lấy dữ liệu category và story_category

?>