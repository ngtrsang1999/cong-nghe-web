<?php
	$listGroupAtc = getListGroupAtc($connect);
?>	
		<!-- modal -->
		<div class="modal fade" id="modal-quanlyuser">
	        <div class="modal-dialog modal-xl">
	          <div class="modal-content content-modal-quanLyUser">			
	          	<form action="" class="p-4" method="POST" id="formXemThongTinUser" >
	          		<button type="button" class="close" data-dismiss="modal" style="font-size: 40px; line-height: 1; margin-top: -25px; margin-right: -15px;">&times;</button>
	          		<p class="text-center text-primary" style="font-size: 30px;">Tạo tài khoản</p>
	          		<p class="text-danger text-center d-none warningDangKyTaiKhoanQuanLy" style="font-size: 20px;">Tên đăng nhập đã tồn tại</p>
	          		<label style="font-size: 24px;" for="userName-dangky">Tên đăng nhập: </label>
	          		<input name="userName-dangky" id="userName-dangky" style="font-size: 18px;" type="text" class="mb-3 ip-just-a-zA-Z0-9_" placeholder="Nhập tên đăng nhập">


	          		<label style="font-size: 24px;" for="userpassword-dangky">Mật khẩu: </label>
	          		<input name="userpassword-dangky" id="userpassword-dangky" type="password" style="font-size: 18px;" class="mb-3 ip-just-a-zA-Z0-9_" placeholder="Nhập mật khẩu">


	          		<label style="font-size: 24px;" for="rp-userpassword-dangky">Nhập lại mật khẩu: </label>
	          		<input name="rp-userpassword-dangky" id="rp-userpassword-dangky" style="font-size: 18px;" type="password" class="mb-3 ip-just-a-zA-Z0-9_" placeholder="Nhập lại mật khẩu">
					
					<label style="font-size: 24px;" for="">Chọn nhóm tài khoản: </label>
	          		<select style="font-size: 18px;" id="chose-new-usergroup">
					    <option value="null" selected>Chưa chọn</option>
					    <option value="user">User</option>
					    <option value="quan-tri-vien">Quản trị Viên</option>
					    <option value="admin">Admin</option>
					</select>
					<div class="text-center mt-4 content-dangky-user text-success">
						<button type="button" class="btn btn-danger mx-2 px-3 py-1" data-dismiss="modal">Hủy Bỏ</button>
						<button type="button" class="btn btn-success mx-2 px-3 py-1" onclick ="taoTaiKhoanQuanLy()">Đăng ký</button>
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
						<p class="m-0">Danh Sách Các Thống Kê: </p>
					</div>

					<div class="loc-quanly">
						<div>
							<a class="btn btn-success" href="./quanly.php?content=mystories">Quay về</a>
						</div>
					</div>
					<div class="table-list-quanly">
						<table class="table table-bordered">
						    <thead>
						      <tr>
						        <th>STT</th>
						        <th>Nội Dung Thống Kê</th>
						        <th>Kết Quả Thống Kê</th>
						      </tr>
						    </thead>
						    <tbody id="bodyListGroupQuyen">
								<tr>
									<td>1</td>
									<td>Số Tài Khoản</td>
									<td>6</td>
								</tr>
								<tr>
									<td>2</td>
									<td>Số Thể Loại</td>
									<td>10</td>
								</tr>
								<tr>
									<td>3</td>
									<td>Số truyện</td>
									<td>20</td>
								</tr>
								<tr>
									<td>4</td>
									<td>Tổng Lượt Views</td>
									<td>20320992</td>
								</tr>
								<tr>
									<td>5</td>
									<td>Tổng Lượt Likes</td>
									<td>20232</td>
								</tr>

								<tr>
									<td>6</td>
									<td>Tổng Lượt Followes</td>
									<td>5032</td>
								</tr>
								
								<tr>
									<td>7</td>
									<td>Tổng Lượt Views Ngày</td>
									<td>52</td>
								</tr>
								
								<tr>
									<td>8</td>
									<td>Tổng Lượt Views Tuần</td>
									<td>102</td>
								</tr>

								<tr>
									<td>9</td>
									<td>Tổng Lượt Views Tháng</td>
									<td>102</td>
								</tr>
								
								<tr>
									<td>10</td>
									<td>Tổng Lượt Views Năm</td>
									<td>102</td>
								</tr>
						    </tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<!-- end main -->
	</div>
</section>