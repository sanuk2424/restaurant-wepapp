<?php include("partials/menu.php");?>
<div class="main_content">
    <div class="wrapper">
        <br><br>
        <h1>Add Food</h1>
        <br><br>
        <?php
        if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" placeholder="Title of Food"></td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td><textarea name="description" cols="30" rows="10" placeholder="Description of Food"></textarea></td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td><input type="number" name="price"></td>
                </tr>
                <tr>

                <td>SelectImage:</td>
                <td><input type="file" name='image'></td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td><select name="category">
                        <?php 
                        //Create php code to display Categories from database
                        //Create sql create to get all active category from database
                        //display on dropdown
                        $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                        //execute the sql query
                        $res = mysqli_query($conn,$sql);
                        // check query executed successfully or not
                        //to count rows to check whether we have categories or not
                        $count = mysqli_num_rows($res);

                        // if count grater than 0 we have categories else we dont have categories
                        if($count>0) {
                            while($row=mysqli_fetch_assoc($res)){
                                $title = $row['title'];
                                $id = $row['id'];
                                ?>

                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                        
                                <?php

                            }

                        }

                        else {
                            //We do not have categoris
                            echo "<option value='0'>No Category Found</option>";
                        }
                        ?>
                       
                       
                    </select></td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" name="submit" value="Add Food"></td>
                </tr>
            </table>
        </form>

        <?php 
        
        // check whether submit button clicked or not
        if(isset($_POST['submit'])) {
            //Add the food in databse

            // 1.Get the data from form
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];

            $category = $_POST['category'];

            // check whether radio button (featured or active) checked or not
            if(isset($_POST['featured'])) {
                $featured = $_POST['featured'];
            }else {
                $featured = 'No'; //Setting the default value
            }

            if(isset($_POST['active'])) {
                $active = $_POST['active'];

            } else {
                $active='No';//setting default value
            }


            // 2.Upload the image if selected

            // check whther the select image is clicked or
            //  not and upload the imageonly if the image is selected
            if(isset($_FILES['image']['name'])){
                //Get the details of the selected image
                $image_name = $_FILES['image']['name'];
                if($image_name!="") {
                    //Image is selected
                    //A.rename the image


                    //to get extension of image 
                   
                    $ext = end(explode('.',$image_name)); 

                    // create new name

                    $image_name = "Food_Name_".rand(000,9999).".".$ext;

                    //get Source and destinaiton path
                    $src = $_FILES['image']['tmp_name'];
                    // get destination path
                    $dest = "../images/food/".$image_name; 

                    //B.upload the image

                    $uploaded = move_uploaded_file($src,$dest);

                    // check if the image uploaded successfully or not
                    if($uploaded==false) {
                        //Failed to upload image
                        //Redirect to add-food page with Error message
                        $_SESSION['upload']="<div class='error'>Failed to upload image</div>";
                        header("location: ".SITEURL."admin/add-food.php");
                        //stop the process
                        die();
                    }
                }

                // check whether image is selected or not and upload image if selected.



            } else {
                $image_name = ""; //setting default value as blank.
            }

            //insert into database

            // Create a sql query to insert into database table tbl_food

            //for numerical value we dont need to pass the value inside codes
            //but string value it is compulsary to add single quotes ''
            $sql2 = "INSERT INTO tbl_food SET
            title='$title',
            description='$description',
            price=$price,
            image_name='$image_name',
            category_id=$category,
            featured='$featured',
            active='$active'
            ";
            //Execute query
            $res2 = mysqli_query($conn,$sql2);

             //4.Redirect with message to manage-food.php page

            //check whether data inserted or not

            if($res2==TRUE) {
                //Data inserted successfully
                $_SESSION['add']="<div class='success'>Food Added successfully</div>";
                header("location: ".SITEURL."admin/manage-food.php");
            }else {
                //failed to insert data
                //set message
                $_SESSION['add']="<div class='error'>Failed to add food</div>";
                //redirect to 
                header("location: ".SITEURL."admin/manage-food.php");
            }


           


        }
        
        ?>
    </div>
</div>


<?php include("partials/footer.php");?>