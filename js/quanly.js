function loadListUserQuanLy(){
	var userID = $('#userIDSearch').val();
	var groupUser = $('#groupUserSearch').val();
	// $('.truyen-moi-cap-nhat .list-story').html(data);
	$.ajax({
			url: "models/ajax/quanly/getListUserQuanLy.php",
			method: "POST",
			data:{userID:userID, groupUser:groupUser},
			success:function(data){
				$('#bodyTableListUserQuanLy').html(data);
			}
		});

}

function loadListMyStoriesQuanLy(){
	var keySearch = $('#keySearchQuanLy').val();
	var theloai = $('#categorySearchQuanLy').val();
	var trangthai = $('#statusSearchQuanLy').val();
	$.ajax({
			url: "models/ajax/quanly/getListMyStoriesQuanLy.php",
			method: "POST",
			data:{keySearch:keySearch, theloai:theloai, trangthai:trangthai},
			success:function(data){
				$('#listMyStoriesQuanLy').html(data);
				$('.lazy-img').Lazy();
			}
		});

}

function loadListAllStoriesQuanLy(){
	var keySearch = $('#keySearchQuanLy').val();
	var theloai = $('#categorySearchQuanLy').val();
	var trangthai = $('#statusSearchQuanLy').val();
	$.ajax({
			url: "models/ajax/quanly/getListAllStories.php",
			method: "POST",
			data:{keySearch:keySearch, theloai:theloai, trangthai:trangthai},
			success:function(data){
				$('#listAllStoriesQuanLy').html(data);
				$('.lazy-img').Lazy();
			}
		});

}




function showModalInForUser(thise){
	var userID = $(thise).attr('data-userid');
	$.ajax({
			url: "models/ajax/quanly/loadInForUser.php",
			method: "POST",
			data:{userID:userID},
			success:function(data){
				$('#formXemThongTinUser').html(data);
			}
		});
}

function saveChangeUserGroupQuanLy(thise){
	var userID = $('#ifFoUserID').val();
	var  new_group = $('#chose-new-usergroup').val();
	if(new_group != 'null'){
		$.ajax({
			url: "models/ajax/quanly/saveChangeUserGroup.php",
			method: "POST",
			data:{new_group:new_group, userID:userID},
			success:function(data){
				$('#inForUserGroup').attr('value', data);
				$('.txtNameUserGroup[data-userid='+userID+']').html(data);
			}
		});
	}
}

function showModalcomfirmLock(thise){
	var userID = $(thise).attr('data-userid');
	$.ajax({
			url: "models/ajax/quanly/getFormComfirmLockUser.php",
			method: "POST",
			data:{userID:userID},
			success:function(data){
				$('#formXemThongTinUser').html(data);
			}
		});
}

function LockUser(thise){
	var userID = $(thise).attr('data-userid');
	$.ajax({
			url: "models/ajax/quanly/lockUser.php",
			method: "POST",
			data:{userID:userID},
			success:function(data){
				$('.content-confirm-user').html('Đã khóa tài khoản');
				$('.btnevenLock[data-userid='+userID+']').attr('onclick', 'showModalcomfirmUnLock(this)');
				$('.btnevenLock[data-userid='+userID+']').attr('class', 'fa fa fa-unlock-alt ml-2 text-success btnevenLock');
				$('.textUserStatus[data-userid='+userID+']').attr('class', 'text-danger textUserStatus');
				$('.textUserStatus[data-userid='+userID+']').html('Đang bị khóa');
			}
		});
}

function unLockUser(thise){
	var userID = $(thise).attr('data-userid');
	$.ajax({
		// var query = '.btnOpenLockUser[data-userid=""]';
			url: "models/ajax/quanly/unLockUser.php",
			method: "POST",
			data:{userID:userID},
			success:function(data){
				$('.content-confirm-user').html('Đã mở khóa tài khoản');
				$('.btnevenLock[data-userid='+userID+']').attr('onclick', 'showModalcomfirmLock(this)');
				$('.btnevenLock[data-userid='+userID+']').attr('class', 'fa fa fa-lock ml-2 text-danger btnevenLock');
				$('.textUserStatus[data-userid='+userID+']').attr('class', 'text-success textUserStatus');
				$('.textUserStatus[data-userid='+userID+']').html('Đang hoạt động');
			}
		});
}

