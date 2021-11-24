<?php include('partials/menu.php');?>

<div class="main_content">
    <div class="wrapper">
        <h1 class="my-5">Add Category</h1>
        <br/><br/>
        <?php 
        if(isset($_SESSION['add'])){
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        
        ?>
        <br><br>
        <!-- Add category form start Here -->
        <form action="" method="POST" enctype="multipart/form-data">

        <table class="tbl-30">
            <tr>
                <td>Title:</td>
                <td><input type="text" name="title" placeholder="category title"></td>
            </tr>
            <tr>
                <td>SelectImage:</td>
                <td><input type="file" name="image"></td>
            </tr>

            <tr>
                <td>Featured:</td>
                <td>
                    <input class="form-control" type="radio" name="featured" value="Yes">Yes
                    <input class="form-control" type="radio" name="featured" value="No">No
                </td>
            </tr>

            <tr>
                <td>Active:</td>
                <td>
                    <input class="form-control" type="radio" name="active" value="Yes">Yes
                    <input class="form-control" type="radio" name="active" value="No">No
                </td>
            </tr>

            <tr>
                <td colspan="2"><input type="submit" name="submit" value="Add Category"  class="btn-secondary"></td>
                
            </tr>
        </table>
        </form>


         <!-- Add category form end Here -->

    </div>
</div>


<?php
//check if submit button is clicked or not
if(isset($_POST['submit'])) {
    // 1.Get the value from Category Form
    $title = $_POST['title'];
    //For radio input, we need to check whether the button is selected or not
    if(isset($_POST['featured'])){
        //Get the value from form
        $featured = $_POST['featured'];
    } else {
        //Set the default value
        $featured = "No";
    }
    if(isset($_POST['active'])) {
        $active = $_POST['active'];
    }else {
         //Set the default value
        $active = "No";
    }

    //check whether the image is selected or not
    //set the value for image name accordingly.
    // print_r($_FILES['image']);
    // die(); //Break the code here 
    if(isset($_FILES['image']['name'])){
        //upload the image
        //To upload image we need image name and source path and destination path.
        $image_name = $_FILES['image']['name'];
        
        // upload image only if image is selected
        if($image_name!="") {

        
        //Autorename our image
        //get the extension(jpg,png,gif) of our images ex.food.jpg
        $ext = end(explode('.',$image_name)); 
        //Rename the image
        $image_name = "Food_Category_".rand(000,999).'.'.$ext;//ex.Food_Category_834.jpg


        $source_path = $_FILES['image']['tmp_name'];

        $destination_path = "../images/category/".$image_name;

        // Finally upload the image
        $upload = move_uploaded_file($source_path,$destination_path);
        //check whether the image uploaded or not
        // and if the image is not uploaded then we will stop the process and redirect with error message

        if($upload==false){
            // set message
            $_SESSION['upload'] = "<div class='error'>Failed to upload Image</div>";
            //Redirect to add category page
            header("location:".SITEURL."admin/add-category.php");
            //stop the process
            die();
        }
    }

    }else {
        //don't upload image and set the image_name value as blank;
        $image_name = "";
    }

    //Create sql query to insert into database
    $sql = "INSERT INTO tbl_category SET
    title='$title',
    image_name='$image_name',
    featured='$featured',
    active= '$active'
    ";
    //Execute the query and save into databse
    $res = mysqli_query($conn,$sql);
    //checl whether the query executed successfully or not
    if($res==TRUE) {
        //Query executed and category added
        $_SESSION['add'] = "<div class='success'>Category added successfully</div>";
        //redirect to manage-category.php page
        
        header("location: ".SITEURL."admin/manage-category.php");
    } else {
        //Failed to add category
        $_SESSION['add'] = "<div class='error'>Failed to add Category</div>";
        //redirect to add-category.php page
        header("location: ".SITEURL."admin/add-category.php");
    }
}

?>
<?php include('partials/footer.php');?>