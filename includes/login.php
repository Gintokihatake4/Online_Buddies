<?php include "db.php"; ?>
<?php session_start(); ?>



<?php 

if(isset($_POST['login']))
{
 $username=$_POST['username'];
 $password=$_POST['password'];
 
 $username=mysqli_real_escape_string($connection,$username);
 $password=mysqli_real_escape_string($connection,$password);
    
 $query="SELECT * FROM user WHERE username='{$username}' ";
 $select_user_query=mysqli_query($connection,$query);
 

 while($row=mysqli_fetch_array($select_user_query))
 {
   $db_user_id=$row['user_id'];
   $db_username=$row['username'];
   $db_user_password=$row['user_password'];
   $db_user_firstname=$row['user_firstname'];
   $db_user_lastname=$row['user_lastname'];
   $db_user_role=$row['user_role'];
 }

   $password=crypt($password,$db_user_password);
    
if($username == $db_username && $password == $db_user_password)
{
   if($db_user_role == 'subscriber')
    {
        echo "<script>alert('Logged in successfully!');</script>";
      
        $_SESSION['username']=$db_username;
        $_SESSION['firstname']=$db_user_firstname;
        $_SESSION['lastname']=$db_user_lastname;
        $_SESSION['user_role']=$db_user_role;
        
        header("Location: ../index.php");
    } 
    else
    {
        $_SESSION['username']=$db_username;
        $_SESSION['firstname']=$db_user_firstname;
        $_SESSION['lastname']=$db_user_lastname;
        $_SESSION['user_role']=$db_user_role;
        
        header("Location: ../admin");  
    }
  
}
else
{
    if($username !== $db_username)
    {
        echo "<script type=\"text/javascript\">";
        echo "alert(\"Inavlid Username!\")";
        echo "</script>";
        
        header("Location: ../index.php");
    }
    else if($password !== $db_user_password)
    {
        echo "<script type=\"text/javascript\">";
        echo "alert(\"Inavlid Password!\")";
        echo "</script>";
        
        header("Location: ../index.php");
    }
   
}
}

?>