<?php include('partials/menu.php');?>
<div class="main_content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br/><br/>
        <?php 
        //Get the id of selected admin
        $id = $_GET['id'];

        //Get the sql query to get details
        $sql = "SELECT * FROM tbl_admin WHERE id=$id";
        //Execute query
        $res = mysqli_query($conn,$sql);

        // check whether the query executed or not

        if($res==TRUE) {
            //Check whether the data is available or not
            $count = mysqli_num_rows($res);
            //check whether we have admin data or not
            if($count==1) {
                // echo "Admin Available";
                $row = mysqli_fetch_assoc($res);
                $full_name = $row['full_name'];
                $username = $row['username'];

            } else {
                //Redirect to manage admin page
                header("location:".SITEURL."admin/manage-admin.php");
            }

        }

        
        
        ?>
        <form action="" method="POST">
        <table class="tbl-30">
            <input type="hidden" name="id" value="<?php echo $id;?>">
                <tr>
                    <td>FullName:</td>
                    <td><input type="text" name="full_name" value="<?php echo $full_name; ?>"></td>
                </tr>


                <tr>
                    <td>Username</td>
                    <td><input type="text" name="username" value="<?php echo $username; ?>"></td>
                </tr>


             

                <tr>
                    <td colspan="2"><input type="submit" value="Update Admin" class="btn-secondary" name="submit"></td>

                </tr>
            </table>

        </form>
    </div>
</div>

<?php 
//check whether the submit button is click or not
if(isset($_POST['submit'])) {
    // Get the selected admin data to update
    $id  = $_POST['id'];
    $full_name = $_POST['full_name'];
    $username = $_POST['username']; 
    echo $username;

    //create a sql query to update selected admin data
    $sql = "UPDATE tbl_admin SET 
    full_name='$full_name',
    username='$username' 
    WHERE id='$id'
    ";

    // Execite the query
    $res = mysqli_query($conn,$sql);

    // whether the query executed successfully or not
    if($res==TRUE) {
        //Query executed and update admin
        $_SESSION['message'] = "<div class='success'>Admin updated successfully.</div>";
        header("location: ".SITEURL."admin/manage-admin.php");
    } else {
        //Failed to update admin 
        $_SESSION['message'] = "<div class='error'>Failed to update admin.</div>";
        header("location: ".SITEURL."admin/manage-admin.php");

    }


}

?>
<?php include('partials/footer.php');?>