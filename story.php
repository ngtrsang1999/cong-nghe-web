<?php
ob_start();
    include('views/header.php');
    include('views/form_login.php');
    if(isset($_GET['id'])){
	    $story_code=$_GET['id'];
	    if(!isset_Story($connect, $story_code)){
	         header('Location: liststory.php');
	    }else{
	        $thisStory = getStory_byCode($connect, $story_code);
	        if($thisStory["story_status"] == 'dang-cap-nhat'){
	            $status_name = 'Đang cập nhật';
	        }else{
	            $status_name = 'Đã hoàn thành';
	        }
	        $listAuthor = trim(strtolower($thisStory["story_author_name"]));
	        $listAuthor = explode(',', $listAuthor);
	        $categories_code = getCategory_byStoryCode($connect, $story_code);
	        $listChapteres = getListChater_byStorycode($connect, $story_code);
    		include ('views/story.php');
	    }
	}else{
	    header('Location: liststory.php');
	}

    include ('views/footer.php');
    ob_end_flush();
?>