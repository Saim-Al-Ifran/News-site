<?php

include 'config.php';


if(isset($_FILES['fileToUpload'])){
       $errors = array();

       $file_name = $_FILES['fileToUpload']['name'];
       $file_size= $_FILES['fileToUpload']['size'];
       $file_tmp = $_FILES['fileToUpload']['tmp_name'];
       $file_type = $_FILES['fileToUpload']['type'];
       $file_ext = strtolower(end(explode('.',$file_name)));
       $extensions = array("jpeg","jpg","png");

       if(in_array($file_ext,$extensions) === false){
        $errors[]  = "This extension file not allowed,Please choose jpg,jpeg or png";
     
       }

       if($file_size > 3145728){
                 $errors[]="File size must be 3mb or lower";
                
       }
       $new_name= time().'-'.basename($file_name);
       $target = 'upload/'.$new_name;
   
       if(empty($errors) == true){
               move_uploaded_file($file_tmp,$target);
       }else{
           print_r($errors);
           die();
       }
}



session_start();
$title = mysqli_real_escape_string($conn, $_POST['post_title']); 
$description = mysqli_real_escape_string($conn, $_POST['postdesc']); 
$category = mysqli_real_escape_string($conn, $_POST['category']);
$date = date("d M, Y");

$author = $_SESSION['user_id'];


$sql = "INSERT INTO post(title, description, category,	post_date,author,post_img) VALUES('{$title}','{$description}',{$category},'{$date }',{$author},'{$new_name}');";

$sql .= "UPDATE category SET post = post + 1  WHERE category_id = {$category}";




if(mysqli_multi_query($conn, $sql)){
           header("Location: http://localhost/news-site/admin/post.php");
}else{
          echo "<div class ='alert alert-danger'>Query failed</div>";
}


// এখানে  session_start(); না লেখার  কারণে  এবং  প্রথম $sql এ  ;  না দেয়ার কারণে  Error আসছিলো //




















// include 'config.php';


// if(isset($_FILES['fileToUpload'])){

//      $errors = array();

//     $file_name = $_FILES['fileToUpload']['name'];
//     $file_size = $_FILES['fileToUpload']['size'];
//     $file_tmp = $_FILES['fileToUpload']['tmp_name'];
//     $file_type = $_FILES['fileToUpload']['type'];
//     $file_ext  = strtolower(end(explode('.',$file_name)));
//     $extensions = arry("jpeg","jpg","png");

//      if(in_array($file_ext,$extensions) === false){

//              $errors[]= "This type of file is not allowed, Please Choose jpg,jpeg or png";

//      }

//      if($file_size > 3145728){
//         $errors[]= "File Size is higher than 3mb";
//      }

//      if(empty($errors) == true){
//           move_uploaded_file($file_tmp,"upload/".$file_name);
//      }else{
//                    print_r($errors);
//                    die();
//              }

//      }




// $title = mysqli_real_escape_string($conn, $_POST['post_title']);
// $description = mysqli_real_escape_string($conn, $_POST['postdesc']);
// $category = mysqli_real_escape_string($conn, $_POST['category']);
// $date = date("d M, Y");
// $author = $_SESSION['user_id'];


// $sql = "INSERT INTO post(title, description, category,	post_date,author,post_img) VALUES('{$title}','{$description}',{$category},'{$date }',{$author},'{$file_name}')";


?>