function showModalcomfirmUnLock(thise){
	var userID = $(thise).attr('data-userid');
	$.ajax({
			url: "models/ajax/quanly/getFormComfirmUnLockUser.php",
			method: "POST",
			data:{userID:userID},
			success:function(data){
				$('#formXemThongTinUser').html(data);
			}
		});
}
// xóa truyện của tôi
function showFormComFirmDeleteMyStory(thise){
	$('.alertDeleteMyStory').hide();
	var story_code = $(thise).attr('data-storycode');
	$('.btnDeleteMyStoryQuanLy').attr('data-storycode', story_code);
}

function deleteMyStoryQuanLy(story_code){
	$.ajax({
			url: "models/ajax/quanly/deleteMyStoryQuanLy.php",
			method: "POST",
			data:{story_code:story_code},
			success:function(data){
				if(data == '1'){
					$('.alertDeleteMyStory').html('Thành công');
					$('.alertDeleteMyStory').css('color','green');
					location.reload();
				}else{
					$('.alertDeleteMyStory').html('Thất bại');
					$('.alertDeleteMyStory').css('color','red');
				}
				$('.alertDeleteMyStory').show();
			}
		});
}
function showModalDangKyTaiKhoanQuanLy(){
	$.ajax({
			url: "models/ajax/quanly/getFormTaoTaiKhoan.php",
			method: "POST",
			data:{},
			success:function(data){
				$('#formXemThongTinUser').html(data);
			}
		});
}

function showModalTaoTruyenMoi(){
}

function taoTaiKhoanQuanLy(){
	$('.successDangKyTaiKhoanQuanLy').hide();
	$('.warningDangKyTaiKhoanQuanLy').hide();
	var user_code = $('#userName-dangky').val();
	var user_password = $('#userpassword-dangky').val();
	var user_password_rp = $('#rp-userpassword-dangky').val();
	var user_group = $('#chose-usergroup').val();
	if(user_code =='' ||user_password =='' ||user_password_rp =='' ||user_group =='null'){
		//Kiểm tra cá trường trống 
		$('.warningDangKyTaiKhoanQuanLy').html('Không được để trống các trường và phải chọn loại tài khoản');
		$('.warningDangKyTaiKhoanQuanLy').show();
	}else{
		if(user_password != user_password_rp){
			// kiểm tra mật khẩu nhập lại đã đúng chưa
			$('.warningDangKyTaiKhoanQuanLy').html('Mật khẩu nhập lại không đúng');
			$('.warningDangKyTaiKhoanQuanLy').show();
		}else{
			$.ajax({
				url: "models/ajax/quanly/taoTaiKhoan.php",
				method: "POST",
				data:{user_code:user_code, user_password:user_password, user_group:user_group},
				success:function(data){
					if(data != '1'){
						$('.warningDangKyTaiKhoanQuanLy').html(data);
						$('.warningDangKyTaiKhoanQuanLy').show();
					}else{
						$('.successDangKyTaiKhoanQuanLy').show();
					}
				}
			});
		}

	}
}

// Hiện ảnh đã chọn
function showimgavatar(input){
	if (input.files && input.files[0]) {
	    var reader = new FileReader();

	    reader.onload = function (e) {
	        $('#avatarTaoMyStory')
	            .attr('src', e.target.result);
	    };

	    reader.readAsDataURL(input.files[0]);
	}
}
function resetMyStoryCategoriesDangKy(){
	$('#storycategories-dangky').val('');
	$('#storycategories-dangky2').val('');
	$('#chosestorycategories-dangky option').prop('disabled', false);
	$('#chosestorycategories-dangky option[value=null]').prop('disabled', true);
}

function resetCategoriesEdit(){
	$('#storyCategoriesEdit').prop('disabled', false);
	$('#ipStoryCategoriesEdit').val('');
	$('#ipStoryCategoriesEdit2').val('');
	$('#storyCategoriesEdit option').prop('disabled', false);
	$('#storyCategoriesEdit option[value=null]').prop('disabled', true);
}


// Xóa dấu 1 chuỗi
function removeAccents(str) {
	str = str.replace(/\s+/g, ' ');
  var AccentsMap = [
    "aàảãáạăằẳẵắặâầẩẫấậ",
    "aAÀẢÃÁẠĂẰẲẴẮẶÂẦẨẪẤẬ",
    "dđ", "dĐĐ",
    "eèẻẽéẹêềểễếệ",
    "eEÈẺẼÉẸÊỀỂỄẾỆ",
    "iìỉĩíị",
    "iIÌỈĨÍỊ",
    "oòỏõóọôồổỗốộơờởỡớợ",
    "oOÒỎÕÓỌÔỒỔỖỐỘƠỜỞỠỚỢ",
    "uùủũúụưừửữứự",
    "uUÙỦŨÚỤƯỪỬỮỨỰ",
    "yỳỷỹýỵ",
    "yYỲỶỸÝỴ",
    "- "
  ];
  for (var i=0; i<AccentsMap.length; i++) {
    var re = new RegExp('[' + AccentsMap[i].substr(1) + ']', 'g');
    var char = AccentsMap[i][0];
    str = str.replace(re, char);
  }
  return str.toLowerCase();
}

