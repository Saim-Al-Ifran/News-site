<?php

include "config.php";
session_start();
if($_SESSION['user_role'] != 1){
       header("Location: http://localhost/news-site/admin/post.php");
}
$id = $_GET['id'];


if(isset($_GET['id'])){
       
    $sql = "DELETE FROM category WHERE category_id = $id";
    $result = mysqli_query($conn,$sql);
    header("Location: http://localhost/news-site/admin/category.php");
}

?>