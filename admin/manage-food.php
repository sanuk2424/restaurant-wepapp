<?php include("partials/menu.php");?>
    <!-- Main Content Section start here  -->
    <div class="main_content">
        <div class="wrapper">
            <br><br>
            <h1>Manage Food</h1>
            
               
            <br/> <br/>
            <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            ?>
             <br/> <br/>
        <!-- Button to add Food -->
        <a href="<?php echo SITEURL?>admin/add-food.php"  class="btn-primary">Add Food</a>
        <br/> <br/>

        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Description</th>
                <th>Price</th>
                <th>Image</th>
                <th>Category</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Action</th>
            </tr>
            <?php 
            
            //Get data from database to display
            //create sql query 
            $sql = "SELECT * FROM tbl_food";
            //execute query
            $res = mysqli_query($conn,$sql);
            //Count the number of rows
            $count = mysqli_num_rows($res);

            // check whether the data is available or not in database

            if($count>0) {
                //Get the data
                $sn = 1;

                while($row = mysqli_fetch_assoc($res)){
                    $id = $row['id'];
                    $title = $row['title'];
                    $description = $row['description'];
                    $price = $row['price'];
                    $image_name = $row['image_name'];
                    $category = $row['category_id'];
                    $featured = $row['featured'];
                    $active = $row['active'];

                    ?>

                <tr>
                    <td><?php echo $sn++;?></td>
                    <td><?php echo $title; ?></td>
                    <td><?php echo $description; ?></td>
                    <td><?php echo $price; ?></td>
                    <td>
                        <?php 
                        if($image_name!=""){
                            ?>
                            <img 
                            src="<?php echo SITEURL?>images/food/<?php echo $image_name;?>" 
                            alt="<?php echo $image_name;?>"
                            width="100px"
                            >

                            <?php
                        } else {
                            echo "<div class='error'>Image Not Found</div>";
                        }
                        ?>
                       
                    </td>
                    <td><?php echo $category; ?></td>
                    <td><?php echo $featured; ?></td>
                    <td><?php echo $active; ?></td>
                
                    <td>
                        <a title="update" href="#" class="btn-secondary"><i class="fas fa-edit"></i></a>
                        <a title="delete" href="#" class="btn-danger"><i class="far fa-times-circle"></i></a>
                    </td>
            </tr>


                    <?php

                }
            } else {
                echo "<tr><td colspan='10'>Food Not Added Yet.</td></tr>";
            }
            
            ?>
            


           

            

        </table>
            
        </div>
    </div>
    <!-- Maint Content Section end here  -->
    <?php include("partials/footer.php");?>