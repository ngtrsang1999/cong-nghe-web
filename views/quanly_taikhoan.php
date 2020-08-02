<?php
	if (isset($_POST['btn-submit-thongtin'])){
		if(check_login($connect,$_SESSION['user']['user_id'], $_POST["txtPassWord"])){
			$data = array();
			$data["user_name"] = trim($_POST["txtHoTen"]);
			$data["user_email"] = trim($_POST["txtEmail"]);
			$data["user_birthday"] = trim($_POST["txtNgaySinh"]);
			$data["user_address"] = trim($_POST["txtDiaChi"]);
			$data["user_numberphone"] = trim($_POST["txtNumberPhone"]);
			$data["gioi_tinh"] = trim($_POST["txtGioiTinh"]);
			updateThongTin($connect, $_SESSION['user']['user_id'], $data);
			check_login($connect,$_SESSION['user']['user_id'], $_POST["txtPassWord"]);
			// echo '<pre>';
			// print_r($_SESSION['user']);
			// echo '</pre>';
		}else{

			echo'<script type="text/javascript">
				$(document).ready(function(){
					alert("Mật khẩu không đúng");
				}); 
			</script>';
		}		
	}
	$thongtintaikhoan = $_SESSION['user'];
	$gioi_tinh = $_SESSION['user']['gioi_tinh'];
?>
<!-- HTML phần nội dung -->
    <section class="main-content">
        <div class="container row mx-auto mb-3 p-4 center-quanlytaikhoan" style="background-color: #fff">
			<div class="col-md-4 box-left d-none d-md-block">
				<ul class="">
					<li><a style="color: #fd7e14"><i class="fa fa-user-circle  mr-2" aria-hidden="true"></i> Quản lí tài khoản</a></li>
					<li><a id="link-change-pw" data-toggle="modal" data-target="#modal-change-pw"><i class="fa fa-lock mr-2" aria-hidden="true"></i> Đổi mật khẩu</a></li>
				</ul>
			</div>

			<div class="col-md-8 box-right">
				<form action="" class="p-4" method="POST" id="form-quanly-taikhoan">
					<p class="title-quanly">Thông tin tài khoản </p>

					<label for="">
						UserID:
					</label>
					<input type="text" name="txt-userID" id="txt-userID" value="<?php echo $thongtintaikhoan["user_id"]; ?>" disabled style="cursor: not-allowed;">
						
					<label for="">Loại tài khoản :</label>
					<input type="text" name="txt-userGroup" id="txt-userGroup" value="<?php echo getNameGroup($connect ,$thongtintaikhoan["user_group"]); ?>" disabled style="cursor: not-allowed;">

					<p class="title-quanly">Thông tin cá nhân </p>

					<label for="txtHoTen">Họ tên :</label>
					<input type="text" name="txtHoTen" id="txtHoTen" placeholder="Nhập họ tên" value="<?php echo $thongtintaikhoan["user_name"]; ?>">

					<label for="txtEmail">Email :</label>
					<p id="warning-email" class="text-danger mb-1" style="font-size: 0.8rem">Đây không phải địa chỉ email</p>
					<input type="email" name="txtEmail" id="txtEmail" placeholder="Nhập Email" value="<?php echo $thongtintaikhoan["user_email"]; ?>">

					<label for="txtNumberPhone">Số điện thoại :</label>
					<input type="number" name="txtNumberPhone" id="txtNumberPhone" placeholder="Nhập số điện thoại" value="<?php echo $thongtintaikhoan["user_numberphone"]; ?>">

					<label for="txtNgaySinh">Ngày sinh :</label>
					<input type="date" name="txtNgaySinh" id="txtNgaySinh" value="<?php echo $thongtintaikhoan["user_birthday"]; ?>">
					<label for="" style="display: block; width: 100%">Giới tính :</label>
					<div class="radio-gioitinh">
						<label for="" class="mx-3"><input value="nam" class="radio-btn" type="radio" name="txtGioiTinh" <?php if($gioi_tinh == 'nam') echo "checked"; ?>> Nam</label>
						<label for="" class="mx-3"><input value="nu" class="radio-btn" type="radio" name="txtGioiTinh" <?php if($gioi_tinh == 'nu') echo "checked"; ?>> Nữ</label>
					</div>
					<label for="txtDiaChi">Địa chỉ :</label>
					<input type="text" name="txtDiaChi" id="txtDiaChi" placeholder="Nhập địa chỉ" value="<?php echo $thongtintaikhoan["user_address"]; ?>">
					<label for="txtPassWord">Nhập mật khẩu hiện tại :</label>
					<input type="password" name="txtPassWord" id="txtPassWord" class="reset-form ip-just-a-zA-Z0-9_" placeholder="Nhập mật khẩu hiện tại">
					<p id="warning-submit" class="text-danger mb-1" style="font-size: 0.8rem">Không được để trống các trường</p>
					<input class="px-4 btn-danger" type="submit" value="Lưu" name="btn-submit-thongtin" id="btn-submit-thongtin" style="width: auto;">
				</form>
			</div>
        </div>
    </section>
    