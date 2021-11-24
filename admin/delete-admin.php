
<?php include('partials/menu.php');?>

<div class="main_content">
    <div class="wrapper">
    <h1>Delete Admin</h1>
    <form action="" method="POST">

<p class="delete-title text-center">Are you sure want to delete?</p>
<input type="submit" name="yes" value="Yes" class="btn-danger">
<input type="submit" name="no" value="No" class="btn-primary">


</form>


    </div>
</div>



<?php include('partials/footer.php');?>


<?php 
//include constant.php file here
// include('../config/constant.php');
//to get the id of admin to be deleted
$id = $_GET['id'];

//create a sql query to delete an admin
$sql = "DELETE FROM tbl_admin WHERE id=$id";
//execute the query

// check which button is clicked delete or not
if(isset($_POST["yes"])){
    $res = mysqli_query($conn,$sql);

//check whether query executed successfully or not
if($res==TRUE) {
    //Query executed Successfully and admin delete
    $_SESSION['message'] = "<div class='success'>Admin deleted successfully</div>";
    header("location: ".SITEURL."admin/manage-admin.php");

   
} else {
    
    $_SESSION['message'] = "<div class='error'>Failed to delete Admin.Try again later</div>";
    header("location: ".SITEURL."admin/manage-admin.php");

}
    
} else if(isset($_POST["no"])) {
    header("location: ".SITEURL."admin/manage-admin.php");

}

 

?>