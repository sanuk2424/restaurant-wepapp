<?php include("partials/menu.php");?>
    <!-- Main Content Section start here  -->
    <div class="main_content">
        <div class="wrapper">
            <br><br>
            <h1>Manage Food</h1>
            
               
            <br/> <br/>
        <!-- Button to add Food -->
        <a href="<?php echo SITEURL?>/admin/add-food.php"  class="btn-primary">Add Food</a>
        <br/> <br/>

        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Action</th>
            </tr>
            <tr>
                <td>1.</td>
                <td>Sanukaji Ale Magar</td>
                <td>sanukajiale</td>
                <td>
                    <a href="#" class="btn-secondary">Update</a>
                    <a href="#" class="btn-danger">Delete</a>
                </td>
            </tr>


            <tr>
                <td>2.</td>
                <td>Sanukaji Ale Magar</td>
                <td>sanukajiale</td>
                <td>
                <a href="#" class="btn-secondary">Update</a>
                    <a href="#" class="btn-danger">Delete</a>
                </td>
            </tr>


            

        </table>
            
        </div>
    </div>
    <!-- Maint Content Section end here  -->
    <?php include("partials/footer.php");?>