//Kiểm tra thông tin form tạo truyện ;
function editMyStory(){
		$('.warningEditMyStory').hide();
		var old_storyid = $('p[data-thisStoryID]').attr('data-thisStoryID');
		var story_name = $('#storyNameEdit').val();
		// var story_code = $('#storyCodeEdit').val();
		var another_name_story = $('#storyOrtherNameEdit').val();
		var story_author_name = $('#storyAuthorNameEdit').val();
		var story_status = $('#storyStatusEdit').val();
		var story_categories = $('#ipStoryCategoriesEdit').val();
		var story_description = $('#storyDescriptionEdit').val();

		if(story_name =='' || another_name_story =='' 
			|| story_author_name ==''|| story_categories ==''|| story_description =='' || story_status ==''){
			//Kiểm tra cá trường trống 
			$('.warningEditMyStory').html('Không được để trống các trường và phải chọn trạng thái và thể loại cho truyện');
			$('.warningEditMyStory').show();
		}else{
			$.ajax({
					url: "models/ajax/quanly/editMyStory.php",
					method: "POST",
					data:{
						story_name:story_name,
						// story_code:story_code,
						another_name_story:another_name_story, 
						story_author_name:story_author_name,
						story_categories:story_categories, 
						story_description:story_description,
						story_status:story_status,
						old_storyid:old_storyid
					},
					success:function(data){
						if(data == '1'){
							alert('Sửa truyện thành công');
							location.reload();
						}else{
							alert('Thất bại !');
							location.reload();
						}
					}
				});
		}
}

function ckeckformtaoMyStory(){
		$('#btnTaoMyStoryQuanLy').prop('disabled', true);
		$('.successTaoMyStoryQuanLy').hide();
		$('.warningTaoMyStoryQuanLy').hide();
		var story_name = $('#storyName-dangky').val();
		var story_code = $('#storyid-dangky').val();
		var story_avatar = $('#storyAvater-dangky').val();
		var another_name_story = $('#storyorthername-dangky').val();
		var story_author_name = $('#storyauthorname-dangky').val();
		var story_author_id = $('#storyauthorid-dangky').val();
		var story_status = $('#storystatus-dangky').val();
		var story_categories = $('#storycategories-dangky').val();
		var story_description = $('#storydescription-dangky').val();

		if(story_name =='' || story_code =='' ||story_avatar =='' || another_name_story =='' 
			|| story_author_name ==''|| story_categories ==''|| story_description ==''){
			//Kiểm tra cá trường trống 
			$('.warningTaoMyStoryQuanLy').html('Không được để trống các trường và phải chọn ảnh và thể loại cho truyện');
			$('.warningTaoMyStoryQuanLy').show();
		}else{
			$.ajax({
				url: "models/ajax/quanly/issetStoryCode.php",
				method: "POST",
				data:{story_code:story_code},
				success:function(data){
					if(data == '1'){
						$('.warningTaoMyStoryQuanLy').html("ID truyện đã tồn tại. vui lòng chọn tên truyện khác!");
						$('.warningTaoMyStoryQuanLy').show();
					}else{
						$('.successTaoMyStoryQuanLy').show();
						$('#btnTaoMyStoryQuanLy').prop('disabled', false);
					}
				}
			});
		}
}


