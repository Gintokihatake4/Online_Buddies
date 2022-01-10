<?php                                 

if(isset($_GET['p_id']))
{
    $the_p_id=$_GET['p_id'];
}

//DSIPLAYING THE SELECTED POST DETAILS FOR EDITING
$query = "SELECT * FROM gposts WHERE gpost_id={$the_p_id}";
$select_post_by_pid = mysqli_query($connection,$query);

while($row = mysqli_fetch_assoc($select_post_by_pid))
{

$gpost_id=$row['gpost_id'];
$gpost_author=$row['gpost_author'];
$gpost_title=$row['gpost_title'];
$gpost_category_id=$row['gpost_category_id'];
$gpost_status=$row['gpost_status'];
$gpost_image=$row['gpost_image'];
$gpost_content=$row['gpost_content'];
$gpost_tags=$row['gpost_tags'];
$gpost_comment_count=$row['gpost_comment_count'];
$gpost_date=$row['gpost_date'];

}

//UPDATING THE NEW DETAILS OF THE SELECT POST IN THE DATABSE
if(isset($_POST['update_post']))
{

$gpost_title=$_POST['title'];
$gpost_author=$_POST['author'];
$gpost_category_id=$_POST['post_category'];
$gpost_status=$_POST['post_status'];
$gpost_image=$_FILES['post_image']['name'];
$gpost_image_temp=$_FILES['post_image']['tmp_name'];
$gpost_content=$_POST['post_content'];
$gpost_tags=$_POST['post_tags'];

move_uploaded_file($gpost_image_temp,"../images/$gpost_image");
    
if(empty($gpost_image))
{
    $query="SELECT * FROM gposts WHERE gpost_id={$the_p_id}";
    $image_query=mysqli_query($connection,$query);
    queryCheck($image_query);
    
    while($row=mysqli_fetch_array($image_query))
    {
        $gpost_image=$row['gpost_image'];
    }
}
    
$query="UPDATE gposts SET ";
$query.="gpost_title='{$gpost_title}', ";
$query.="gpost_category_id='{$gpost_category_id}', ";
$query.="gpost_author='{$gpost_author}', ";
$query.="gpost_date=now(), ";
$query.="gpost_status='{$gpost_status}', ";
$query.="gpost_image='{$gpost_image}', ";
$query.="gpost_tags='{$gpost_tags}', ";
$query.="gpost_content='{$gpost_content}' ";
$query.="WHERE gpost_id={$the_p_id}";

$post_update_query=mysqli_query($connection,$query);
queryCheck($post_update_query);
echo "<p class='bg-success'>Post Updated:" . " " . "<a href='../post.php?p_id={$the_p_id}'>View Post</a> or <a href='posts.php'>Edit More Posts</a></p> ";
}

?>





<!-- EDIT POST FORM -->
<form action="" method="post" enctype="multipart/form-data">

<div class="form-group">
<label for="title">Post Title</label>
<input value="<?php echo $gpost_title ?>" type="text" class="form-control" name="title">
</div>                

<div class="form-group">
<select name="post_category" id="">
    
<?php 
    
$query = "SELECT * FROM gcategories";
$select_categories = mysqli_query($connection,$query);
queryCheck($select_categories);           
       
while($row=mysqli_fetch_assoc($select_categories))
{

$cat_id=$row['cat_id'];
$cat_title=$row['cat_title'];

echo "<option value='{$cat_id}'>{$cat_title}</option>";
 
}
    ?>
    
    </select>
</div>
    
<div class="form-group">
<label for="author">Post Author</label>
<input value="<?php echo $gpost_author; ?>" type="text" class="form-control" name="author">
</div>
    
<div class="form-group">
<label for="post_status">Post Status</label>
<select name="post_status" id="">
<option value='<?php echo $gpost_status; ?>'><?php echo $gpost_status; ?></option>
<?php 
    if($gpost_status == 'published')
    {
        echo "<option value='draft'>Draft</option>";
    }
    else
    {
        echo "<option value='published'>Publish</option>";
    }
?>
</select>
</div>
    
<div class="form-group">
<label for="post_image">Post Image</label>
<img width="100" src="../images/<?php echo $gpost_image; ?>" alt="">
<input type="file"  name="post_image">
</div>
    
<div class="form-group">
<label for="post_tags">Post Tags</label>
<input value="<?php echo $gpost_tags; ?>" type="text" class="form-control" name="post_tags">
</div>
    
<div class="form-group">
<label for="summernote">Post Content</label>
<textarea class="form-control" name="post_content" id="summernote" cols="30" rows="10"><?php echo $gpost_content; ?></textarea> 
</div>
    
<div class="form-group">
<input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
</div>
</form>

