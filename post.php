<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>




    <!-- Navigation -->
   
<?php include "includes/navigation.php"; ?>

                   <!-- Page Content -->
                   <div class="container">

                     <div class="row">

                 <!-- Blog Entries Column -->
                    <div class="col-md-8">
<?php 

if(isset($_GET['p_id']))
{
$gpost_id=$_GET['p_id'];

$query="UPDATE gposts SET gpost_views_count=gpost_views_count + 1 WHERE gpost_id={$gpost_id}";
$post_view_query=mysqli_query($connection,$query);
if(!$post_view_query)
{
    die("Query Falied!" . mysqli_error($connection));
}

if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin')
{
    $query = "SELECT * FROM gposts WHERE gpost_id={$gpost_id}";
}
else
{
    $query = "SELECT * FROM gposts WHERE gpost_id={$gpost_id} AND gpost_status='published' ";
}
    
$selected_post_query = mysqli_query($connection,$query);

    
if(mysqli_num_rows($selected_post_query) < 1)
{
    echo "<h1 class='text-center'>Sorry! No Posts To Show.</h1>";
}
else
{

while($row = mysqli_fetch_assoc($selected_post_query)) 
{

$gpost_title=$row['gpost_title'];
$gpost_author=$row['gpost_author'];
$gpost_date=$row['gpost_date'];
$gpost_image=$row['gpost_image'];
$gpost_content=$row['gpost_content'];
?>
                
                
                   

                <!-- First Blog Post -->
                <h2>
                    <a href=""><?php echo $gpost_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href=""><?php echo $gpost_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $gpost_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $gpost_image; ?>" alt="">
                <hr>
                <p><?php echo $gpost_content; ?></p>
<!--                <hr>-->
<!--                <a class="btn btn-primary" href="games/snakegame/index.html">PLAY</a>    -->
                
          <?php      } ?>



                
                
                        <!-- Blog Comments -->

<?php

                        
if(isset($_POST['create_comment']))
{
 
 $gpost_id=$_GET['p_id'];
 $comment_author=$_POST['comment_author'];
 $comment_email=$_POST['comment_email'];
 $comment_content=$_POST['comment_content'];

if(!empty($comment_author && $comment_email && $comment_content))
{
    $query="INSERT INTO comments (comment_post_id,comment_author,comment_email,comment_content,comment_status,comment_date)";
$query.="VALUES ($gpost_id,'{$comment_author}','{$comment_email}','{$comment_content}','unapproved',now())";  

$insert_comment_query=mysqli_query($connection,$query);
if(!$insert_comment_query)
{
    die("Failed!" . mysqli_error($connection));
}
    
                        
//$query="UPDATE gposts SET gpost_comment_count=gpost_comment_count+1 ";
//$query.="WHERE gpost_id={$gpost_id}";
//$update_comment_query=mysqli_query($connection,$query);
//if(!$update_comment_query)
//{
//    die("Query Failed!" . mysqli_error($connection));
//}
        
    
}
    else
    {
        echo "<script>alert('Fields Cannot Be Empty!');</script>";
    }
}


?>                      
                        
                        
                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action="" method="post" role="form">
                        <div class="form-group">
                            <label for="Author">Author</label>
                            <input type="text" name="comment_author" class="form-control" name="comment_author">
                        </div>
                        
                        <div class="form-group">
                            <label for="Email">Email</label>
                            <input type="email" name="comment_email" class="form-control" name="comment_email">
                        </div>
                        
                        <div class="form-group">
                            <label for="Comment">Your Comment</label>
                            <textarea name="comment_content" class="form-control" rows="3"></textarea>
                        </div>
                        
                        <button type="submit" name="create_comment" class="btn btn-primary" >Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

<?php 
                        
$query="SELECT * FROM comments WHERE comment_post_id={$gpost_id} ";
$query.="AND comment_status='approved' ";
$query.="ORDER BY comment_id DESC";
$display_comment_query=mysqli_query($connection,$query);
if(!$display_comment_query)
{
    die("Query Failed!" . mysqli_error($connection));
}
                
while($row=mysqli_fetch_array($display_comment_query))
{
    $Comment_date=$row['comment_date'];
    $Comment_content=$row['comment_content'];
    $Comment_author=$row['comment_author'];
?>
                        
                        
                                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $Comment_author; ?>
                            <small><?php echo $Comment_date; ?></small>
                        </h4>
                        <?php echo $Comment_content; ?>
                    </div>
                </div>
                       
                       
                        
<?php   } 
    }
}
else
{
header("Location: index.php");
}
?>
                
                            
                            
                            
                            
                            
                    

                
                
                


                <!-- Second Blog Post -->
             

            </div>

            <!-- Blog Sidebar Widgets Column -->
            
<?php include "includes/sidebar.php"; ?>        

            
        </div>
        <!-- /.row -->
        </div>
        <hr>

        
<?php include "includes/footer.php"; ?>