<?php




     include 'config.php';

//      $sql1 ="SELECT * FROM post WHERE post_id ={$_GET['id']}";
//      $result1 = mysqli_query($conn, $sql1);
//      $row = mysqli_fetch_assoc($result1);

//      // delete any file form folder ///
     
//      unlink("upload/".$row['post_img']);

     $sql1 = "SELECT * FROM post WHERE post_id={$_GET['id']}";
     $result1 = mysqli_query($conn, $sql1);
     $row = mysqli_fetch_assoc($result1);

     unlink("upload/".$row['post_img']);


     $sql = "DELETE FROM post WHERE post_id = {$_GET['id']};";
     $sql .="UPDATE category SET post = post -1 WHERE category_id = {$_GET['cat_id']}";

     $result = mysqli_multi_query($conn, $sql);

     if($result){
           header("Location: http://localhost/news-site/admin/post.php");
     }else{
           echo "QUERY FAILED";
     }


?>