var isset_user = false ;
function show_dangnhap(){
	$('.tab-content .form-login').css('visibility','visible');
	$('.tab-content .form-registration').css('visibility','hidden');
	$('.modal-btn-dangnhap').css({'background-color':'#56ccf2', 'color': '#fff'});
	$('.modal-btn-dangky').css({'background-color':'#fff', 'color': '#007bff'});
}

function show_dangky(){
	$('.tab-content .form-login').css('visibility','hidden');
	$('.tab-content .form-registration').css('visibility','visible');
	$('.modal-btn-dangky').css({'background-color':'#56ccf2', 'color': '#fff'});
	$('.modal-btn-dangnhap').css({'background-color':'#fff', 'color': '#007bff'});
}

function check_form_login(){
	var user_id = $('#email_login').val();
	var user_password = $('#password_login').val();
	if(user_id == ''){
			return false;
	}
	if(user_password == ''){
			return false;
	}
	return true;
}

function check_form_change_pw(){
	var user_password = $('#old_pw').val();
	var new_password = $('#new_pw').val();
	var rp_new_password = $('#repeat_new_pw').val();
	if(user_password == ''){
			return false;
	}
	if(new_password == ''){
			return false;
	}
	if(rp_new_password == ''){
			return false;
	}
	return true;
}

function check_form_quanly_taikhoan(){
	var user_hoten = $('#txtHoTen').val();
	var user_email = $('#txtEmail').val();
	var user_numberphone = $('#txtNumberPhone').val();
	var user_birthday = $('#txtNgaySinh').val();
	var user_gioitinh = $('#txtGioiTinh').val();
	var user_diachi = $('#txtDiaChi').val();
	var user_password = $('#txtPassWord').val();
	if(user_hoten == '' || user_email == '' || user_numberphone == '' 
	|| user_birthday == '' || user_gioitinh == '' || user_diachi == '' || user_password == ''){
			return false;
	}else{
		return true;
	}
}


function xem_description(){
	$('.clearbt').hide();
	var height_p = $('.story-descripstion p').outerHeight();
	var height_d = $('.story-descripstion').outerHeight();
	if(height_p > height_d){
		$('.clearbt').show();
	}else{
		$('.story-descripstion').css('height','auto');
	}
}

$('.btn-dangky, .modal-btn-dangky').on('click', function(){
	$('.warning-register').hide();
	$('.success-register').hide();
	show_dangky();
});
$('.btn-dangnhap, .modal-btn-dangnhap').on('click', function(){
	$('.warning-login').hide();
	show_dangnhap();
});
$('.user-links').hide();

