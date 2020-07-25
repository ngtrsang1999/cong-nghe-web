<?php
	session_start();
	include_once('../../mdUser.php');
	$data = $_POST['data'];
	$data .='&';
	$pattern = '#id=(.*)&.*chapter=(.*)&#imsU';
	preg_match($pattern, $data, $matches);
	if(!empty($matches)){
		$story_code = $matches[1];
		$chapter_number = $matches[2];
	}
	if(isset($_SESSION['user'])){
		if(empty($_SESSION['user']['lich_su'])){
			$listLichSu = array();
			$listLichSu[$story_code] = $chapter_number;
		}else{
			$listLichSu = json_decode($_SESSION['user']['lich_su'], true);	
			if(count($listLichSu) >= 30){
				// Xóa phần tử đầu tiên của mảng $listLichSu
				if(array_key_exists($story_code, $listLichSu)){
					unset($listLichSu[$story_code]);
				}else{
					foreach ($listLichSu as $key => $value) {
						unset($listLichSu[$key]);
						if(count($listLichSu < 30)){
							break;
						}
					}
				}
			}
			$listLichSu[$story_code] = $chapter_number;	
		}
		$_SESSION['user']['lich_su'] = json_encode($listLichSu);
		updateLichSu($connect, $_SESSION['user']['user_id'], $_SESSION['user']['lich_su']);
	}else{
		// chưa đăng nhập nên bỏ qua
	}
?>