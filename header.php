
<?php

// echo "<pre>";

//    print_r($_SERVER);

// echo "</pre>"

// echo "<h1>" . basename($_SERVER['PHP_SELF']) . "</h1>";

include 'config.php';

$page = basename($_SERVER['PHP_SELF']);

switch($page){
      case "single.php";
      $sql_title = "SELECT * FROM post WHERE post_id = {$_GET['sid']}";

      $result_title = mysqli_query($conn, $sql_title);

      $row_title = mysqli_fetch_assoc($result_title);

      $header_title = $row_title['title'];

      break;

      case "search.php";
      if(isset($_GET['search'])){
          $header_title = $_GET['search'];
      }
      break;

      case "category.php";
      $sql_title = "SELECT * FROM category WHERE category_id = {$_GET['cid']}";

      $result_title = mysqli_query($conn, $sql_title);

      $row_title = mysqli_fetch_assoc($result_title);

      $header_title = $row_title['category_name'] . " News";
      break;

      case "author.php";
      $sql_title = "SELECT * FROM user WHERE user_id = {$_GET['aid']}";

      $result_title = mysqli_query($conn, $sql_title);

      $row_title = mysqli_fetch_assoc($result_title);

      $header_title = $row_title['username'];
      break;

      default :
      $header_title = "News site";
      break;  
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $header_title ?></title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<!-- HEADER -->
<div id="header">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- LOGO -->
            <?php
          
            $sql1 = "SELECT * FROM  settings";
            $result1 = mysqli_query($conn, $sql1);
            $row1 = mysqli_fetch_assoc($result1);
            
            if(mysqli_num_rows($result1) > 0){

            ?>
            <div class=" col-md-offset-4 col-md-4">
                <a href="index.php" id="logo"><img src="admin/images/<?php echo $row1['logo'] ?>"></a>
            </div>
            <!-- /LOGO -->
            <?php
            }
            ?>
        </div>
    </div>
</div>
<!-- /HEADER -->
<!-- Menu Bar -->
<div id="menu-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                
                   include 'config.php';

                    if(isset($_GET['cid'])){
                        $cat_id = $_GET['cid'];
                    }

                    $sql = "SELECT * FROM category WHERE post > 0";

                    $result = mysqli_query($conn, $sql);
                   
                    if(mysqli_num_rows($result) > 0){
                    $active = '';
                ?>
                <ul class='menu'>
                    <li><a href="index.php">Home</a></li>
                    <?php

                        while($row = mysqli_fetch_assoc($result)){
                              
                            if(isset($_GET['cid'])){
                                
                             if($row['category_id'] == $cat_id){
                                $active = "active";
                             }else{
                             $active = "";
                             }
                            }

                            echo "<li><a class='{$active}' href='category.php?cid={$row['category_id']}'>{$row['category_name']}</a></li>";

                        }

                    ?>
                    

                </ul>
            <?php
                    }
            ?>
             </div>
        </div>
    </div>
</div>
<!-- /Menu Bar -->
