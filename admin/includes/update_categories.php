               <!-- Update Category form-->
                            <form action="" method="post">
                            <div class="form-group">
                            <label for="cat-title">Edit Category</label>
<?php   //UPDATE CATEGORIES QUERY 
   
if(isset($_GET['edit']))
{
    $cat_id = $_GET['edit'];

$query = "SELECT * FROM gcategories WHERE cat_id=$cat_id ";
$select_update_categories = mysqli_query($connection,$query);
      
while($row = mysqli_fetch_assoc($select_update_categories))
{
$cat_id=$row['cat_id'];
$cat_title=$row['cat_title'];
?>
                        
    <input value="<?php if(isset($cat_title)){ echo $cat_title; } ?>" type="text" class="form-control" name="cat_title">

<?php }
        } ?>
        
<?php 
                         
     //UPDATE QUERY                            
   if(isset($_POST['update_category']))
{
    $update_cat_title = $_POST['cat_title'];
    $query = "UPDATE gcategories SET cat_title = '{$update_cat_title}' WHERE cat_id={$cat_id} ";
    $update_query=mysqli_query($connection,$query);  
       
       if(!$update_query)
       {
           die("Query Failed!" . mysqli_error($connection));
       }
       
                                
}
                      
                                
?> 
                            
                            </div>                
                            <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="update_category" value="Update">
                            </div>    
                        </form>