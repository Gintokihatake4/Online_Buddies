<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>

<?php 

if(isset($_POST['submit']))
{
    $Username=$_POST['username'];
    $Email=$_POST['email'];
    $Password=$_POST['password'];
    
    if(!empty($Username && $Email && $Password))
    {
    $Username=mysqli_real_escape_string($connection,$Username);
    $Email=mysqli_real_escape_string($connection,$Email);
    $password=mysqli_real_escape_string($connection,$Password);
    
    $hash_format="$2y$10$";
    $salt="temezurajanaikatsurada";
    $hash_and_salt=$hash_format . $salt;
    $encripted_password=crypt($password,$hash_and_salt);
    
    $query="INSERT INTO user(username,user_email,user_password,user_role) ";
    $query.="VALUES('{$Username}','{$Email}','{$encripted_password}','subscriber')";
    $registration_query=mysqli_query($connection,$query);
    if(!$registration_query)
    {
        die("Query Failed!" . mysqli_error($connection));
    }
     else
     {
          $message="Your Registration Was Successful !";
     }
        
       
}
    else
    {
        $message="Please Fill All The Fields!";
    }
    

}
else
{
    $message="";
}

    
    
    

?>
   
   
    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                       <h6 class="text-center"><?php echo $message; ?></h6>
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
