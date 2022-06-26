<?php

  include 'config.php';

  session_start();
  if($_SESSION['user_role'] != 1){
         header("Location: http://localhost/news-site/admin/post.php");
  }
   
  $id= $_GET['deleteid'];

  if(isset($_GET['deleteid'])){
           
         $sql="DELETE FROM user WHERE user_id=$id";
         $result = mysqli_query($conn,$sql);

         header("Location: http://localhost/news-site/admin/users.php");
  }


?>