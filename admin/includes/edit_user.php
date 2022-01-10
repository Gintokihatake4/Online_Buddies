<?php

if(isset($_GET['edit_user']))
{
    $the_user_id=$_GET['edit_user'];

$query = "SELECT * FROM user WHERE user_id=$the_user_id ";
$select_edit_user = mysqli_query($connection,$query);
if(!$select_edit_user)
{
    die("Query Failed!" . mysqli_error($connection));
}

while($row = mysqli_fetch_assoc($select_edit_user))
{
$user_id=$row['user_id'];
$username=$row['username'];
$user_password=$row['user_password'];
$user_firstname=$row['user_firstname'];
$user_lastname=$row['user_lastname'];
$user_image=$row['user_image'];
$user_email=$row['user_email'];
$user_role=$row['user_role'];
}
}




if(isset($_POST['edit_user']))
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
    
   if(empty($user_image))
{
    $query="SELECT * FROM user WHERE user_id={$the_user_id} ";
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
$query.="user_image='{$user_image}', ";
$query.="user_role='{$user_role}' ";
$query.="WHERE user_id={$the_user_id}";

$user_update_query=mysqli_query($connection,$query);
if(!$user_update_query)
{
    die("Query Failed!" . mysqli_error($connection));
}
echo "User Updated:" . " " . "<a href='users.php'>View Users</a> ";
}

?>





<form action="" method="post" enctype="multipart/form-data">

<div class="form-group">
<label for="title">First Name</label>
<input value="<?php echo $user_firstname; ?>" type="text" class="form-control" name="user_firstname">
</div> 

<div class="form-group">
<label for="author">Last Name</label>
<input value="<?php echo $user_lastname; ?>" type="text" class="form-control" name="user_lastname">
</div>               

<div class="form-group">
<label for="role">Role</label>
<select name="user_role" id="">
<option value='<?php echo $user_role; ?>'><?php echo $user_role; ?></option>
<?php
 if($user_role == 'admin')
{
 echo "<option value='subscriber'>Subscriber</option>";    
}
else
{
 echo "<option value='admin'>Admin</option>";        
}
?>
</select>
</div>

<div class="form-group">
<label for="user_image">User Image</label>
<input value="<?php echo $user_image; ?>" type="file"  name="user_image">
</div>
    
<div class="form-group">
<label for="username">Username</label>
<input value="<?php echo $username; ?>" type="text" class="form-control" name="username">
</div>

<div class="form-group">
<label for="userpassword">Password</label>
<input autocomplete="off" type="password" class="form-control" name="user_password">
</div>    
            
<div class="form-group">
<label for="useremail">User Email</label>
<input value="<?php echo $user_email; ?>" type="email" class="form-control" name="user_email">    
</div>
    
<div class="form-group">
<input class="btn btn-primary" type="submit" name="edit_user" value="Update User">
</div>
</form>