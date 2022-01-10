<?php  


function escape($string)
{
    global $connection;
    return mysqli_real_escape_string($connection, trim($string));
}


//Function to display the users online dynamically 
function users_online()
{
        global $connection;
       
        $session=session_id();
        $time=time();
        $time_out_in_seconds=10;
        $time_out=$time-$time_out_in_seconds;
        
$query="SELECT * FROM users_online WHERE session='$session'";
$user_count_query=mysqli_query($connection,$query);
$count=mysqli_num_rows($user_count_query);
if($count==NULL)
{
    mysqli_query($connection,"INSERT INTO users_online(session,time) VALUES('$session','$time')");
}
else
{
    mysqli_query($connection,"UPDATE users_online SET time='$time' WHERE session='$session'");
}

$users_online_query=mysqli_query($connection,"SELECT * FROM users_online WHERE time>'$time_out'");
return $user_count=mysqli_num_rows($users_online_query);

}



//Function to chech if the query is valid/working
function queryCheck($result)
{
     global $connection;  
     if(!$result)
    {
        die("Query Failed" . mysqli_error($connection));    
    }

}



//INSERTING CATEGORIES IN CATEGORIES.PHP
function insert_category()
{
       global $connection;     
       if(isset($_POST['submit']))
        {
           $cat_title=$_POST['cat_title'];
            if($cat_title == "" || empty($cat_title))
            {
             echo "This field should not be empty";
            }
        else
         {
            $query="INSERT INTO gcategories(cat_title)";
            $query.="VALUE('{$cat_title}') ";
            $add_category_query=mysqli_query($connection,$query);                                   if(!$add_category_query)
            {
                die("Query Failed") . mysqli_error($connection);
            }
         }
        }

}



//DISPLAYING ALL CATEGORIES IN CATEGORIES.PHP
function findAllCategories()
{
    global $connection; 
    $query = "SELECT * FROM gcategories";
$select_categories = mysqli_query($connection,$query);
                            
while($row = mysqli_fetch_assoc($select_categories))
{
 $cat_id=$row['cat_id'];
 $cat_title=$row['cat_title'];
    
 echo "<tr>";
 echo "<td>{$cat_id}</td>";
 echo "<td>{$cat_title}</td>";
 echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
 echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
 echo "<tr>";
}
}



//DELETING CATEGORIES IN CATEGORIES.PHP
function deleteCategories()
{
    global $connection;
    if(isset($_GET['delete']))
{
    
    $delete_cat_id=$_GET['delete'];
    $query="DELETE FROM gcategories WHERE cat_id={$delete_cat_id} ";
    $delete_query=mysqli_query($connection,$query);
    header("Location: categories.php");
}
}


?>