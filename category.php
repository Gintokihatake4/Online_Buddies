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
                
                if(isset($_GET['category']))
                {
                    $post_category_id=$_GET['category'];
                
                
                 $query = "SELECT * FROM gposts WHERE gpost_category_id={$post_category_id} AND gpost_status='published' ";
                 $select_all_gposts_query = mysqli_query($connection,$query);
                
                if(mysqli_num_rows($select_all_gposts_query) < 1)
                {
                    echo "<h1 class='text-center'>Sorry! No Posts To Show.</h1>";
                }
                    else
                    {
        
                  while($row = mysqli_fetch_assoc($select_all_gposts_query)) 
                    {
                        $gpost_id=$row['gpost_id'];
                        $gpost_title=$row['gpost_title'];
                        $gpost_author=$row['gpost_author'];
                        $gpost_date=$row['gpost_date'];
                        $gpost_image=$row['gpost_image'];
                        $gpost_content=substr($row['gpost_content'],0,100);
                ?>
                
                
                   

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $gpost_id; ?>"><?php echo $gpost_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $gpost_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $gpost_date ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $gpost_image ?>" alt="">
                <hr>
                <p><?php echo $gpost_content ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>    
                
          <?php      } 
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

        <hr>

        
<?php include "includes/footer.php"; ?>