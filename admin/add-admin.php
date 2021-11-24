<?php include("partials/menu.php");?>

<div class="main_content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br/>  <br/>  <br/>
        <?php
        if(isset($_SESSION['message'])){ //Checking the session message is set
            echo $_SESSION['message']; //Display the session message if set
            unset($_SESSION['message']); //Removing the session message
        } 
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>FullName:</td>
                    <td><input type="text" name="full_name" placeholder="Enter your Fullname"></td>
                </tr>


                <tr>
                    <td>Username</td>
                    <td><input type="text" name="username" placeholder="Enter Your Username"></td>
                </tr>


                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" placeholder="Enter Your Password"></td>
                </tr>

                <tr>
                    <td colspan="2"><input type="submit" value="Add Admin" class="btn-secondary" name="submit"></td>

                </tr>
            </table>
        </form>
    </div>
</div>


<?php include("partials/footer.php");?>

<?php 

//Process the value from form and save it in database

//check whether the submit button is clicked or not
if(isset($_POST['submit'])){

    //Button clicked
    // echo "Button cliked";
    //Get the data from form

    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); //password Encrypt with md5
    
    //SQL query to save the data in database 

    $sql = "INSERT INTO tbl_admin SET 
    full_name='$full_name',
    username='$username',
    password='$password'
    ";
    //check the input field is filled or not
    if(!empty($full_name) && !empty($username) && !empty($password)) {
        //Executing query and saving data in database
    $res = mysqli_query($conn,$sql) or die(mysqli_error());
    //checl whether the (QUery is executed) data is inserted or not and display approproate message
    if($res ==TRUE) {
       
        // create a sesson variable to display message
        $_SESSION['message'] ="<div class='success'>Admin Added Successfully</div>";
        //Redirect Page to Manage Admin
        header("location: ".SITEURL."admin/manage-admin.php");
    } else {
       
        //  create a session variable to display message
        $_SESSION['message'] ="<div class='error'>Failed to add Admin</div>";
        //Redirect Page to Add Admin
        header("location: ".SITEURL."admin/add-admin.php");
    }


    } else {
        $_SESSION['message'] ="<div class='error'>Please Fill All Fields</div>";
        //Redirect Page to Add Admin
        header("location: ".SITEURL."admin/add-admin.php");

    }
 

   
} 

?>