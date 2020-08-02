<?php
	$userID = $_POST['userID'];
	echo '
	<button type="button" class="close" data-dismiss="modal" style="font-size: 40px; line-height: 1; margin-top: -25px; margin-right: -15px;">&times;</button>
	<p class="text-center text-primary" style="font-size: 20px;">Bạn có chắc muốn khóa tài khoản này?</p>
	<p class="text-center text-warning" style="font-size: 15px;">Tài khoản này sẽ bị khóa</p>
	<div class="text-center mt-4 content-confirm-user text-success">
		<button type="button" class="btn btn-danger mx-2 px-3 py-1" data-dismiss="modal">Hủy Bỏ</button>
		<button data-userid ="'.$userID.'" type="button" class="btn btn-success mx-2 px-3 py-1" onclick ="LockUser(this)">Đồng Ý</button>
	</div>';
?>