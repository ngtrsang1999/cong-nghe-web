<?php
	$thisStory = getStory_byCode($connect, $_GET["id"]);
	$listStatus = getListStatus($connect);
	$strCatergoriesStoryEdit = '';
	$CatergoriesStoryEdit = getCategory_byStoryCode($connect, $_GET["id"]);
	foreach ($CatergoriesStoryEdit as $value) {
		if($strCatergoriesStoryEdit != ''){
			$strCatergoriesStoryEdit .= ';'.$value['category_code'];
		}else{
			$strCatergoriesStoryEdit .= $value['category_code'];
		}
	}
	$listMyStoryChapter = getListChater_byStorycode($connect, $_GET["id"]);

	// echo '<pre>';
	// print_r($_POST);
	// echo '</pre>';
	// echo '<pre>';
	// print_r($_FILES);
	// echo '</pre>';
	if(!empty($_POST["chapterNameMyStory"]) && !empty($_POST["chapterNumberMyChapter"])){		
		$allIsImage = true;
		foreach ($_FILES as $key => $value){
			if(!is_img($_FILES[$key])){
				$allIsImage = false;
				echo "<script>
				$(document).ready(function(){
					alert('Thêm chapter không thành công do các file đã chọn có file không phải file ảnh!');
					location.reload();
				});
				</script>";
				break;
			}
		}

		if($allIsImage){
			$listImageMyChapter = array();
			$data = array();
			$data["chapter_name"] = trim($_POST["chapterNameMyStory"]);
			$data["chapter_number"] = $_POST["chapterNumberMyChapter"];
			$data["story_code"] = $thisStory["story_code"];
			$data["create_at"] = date('Y-m-d H-i-s');
			foreach ($_FILES as $key1 => $value1){
				$listImageMyChapter[] = add_img_story($_FILES[$key1]);
			}

			$data["chapter_content"] = json_encode($listImageMyChapter);
			$res = addChapter($connect,$data);
			if($res){
				updateTimeUpdateStory($connect, $data["story_code"], $data["create_at"]);
				echo "<script>
					$(document).ready(function(){
						alert('Thêm chapter thành công!');
					});
					</script>";
				header("Location: ./quanly.php?content=mystories&id=".$data["story_code"]);
			}else{
				echo "<script>
					$(document).ready(function(){
						alert('Thêm chapter Thất Bại!');
					});
					</script>";
			}

		}
	}
