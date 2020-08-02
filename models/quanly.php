<?php
	$thisUserGroup = $_SESSION["user"]["user_group"];
	if (!empty($_GET['content'])){
		switch ($_GET['content']){
			case 'user':{
				if (groupHasAct($connect, $thisUserGroup, 'act-users')) {
					include_once('views/quanly/headerQuanLy.php');
					include_once('views/quanly/Viewquanlyuser.php');
					break;
				}else{
					 echo '<p class ="text-danger text-center" style = "font-size:30px;margin: 450px 0;">Chức năng này cần quyền Quản lý tài khoản</p>';
					 break;
				}
			}

			case 'theloai':{
				if (groupHasAct($connect, $thisUserGroup, 'act-users')) {
					include_once('views/quanly/headerQuanLy.php');
					include_once('views/quanly/Viewtheloai.php');
					break;
				}else{
					 echo '<p class ="text-danger text-center" style = "font-size:30px;margin: 450px 0;">Chức năng này cần quyền Quản lý tài khoản</p>';
					 break;
				}
			}

			case 'thongke':{
				if (groupHasAct($connect, $thisUserGroup, 'act-thongke')){
					include_once('views/quanly/headerQuanLy.php');
					include_once('views/quanly/Viewthongke.php');
					break;
				}else{
					 echo '<p class ="text-danger text-center" style = "font-size:30px;margin: 450px 0;">Chức năng này cần quyền Xem Thống Kê</p>';
					 break;
				}
			}

			case 'phanquyen':{
				if (groupHasAct($connect, $thisUserGroup, 'act-users')) {
					include_once('views/quanly/headerQuanLy.php');
					include_once('views/quanly/Viewsphanquyen.php');
					break;
				}else{
					 echo '<p class ="text-danger text-center" style = "font-size:30px;margin: 450px 0;">Chức năng này cần quyền Quản lý tài khoản</p>';
					 break;
				}
			}


			case 'mystories':{
				if(groupHasAct($connect, $thisUserGroup, 'act-mystories')){
					if(!empty($_GET['id'])){
						if(isMyStory($connect, $_GET['id'], $_SESSION["user"]["user_id"])){
							include_once('views/quanly/headerQuanLy.php');
							include_once('views/quanly/Viewquanlymystory.php');
							break;
						}else{
							header("Location: ./quanly.php?content=mystories");
							break;
						}
					}else{
						include_once('views/quanly/headerQuanLy.php');
						include_once('views/quanly/Viewquanlymystories.php');
						break;
					}
				}else{
					 echo '<p class ="text-danger text-center" style = "font-size:30px;margin: 450px 0;">Chức năng này cần quyền Quản lý truyện của mình</p>';
					 break;
				}
			}

			case 'allstories':{
				if(groupHasAct($connect, $thisUserGroup, 'act-allstories')){
					include_once('views/quanly/headerQuanLy.php');
					include_once('views/quanly/Viewsquanlyallstories.php');
					break;
				}else{
					echo '<p class ="text-danger text-center" style = "font-size:30px;margin: 450px 0;">Chức năng này cần quyền Quản lý tất cả truyện</p>';
					break;
				}
			}
				
			
			default:
				header("Location: ./quanly.php?content=mystories");
				break;
		}
	}else{
		header("Location: ./quanly.php?content=mystories");
	}
?>