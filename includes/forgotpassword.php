
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<?php include "db.php"; ?>
<?php 

if(isset($_POST['changepswd']))
{
    $username=$_POST['username'];
    $new_password=$_POST['password1'];
    $confirm_password=$_POST['password2'];
    if($new_password == $confirm_password)
    {
        echo "<script>alert('Password Changed!');</script>";
        
        $hash_format="$2y$10$";
        $salt="temezurajanaikatsurada";
        $hash_and_salt=$hash_format . $salt;
        $encripted_password=crypt($confirm_password,$hash_and_salt);
        
        $query="UPDATE user SET user_password='{$encripted_password}' WHERE username='{$username}'";
        $change_password_query=mysqli_query($connection,$query);
        if(!$change_password_query)
        {
            die("Query Failed!" . mysqli_error($connection));
        }
//        header("Location: /index.php");
    }
    else
    {
        echo "<script>alert('Passwords does not match!');</script>";
    }
}

?>

<div class="container">
<div class="row">
<div class="col-sm-12">
<h1 align="center">Change Password</h1>
</div>
</div>
<div class="row">
<div class="col-sm-6 col-sm-offset-3">
<form method="post" id="passwordForm">
<input type="text" class="input-lg form-control" name="username" id="username" placeholder="Enter Username" autocomplete="off">
<input type="password" class="input-lg form-control" name="password1" id="password1" placeholder="New Password" autocomplete="off">

<input type="password" class="input-lg form-control" name="password2" id="password2" placeholder="Confirm Password" autocomplete="off">
<input type="submit" class="col-xs-12 btn btn-primary btn-load btn-lg" data-loading-text="Changing Password..." name="changepswd" value="Change Password">
<br/><br/>
<a href="../index.php">Back to Login</a>

</form>
</div><!--/col-sm-6-->
</div><!--/row-->
</div>




<!--
<div class="col-md-4">
<div class="well">
<h4 align="center">Change Password</h4>
<form action="" method="post">
<center>
<div class="form-group">
<label>Enter New Password</label>
<input name="username" type="text" class="form-control">
</div>
<div class="form-group">
<label>Confirm New Password</label>
<input name="password" type="password" class="form-control">
</div>
<br/>
<input class="btn btn-primary" name="login" type="submit" value="Submit">
</center>
</form>
</div>
</div>-->
