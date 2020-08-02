<?php 
	$dbHost = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $database = "truyen_sh";

    $connect = mysqli_connect($dbHost, $dbUsername, $dbPassword, $database) or die("Cannot connect to database");

    function getListStories($connect, $page = 1, $limit = 24, $order = 'update_at'){
	    $query = "SELECT COUNT(*) as max FROM stories";
	    $result = mysqli_query($connect, $query);
	    foreach ($result as $value) {
	    	$max_tintuc = $value['max'];
	    	break;
	    }
	    $page_max = ceil($max_tintuc / $limit);
	    if($page > $page_max){
	    	$page = $page_max;
	    }
		if($page < 1){
			$page = 1;
		}
		$start = $limit * ($page - 1);
		$query = "SELECT * FROM stories ORDER BY $order DESC LIMIT $start, $limit";
		$data = mysqli_query($connect, $query);
	    // $data['list_data'] = mysqli_query($connect, $query);
	    // $data['page_max'] = $page_max;
	    // $data['page'] = $page;
	    return $data ;
	}
	function getPageMax($connect ,$limit = 18, $data){
		$sql1 = "SELECT COUNT(*) as max FROM stories ";
		if(isset($data->status)){
			$sql1 .= "WHERE (story_status = '$data->status') ";
		}
		if(isset($data->category)){
			if(isset($data->status)){
				$sql1 .= "AND (story_code in (SELECT story_code FROM story_category WHERE category_code = 
				'$data->category')) ";
			}else{
				$sql1 .= "WHERE (story_code in (SELECT story_code FROM story_category WHERE category_code = 
				'$data->category')) ";
			}
		}

		$result = mysqli_query($connect, $sql1);
	    foreach ($result as $value) {
	    	$max_story = $value['max'];
	    	break;
	    }
	    $page_max = ceil($max_story / $limit);
	    if($page_max < 1){
	    	$page_max = 1;
	    }
	    return $page_max;
	}
	function getListMyStoriesQuanLy($connect ,$keySearch, $tinh_trang, $category_code, $story_author_id){
		$keySearch = "%".trim($keySearch)."%";
		$sql2 = "SELECT * FROM stories ";
		if($tinh_trang != 'all'){
			$sql2 .= "WHERE (tinh_trang = '$tinh_trang') ";
		}
		if($category_code != 'all'){
			if($tinh_trang != 'all'){
				$sql2 .= "AND (story_code in (SELECT story_code FROM story_category WHERE category_code = 
				'$category_code')) ";
			}else{
				$sql2 .= "WHERE (story_code in (SELECT story_code FROM story_category WHERE category_code = 
				'$category_code')) ";
			}
		}
		if($tinh_trang != 'all' || $category_code != 'all'){
			$sql2 .= "AND (story_name LIKE '$keySearch') ";
		}else{
			$sql2 .= "WHERE (story_name LIKE '$keySearch') ";
		}

		$sql2 .= "AND (story_author_id = '$story_author_id') ";
	    if(!($data_rs = mysqli_query($connect, $sql2))){
	    	return array();
	    }else{
	    	return $data_rs->fetch_all(MYSQLI_ASSOC);
	    }
	}

	function getListAllStoriesQuanLy($connect ,$keySearch, $tinh_trang, $category_code){
		$keySearch = "%".trim($keySearch)."%";
		$sql2 = "SELECT * FROM stories ";
		if($tinh_trang != 'all'){
			$sql2 .= "WHERE (tinh_trang = '$tinh_trang') ";
		}
		if($category_code != 'all'){
			if($tinh_trang != 'all'){
				$sql2 .= "AND (story_code in (SELECT story_code FROM story_category WHERE category_code = 
				'$category_code')) ";
			}else{
				$sql2 .= "WHERE (story_code in (SELECT story_code FROM story_category WHERE category_code = 
				'$category_code')) ";
			}
		}
		if($tinh_trang != 'all' || $category_code != 'all'){
			$sql2 .= "AND (story_name LIKE '$keySearch') ";
		}else{
			$sql2 .= "WHERE (story_name LIKE '$keySearch') ";
		}
	    if(!($data_rs = mysqli_query($connect, $sql2))){
	    	return array();
	    }else{
	    	return $data_rs->fetch_all(MYSQLI_ASSOC);
	    }
	}


	function isMyStory($connect, $story_code, $story_author_id){
		$sql = "SELECT * FROM stories WHERE (story_code = ?) AND ( story_author_id = ?)";
		if ($connect->connect_errno) {
		    echo "Failed to connect to MySQL: (" . $connect->connect_errno . ") " . $connect->connect_error;
		}
		if (!($stmt = $connect->prepare($sql))){
		     echo "Prepare failed: (" . $connect->errno . ") " . $connect->error;
		}

		/* Prepared statement, stage 2: bind and execute */
		if (!$stmt->bind_param("ss", $story_code, $story_author_id)){
		    echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
		}

		if (!$stmt->execute()) {
		    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
		}
		if (!($res = $stmt->get_result())) {
		    echo "Getting result set failed: (" . $stmt->errno . ") " . $stmt->error;
		}
		if($res->num_rows > 0){
			return true;
		}else{
			return false;
		}
	}
	function getListStoriesForPageList($connect ,$limit = 18, $data, $page){
		$sql1 = "SELECT COUNT(*) as max FROM stories ";
		$sql2 = "SELECT * FROM stories ";
		// if(isset($data->page)){
		// 	$page = $data->page;
		// }else{
		// 	$page = 1;
		// }
		if(isset($data->status)){
			$sql1 .= "WHERE (story_status = '$data->status') ";
			$sql2 .= "WHERE (story_status = '$data->status') ";
		}
		if(isset($data->category)){
			if(isset($data->status)){
				$sql1 .= "AND (story_code in (SELECT story_code FROM story_category WHERE category_code = 
				'$data->category')) ";

				$sql2 .= "AND (story_code in (SELECT story_code FROM story_category WHERE category_code = 
				'$data->category')) ";
			}else{
				$sql1 .= "WHERE (story_code in (SELECT story_code FROM story_category WHERE category_code = 
				'$data->category')) ";

				$sql2 .= "WHERE (story_code in (SELECT story_code FROM story_category WHERE category_code = 
				'$data->category')) ";
			}
		}

		$result = mysqli_query($connect, $sql1);
	    foreach ($result as $value) {
	    	$max_story = $value['max'];
	    	break;
	    }
	    $page_max = ceil($max_story / $limit);
	    if($page > $page_max){
	    	$page = $page_max;
	    }
		if($page < 1){
			$page = 1;
		}
		$start = $limit * ($page - 1);

		if(isset($data->order)){
			$sql2 .= " ORDER BY $data->order DESC LIMIT $start, $limit";
		}else{
			$sql2 .= " ORDER BY update_at DESC LIMIT $start, $limit";
		}

		// $data_rs = mysqli_query($connect, $sql2);
	    // $data['list_data'] = mysqli_query($connect, $query);
	    // $data['page_max'] = $page_max;
	    // $data['page'] = $page;
	    if(!($data_rs = mysqli_query($connect, $sql2))){
	    	return array();
	    }else{
	    	return $data_rs->fetch_all(MYSQLI_ASSOC);
	    }
	}

	function addStory($connect,$data){
		if ($connect->connect_errno) {
		    echo "Failed to connect to MySQL: (" . $connect->connect_errno . ") " . $connect->connect_error;
		}

		if (!($stmt = $connect->prepare("
			INSERT INTO  stories (story_code, story_name, another_name_story, story_description, story_author_name, story_author_id, count_views, views_day, views_week, views_month, views_year, count_followes, count_likes, story_status, story_avatar, story_categories, create_at, update_at, tinh_trang) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
			"))){
		     echo "Prepare failed: (" . $connect->errno . ") " . $connect->error;
		}
		/* Prepared statement, stage 2: bind and execute */
		if (!$stmt->bind_param("ssssssiiiiiiissssss",  $data["story_code"],  $data["story_name"],  $data["another_name_story"],  $data["story_description"],  $data["story_author_name"],  $data["story_author_id"],  $data["count_views"],  $data["views_day"],  $data["views_week"],  $data["views_month"],  $data["views_year"],  $data["count_followes"],  $data["count_likes"],  $data["story_status"],  $data["story_avatar"],  $data["story_categories"],  $data["create_at"],  $data["update_at"],  $data["tinh_trang"])){
		    echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
		}

		return $stmt->execute();
	}

	function upLikes($connect, $story_code){
		if ($connect->connect_errno) {
		    echo "Failed to connect to MySQL: (" . $connect->connect_errno . ") " . $connect->connect_error;
		}

		if (!($stmt = $connect->prepare("UPDATE  stories SET count_likes = (count_likes + 1) where ( story_code= ? )"))){
		     echo "Prepare failed: (" . $connect->errno . ") " . $connect->error;
		}
		/* Prepared statement, stage 2: bind and execute */
		if (!$stmt->bind_param("s",  $story_code)){
		    echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
		}

		if (!$stmt->execute()) {
		    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
		}
	}

	function updateTimeUpdateStory($connect, $story_code, $time){
		if ($connect->connect_errno) {
		    echo "Failed to connect to MySQL: (" . $connect->connect_errno . ") " . $connect->connect_error;
		}

		if (!($stmt = $connect->prepare("UPDATE  stories SET update_at = ? where ( story_code= ? )"))){
		     echo "Prepare failed: (" . $connect->errno . ") " . $connect->error;
		}
		/* Prepared statement, stage 2: bind and execute */
		if (!$stmt->bind_param("ss",  $time,  $story_code)){
		    echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
		}

		return  $stmt->execute();
	}


	function updateMyStory($connect,$story_code, $data){
		if ($connect->connect_errno) {
		    echo "Failed to connect to MySQL: (" . $connect->connect_errno . ") " . $connect->connect_error;
		}

		if (!($stmt = $connect->prepare("
			UPDATE  stories SET 
			-- story_code = ?, 
			story_name = ?,
			another_name_story = ?, story_description = ?,
			story_author_name = ?, story_status = ?,
			update_at = ?
			where (story_code= '$story_code' )
			"))){
		     echo "Prepare failed: (" . $connect->errno . ") " . $connect->error;
		}
		/* Prepared statement, stage 2: bind and execute */
		if (!$stmt->bind_param("ssssss", $data['story_name'], $data['another_name_story'], $data['story_description'], $data['story_author_name'], $data['story_status'], $data['update_at'])){
		    echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
		}

		return $stmt->execute();
	}

	function deleteStoryByID($connect, $story_code){
		if ($connect->connect_errno) {
		    echo "Failed to connect to MySQL: (" . $connect->connect_errno . ") " . $connect->connect_error;
		}

		if (!($stmt = $connect->prepare("DELETE FROM `stories` WHERE ( story_code= ? )"))){
		     echo "Prepare failed: (" . $connect->errno . ") " . $connect->error;
		}
		/* Prepared statement, stage 2: bind and execute */
		if (!$stmt->bind_param("s",  $story_code)){
		    echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
		}

		// if (!$stmt->execute()) {
		//     echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
		// }

		return $stmt->execute();
	}

	function upFollowes($connect, $story_code){
		if ($connect->connect_errno) {
		    echo "Failed to connect to MySQL: (" . $connect->connect_errno . ") " . $connect->connect_error;
		}

		if (!($stmt = $connect->prepare("UPDATE  stories SET count_followes = (count_followes + 1) where ( story_code= ? )"))){
		     echo "Prepare failed: (" . $connect->errno . ") " . $connect->error;
		}
		/* Prepared statement, stage 2: bind and execute */
		if (!$stmt->bind_param("s",  $story_code)){
		    echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
		}

		if (!$stmt->execute()) {
		    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
		}
	}

	function upViews($connect, $story_code){
		if ($connect->connect_errno) {
		    echo "Failed to connect to MySQL: (" . $connect->connect_errno . ") " . $connect->connect_error;
		}

		if (!($stmt = $connect->prepare("UPDATE  stories SET 
			count_views = (count_views + 1),
			views_day   = (views_day + 1),
			views_week  = (views_week + 1),
			views_month = (views_month + 1),
			views_year  = (views_year + 1)
			where ( story_code= ? )"))){
		     echo "Prepare failed: (" . $connect->errno . ") " . $connect->error;
		}
		/* Prepared statement, stage 2: bind and execute */
		if (!$stmt->bind_param("s",  $story_code)){
		    echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
		}

		if (!$stmt->execute()) {
		    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
		}
	}

	function downLikes($connect, $story_code){
		if ($connect->connect_errno) {
		    echo "Failed to connect to MySQL: (" . $connect->connect_errno . ") " . $connect->connect_error;
		}
		
		if (!($stmt = $connect->prepare("UPDATE  stories SET count_likes = (count_likes - 1) where ( story_code= ? )"))){
		     echo "Prepare failed: (" . $connect->errno . ") " . $connect->error;
		}
		/* Prepared statement, stage 2: bind and execute */
		if (!$stmt->bind_param("s",  $story_code)){
		    echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
		}

		if (!$stmt->execute()) {
		    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
		}
	}

	function downFollowes($connect, $story_code){
		if ($connect->connect_errno) {
		    echo "Failed to connect to MySQL: (" . $connect->connect_errno . ") " . $connect->connect_error;
		}
		
		if (!($stmt = $connect->prepare("UPDATE  stories SET count_followes = (count_followes - 1) where ( story_code= ? )"))){
		     echo "Prepare failed: (" . $connect->errno . ") " . $connect->error;
		}
		/* Prepared statement, stage 2: bind and execute */
		if (!$stmt->bind_param("s",  $story_code)){
		    echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
		}

		if (!$stmt->execute()) {
		    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
		}
	}


	function isset_Story($connect, $story_code){
		if ($connect->connect_errno) {
		    echo "Failed to connect to MySQL: (" . $connect->connect_errno . ") " . $connect->connect_error;
		}
		if (!($stmt = $connect->prepare("SELECT * FROM stories WHERE story_code = ?"))){
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
			return true;
		}else{
			return false;
		}
	}

	function getStory_byCode($connect, $story_code){
		if ($connect->connect_errno) {
		    echo "Failed to connect to MySQL: (" . $connect->connect_errno . ") " . $connect->connect_error;
		}
		if (!($stmt = $connect->prepare("SELECT * FROM stories WHERE story_code = ?"))){
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

	function resultSearchStoryName($connect, $keyword){
		$keyword = "%".$keyword."%";
		if ($connect->connect_errno) {
		    echo "Failed to connect to MySQL: (" . $connect->connect_errno . ") " . $connect->connect_error;
		}
		if (!($stmt = $connect->prepare("SELECT * FROM stories 
			 WHERE (LOWER(story_name) LIKE LOWER(?)) OR (LOWER(another_name_story) LIKE LOWER(?))"))){
		     echo "Prepare failed: (" . $connect->errno . ") " . $connect->error;
		}
		/* Prepared statement, stage 2: bind and execute */
		if (!$stmt->bind_param("ss", $keyword, $keyword)){
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
			return NULL;
		}
	}

	function resultSearchStoryAuthurName($connect, $keyword){
		$keyword = "%".$keyword."%";
		if ($connect->connect_errno) {
		    echo "Failed to connect to MySQL: (" . $connect->connect_errno . ") " . $connect->connect_error;
		}
		if (!($stmt = $connect->prepare("SELECT * FROM stories WHERE LOWER(story_author_name) LIKE LOWER(?)"))){
		     echo "Prepare failed: (" . $connect->errno . ") " . $connect->error;
		}
		/* Prepared statement, stage 2: bind and execute */
		if (!$stmt->bind_param("s", $keyword)){
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
			return NULL;
		}
	}


?>