function taoMyStoryQuanLy(){
		// $('#storyid-dangky').prop('disabled', false);
		// $('#storyauthorid-dangky').prop('disabled', false);
		// $('#storystatus-dangky').prop('disabled', false);
		// $('#storycategories-dangky').prop('disabled', false);
}
$(document).ready(function(){
	//load danh sách user ở trang quản lý user
	loadListUserQuanLy();
	$('#btnSearchUser').click(function(){
		loadListUserQuanLy();
	});

	// load danh sách truyện ở trang quản lý truyện của tôi
	loadListMyStoriesQuanLy();
	$('#btnSearchMyStories').click(function(){
		loadListMyStoriesQuanLy();
	});

	//load danh sách truyện allstories
	loadListAllStoriesQuanLy();
	$('#btnSearchAllStories').click(function(){
		loadListAllStoriesQuanLy();
	});

	$('.btnDeleteMyStoryQuanLy').click(function(){
		//Tiến hành xóa truyện của tôi
		var story_code = $(this).attr('data-storycode');
		deleteMyStoryQuanLy(story_code);
	});

	$('#storyAvater-dangky').change(function(){
		showimgavatar(this);
	});

	//Tự tạo id khi nhập tên truyện
	$('#storyName-dangky').keyup(function(){
		var str = this.value;
			str = removeAccents(str);
		$('#storyid-dangky').attr('value', str);
		$('#storyid-dangky2').attr('value', str);
	});

	// $('#storyNameEdit').keyup(function(){
	// 	var str = this.value;
	// 		str = removeAccents(str);
	// 	$('#storyCodeEdit').attr('value', str);
	// 	$('#storyCodeEdit2').attr('value', str);
	// });


	$("#resetStoryCategorieDangKy").click(function(){
		resetMyStoryCategoriesDangKy();
		$('#btnTaoMyStoryQuanLy').prop('disabled', true);
		$('.warningTaoMyStoryQuanLy').html('Không được để trống các trường và phải chọn ảnh và thể loại cho truyện');
		$('.warningTaoMyStoryQuanLy').show();
		$('.successTaoMyStoryQuanLy').hide();
	});

	$("#resetCategoriesEdit").click(function(){
		resetCategoriesEdit();
	});
	// thêm thể loại khi chọn quản lý mystory
	$('#chosestorycategories-dangky').change(function(){
		var categorycode = this.value;
		var strCategories = $('#storycategories-dangky').val();
		if(strCategories == ""){
			strCategories = strCategories+categorycode;
		}else{
			strCategories = strCategories+';'+categorycode;
		}

		$('#chosestorycategories-dangky option[value='+categorycode+']').prop('disabled', true);
		$('#storycategories-dangky').val(strCategories);
		$('#storycategories-dangky2').val(strCategories);
	});

	$('#storyCategoriesEdit').change(function(){
		var categorycode = this.value;
		var strCategories = $('#ipStoryCategoriesEdit').val();
		if(strCategories == ""){
			strCategories = strCategories+categorycode;
		}else{
			strCategories = strCategories+';'+categorycode;
		}

		$('#storyCategoriesEdit option[value='+categorycode+']').prop('disabled', true);
		$('#ipStoryCategoriesEdit').val(strCategories);
		$('#ipStoryCategoriesEdit2').val(strCategories);
	});


	// Tạo Truyện mystory
	$('#btnTaoMyStoryQuanLy').prop('disabled', true);
	$('#btnTaoMyStoryQuanLy').click(function(){
		// taoMyStoryQuanLy();
	});
	// Kiểm a các thông tin của truyện đã nhập để tạo
	$('.formTaoMyStory').on('keyup change', function(){
		ckeckformtaoMyStory();
	});
	

	$('.formAddMyChapter').on('keyup change', function(){
		if(ckeckFormTaoMyChapter()){
			$('#btnAddMyChapter').prop('disabled', false);
		}
	});
	// $('.formTaoMyStory').keyup(function(){
	// 	ckeckformtaoMyStory();
	// });

	// show input edit mystory
	$('.edit').click(function(){
		var target = $(this).attr('data-pttarget');
		$(target).prop('disabled', false);
		$('#btnEditMyStory').prop('disabled', false);
	});
	$('#btnEditMyStory').click(function(){
		editMyStory();
	});
});
$('#btnAddMyChapter').prop('disabled', true);
function ckeckFormTaoMyChapter(){
	$('#btnAddMyChapter').prop('disabled', true);
	var check = true;
    $('#warningAddMyChapter').hide();
    var chapterName = $('#chapterNameMyStory').val();
    chapterName = chapterName.trim();
    if(chapterName == ''){
		$('#warningAddMyChapter').html('Phải Nhập tên chapter');
		$('#warningAddMyChapter').show();
    	check = false;
    }
	var listImage = document.getElementsByClassName('ipImageChapter');
	if(check){
		for (var i = 0; i < listImage.length; i++){
	    	if(listImage[i].value == ''){
	    		$('#warningAddMyChapter').html('Phải chọn hết các ảnh');
	    		$('#warningAddMyChapter').show();
	    		check = false;
	    		break;
	    	}
		}
	}

	return check;
}

function addInputImageMyChapter(){
	var number = $('#listImageMychapter').attr('data-numberimg');
	 const numbernew = parseInt(number, 10) + 1;
	$('#listImageMychapter').append('<input type="file" id="imgMyChapter'+number+'" name ="imgMyChapter'+number+'" class ="ipImageChapter">');
	$('#listImageMychapter').attr('data-numberimg',numbernew);
}

function resetInputImageMyChapter(){
	$('#listImageMychapter').html('');
}