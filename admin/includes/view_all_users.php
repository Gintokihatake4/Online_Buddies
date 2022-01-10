<?php

if(isset($_POST['checkboxArray']))
{
    foreach($_POST['checkboxArray'] as $checkboxid)
    {
        $bulk_options=$_POST['bulk_options'];
        
        switch($bulk_options)
        {
            case 'admin':
            
            $query="UPDATE user SET user_role='{$bulk_options}' WHERE user_id={$checkboxid} ";
            $update_query=mysqli_query($connection,$query);
            queryCheck($update_query);  
                
            break;
                
            case 'subscriber':
            
            $query="UPDATE user SET user_role='{$bulk_options}' WHERE user_id={$checkboxid} ";
            $update_query=mysqli_query($connection,$query);
            queryCheck($update_query);  
                
            break;
               
            case 'delete':
            
            $query="DELETE FROM user WHERE user_id={$checkboxid} ";
            $Delete_query=mysqli_query($connection,$query);
            queryCheck($Delete_query);
                
            break;
        }
    }
}



?>


<form action="" method='post'>
<table class="table table-bordered table-hover">
<div class="row">
   <div id="bulkOptionContainer" class="col-xs-4">
   <select class="form-control" name="bulk_options" id="">
    
    <option value="">Select Options</option>
    <option value="admin">Admin</option>
    <option value="subscriber">Subscriber</option>
    <option value="delete">Delete</option>
   
   </select>
   </div>
   
   <div class="col-xs-4">
   
   <input type="submit" name="submit" class="btn btn-success" value="Apply">
   <a class="btn btn-primary" href="users.php?source=add_user">Add New</a>
   
   </div>
   </div>
                                <thead>
                                    <tr>
                                        <th><input id="selectAllBoxes" type="checkbox"></th>
                                        <th>User Id</th>
                                        <th>Username</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Edit User</th>
                                        <th>Delete User</th>
                                        
                                        
                                    </tr>
                                </thead>
                                <tbody>
<?php                                 
$query = "SELECT * FROM user ";
$select_users = mysqli_query($connection,$query);


while($row = mysqli_fetch_assoc($select_users))
{
$user_id=$row['user_id'];
$username=$row['username'];
$user_password=$row['user_password'];
$user_firstname=$row['user_firstname'];
$user_lastname=$row['user_lastname'];
$user_email=$row['user_email'];
$user_role=$row['user_role'];


echo "<tr>";
?>

<th><input class="checkBoxes" type="checkbox" name="checkboxArray[]" value="<?php echo $user_id; ?>"></th>

<?php
echo "<td>$user_id</td>";
echo "<td>$username</td>";
echo "<td>$user_firstname</td>";
    
//$query = "SELECT * FROM gcategories WHERE cat_id=$post_category_id ";
//$select_update_categories = mysqli_query($connection,$query);
//      
//while($row = mysqli_fetch_assoc($select_update_categories))
//{
//$cat_id=$row['cat_id'];
//$cat_title=$row['cat_title'];
//}
//
//echo "<td>{$cat_title}</td>";

    
    
echo "<td>$user_lastname</td>";
echo "<td>$user_email</td>";
echo "<td>$user_role</td>";
    
//$query="SELECT * FROM gposts WHERE gpost_id={$comment_post_id}";
//$select_post_id_query=mysqli_query($connection,$query);
//
//while($row=mysqli_fetch_assoc($select_post_id_query))
//{
//    $post_id=$row['gpost_id'];
//    $post_title=$row['gpost_title'];
//    
//    echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
//    
//}
    
 
    



echo "<td><a href='users.php?source=edit_user&edit_user={$user_id}'>Edit</a></td>";
echo "<td><a onClick=\"javascript: return confirm('Are You Sure?'); \" href='users.php?delete={$user_id}'>Delete</a></td>";

echo "</tr>";
}
?>                                    
                                    
                                    
                                    
                                </tbody>
                            </table>
                            </form>

<?php

if(isset($_GET['delete']))
{

$User_id=$_GET['delete'];
$query="DELETE FROM user WHERE user_id='$User_id'";
$delete_user_query=mysqli_query($connection,$query);
queryCheck($delete_user_query);
header("Location: users.php");
   
}

?>