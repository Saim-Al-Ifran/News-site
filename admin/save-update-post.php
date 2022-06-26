<?php

  include 'config.php';

  if(empty($_FILES['new-image']['name'])){
    $new_name = $_POST['old-image'];
  }else{
    $errors = array();

    $file_name = $_FILES['new-image']['name'];
    $file_size= $_FILES['new-image']['size'];
    $file_tmp = $_FILES['new-image']['tmp_name'];
    $file_type = $_FILES['new-image']['type'];
    $file_ext = strtolower(end(explode('.',$file_name)));
    $extensions = array("jpeg","jpg","png");

    if(in_array($file_ext,$extensions) === false){
     $errors[]  = "This extension file not allowed,Please choose jpg,jpeg or png";
    }

    if($file_size > 3145728){
              $errors[]="File size must be 3mb or lower";

    }
          
    //-------------------------- if an error occur then put $file_name into basename()--------------//

    $new_name = time().'-'.$file_name;
    $target   = "upload/".$new_name; 

    if(empty($errors) == true){
            move_uploaded_file($file_tmp,$target);
    }else{
        print_r($errors);
        die();
    }
  }

   $desc =mysqli_real_escape_string($conn,$_POST["postdesc"]);

   $sql = "UPDATE post SET title='{$_POST["post_title"]}',description='{$desc}', category={$_POST["category"]}, post_img='{$new_name }' WHERE post_id ='{$_POST["pid"]}';";

   if($_POST["old_category"] != $_POST["category"]){
       $sql .= "UPDATE category SET post = post - 1 WHERE category_id = {$_POST["old_category"]};";
       $sql .= "UPDATE category SET post = post + 1 WHERE category_id = {$_POST["category"]};";
     
   }

 

   $result = mysqli_multi_query($conn, $sql) ;


   if($result){
 
    header("Location: http://localhost/news-site/admin/post.php");

   }else{
     echo "QUERY FAILED";
   }







?>
