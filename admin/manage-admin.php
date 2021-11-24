<?php include("partials/menu.php");?>
<!-- Main Content Section start here  -->
<div class="main_content">
    <div class="wrapper">
    <br/> <br/>
        <h1>Manage Admin</h1>
       

        <?php 
        if(isset($_SESSION['message'])){
            echo $_SESSION['message']; //Displaying session Message
            unset($_SESSION['message']); //Resetting session Message
        }
      
        ?>
          <br/> <br/> <br/>
        <!-- Button to add admin -->
        <a href="add-admin.php"  class="btn-primary">Add Admin</a>
        <br/> <br/> <br/>

        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>
            <?php 
            //Query to get all Admin
            $sql = "SELECT * FROM tbl_admin";
            // Execute the query
            $res = mysqli_query($conn,$sql);
            // check whether the query is executed or not
            if($res == TRUE) {
                //Count rows to check whether we have data in database or not
                $count = mysqli_num_rows($res);
                // check the number of rows
                if($count>0) {
                    //We have data in databse
                    // Create a variable to assign to id
                    $sn = 1;
                    while($rows = mysqli_fetch_assoc($res)){
                        //Using while loop to get all the data from the database
                        //And while loop will run as long as we have data in database
                        //Get individual data
                        $id = $rows['id'];
                        $full_name = $rows['full_name'];
                        $username = $rows['username'];

                        //Display the values in our table
                       ?>
                      <tr>
                <td><?php echo $sn++; ?></td>
                <td><?php echo $full_name; ?></td>
                <td><?php echo $username; ?></td>
                <td>
                    <a href="<?php echo SITEURL ?>admin/update-password.php?id=<?php echo $id;?>" class="btn-primary">Change Password</a>
                    <a href="<?php echo SITEURL ?>admin/update-admin.php?id=<?php echo $id;?>" class="btn-secondary">Update</a>
                    <a href="<?php echo SITEURL ?>admin/delete-admin.php?id=<?php echo $id;?>" class="btn-danger">Delete</a>
                </td>
            </tr>

                       <?php 
                   

                    }
                } else {
                    // We don't have data in database
                    echo "Nothing in database";

                }
            }
            
            ?>


        </table>

    </div>
</div>
<!-- Maint Content Section end here  -->
<?php include("partials/footer.php");?>