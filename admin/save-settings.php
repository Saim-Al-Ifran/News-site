<?php

include 'config.php';


if(empty($_FILES['logo']['name'])){
        $logo_file = $_POST['old_logo'];
}else{
    $errors = array();

    $logo_file = $_FILES['logo']['name'];
    $file_size= $_FILES['logo']['size'];
    $file_tmp = $_FILES['logo']['tmp_name'];
    $file_type = $_FILES['logo']['type'];
    $file_ext = strtolower(end(explode('.',$logo_file)));
    $extensions = array("jpeg","jpg","png");

    if(in_array($file_ext,$extensions) === false){
     $errors[]  = "This extension file not allowed,Please choose jpg,jpeg or png";
    }

    if($file_size > 3145728){
              $errors[]="File size must be 3mb or lower";
    }

    if(empty($errors) == true){
            move_uploaded_file($file_tmp,"images/".$logo_file);
    }else{
        print_r($errors);
        die();
    }
}

 


 $sql = "UPDATE settings SET websitename='{$_POST['website_name']}', logo='{$logo_file}',footerdesc='{$_POST['footer_desc']}'  WHERE settings_id = {$_POST['thu']} ";
// echo $sql= " INSERT INTO settings(websitename,logo,footerdesc) VALUES('{$_POST['website_name']}','{$logo_file}','{$_POST['footer_desc']}') ";

$result = mysqli_query($conn, $sql);

 
    header("Location: http://localhost/news-site/admin/settings.php");
 



?>