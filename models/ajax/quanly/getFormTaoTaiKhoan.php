	<button type="button" class="close" data-dismiss="modal" style="font-size: 40px; line-height: 1; margin-top: -25px; margin-right: -15px;">&times;</button>
	<p class="text-center text-primary" style="font-size: 30px;">Tạo tài khoản</p>
	<p class="text-danger text-center warningDangKyTaiKhoanQuanLy" style="display: none ;font-size: 20px;"></p>
	<p class="text-success text-center successDangKyTaiKhoanQuanLy" style="display: none ;font-size: 20px;">Tạo tài khoản thành công !</p>
	<label style="font-size: 24px;" for="userName-dangky">Tên đăng nhập: </label>
	<input name="userName-dangky" id="userName-dangky" style="font-size: 18px;" type="text" class="mb-3" placeholder="Nhập tên đăng nhập" onkeyup="if(/\W/g.test(this.value)) this.value = this.value.replace(/\W/g, '');">


	<label style="font-size: 24px;" for="userpassword-dangky">Mật khẩu: </label>
	<input name="userpassword-dangky" id="userpassword-dangky" type="password" style="font-size: 18px;" class="" placeholder="Nhập mật khẩu" onkeyup="if(/\W/g.test(this.value)) this.value = this.value.replace(/\W/g, '');">


	<label style="font-size: 24px;" for="rp-userpassword-dangky">Nhập lại mật khẩu: </label>
	<input name="rp-userpassword-dangky" id="rp-userpassword-dangky" style="font-size: 18px;" type="password" class="mb-3" placeholder="Nhập lại mật khẩu" onkeyup="if(/\W/g.test(this.value)) this.value = this.value.replace(/\W/g, '');">

	<label style="font-size: 24px;" for="chose-usergroup">Chọn nhóm tài khoản: </label>
	<select style="font-size: 18px;" id="chose-usergroup" name="chose-usergroup">
		<option value="null" selected>Chưa chọn</option>
		<option value="user">User</option>
		<option value="quan-tri-vien">Quản trị Viên</option>
		<option value="admin">Admin</option>
	</select>
	<div class="text-center mt-4 content-dangky-user text-success">
		<button type="button" class="btn btn-danger mx-2 px-3 py-1" data-dismiss="modal">Hủy Bỏ</button>
		<button type="button" class="btn btn-success mx-2 px-3 py-1" onclick ="taoTaiKhoanQuanLy()">Đăng ký</button>
	</div>
