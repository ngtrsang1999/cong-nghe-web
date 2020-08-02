<?php
function is_img($file)
{
    if (file_exists($file["tmp_name"])) {
        $typeFile = pathinfo($file["name"], PATHINFO_EXTENSION);
        $type_FileAllow = array('png', 'jpg', 'jpeg', 'gif');
        if (in_array(strtolower($typeFile), $type_FileAllow)) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function add_img_story($file)
{
    $typeFile = pathinfo($file["name"], PATHINFO_EXTENSION);
    $name_img = uniqid('img');
    $link_img = './img/story_img/' . $name_img . '.' . strtolower($typeFile);
    move_uploaded_file($file['tmp_name'], $link_img);
    return $link_img;
}

?>