$(document).ready(function(){
	// đăng nhập

	xem_description();
	$('.clearbt button').on('click', function(){
		var height_p = $('.story-descripstion p').outerHeight();
		var height_d = $('.story-descripstion').outerHeight();
		if(height_p > height_d){
			$('.story-descripstion').css('height','auto');
			$('.clearbt button').html('Thu gọn');
		}else{
			$('.story-descripstion').css('height','50px');
			$('.clearbt button').html('Xem thêm');
		}
	});
	$('.warning-login').hide();
	$('#button_login').on('click', function(){
		var user_id = $('#email_login').val();
		var user_password = $('#password_login').val();
		
		if(!check_form_login()){
			$('.warning-login').html('Không được để trống các trường!');
			$('.warning-login').show();
		}else{
			$.ajax({
						url: "models/ajax/login.php",
						method: "POST",
						data:{user_id:user_id, user_password:user_password},
						success:function(data){
							if(data == '1'){
								location.reload();
							}else{
								$('.warning-login').html(data);
								$('.warning-login').show();	
							}
						}
					});

		}
	});

	$('.avatar-user').on('click', function(){
		if($('.user-links').css("display") == 'none'){
			$('.user-links').show();
		}
		else{
			$('.user-links').hide();
		}
	});

	// Đăng xuất

	$('#btn-logout').on('click', function(){
		$.ajax({
						url: "models/ajax/logout.php",
						method: "POST",
						success:function(data){
								location.reload();
						}
					});
	});

	// Đổi mật khẩu
	$('#btn-change-pw, #link-change-pw').on('click', function(){
		$('.warning-change-pw').hide();
		$('.success-change-pw').hide();
	});


	$('#button_change_pw').on('click', function(){
		$('.warning-change-pw').hide();
		$('.success-change-pw').hide();
		var user_password = $('#old_pw').val();
		var new_password = $('#new_pw').val();
		var rp_new_password = $('#repeat_new_pw').val();
		
		if(!check_form_change_pw()){
			$('.warning-change-pw').html('Không được để trống các trường!');
			$('.warning-change-pw').show();
		}else{
			if(new_password != rp_new_password){
				$('.warning-change-pw').html('Xác nhận lại mật khẩu không đúng!');
				$('.warning-change-pw').show();
			}else{
				$.ajax({
							url: "models/ajax/change_pw.php",
							method: "POST",
							data:{user_password:user_password, new_password:new_password},
							success:function(data_pw){
								if(data_pw == 1){
									$('.success-change-pw').html('Đổi Mật khẩu thành công!');
									$('.success-change-pw').show();
								}else{
									$('.warning-change-pw').html(data_pw);
									$('.warning-change-pw').show();
								}
							}
						});
			}

		}
	});
	// end đổi mk

	// Đăng ký tài khoản


	$('#email_register').keyup(function(){
		$('.warning-register').hide();
		$('.success-register').hide();
		var user_id = $('#email_register').val();
		$.ajax({
				url: "models/ajax/isset_user.php",
				method: "POST",
				data:{user_id:user_id},
				success:function(data){
					if(data == 1){
						isset_user = true ;
						$('.warning-register').html('Tên tài khoản đã tồn tại!');
						$('.warning-register').show();
					}else{
						isset_user = false ;
					}
				}
			});
	});
	function check_form_email(str){
		var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/; 
		if (!filter.test(str)){
			return false;
		}else{
			return true;
		}
	}
	function check_form_change_register(){
		var user_id = $('#email_register').val();
		var user_password = $('#password_register').val();
		var rp_user_password = $('#rp_password_register').val();
		if(user_id == ''){
				return false;
		}
		if(user_password == ''){
				return false;
		}
		if(rp_user_password == ''){
				return false;
		}
		return true;

	}
	$('#button_register').on('click', function(){
		$('.warning-register').hide();
		$('.success-register').hide();
		var user_id = $('#email_register').val();
		var user_password = $('#password_register').val();
		var rp_user_password = $('#rp_password_register').val();
		if(!check_form_change_register()){
			$('.warning-register').html('Không được để trống các trường!');
			$('.warning-register').show();
		}else{
			if(isset_user){
				$('.warning-register').html('Tên tài khoản đã tồn tại!');
				$('.warning-register').show();
			}else{

				if(user_password != rp_user_password){
					$('.warning-register').html('Xác nhận lại mật khẩu không đúng!');
					$('.warning-register').show();
				}else{
					$.ajax({
								url: "models/ajax/register_user.php",
								method: "POST",
								data:{user_id:user_id, user_password:user_password},
								success:function(data){
									if(data == 1){
										$('.success-register').html('Đăng ký tài khoản thành công!');
										$('.success-register').show();
									}else{
										$('.warning-register').html('Đăng ký tài khoản thất bại!');
										$('.warning-register').show();
									}
								}
							});

				}


			}

		}

	});

	// end đăng ký tài khoản
	//check input chỉ chó nhập các ký tự a-zA-Z0-9_
	$('.ip-just-a-zA-Z0-9_').keyup(function(){
		if (/\W/g.test(this.value)){
			this.value = this.value.replace(/\W/g, '');
		}
	});
	$('#warning-email').hide();
	$('#txtEmail').change(function(){
		if (!check_form_email(this.value)){
			$('#warning-email').show();
		}else{
			$('#warning-email').hide();
		}
	});

	$('#warning-submit').hide();
	$('#btn-submit-thongtin').prop('disabled', true);
	$('#form-quanly-taikhoan').keyup(function(){
		var email =$('#txtEmail').val();
		// Kiểm tra nếu đã thỏa mã hết thì cho submit
		if(check_form_quanly_taikhoan() && check_form_email(email)){
			$('#btn-submit-thongtin').prop('disabled', false);
			$('#warning-submit').hide();
		}else{
			if(!check_form_quanly_taikhoan()){
				$('#warning-submit').show();
			}else{
				$('#warning-submit').hide();
			}
		}
	});
});


