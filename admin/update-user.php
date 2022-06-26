<?php
 include "header.php";
 include 'config.php';

  
 if($_SESSION['user_role'] != 1){
        header("Location: http://localhost/news-site/admin/post.php");
 }

 $id = $_GET['updateid'];

 $sql = "SELECT * FROM user WHERE user_id = $id";

 $result= mysqli_query($conn,$sql);
 $row=mysqli_fetch_assoc($result);

 $fname = $row['first_name'];
 $lname = $row['last_name'];
 $username = $row['username'];


 if(isset($_POST['submit'])){
    $firstname = mysqli_real_escape_string($conn,$_POST['f_name']);
    $lastname  = mysqli_real_escape_string($conn,$_POST['l_name']);
    $uname     = mysqli_real_escape_string($conn,$_POST['username']);
    $role      = mysqli_real_escape_string($conn,$_POST['role']);
    

    $sql1 = "UPDATE user SET  user_id= $id, first_name='$firstname',last_name='$lastname',username='$uname',role='$role' WHERE user_id = $id";
    $result1 = mysqli_query($conn,$sql1);

    header("Location: http://localhost/news-site/admin/users.php");


}




 ?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Modify User Details</h1>
              </div>
              <div class="col-md-offset-4 col-md-4">
                  <!-- Form Start -->
                  <form  action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="user_id"  class="form-control" value="1" placeholder="" >
                      </div>
                          <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="f_name" class="form-control" value="<?php echo $fname ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="l_name" class="form-control" value="<?php echo $lname ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="username" class="form-control" value="<?php echo $username ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" >
                               <?php
                                 if($row['role']== 1){
                                      echo "<option  value='0'>Normal</option>
                                            <option  value='1' selected>Admin</option>";
                                 }else{
                                    echo "<option  value='0' selected>Normal</option>
                                           <option  value='1'>Admin</option>";
                                 }
                               
                               ?>
                            

                              
                          </select>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                  </form>
                  <!-- /Form -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
