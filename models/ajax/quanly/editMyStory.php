<?php 
	date_default_timezone_set('Asia/Ho_Chi_Minh');
	session_start();
    include_once('../../mdStory.php');
    include_once('../../mdStory_Category.php');
    $oldStoryCode = $_POST['old_storyid'];
    $strCategories = $_POST['story_categories'];
    $listCategories = explode(';', $strCategories);
    // $data["story_code"] = $_POST["story_code"];
	$data["story_name"] = $_POST["story_name"]; 
	$data["another_name_story"] = $_POST["another_name_story"]; 
	$data["story_description"] = $_POST["story_description"]; 
	$data["story_author_name"] = $_POST["story_author_name"];
	$data["story_status"] = $_POST["story_status"];
	$data["update_at"] = date('Y-m-d H-i-s');
    if(updateMyStory($connect,$oldStoryCode, $data)){
    	if(deleteStoryCategoryByStoryID($connect, $oldStoryCode)){
	    	foreach ($listCategories as  $value) {
	    		insertStory_Category($connect, $oldStoryCode, $value);
	    	}
	    	echo '1';
    	}
    }else{
    	echo '0';
    }

?>