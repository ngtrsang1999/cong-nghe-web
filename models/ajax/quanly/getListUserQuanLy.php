<?php 
	session_start();
    include_once('../../mdUser.php');	
    include_once('../../mdGroupUser.php');
    $userID = $_POST['userID'];
	$groupUser = $_POST['groupUser'];
    $ret = getListUserSearchQuanLy($connect ,$userID, $groupUser);
    $output = '';
    $i = 1;
    foreach ($ret as $value) {
        $groupName =  getNameGroup($connect ,$value["user_group"]);
        $output .= '
            <tr>
                <td>'.$i.'</td>
                <td>'.$value["user_id"].'</td>
                <td>'.$value["user_name"].'</td>
                <td data-userid = "'.$value["user_id"].'" class="txtNameUserGroup">'.$groupName.'</td>';

            if($value["user_status"] != 'lock'){
                $output .= '
                <td data-userid = "'.$value["user_id"].'" class = "text-success textUserStatus">Đang hoạt động</td>
                <td>
                    <i data-userid = "'.$value["user_id"].'" class="fa fa fa-lock ml-2 text-danger btnevenLock" title="Khóa tài khoản" aria-hidden="true" data-toggle="modal" data-target="#modal-quanlyuser" onclick="showModalcomfirmLock(this)"></i>               
                    <i data-userid = "'.$value["user_id"].'" class=" text-primary fa fa-eye ml-2 " title="Xem thông tin tài khoản" aria-hidden="true" data-toggle="modal" data-target="#modal-quanlyuser" onclick ="showModalInForUser(this)"></i>
                </td>
            </tr>';
            }else{
                 $output .= '
                <td data-userid = "'.$value["user_id"].'" class = "text-danger textUserStatus">Đang bị khóa</td>
                <td>
                    <i data-userid = "'.$value["user_id"].'" class="fa fa fa-unlock-alt ml-2 text-success btnevenLock" title="Mở khóa tài khoản" aria-hidden="true" data-toggle="modal" data-target="#modal-quanlyuser" onclick="showModalcomfirmUnLock(this)"></i>
                    <i data-userid = "'.$value["user_id"].'" class="text-primary fa fa-eye ml-2 btnViewsInForUser" title="Xem thông tin tài khoản" aria-hidden="true" data-toggle="modal" data-target="#modal-quanlyuser" onclick ="showModalInForUser(this)"></i>
                </td>
            </tr>';
            }
            $i++;
    }
    if($output == ''){
        echo '<p class="text-danger text-center mt-4" style ="font-size: 30px; position: absolute;">Không tìm thấy kết quả phù hợp</p>';
    }else{
        echo $output ;
    }
?>
