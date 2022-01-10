<?php
include "delete_modal.php";

if(isset($_POST['checkboxArray']))
{
    foreach($_POST['checkboxArray'] as $checkboxid)
    {
        $bulk_options=$_POST['bulk_options'];
        
        switch($bulk_options)
        {
            case 'published':
            
            $query="UPDATE gposts SET gpost_status='{$bulk_options}' WHERE gpost_id={$checkboxid} ";
            $update_query=mysqli_query($connection,$query);
            queryCheck($update_query);  
                
            break;
                
            case 'draft':
            
            $query="UPDATE gposts SET gpost_status='{$bulk_options}' WHERE gpost_id={$checkboxid} ";
            $Update_query=mysqli_query($connection,$query);
            queryCheck($Update_query);
                
            break;
                
            case 'clone':
                
            $query="SELECT * FROM gposts WHERE gpost_id='{$checkboxid}'";
            $select_post_query=mysqli_query($connection,$query);
            if(!$select_post_query)
            {
                die("Query Failed!" . mysqli_error($connection));
            }
            
            while($row=mysqli_fetch_array($select_post_query))
            {
                $gpost_author=$row['gpost_author'];
                $gpost_title=$row['gpost_title'];
                $gpost_category_id=$row['gpost_category_id'];
                $gpost_status=$row['gpost_status'];
                $gpost_image=$row['gpost_image'];
                $gpost_tags=$row['gpost_tags'];
                $gpost_content=$row['gpost_content'];
                $gpost_date=$row['gpost_date'];
            }
            
            $query = "INSERT INTO
            gposts(gpost_category_id, gpost_title, gpost_author, gpost_date, gpost_image, gpost_content, gpost_tags, gpost_status) ";
            $query .= "VALUES ({$gpost_category_id},'{$gpost_title}','{$gpost_author}',now(),'{$gpost_image}','{$gpost_content}','{$gpost_tags}','{$gpost_status}') ";

            $create_post_query = mysqli_query($connection,$query);
            if(!$create_post_query)
            {
                die("Query Failed!" . mysqli_error($connection));
            }
                
            break;
                
                
            case 'delete':
            
            $query="DELETE FROM gposts WHERE gpost_id={$checkboxid} ";
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
    <option value="published">Publish</option>
    <option value="draft">Draft</option>
    <option value="clone">Clone</option>
    <option value="delete">Delete</option>
   </select>
   </div>
   
   <div class="col-xs-4">
   
   <input type="submit" name="submit" class="btn btn-success" value="Apply">
   <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
   
   </div>
   </div>
    <thead>
        <tr>
            <th><input id="selectAllBoxes" type="checkbox"></th>
            <th>Id</th>
            <th>Author</th>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Images</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Date</th>
            <th>View</th>
            <th>Edit</th>
            <th>Delete</th>
            <th>Views</th>

        </tr>
    </thead>
    <tbody>
<?php                                 
$query = "SELECT * FROM gposts ORDER BY gpost_id DESC ";
$select_posts = mysqli_query($connection,$query);


while($row = mysqli_fetch_assoc($select_posts))
{
$post_id=$row['gpost_id'];
$post_author=$row['gpost_author'];
$post_title=$row['gpost_title'];
$post_category_id=$row['gpost_category_id'];
$post_status=$row['gpost_status'];
$post_image=$row['gpost_image'];
$post_tags=$row['gpost_tags'];
$post_comment_count=$row['gpost_comment_count'];
$post_date=$row['gpost_date'];
$post_views_count=$row['gpost_views_count'];

echo "<tr>";
?>

<th><input class="checkBoxes" type="checkbox" name="checkboxArray[]" value="<?php echo $post_id; ?>"></th>

<?php
echo "<td>$post_id</td>";
echo "<td>$post_author</td>";
echo "<td>$post_title</td>";
    
$query = "SELECT * FROM gcategories WHERE cat_id={$post_category_id}";
$select_update_categories = mysqli_query($connection,$query);
if(!$select_update_categories)
{
    die("Query Failed!" . mysqli_error($connection));
}
while($row = mysqli_fetch_assoc($select_update_categories))
{
$cat_id=$row['cat_id'];
$cat_title=$row['cat_title'];
}

echo "<td>{$cat_title}</td>";

    
    
echo "<td>$post_status</td>";
echo "<td><img width='100' src='../images/$post_image' alt='image'></td>";
echo "<td>$post_tags</td>";
    
$query="SELECT * FROM comments WHERE comment_post_id={$post_id}";
$comment_count_query=mysqli_query($connection,$query);

$comment_count=mysqli_num_rows($comment_count_query);
    
echo "<td><a href='post_comments.php?id=$post_id'>$comment_count</a></td>";
    
echo "<td>$post_date</td>";
echo "<td><a href='../post.php?p_id={$post_id}'>View Post</a></td>";
echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
echo "<td><a rel='$post_id' href='javascript:void(0)' class='delete_link' >Delete</a></td>";
//echo "<td><a onClick=\"javascript: return confirm('Are You Sure?'); \" href='posts.php?delete={$post_id}'>Delete</a></td>";
echo "<td><a href='posts.php?reset={$post_id}'>{$post_views_count}</a></td>";
echo "</tr>";
}
?>                                    
                                    
                                    
                                    
    </tbody>
</table>
</form>

<?php

if(isset($_GET['delete']))
{
    $Post_id=$_GET['delete'];
    
    $query="DELETE FROM gposts WHERE gpost_id={$Post_id} ";
    $delete_post_query=mysqli_query($connection,$query);
    queryCheck($delete_post_query);
    header("Location: posts.php");
}

if(isset($_GET['reset']))
{
    $Post_id=$_GET['reset'];
    $query="UPDATE gposts SET gpost_views_count=0 WHERE gpost_id={$Post_id} ";
    $reset_views_query=mysqli_query($connection,$query);
    queryCheck($reset_views_query);
    header("Location: posts.php");
}

?>


<script>


$(document).ready(function(){
    $(".delete_link").on('click', function(){
        
        var id=$(this).attr("rel");
        var delete_url="posts.php?delete="+ id +"";
        
        $(".delete_modal_link").attr("href",delete_url);
        $("#myModal").modal('show');
        
    });
    
});


</script>

