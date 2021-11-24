<?php include("partials/menu.php");?>
    <!-- Main Content Section start here  -->
    <div class="main_content">
        <div class="wrapper">
        <br/> <br/>
            <h1>Manage Category</h1>
            
            <br/> <br/>
            <?php 
        if(isset($_SESSION['add'])){
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if(isset($_SESSION['remove'])){
            echo $_SESSION['remove'];
            unset($_SESSION['remove']);
        }

        if(isset($_SESSION['delete'])){
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }

        if(isset($_SESSION['no-category-found'])){
            echo $_SESSION['no-category-found'];
            unset($_SESSION['no-category-found']);
        }

        if(isset($_SESSION['update'])){
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }

        if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        
        if(isset($_SESSION['failed-remove'])){
            echo $_SESSION['failed-remove'];
            unset($_SESSION['failed-remove']);
        }

        
        ?>
         <br/> <br/>
        <!-- Button to add Category -->
        <a href="<?php echo SITEURL; ?>admin/add-category.php"  class="btn-primary">Add Category</a>
        <br/> <br/> <br/>

        <table id="example"  class="tbl-full">
        <thead class="thead-light">   
        <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Action</th>
            </tr>
          
            </thead> 
        <tbody>
            <?php 
            
            //Get all data from database
            //Create a sql query
            $sql="SELECT * FROM tbl_category";
            //execute query 
            $res = mysqli_query($conn,$sql);
            //count the rows
            $count = mysqli_num_rows($res);
            //check whether we have data in database or not
            if($count>0) {
                //We have data in database
                $sn=1;
                while($row = mysqli_fetch_assoc($res)){
                    $id=$row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                    ?>
                <tr>
                     <td><?php echo $sn++;?></td>
                <td><?php echo $title;?></td>

                <td>
                    <?php
                    //check whether image name is available or not
                    if($image_name!="") {
                        ?>
                        <img class="sm-img" 
                    src="<?php echo SITEURL.'images/category/'. $image_name;?>" 
                    alt="<?php echo $row['image_name']; ?>" 
                    width="100px" 
                    
                    >

                        <?php

                    } else {
                        //display the message
                        echo "<div class='error'>Image not Added.</div>";
                    }
                    ?>
                    
                   
                </td>
                <td><?php echo $featured;?></td>
                <td><?php echo $active;?></td>
                <td>
                    <a href="<?php echo SITEURL;?>admin/update-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name;?>" 
                    class="btn-secondary">Update Category</a>
                    <a 
                    href="<?php echo SITEURL;?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name;?>" 
                    class="btn-danger">Delete Category</a>
                </td>
            </tr>


                    <?php
                }

            } else {
                //We donot have data
                //We will display message inside table

            }
            
            ?>
               


           


               </tbody>   

        </table>

            
        </div>
    </div>
    <!-- Maint Content Section end here  -->
    <?php include("partials/footer.php");?>