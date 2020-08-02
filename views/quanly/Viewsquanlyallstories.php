<?php
	if(!empty($_POST) && isset($_FILES["storyAvater-dangky"])){
		if(is_img($_FILES["storyAvater-dangky"])){
			$listMyStoriCategories = $_POST["storycategories-dangky"];
			$listMyStoriCategories = explode(';', $listMyStoriCategories);
			
			$data = array();
			$data["story_code"] = $_POST["storyid-dangky"]; 
			$data["story_name"] = $_POST["storyName-dangky"]; 
			$data["another_name_story"] = $_POST["storyorthername-dangky"]; 
			$data["story_description"] = $_POST["storydescription-dangky"]; 
			$data["story_author_name"] = $_POST["storyauthorname-dangky"];
			$data["story_author_id"] = $_POST["storyauthorid-dangky"];
			$data["count_views"] = '0';
			$data["views_day"] = '0';
			$data["views_week"] = '0';
			$data["views_month"] = '0';
			$data["views_year"] = '0';
			$data["count_followes"] = '0';
			$data["count_likes"] = '0';
			$data["story_status"] = $_POST["storystatus-dangky"];
			$data["story_categories"] = '2';
			$data["create_at"] = date('Y-m-d H-i-s');
			$data["update_at"] = date('Y-m-d H-i-s');
			$data["tinh_trang"] = "dang-cho-duyet";
			$story_avatar = add_img_story($_FILES["storyAvater-dangky"]);
			$data["story_avatar"] = $story_avatar;
			$res = addStory($connect,$data);
			if($res){
				foreach ($listMyStoriCategories as  $value) {
					insertStory_Category($connect, $data["story_code"], $value);
				}
				echo "<script>
					$(document).ready(function(){
						alert('Thêm truyện thành công!');
					});
					</script>";
				}else{
					echo "<script>
						$(document).ready(function(){
							alert('Thêm truyện Thất Bại!');
						});
						</script>";
			}
		}else{
			echo "<script>
				$(document).ready(function(){
					alert('tạo truyện không thành công do avatar đã chọn không phải file ảnh!');
				});
				</script>";
		}
	}
	$listTinhTrang = getlistTinhTrang($connect);
?>

		<!-- end menutop -->
		<!-- modal -->
		<div class="modal fade" id="modal-quanlyuser">
	        <div class="modal-dialog modal-xl">
	          <div class="modal-content content-modal-quanLyUser">			
	          	<form action="" class="p-4" method="POST" id="formXemThongTinUser" >
	          		<button type="button" class="close" data-dismiss="modal" style="font-size: 40px; line-height: 1; margin-top: -25px; margin-right: -15px;">&times;</button>
					<p class="text-center text-primary" style="font-size: 20px;">Bạn có chắc muốn khóa truyện này?</p>
					<p class="text-center text-warning" style="font-size: 15px;">Truyện này sẽ bị khóa</p>
					<p class="text-center alertDeleteMyStory" style="font-size: 20px; display: none;"></p>
					<div class="text-center mt-4 content-confirm-user">
						<button type="button" class="btn btn-danger mx-2 px-3 py-1" data-dismiss="modal">Hủy Bỏ</button>
						<button data-storycode ="" type="button" class="btn btn-success mx-2 px-3 py-1 btnLockStory">Đồng Ý</button>
					</div>
				</form>
	          </div>
	        </div>
	      </div>

			<!-- Modal tạo truyện mới -->
	      <div class="modal fade" id="modalTaoTruyenMoi">
	        <div class="modal-dialog modal-xl">
	          <div class="modal-content content-modal-quanLyUser">			
	          	<form action="" class="p-4 formTaoMyStory" method="POST"  id="formXemThongTinUser" enctype="multipart/form-data">
	          		
				</form>
	          </div>
	        </div>
	      </div>

		<!-- end modal -->
		<!-- main -->
		<div class="col-12 bg-warning p-0 m-0 d-flex">
			<div class="d-none d-md-block" style="width: 200px; background-color: #263238;">

			</div>
			<div class="flex-grow-1 px-2 " style="background-color: #f5f5f5">
				<div class="list-quanly">
					<div class="title-list-quanly">
						<p class="m-0">Danh Sách Tất Cả Truyện</p>
					</div>

					<div class="loc-quanly">
						<div>
							<span>Tìm kiếm :
							</span>
							<input class="ml-5 ml-lg-2" id="keySearchQuanLy" type="text" placeholder="Nhập Tên Truyện">

							<br class="d-lg-none">
							<span class="ml-lg-4 mt-2 mt-lg-0">Thể loại: </span>
							<select class="ml-2 p-1 mt-2 mt-lg-0" id="categorySearchQuanLy">
							    <option value="all" selected>Tất cả</option>
							    <?php
							    	foreach ($listCategories as  $value) {
							    		echo '<option value="'.$value["category_code"].'">'.$value["category_name"].'</option>';
							    	}
							    ?>
							</select>

							<br class="d-lg-none">
							<span class="ml-lg-4 mt-2 mt-lg-0">Tình trạng: </span>
							<select class="ml-2 p-1 mt-2 mt-lg-0 " id="statusSearchQuanLy">
							    <option value="all" selected>Tất cả</option>
							    <?php
							    	foreach ($listTinhTrang as  $value) {
							    		echo '<option value="'.$value["tinh_trang_id"].'">'.$value["tinh_trang_name"].'</option>';
							    	}
							    ?>
							</select>
								<button class="ml-2" id="btnSearchAllStories"><i class="fa fa-search text-dark" aria-hidden="true"></i></button>
						</div>
					</div>
					<div class="table-list-quanly">
						<ul class="grid-6 list-story pt-3 px-lg-5" style ="min-height: 650px" id="listAllStoriesQuanLy">
                            <!-- Danh sách truyện                  -->
                           
                             <!-- end danh sách truyện -->
                    </ul>
					</div>
				</div>
			</div>
		</div>
		<!-- end main -->
	</div>
</section>