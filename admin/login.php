<?php include("../config/constant.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Food Order System</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
<div class="login">
  
     
  
        <h1 class="text-center">Login</h1>
        <?php 
        
        if(isset($_SESSION['login'])){
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }


        if(isset($_SESSION['no-login-message'])){
            echo $_SESSION['no-login-message'];
            unset($_SESSION['no-login-message']);
        }
        
        ?>
        <br/>

        <!-- login from start here -->
        <form action="" method="POST">

                    Username
                    <input type="text" name="username" placeholder="Enter Your Username">
               

                Password:
                   <input type="password" name="password" placeholder="Enter Your Password">
                

           
                
                <input type="submit" name="submit" value="Login" class="btn-primary">
            
        </form>
        <!-- login from end here -->
        <p class="text-center">Created By: <a href="#">Sanukaji Ale Magar</a></p>
    </div>

    
</body>
</html>

<?php 


if(isset($_POST['submit'])) {
    // //process for login
    // 1.Get the data from login form
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    // 2.create sql to check whether the user with username and password exist or not
    $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
    // 3. execute query
    // check whether the user submit with empty form
    if(!empty($username) && !empty($password)){
        $res = mysqli_query($conn,$sql);
    // check whether the user exist or not
    $count = mysqli_num_rows($res);
    if($count==1) {
        //User Available and login succcess
        $_SESSION['login'] = "<div class='succcess'>Login Successful</div>";
        // create a session if user logged in or  not and logout unset it
        $_SESSION['user'] = $username;
        //Redirect to Dashboard or home page of admin
        header("location: ".SITEURL."admin/");
    } else {
        //User not available
        $_SESSION['login'] = "<div class='error text-center'>Username or password did not mactch.</div>";
        header("location: ".SITEURL."admin/login.php");

    }

    } else {
        $_SESSION['login'] = "<div class='error text-center'>Please fill username and password.</div>";
        header("location: ".SITEURL."admin/login.php");

    }
    
}
?>