<?php


if(isset($_POST['create_post']))
{
   $gpost_title=$_POST['title'];
   $gpost_author=$_POST['author'];
   $gpost_category_id=$_POST['post_category'];
   $gpost_status=$_POST['post_status'];
   $gpost_image=$_FILES['post_image']['name'];
   $gpost_image_temp=$_FILES['post_image']['tmp_name'];
   $gpost_tags=$_POST['post_tags'];
   $gpost_content=$_POST['post_content'];
   $gpost_date=date('d-m-y');
 
    
   move_uploaded_file($gpost_image_temp,"../images/$gpost_image");

    //INSERT QUERY
$query = "INSERT INTO
gposts(gpost_category_id, gpost_title, gpost_author, gpost_date, gpost_image, gpost_content, gpost_tags, gpost_status) ";
$query .= "VALUES ({$gpost_category_id},'{$gpost_title}','{$gpost_author}',now(),'{$gpost_image}','{$gpost_content}','{$gpost_tags}','{$gpost_status}') ";

$create_post_query = mysqli_query($connection,$query);
  
    queryCheck($create_post_query);
    $the_p_id=mysqli_insert_id($connection);
    echo "<p class='bg-success'>Post Created:" . " " . "<a href='../post.php?p_id={$the_p_id}'>View Post</a> or <a href='posts.php?source=add_post'>Add More Posts</a></p> ";
}

?>





<form action="" method="post" enctype="multipart/form-data">

<div class="form-group">
<label for="title">Post Title</label>
<input type="text" class="form-control" name="title">
</div>                

<div class="form-group">
<select name="post_category" id="">
    
<?php 
    
$query = "SELECT * FROM gcategories";
$select_categories = mysqli_query($connection,$query);
queryCheck($select_categories);           
       
while($row = mysqli_fetch_assoc($select_categories))
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
<input type="text" class="form-control" name="author">
</div>
    
<div class="form-group">
<select name="post_status" id="">

<option value="">Post Status</option>
<option value="published">Published</option>
<option value="draft">Draft</option>

</select>
</div>
    
<div class="form-group">
<label for="post_image">Post Image</label>
<input type="file"  name="post_image">
</div>
    
<div class="form-group">
<label for="post_tags">Post Tags</label>
<input type="text" class="form-control" name="post_tags">
</div>
    
<div class="form-group">
<label for="summernote">Post Content</label>
<textarea class="form-control" name="post_content" id="summernote" cols="30" rows="10"></textarea> 

</div>
    
<div class="form-group">
<input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
</div>
</form>