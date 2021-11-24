<?php include('partials/menu.php');?>

<div class="main_content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br/><br/>

        <?php 
        if(isset($_GET['id'])){
            $id =$_GET['id'];

        }
        
        
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                  <td>CurrentPassword</td>
                  <td><input type="password" name="current_password"  placeholder="Current Password"></td>
                </tr>
                <tr>
                    <td>NewPassword</td>
                    <td><input type="password" name="new_password" placeholder="New Password"></td>
                </tr>

                <tr>
                    <td>ConfirmPassword</td>
                    <td><input type="password" name="confirm_password" placeholder="Confirm Password"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary"> 
                    </td>
                </tr>

            </table>
        </form>
    </div>
</div>

    <?php 
    // check whether the submit button is clicked or not 
    if(isset($_POST['submit'])) {
        //Get data from form
        $id = $_POST['id'];
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);


        
        //check whether the admin with current password exist or not
        $sql  = "SELECT * FROM tbl_admin WHERE id = $id AND password='$new_password'";
        //execute the query
        $res = mysqli_query($conn,$sql);
        if($res==TRUE) {
            //check whether the data is available or not
            $count = mysqli_num_rows($res);
            if($count==1) {
                //Admin exist and password can be changed
                // check whether the new password and confirm password matched or not
                if($new_password ==$confirm_password) {
                    // Update the password
                    //Create a query
                    $sql2 = "UPDATE tbl_admin SET 
                    password = '$new_password' 
                    WHERE id=$id
                    ";
                    //Execute the query
                    $res2 = mysqli_query($conn,$sql2);
                    //check the query executed successfully or  not
                    if($res2 ==TRUE) {
                        //Display message
                        $_SESSION['message'] = "<div class='success'>Changed password Successfully </div>";
                        header("location: ".SITEURL."admin/manage-admin.php");

                    } else {
                        //display Error message
                        $_SESSION['message'] = "<div class='error'>Failed to change password</div>";
                        header("location: ".SITEURL."admin/manage-admin.php");
                    }

                } else {
                    //Redirect to manage admin page with Error Message
                    $_SESSION['message'] = "<div class='error'>Password did not match.</div>";
                    header("location: ".SITEURL."admin/manage-admin.php");

                }
                $_SESSION['message'] = "<div class='success'>Successfully Changed password</div>";
                header("location: ".SITEURL."admin/manage-admin.php");

            } else {
                //Admin does not exist set message and redirect
                $_SESSION['message'] ="<div class='error'> User not found.</div>";
                header("location: ".SITEURL."admin/manage-admin.php");

            }
        }

        //check whether the new pasword and confirm password match or not
        // change password if all above it true
        
    }

?>
<?php include('partials/footer.php');?>