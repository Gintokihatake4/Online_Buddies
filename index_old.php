<?php include "includes/db.php"; ?>
<!--
<style>
    body {
          background-color:brown;
         }
</style>
-->
<?php include "includes/header.php"; ?>




    <!-- Navigation -->
   
<?php include "includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <?php 
                
                 $query = "SELECT * FROM gposts ";
                 $select_all_gposts_query = mysqli_query($connection,$query);
        
                  while($row = mysqli_fetch_assoc($select_all_gposts_query)) 
                    {
                        $gpost_id=$row['gpost_id'];
                        $gpost_title=$row['gpost_title'];
                        $gpost_author=$row['gpost_author'];
                        $gpost_date=$row['gpost_date'];
                        $gpost_image=$row['gpost_image'];
                        $gpost_content=substr($row['gpost_content'],0,100);
                        $gpost_status=$row['gpost_status'];
                      
                      if($gpost_status == 'published')
                      {
                ?>
                
<!--
                
                    <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
-->
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $gpost_id; ?>"><?php echo $gpost_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="author_posts.php?author=<?php echo $gpost_author; ?>&p_id=<?php echo $gpost_id; ?>"><?php echo $gpost_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $gpost_date ?></p>
                <hr>
                <a href="post.php?p_id=<?php echo $gpost_id; ?>">
                <img class="img-responsive" src="images/<?php echo $gpost_image ?>" alt="">
                </a>
                <hr>
                <p><?php echo $gpost_content ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $gpost_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>    
                
          <?php      } } ?>
                
                
                


                <!-- Second Blog Post -->
             

            </div>

            <!-- Blog Sidebar Widgets Column -->
            
<?php include "includes/sidebar.php"; ?>        

            
        </div>
        <!-- /.row -->

        <hr>

        
<?php include "includes/footer.php"; ?>