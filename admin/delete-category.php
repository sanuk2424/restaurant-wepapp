
<?php include('partials/menu.php');?>

<div class="main_content">
    <div class="wrapper">
    <h1>Delete Category</h1>
    <form action="" method="POST">

<p class="delete-title text-center">Are you sure want to delete?</p>
<input type="submit" name="yes" value="Yes" class="btn-danger">
<input type="submit" name="no" value="No" class="btn-primary">


</form>


    </div>
</div>



<?php include('partials/footer.php');?>



<?php 

if(isset($_POST['yes'])) {
    //Process to delete the category
    //check whether the id and image_name value set or not
    if(isset($_GET['id']) AND  isset($_GET['image_name'])) {
        //get the value and delete
        // echo "Get value and Delete";
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //Remove the physical image file if available
        if($image_name!=''){
            //image is available.so we remove it
            $path = "../images/category/".$image_name;
            
            // remove the image
            $remove = unlink($path);
            // Print_r($remove);
            // die();
            
            //if failed to remove image then add error message and stop the process
            if($remove==false) {
                //Set the session message
                $_SESSION['remove']="<div class='error'>Failed to remove Category Image</div>";
                //Redirect to manage-category.php page
                header("location: ".SITEURL."admin/manage-category.php");
                //stop the process
                die();

            }

        } 

        //Delete data from database
        //create a sql query to delete data from database
        $sql = "DELETE FROM tbl_category WHERE id=$id";

        //Execute the query
        $res = mysqli_query($conn,$sql);

        //check whether the data deleted or not
        if($res==TRUE) {
             //SET SUCCESS message and redirec
            $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully.</div>";
           header("location:".SITEURL."admin/manage-category.php");
        } else {
            //Set Fail message and redirect
            $_SESSION['delete'] = "<div class='error'>Failed to delete category.</div>";
           header("location:".SITEURL,"admin/manage-category.php");
        }


        //Redirect to manage-category.php page with message

    }else {
    //redirect to manage-category.php page
    header("location: ".SITEURL."admin/manage-category.php");

    }


} else if(isset($_POST['no'])) {
    //redirect to manage-category.php page
    header("location: ".SITEURL."admin/manage-category.php");

}






?>