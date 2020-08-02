<?php
	session_start();
    include_once('../../mdUser.php');	
    include_once('../../mdGroupUser.php');
    $user_id = $_POST['user_code'];
    $user_password = $_POST['user_password'];
    $user_group = $_POST['user_group'];
    if(isset_user($connect,$user_id)){
    	//Tên tài khoản đã tồn tại
    	echo 'Tên tài khoản đã tồn tại';
    }else{
    	// tên tài khoản chưa tồn tại => tiến hành tạo tài khoản
    	if(register_user($connect,$user_id, $user_password, $user_group)){
    		//Tạo tài khoản thành công;
    		echo '1';
    	}else{
    		//Tạo tài khoản thất bại
    		echo 'Tạo tài khoản thất bại';
    	}
    }
?>