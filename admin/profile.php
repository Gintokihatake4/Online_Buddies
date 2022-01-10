<?php include "includes/admin_header.php"; ?>

   
<?php 
if(isset($_SESSION['username']))
{
    $username=$_SESSION['username'];
    
    $query="SELECT * FROM user WHERE username='{$username}'";
    $select_user_query=mysqli_query($connection,$query);
    queryCheck($select_user_query);
    
    while($row=mysqli_fetch_array($select_user_query))
    {
      $user_id=$row['user_id'];
      $username=$row['username'];
      $user_password=$row['user_password'];
      $user_firstname=$row['user_firstname'];
      $user_lastname=$row['user_lastname'];
      $user_image=$row['user_image'];
      $user_email=$row['user_email'];
      
    }
}
   
?>
   
      
      
      <?php 
        
if(isset($_POST['update_user']))
{
   
   $user_firstname=$_POST['user_firstname'];
   $user_lastname=$_POST['user_lastname'];
   $user_image=$_FILES['user_image']['name'];
   $user_image_temp=$_FILES['user_image']['tmp_name'];
   $user_email=$_POST['user_email'];
   $username=$_POST['username'];
   $user_password=$_POST['user_password'];
 
   $hash_format="$2y$10$";
   $salt="temezurajanaikatsurada";
   $hash_and_salt=$hash_format . $salt;
   $encripted_password=crypt($user_password,$hash_and_salt);
    
   move_uploaded_file($user_image_temp,"../images/$user_image");
    
   if(empty($user_image))
{
    $query="SELECT * FROM user WHERE username='{$username}' ";
    $user_image_query=mysqli_query($connection,$query);
    
    while($row=mysqli_fetch_array($user_image_query))
    {
        $user_image=$row['user_image'];
    }
}

    //UPDATE QUERY
$query="UPDATE user SET ";
$query.="username='{$username}', ";
$query.="user_password='{$encripted_password}', ";
$query.="user_firstname='{$user_firstname}', ";
$query.="user_lastname='{$user_lastname}', ";
$query.="user_email='{$user_email}', ";
$query.="user_image='{$user_image}' ";
$query.="WHERE username='{$username}'";

$user_profile_update_query=mysqli_query($connection,$query);
if(!$user_profile_update_query)
{
    die("Query Failed!" . mysqli_error($connection));
}

}
        
?>
      
      
      
       
    <div id="wrapper">

        <!-- Navigation -->
       
        <?php include "includes/admin_navigation.php"; ?>

        
            
            <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            WELCOME TO ADMIN
                            <small><?php echo $_SESSION['username']; ?></small>
                        </h1>
    
   
                        
                        <!-- EDIT USER FORM -->
<form action="" method="post" enctype="multipart/form-data">

<div class="form-group">
<label for="firstname">Firstname</label>
<input value="<?php echo $user_firstname; ?>" type="text" class="form-control" name="user_firstname">
</div>

<div class="form-group">
<label for="lastname">Lastname</label>
<input value="<?php echo $user_lastname; ?>" type="text" class="form-control" name="user_lastname">
</div>                

<div class="form-group">
<label for="user_image">User Image</label>
<img width="100" src="../images/<?php echo $user_image; ?>" alt="">
<input type="file"  name="user_image">
</div>
    
<div class="form-group">
<label for="username">Username</label>
<input value="<?php echo $username; ?>" type="text" class="form-control" name="username">
</div>
    
<div class="form-group">
<label for="password">Password</label>
<input autocomplete="off" type="text" class="form-control" name="user_password">    
</div>
   
<div class="form-group">
<label for="email">Email</label>
<input value="<?php echo $user_email; ?>" type="text" class="form-control" name="user_email">    
</div>
    
<div class="form-group">
<input class="btn btn-primary" type="submit" name="update_user" value="Update Profile">
</div>
</form>
                        
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
        
 <?php include "includes/admin_footer.php"; ?>