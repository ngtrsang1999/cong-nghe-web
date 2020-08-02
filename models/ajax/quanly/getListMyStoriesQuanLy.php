<?php 
	session_start();
    include_once('../../mdStory.php');
	include_once('../../mdChapter.php');
	include_once('../../mdTinhTrang.php');
    $keySearch = $_POST['keySearch'];
    $trangthai = $_POST['trangthai'];
    $theloai = $_POST['theloai'];
    $story_author_id = $_SESSION['user']['user_id'];
    $output = '';
    $res = getListMyStoriesQuanLy($connect ,$keySearch, $trangthai, $theloai, $story_author_id);
    if (!empty($res)) {
    	foreach ($res as $value) {
    		$lastestchapter = getLatestChapter($connect, $value["story_code"]);
    		if(empty($lastestchapter)){
    			$lastestchapterName = "chưa có chapter nào";
    		}else{
    			$lastestchapterName = ucfirst($lastestchapter["chapter_name"]);
    		}
	    	$output .= '<li style ="max-height: 600px" class ="mb-3">
	                                <div class="story-item">
	                                    <a href="story.php?id='.$value["story_code"].'" target="_blank" title ="'.$value["story_name"].'">
	                                        <img class="lazy-img" data-src="'.$value["story_avatar"].'" alt="'.$value["story_name"].'">
	                                    </a>

	                                    <h3 class="title-story">
	                                        <a href="story.php?id='.$value["story_code"].'" target="_blank">
	                                            '.$value["story_name"].'
	                                        </a>
	                                     </h3>
	                                        
	                                     <div class="episode-story">
	                                     	<a>Tình trạng: '.getNameTinhTrang($connect, $value["tinh_trang"]).'</a>
	                                        <a>Chapter mới nhất: '.$lastestchapterName.'</a>
	                                        <a>Ngày cập nhật: '.$value["update_at"].'</a>
	                                         <span>
	                                         	<a href="story.php?id='.$value["story_code"].'" title="Xem" class ="d-inline mx-2" target="_blank"><i class="fa fa-eye" aria-hidden="true" ></i></a>
	                                         	<a href="./quanly.php?content=mystories&id='.$value["story_code"].'" title="Sửa" class ="d-inline mx-2"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> </a>
	                                         	<a data-storycode="'.$value["story_code"].'" title="Xóa" class ="d-inline mx-2" data-toggle="modal" data-target="#modal-quanlyuser" onclick="showFormComFirmDeleteMyStory(this)"><i class="fa fa-trash-o" aria-hidden="true"></i></a>              	
	                                         </span>
	                                     </div>
	                                </div>
	                            </li>';
    	}
    }
    if($output == ''){
        echo '<p class="text-danger text-center mt-4" style ="font-size: 30px; position: absolute;">Không tìm thấy truyện phù hợp</p>';
    }else{
        echo $output;
    }
?>