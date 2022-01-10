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
                
                $per_page=2;
                
                if(isset($_GET['page']))
                {
                    $page=$_GET['page'];
                }
                else
                {
                    $page="";
                }
                
                if($page=="" || $page==1)
                {
                    $page_1=0;
                }
                else
                {
                    $page_1=($page*$per_page)-$per_page;
                }
                
                $Query="SELECT * FROM gposts WHERE gpost_status='published'" ;
                $post_count_query=mysqli_query($connection,$Query);
                $post_count=mysqli_num_rows($post_count_query);
                
                if($post_count<1)
                {
                    echo "<h1 class='text-center'>Sorry! No Posts To Show.</h1>";
                }
                else
                {
                
                $post_count=ceil($post_count/$per_page);
                
                
                 $query = "SELECT * FROM gposts LIMIT {$page_1}, {$per_page}";
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
                      
                      
                ?>
                
<!--
                
                    <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
-->
                

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
                
          <?php  }    
                  
                } ?>
                
                
                


                <!-- Second Blog Post -->
             

            </div>

            <!-- Blog Sidebar Widgets Column -->
            
<?php include "includes/sidebar.php"; ?>        

            
        </div>
        <!-- /.row -->

        <hr>

       <ul class="pager">
           
           <?php
           
            for($i=1;$i<=$post_count;$i++)
            {
                if($i==$page)
                {
                  echo "<li><a class='active_link' href='index.php?page={$i}'>{$i}</a></li>";    
                }
                else
                {
                  echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";    
                }
                
            }
           
           ?>
       
       </ul>
        
<?php include "includes/footer.php"; ?>