?>
		<!-- end menutop -->
	<span title="Thêm chapter" style=" position: fixed; z-index: 100; border-radius: 50%; width: 100px; height: 100px; cursor: pointer; bottom: 70px; left: 30px;" class="bg-success p-4 text-center" data-toggle="modal" data-target="#modal-quanlyuser" onclick=""><i class="fa fa-plus" aria-hidden="true" style="line-height: 50px;font-size: 40px;"></i></span>
		<!-- modal -->
		<div class="modal fade" id="modal-quanlyuser">
	        <div class="modal-dialog modal-xl">
	          <div class="modal-content content-modal-quanLyUser">			
	          	<form action="" class="p-4 formAddMyChapter" method="POST" id="formXemThongTinUser" enctype="multipart/form-data">	<button type="button" class="close" data-dismiss="modal" style="font-size: 40px; line-height: 1; margin-top: -25px; margin-right: -15px;">×</button>
					<p class="text-center text-primary" style="font-size: 30px;">Tạo chapter mới</p>
					<p class="text-danger" style="font-size: 20px; display: none" id="warningAddMyChapter"></p>
					<label for="">Tên truyện: </label>
					<input name="" id ="" type="text" value="<?php echo $thisStory["story_name"] ?>" disabled>

					<label for="">ID truyện: </label>
					<input name="" id ="" type="text" value="<?php echo $thisStory["story_code"] ?>" disabled>
					
					<label for="">ID tác giả: </label>
					<input name="" id ="" type="text" value="<?php echo $thisStory["story_author_id"] ?>" disabled>

					<label for="chapterNameMyStory">Tên chapter: </label>
					<input name="chapterNameMyStory" id ="chapterNameMyStory" type="text" placeholder="Nhập tên chapter">
					
					<label for="">Number chapter: </label>
					<input name="" id ="" type="text" value="<?php
						if(!empty($listMyStoryChapter)){
							echo floor($listMyStoryChapter[0]["chapter_number"] + 1)or(1);
						}else{
							echo "1";
						}
			
					 ?>" disabled>
					<input class="d-none" name="chapterNumberMyChapter" id ="chapterNumberMyChapter" type="text" value="<?php echo floor($listMyStoryChapter[0]["chapter_number"] + 1); ?>">
					<div>
						<button type="button" class="btn btn-primary my-3" onclick="addInputImageMyChapter()">Thêm ảnh</button>

						<button type="button" class="btn btn-warning my-3" onclick="resetInputImageMyChapter()">Reset</button>
						<ul id="listImageMychapter" data-numberimg = "0">
							
						</ul>
					</div>
					<div class="text-center mt-4 content-dangky-user text-success">
						<button type="button" class="btn btn-danger mx-2 px-3 py-1" data-dismiss="modal">Hủy Bỏ</button>
						<button type="submit" class="btn btn-success mx-2 px-3 py-1" id="btnAddMyChapter">Thêm</button>
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
						<p class="m-0" data-thisStoryID = "<?php echo $thisStory["story_code"] ?>"><?php echo $thisStory["story_name"] ?></p>
					</div>

					<div class="loc-quanly">
						<div>
							<a href="./quanly.php?content=mystorie" class="btn btn-primary">Quay về</a>
						</div>
					</div>
					<div class="table-list-quanly row">
						<div id="inforMyStory" class="col-lg-7 ">
							<p style="font-size: 25px;">Thông tin truyện: </p>
							<p class="text-danger warningEditMyStory" style="display: none">Cảnh Báo: Không để trống</p>
							<label for="storyNameEdit">Tên truyện: </label>
							<button class="edit btn-info" data-pttarget ="#storyNameEdit" style="font-size: 0.8rem">edit</button>
							<input name="storyNameEdit" id ="storyNameEdit" class="editMyStoryHere" type="text"  value="<?php echo $thisStory["story_name"] ?>" disabled>
							
							<div class="my-4">
	                            <span>Thống kê:</span>
	                            <span class="sp01 ml-2"><i class="fa fa-thumbs-up" aria-hidden="true"></i> <span class="sp02 number-like"><?php echo $thisStory["count_likes"] ?></span></span>
	                            <span class="sp01 ml-2"><i class="fa fa-heart" aria-hidden="true"></i> <span class="sp02 number-followes"><?php echo $thisStory["count_followes"] ?></span></span>
	                            <span class="sp01 ml-2"><i class="fa fa-eye" aria-hidden="true"></i> <span class="sp02"><?php echo $thisStory["count_views"] ?></span></span>
	                        </div>
							<label for="">Cập nhật vào: </label>
							<input type="text" value="<?php echo $thisStory["update_at"] ?>" disabled>

							<label for="storyCodeEdit">ID truyện: </label>
							<input name="storyCodeEdit2" id ="storyCodeEdit2" type="text" value="<?php echo $thisStory["story_code"] ?>" disabled>
							<input name="storyCodeEdit" id ="storyCodeEdit" type="text" value="<?php echo $thisStory["story_code"] ?>" class = "d-none">
		
							<label for="">Avatar truyện: </label>
							<img src="<?php echo $thisStory["story_avatar"] ?>" alt="<?php echo $thisStory["story_name"] ?>">

							<label for="storyStatusEdit">Trạng thái: </label>					
							<button class="edit btn-info" data-pttarget ="#storyStatusEdit" style="font-size: 0.8rem">edit</button>
							<select id="storyStatusEdit" name="storyStatusEdit" disabled>
								<?php
							    	foreach ($listStatus as  $value) {
							    		if($value["status_code"] == $thisStory["story_status"]){
							    			$status_select = "selected";
							    		}else{
							    			$status_select ="";
							    		}
							    		echo '<option value="'.$value["status_code"].'" '.$status_select.'>'.$value["status_name"].'</option>';
							    	}
							    ?>
							</select>

							<label for="">Tình trạng: </label>
							<input type="text" value="<?php echo $thisStory["tinh_trang"] ?>" disabled>
							
							<label for="storyOrtherNameEdit">Tên khác của truyện:(Các tên cách nhau dấu ' ; ') </label>
							<button class="edit btn-info" data-pttarget ="#storyOrtherNameEdit" style="font-size: 0.8rem">edit</button>
							<input id="storyOrtherNameEdit" name="storyOrtherNameEdit" type="text" value="<?php echo $thisStory["another_name_story"] ?>" disabled>

							<label for="storyAuthorNameEdit">Tên tác giả: (Các tên cách nhau dấu ' ; ')</label>
							<button class="edit btn-info" data-pttarget ="#storyAuthorNameEdit" style="font-size: 0.8rem">edit</button >
							<input id="storyAuthorNameEdit" name = "storyAuthorNameEdit" type="text" value="<?php echo $thisStory["story_author_name"] ?>" disabled>
							
							<label for="">ID tác giả: </label>
							<input type="text" value="<?php echo $thisStory["story_author_id"] ?>" disabled>

							<label for="ipStoryCategoriesEdit">Thể loại: </label>
							<button class="edit btn-info" data-pttarget ="#storyCategoriesEdit" style="font-size: 0.8rem" onclick="resetCategoriesEdit()">edit</button>
							<button type="button" class="mb-1" style="font-size: 0.8rem;" id="resetCategoriesEdit">reset</button>
							<input name="ipStoryCategoriesEdit2" id="ipStoryCategoriesEdit2" type="text" class="mb-3"  value="<?php echo $strCatergoriesStoryEdit ?>" disabled>
							<input name="ipStoryCategoriesEdit" id="ipStoryCategoriesEdit" type="text" class="mb-3 d-none"  value="<?php echo $strCatergoriesStoryEdit ?>" >
							<select id="storyCategoriesEdit" name="storyCategoriesEdit" disabled>
								<option value="null" disabled selected>Chưa chọn</option>
								<?php
							    	foreach ($listCategories as  $value) {
							    		echo '<option value="'.$value["category_code"].'">'.$value["category_name"].'</option>';
							    	}
							    ?>
							</select>

							
							<label for="storyDescriptionEdit">Mô tả - Tóm tắt: (Description)</label>
							<button class="edit btn-info" data-pttarget ="#storyDescriptionEdit" style="font-size: 0.8rem">edit</button>
							<textarea name="storyDescriptionEdit" id="storyDescriptionEdit" disabled><?php echo $thisStory["story_description"] ?></textarea>

							<button class="btn-primary btn" id="btnEditMyStory" disabled>Lưu thay đổi</button>
							<button class="btn-danger btn" onclick="location.reload()">Hủy thay đổi</button>


						</div>
						<div id="inforMyStoryChapters" class="col-lg-5">
							<p style="font-size: 25px;">Danh sách các chapter: </p>
							<ul class="m-0">
								<li class="d-flex"> 
                                    <a style="color:#f18121">Tên chapter : </a>
                                    <p class="ml-auto" style="color:#f18121">Thời gian cập nhật</p>
                                </li>
								<?php
								foreach ($listMyStoryChapter as $value) {
									echo '<li class="d-flex"> 
		                                    <a href="read_story.php?id='.$value["story_code"].'&chapter='.$value["chapter_number"].'" target ="_blank">'.$value["chapter_name"].'</a>
		                                    <p class="ml-auto">'.$value["create_at"].'</p>
		                                </li>';
								}
								?>
								<!-- <li class="d-flex"> 
                                    <a href="read_story.php?id=">asd asd asdasd áchap ter1</a>
                                    <p class="ml-auto">2020-12-12 12:12:12</p>
                                </li> -->
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end main -->
	</div>
</section>