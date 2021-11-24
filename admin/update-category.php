<?php include('partials/menu.php');?>
<div class="main_content">
    <div class="wrapper">
        <br><br>
        <h1>Update Category</h1>
        <br><br>
        <?php 
        //whether the id is set or not
        if(isset($_GET['id'])){
            //Get the ID and all other details
            $id = $_GET['id'];
            //create sql query to get all other details
            $sql = "SELECT * FROM tbl_category WHERE id=$id";
            //execute the query
            $res = mysqli_query($conn,$sql);
            //count the rows to check whether the id is valid or not
            $count = mysqli_num_rows($res);

            if($count==1) {
                //Get all data
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $current_image = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];


            } else {
                //redirect to manage-category.php with message
                $_SESSION['no-category-found']="<div class='error'>Category not found.</div>";
                header("location: ".SITEURL."admin/manage-category.php");
            }

        } else {
            //Redirect to manage-category.php page
            header("location: ".SITEURL."admin/manage-category.php");
        }
        
        ?>
<form action="" method="POST" enctype="multipart/form-data">
        <table class="tbl-30">
            <tr>
                <td>Title:</td>
                <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
            </tr>

            <tr>
                <td>Current Image</td>
                <td>
                    <?php
                    
                    if($current_image!="") {
                        //display image
                        ?>
                        <img src="<?php echo SITEURL;?>images/category/<?php echo $current_image;?>" alt="" width="150px">
                        <?php
                        
                    } else {
                        //display error message
                        echo "<div class='error'>Image not added.</div>";
                    }
                    ?>
                   
                </td>
            </tr>


            <tr>
                <td>New Image:</td>
                <td>
                    <input type="file" name="image">
                   
                </td>
            </tr>

            <tr>
                <td>Featured</td>
                <td>
                    <input <?php if($featured=='Yes') {echo 'checked' ;}?> type="radio" name="featured" value="Yes">Yes
                    <input <?php if($featured=='No') {echo 'checked' ;}?> type="radio" name="featured" value="No">No
                </td>
            </tr>


            <tr>
                <td>Active</td>
                <td>
                    <input <?php if($featured=='Yes') {echo 'checked' ;}?> type="radio" name="active" value="Yes">Yes
                    <input <?php if($featured=='No') {echo 'checked' ;}?> type="radio" name="active" value="No">No
                </td>
            </tr>
            <tr>
                <input type="hidden" name="id" value="<?php echo $id;?>">
                <input type="hidden" name='current_image' value="<?php echo $current_image; ?>">
                <td colspan="2"><input type="submit" name="submit" value="Update Category" class="btn-secondary"></td>
            </tr>
        </table>
        </form>

        <?php 
        if(isset($_POST['submit'])) {
            // echo "CLicked";
            //Get all the values from our form
            $id = $_POST['id'];

            $title = $_POST['title'];
            $current_iamge = $_POST['current_image'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            //2.Updating new image if selected

            // check whether the image is selected or not
            if(isset($_FILES['image']['name'])){
                //Get the image details
                $image_name = $_FILES['image']['name'];

                //whether image is available or not
                if($image_name!="") {
                    //Image available
                    //1.upload the new image

                    // Auto rename our image
                    // get the extension of our images(png,jpg,gif) ex. food.jpg
                    $ext = end(explode('.',$image_name));

                    // rename the image 
                    $image_name = 'Food_Category_'.rand(000,999).'.'.$ext;

                    //Source path image 
                    $source_path = $_FILES['image']['tmp_name'];
                    //Destionation path image
                    $destionation_path = "../images/category/".$image_name;

                    // FInally upload the image
                    $uploaded = move_uploaded_file($source_path,$destionation_path);

                    //check whether the image uploaded or not
                    //And if the image is not uploaded then we will stop the prcoces and redirect with error message
                    if($uploaded==false) {
                        //set the message
                        $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
                        //redirect to manage-category.php page
                        header("location: ".SITEURL."admin/manage-category.php");
                        // stop the process
                        die();

                    }


                    //2.Remove the current image if avaialable
                    if($current_iamge!="") {
                        $remove_path = "../images/category/".$current_iamge;
                        $removed = unlink($remove_path);
                        // checked whether the image removed or not
                        //if failed to removed display message and stop the process
                        if($removed==false) {
                            $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current image</div>";
                            //redirect to manage-category.php 
                            header("location:".SITEURL."admin/manage-category.php");
                            // stop the procees
                            die();
                        }

                    } 

                  
                } else {
                    $image_name = $current_image;
                }

            } else {
                $image_name = $current_image;
            }

            //3 Update the database

            $sql2 = "UPDATE tbl_category SET
                title='$title',
                image_name='$image_name',
                featured ='$featured',
                active='$active'
                WHERE id=$id
            ";

            //execute the query
            $res2  =mysqli_query($conn,$sql2);


            //4. Redirect to manage-category with message

            //Check whether query executed or not
            if($res2 ==TRUE) {
                //Category updated 
                $_SESSION['update'] = "<div class='success'>Category updated successfully</div>";
                header("location: ".SITEURL."admin/manage-category.php");
            } else {
                //Failed to update category
                $_SESSION['update'] = "<div class='error'>Failed to update category</div>";
                header("location: ".SITEURL."admin/manage-category.php");
            }


        }


        ?>
    </div>
</div>
<?php include('partials/footer.php');?>

