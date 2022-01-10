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
                            <small><?php echo $_SESSION['username']; ?></small>
                        </h1>
                        
                        <div class="col-xs-6">
                            
        
<!--INSERT CATEGORY QUERY--> 
<?php insert_category(); ?>

     
                            <!-- Add Category form-->
                        <form action="" method="post">
                            <div class="form-group">
                            <label for="cat-title">Category Name</label>
                            <input type="text" class="form-control" name="cat_title">
                            </div>                
                            <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                            </div>    
                        </form>
                            
             
<?php //UPDATE
                            
    if(isset($_GET['edit']))
    {
      $cat_id = $_GET['edit'];  
      include "includes/update_categories.php";
    
    }
?>     
                                                        

                     
                        </div> <!-- ADD CATEGORY -->
                          
                        
                        <div class="col-xs-6">

                        <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Category </th>
                            </tr>
                        </thead>
                        <tbody>
                            
<!--ALL CATEGORIES QUERY--> 
                            
 <?php findAllCategories(); ?>


  <!--DELETE QUERY-->                           
<?php deleteCategories(); ?>

                           
                        </tbody>
                        </table>
                        
                        </div>
                            
                       
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

 <?php include "includes/admin_footer.php"; ?>