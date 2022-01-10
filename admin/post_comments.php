<?php include "includes/admin_header.php"; ?>

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
                            <small>Author</small>
                        </h1>



<?php

if(isset($_POST['checkboxArray']))
{
    foreach($_POST['checkboxArray'] as $checkboxid)
    {
        $bulk_options=$_POST['bulk_options'];
        
        switch($bulk_options)
        {
            case 'approved':
            
            $query="UPDATE comments SET comment_status='{$bulk_options}' WHERE comment_id={$checkboxid} ";
            $update_query=mysqli_query($connection,$query);
            queryCheck($update_query);  
                
            break;
                
            case 'dissapproved':
            
            $query="UPDATE comments SET comment_status='{$bulk_options}' WHERE comment_id={$checkboxid} ";
            $Update_query=mysqli_query($connection,$query);
            queryCheck($Update_query);
                
            break;
                
            case 'delete':
           
            $query="DELETE FROM comments WHERE comment_id={$checkboxid} ";
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
    <option value="approved">Approve</option>
    <option value="dissapproved">Dissapprove</option>
    <option value="delete">Delete</option>
   </select>
   </div>
   
   <div class="col-xs-4">
   
   <input type="submit" name="submit" class="btn btn-success" value="Apply">
   
   
   </div>
   </div>
                                <thead>
                                    <tr>
                                        <th><input id="selectAllBoxes" type="checkbox"></th>
                                        <th>Id</th>
                                        <th>Author</th>
                                        <th>Comment</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>In Response To</th>
                                        <th>Date</th>
                                        <th>Approve</th>
                                        <th>Disapprove</th>
                                        <th>Delete</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
<?php                                 
$query = "SELECT * FROM comments WHERE comment_post_id=" . mysqli_real_escape_string($connection,$_GET['id'])." ";
$select_comments = mysqli_query($connection,$query);


while($row = mysqli_fetch_assoc($select_comments))
{
$comment_id=$row['comment_id'];
$comment_author=$row['comment_author'];
$comment_email=$row['comment_email'];
$comment_post_id=$row['comment_post_id'];
$comment_status=$row['comment_status'];
$comment_content=$row['comment_content'];
$comment_date=$row['comment_date'];

echo "<tr>";
?>

<th><input class="checkBoxes" type="checkbox" name="checkboxArray[]" value="<?php echo $comment_id; ?>"></th>

<?php
echo "<td>$comment_id</td>";
echo "<td>$comment_author</td>";
echo "<td>$comment_content</td>";
    
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

    
    
echo "<td>$comment_email</td>";
echo "<td>$comment_status</td>";
    
$query="SELECT * FROM gposts WHERE gpost_id={$comment_post_id}";
$select_post_id_query=mysqli_query($connection,$query);
    if(!$select_post_id_query)
    {
        die("query failed!" . mysqli_error($connection));
    }

while($row=mysqli_fetch_assoc($select_post_id_query))
{
    $post_id=$row['gpost_id'];
    $post_title=$row['gpost_title'];
    
    echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
    
}
    
 
    
echo "<td>$comment_date</td>";

echo "<td><a href='comments.php?approve=$comment_id'>Approve</a></td>";
echo "<td><a href='comments.php?disapprove=$comment_id'>Disapprove</a></td>";
echo "<td><a onClick=\"javascript: return confirm('Are You Sure?'); \" href='post_comments.php?delete=$comment_id&id=" . $_GET['id'] ."'>Delete</a></td>";

echo "</tr>";
}
?>                                    
                                    
                                    
                                    
                                </tbody>
                            </table>
                            </form>

<?php

if(isset($_GET['approve']))
{
    $Comment_id=$_GET['approve'];
    $query="UPDATE comments SET comment_status='approved' WHERE comment_id={$Comment_id}";
    $approve_comment_query=mysqli_query($connection,$query);
    queryCheck($approve_comment_query);
    header("Location: comments.php");
}



if(isset($_GET['disapprove']))
{
    $Comment_id=$_GET['disapprove'];
    $query="UPDATE comments SET comment_status='disapproved' WHERE comment_id={$Comment_id} ";
    $disapprove_comment_query=mysqli_query($connection,$query);
    queryCheck($disapprove_comment_query);
    header("Location: comments.php");
}



if(isset($_GET['delete']))
{
    $Comment_id=$_GET['delete'];
    $query="DELETE FROM comments WHERE comment_id={$Comment_id} ";
    $delete_comment_query=mysqli_query($connection,$query);
    queryCheck($delete_comment_query);
    header("Location: post_comments.php?id=" . $_GET['id'] . " ");
}

?>


 </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

 <?php include "includes/admin_footer.php"; ?>