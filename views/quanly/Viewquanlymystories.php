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
	<span title="Tạo Truyện Mới" style=" position: fixed; z-index: 100; border-radius: 50%; width: 100px; height: 100px; cursor: pointer; bottom: 70px; left: 30px;" class="bg-success p-4 text-center" data-toggle="modal" data-target="#modalTaoTruyenMoi"><i class="fa fa-plus" aria-hidden="true" style="line-height: 50px;font-size: 40px;"></i></span>
		<!-- modal -->
		<div class="modal fade" id="modal-quanlyuser">
	        <div class="modal-dialog modal-xl">
	          <div class="modal-content content-modal-quanLyUser">			
	          	<form action="" class="p-4" method="POST" id="formXemThongTinUser" >
	          		<button type="button" class="close" data-dismiss="modal" style="font-size: 40px; line-height: 1; margin-top: -25px; margin-right: -15px;">&times;</button>
					<p class="text-center text-primary" style="font-size: 20px;">Bạn có chắc muốn truyện này?</p>
					<p class="text-center text-warning" style="font-size: 15px;">Truyện này sẽ bị xóa vĩnh viễn khỏi cơ sở dữ liệu</p>
					<p class="text-center alertDeleteMyStory" style="font-size: 20px; display: none;"></p>
					<div class="text-center mt-4 content-confirm-user">
						<button type="button" class="btn btn-danger mx-2 px-3 py-1" data-dismiss="modal">Hủy Bỏ</button>
						<button data-storycode ="" type="button" class="btn btn-success mx-2 px-3 py-1 btnDeleteMyStoryQuanLy">Đồng Ý</button>
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
	          		<button type="button" class="close" data-dismiss="modal" style="font-size: 40px; line-height: 1; margin-top: -25px; margin-right: -15px;">&times;</button>
					<p class="text-center text-primary" style="font-size: 30px;">Tạo truyện mới</p>
					<p class="text-danger text-center warningTaoMyStoryQuanLy" style="display: none ;font-size: 20px;"></p>
						<p class="text-success text-center successTaoMyStoryQuanLy" style="display: none ;font-size: 20px;">Các thông tin đã hợp lệ!</p>
					<label  for="storyName-dangky">Tên truyện: </label>
					<input name="storyName-dangky" id="storyName-dangky" type="text" class="mb-3" placeholder="Nhập tên truyện">

					<label  for="storyAvater-dangky">Avatar truyện: </label>
					<input name="storyAvater-dangky" id="storyAvater-dangky" type="file" class="mb-3">
					<div class="mb-3"><img src="https://www.metatube.com/assets/metatube/video/img/Upload.svg" id ="avatarTaoMyStory" class="mx-auto" alt="avatar truyện" style="display: block;width: 200px; background-color: #eee; border: 1px solid red"></div>

					<label for="storyid-dangky">ID của truyện: (ID tự sinh)</label>
					<input name="storyid-dangky2" id="storyid-dangky2" type="text" class="mb-3"  value="" disabled>
					<input name="storyid-dangky" id="storyid-dangky" type="text" class="mb-3 d-none"  value="">
					
					<label for="storyorthername-dangky">Tên khác truyện: (Các tên cách nhâu bởi dấu ';')</label>
					<input name="storyorthername-dangky" id="storyorthername-dangky" type="text" class="mb-3" placeholder="Nhập tên khác của truyện">
					
					<label for="storyauthorname-dangky">Tên tác giả: (Các tên cách nhâu bởi dấu ';')</label>
					<input name="storyauthorname-dangky" id="storyauthorname-dangky" type="text" class="mb-3" placeholder="Nhập tên tác giả">
					
					<label for="storyauthorid-dangky">ID tác giả: (Chỉ ID này có quyền chỉnh sửa truyện)</label>
					<input name="storyauthorid-dangky2" id="storyauthorid-dangky2" type="text" class="mb-3" disabled value="<?php echo $_SESSION["user"]["user_id"] ?>">
					<input name="storyauthorid-dangky" id="storyauthorid-dangky" type="text" class="mb-3 d-none"  value="<?php echo $_SESSION["user"]["user_id"] ?>">

					<label for="storystatus-dangky">Tình trạng: </label>
					<input name="storystatus-dangky2" id="storystatus-dangky2" type="text" disabled class="mb-3" value="dang-cap-nhat">
					<input name="storystatus-dangky" id="storystatus-dangky" type="text" class="mb-3 d-none" value="dang-cap-nhat">
					
					<label for="storycategories-dangky">Thể loại của truyện: </label>
					<!-- <input name="storycategories-dangky" id="storycategories-dangky" type="text" disabled class="" value="dang-cap-nhat"> -->
					<button type="button" class="mb-1" style="font-size: 0.8rem;" id="resetStoryCategorieDangKy">reset</button>
					<input name="storycategories-dangky2" id="storycategories-dangky2" type="text" class="mb-3"  value="" disabled>
					<input name="storycategories-dangky" id="storycategories-dangky" type="text" class="mb-3 d-none"  value="" >
					<select id="chosestorycategories-dangky" name="chosestorycategories-dangky">
						<option value="null" disabled selected>Chưa chọn</option>
						<?php
					    	foreach ($listCategories as  $value) {
					    		echo '<option value="'.$value["category_code"].'">'.$value["category_name"].'</option>';
					    	}
					    ?>
					</select>

					<label for="storydescription-dangky">Mô tả - Tóm tắt: (Description)</label>
					<textarea name="storydescription-dangky" id="storydescription-dangky"></textarea>
					
					
					<div class="text-center mt-4 content-dangky-user text-success">
						<button type="button" class="btn btn-danger mx-2 px-3 py-1" data-dismiss="modal">Hủy Bỏ</button>
						<button type="submit" id="btnTaoMyStoryQuanLy" class="btn btn-success mx-2 px-3 py-1">Đăng ký</button>
					</div>
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
						<p class="m-0">Danh Sách Truyện Của Tôi</p>
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
								<button class="ml-2" id="btnSearchMyStories"><i class="fa fa-search text-dark" aria-hidden="true"></i></button>
						</div>
					</div>
					<div class="table-list-quanly">
						<ul class="grid-6 list-story pt-3 px-lg-5" style ="min-height: 650px" id="listMyStoriesQuanLy">
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