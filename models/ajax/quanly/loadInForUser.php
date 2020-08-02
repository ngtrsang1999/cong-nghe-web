<?php
	session_start();
    include_once('../../mdUser.php');	
    include_once('../../mdGroupUser.php');
    $userID = $_POST['userID'];
    $res = getUserByID($connect, $userID);
    $groupName =  getNameGroup($connect ,$res["user_group"]);
    if(!empty($res)){
    	echo '<button type="button" class="close" data-dismiss="modal">&times;</button>
					<p class="title-quanly my-2">Thông tin tài khoản </p>
					<label for="ifFoUserID">
						UserID:
					</label>
					<input type="text" name="ifFoUserID" id="ifFoUserID" value="'.$res["user_id"].'" disabled style="cursor: not-allowed;">
					<label for="inForUserGroup">Loại tài khoản :</label>
					<input type="text" name="inForUserGroup" id="inForUserGroup" value="'.$groupName.'" disabled style="cursor: not-allowed;"> 
					<label for="chose-new-usergroup">Chọn loại tài khoản mơi:</label>
					<div class="d-flex">
						<select id="chose-new-usergroup">
						    <option value="null">Chưa chọn</option>
						    <option value="user">User</option>
						    <option value="quan-tri-vien">Quản trị Viên</option>
						    <option value="admin">Admin</option>
						</select>
						<span class="bg-success btn ml-2 p-0 px-2" id="btn-change-usergroup" style="font-size: 0.8rem" onclick ="saveChangeUserGroupQuanLy(this)">Lưu</span>
					</div>

					<p class="title-quanly">Thông tin cá nhân </p>

					<label for="txtHoTen">Họ tên :</label>
					<input type="text" name="txtHoTen" id="txtHoTen" disabled value="'.$res["user_name"].'">

					<label for="txtEmail">Email :</label>
					<input type="email" name="txtEmail" id="txtEmail" disabled value="'.$res["user_email"].'">

					<label for="txtNumberPhone">Số điện thoại :</label>
					<input type="number" name="txtNumberPhone" id="txtNumberPhone" disabled  value="'.$res["user_numberphone"].'">

					<label for="txtNgaySinh">Ngày sinh :</label>
					<input type="date" name="txtNgaySinh" id="txtNgaySinh" disabled value="'.$res["user_birthday"].'">
					<label for="txt-gioitinh" style="display: block; width: 100%">Giới tính :</label>
					<input type="text" name="txt-gioitinh" id="txt-gioitinh" value="'.$res["gioi_tinh"].'" disabled style="cursor: not-allowed;">
					<label for="txtDiaChi">Địa chỉ :</label>
					<textarea name="txtDiaChi" id="txtDiaChi" disabled >'.$res["user_address"].'</textarea>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>';
    }else{
    	echo '<p class="text-danger text-center mt-4" style ="font-size: 15px;">Không tìm thấy dữ liệu</p>';
    }

?>

					