<?php include 'header.php'; ?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                    <?php
                        $sql2 = "SELECT * FROM category WHERE category_id = {$cat_id}";
                        $result2 = mysqli_query($conn, $sql2);
                        if(mysqli_num_rows($result2) > 0 ){
                                  $row3 =mysqli_fetch_assoc($result2);
                        
                    

                    ?>
                   <h2 class="page-heading"><?php echo $row3['category_name']?></h2>

                   <?php
                      }
                   ?>

                  <?php 
                           
                           include 'config.php';

                        //    if(isset($_GET['cid'])){
                        //     $cat_id = $_GET['cid'];
                        //    }
                        $cat_id = $_GET['cid'];

                           $limit = 3;
                         
                           if(isset($_GET['page'])){
                               $page= $_GET['page'];
                           }else{
                                $page = 1; 
                           }
                          
                           $offset =($page -1) * $limit;


                           $sql="SELECT * FROM post 
                                 LEFT JOIN category ON post.category = category.category_id
                                 LEFT JOIN user ON post.author = user.user_id
                                 WHERE post.category = {$cat_id}
                                 LIMIT {$offset},{$limit}";

                           $result = mysqli_query($conn, $sql);

                           if(mysqli_num_rows($result) > 0){
                                  while($row= mysqli_fetch_assoc($result)){
                                    

                         ?>
                        <div class="post-content">
                            <div class="row">
                                <div class="col-md-4">
                                    <a class="post-img" href="single.php?sid=<?php echo $row['post_id']?>"><img src="admin/upload/<?php echo $row['post_img']?>" alt=""/></a>
                                </div>
                                <div class="col-md-8">
                                    <div class="inner-content clearfix">
                                        <h3><a href='single.php?sid=<?php echo $row['post_id']?>'><?php echo $row['title']?></a></h3>
                                        <div class="post-information">
                                            <span>
                                                <i class="fa fa-tags" aria-hidden="true"></i>
                                                <a href='category.php?cid=<?php echo $row['category_id']?>'><?php echo $row['category_name']?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                                <a href='author.php?aid=<?php echo $row['user_id']?>'><?php echo $row['username']?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                                <?php echo $row['post_date']?>
                                            </span>
                                        </div>
                                        <p class="description">
                                               <?php echo substr($row['description'],0,120). "....."?>
                                        </p>
                                        <a class='read-more pull-right' href='single.php?sid=<?php echo $row['post_id']?>'>read more</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                   <?php
                        }
                     }
                   ?>

                   <!--------------------- pagination area --------------------------->

                   <?php
                                       $sql1 = "SELECT post FROM category  WHERE category_id = {$cat_id}";
                                       $result1 = mysqli_query($conn,$sql1) or die ("Query Failed");
                                       
                                       if(mysqli_num_rows($result1) > 0){
                   
                                               $total_record = mysqli_num_rows($result1);
                   
                                               $total_page = ceil($total_record / $limit);
                   
                                               echo "<ul class='pagination admin-pagination'>";
                                               if($page > 1){
                                                     echo "<li><a href='category.php?cid=".$cat_id ."&page=".($page-1)."'>prev</a></li>";
                                               }
                                               for($i = 1; $i <= $total_page; $i++){
                   
                                                       if($i == $page){
                                                           $actives = "actives";
                                                       }else{
                                                           $actives = "";
                                                       }
                                                      
                                                       echo '<li class="'.$actives.'"><a href="category.php?cid='.$cat_id .'&page='.$i.'">'.$i.'</a></li>';
                   
                                               };
                   
                                               if($total_page > $page){
                                                   echo "<li><a href='category.php?cid=".$cat_id  ."&page= ".($page + 1)." '>next</a></li>";
                                                }
                                              
                                               echo "</ul>";
                                              
                                       }
                   
                   
                   ?>


                       



                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>
