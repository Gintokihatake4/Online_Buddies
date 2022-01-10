<?php


if(isset($_POST['add_user']))
{
   
   $user_firstname=$_POST['user_firstname'];
   $user_lastname=$_POST['user_lastname'];
   $user_role=$_POST['user_role'];
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

    //ADD USER QUERY
$query = "INSERT INTO user(username,user_password,user_firstname,user_lastname,user_email,user_image,user_role) ";
$query.="VALUES ('{$username}','{$encripted_password}','{$user_firstname}','{$user_lastname}','{$user_email}','{$user_image}','{$user_role}')";
$add_user_query = mysqli_query($connection,$query);
  
    queryCheck($add_user_query);

    echo "User Added:" . " " . "<a href='users.php'>View Users</a> ";

}

?>





<form action="" method="post" enctype="multipart/form-data">

<div class="form-group">
<label for="first_name">First Name</label>
<input type="text" class="form-control" name="user_firstname">
</div> 

<div class="form-group">
<label for="last_name">Last Name</label>
<input type="text" class="form-control" name="user_lastname">
</div>               

<div class="form-group">
<select name="user_role" id="">

<option value="subscriber">Role</option>
<option value="admin">Admin</option>
<option value="subscriber">Subscriber</option>

</select>
</div>

<div class="form-group">
<label for="user_image">User Image</label>
<input type="file"  name="user_image">
</div>
    
<div class="form-group">
<label for="username">Username</label>
<input type="text" class="form-control" name="username">
</div>

<div class="form-group">
<label for="password">Password</label>
<input type="password" class="form-control" name="user_password">
</div>    
            
<div class="form-group">
<label for="user_email">User Email</label>
<input type="email" class="form-control" name="user_email">    
</div>
    
<div class="form-group">
<input class="btn btn-primary" type="submit" name="add_user" value="Add User">
</div>
</form>