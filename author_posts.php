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
  $gpost_author=$_GET['author'];
}

$query = "SELECT * FROM gposts WHERE gpost_author='{$gpost_author}'";
$selected_post_query = mysqli_query($connection,$query);

while($row = mysqli_fetch_assoc($selected_post_query)) 
{

$gpost_title=$row['gpost_title'];
$gpost_author=$row['gpost_author'];
$gpost_date=$row['gpost_date'];
$gpost_image=$row['gpost_image'];
$gpost_content=$row['gpost_content'];
?>
                
                
                    <h1 class="page-header">
                    All Posts By: 
                    <small><?php echo $gpost_author ?></small>
                    </h1>

                <!-- First Blog Post -->
                
                <h2>
                   <a href="post.php?p_id=<?php echo $gpost_id; ?>"><?php echo $gpost_title ?></a>
                </h2>
                <p class="lead">
                    
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $gpost_date ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $gpost_image ?>" alt="">
                <hr>
                <p><?php echo $gpost_content ?></p>
                
                <hr>    
                
          <?php      }  ?>
                
                
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
    
                        
$query="UPDATE gposts SET gpost_comment_count=gpost_comment_count+1 ";
$query.="WHERE gpost_id={$gpost_id}";
$update_comment_query=mysqli_query($connection,$query);
if(!$update_comment_query)
{
    die("Query Failed!" . mysqli_error($connection));
}
        
    
}
    else
    {
        echo "<script>alert('Fields Cannot Be Empty!');</script>";
    }
}


?>                      
       
                
             

            </div>

            <!-- Blog Sidebar Widgets Column -->
            
<?php include "includes/sidebar.php"; ?>        

            
        </div>
        <!-- /.row -->
        </div>
        <hr>

        
<?php include "includes/footer.php"; ?>