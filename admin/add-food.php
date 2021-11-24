<?php include("partials/menu.php");?>
<div class="main_content">
    <div class="wrapper">
        <br><br>
        <h1>Add Food</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" placeholder="Title of Food"></td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td><textarea name="description" cols="30" rows="10" placeholder="Description of Food"></textarea></td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td><input type="number" name="price"></td>
                </tr>
                <tr>

                <td>SelectImage:</td>
                <td><input type="file" name='image'></td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td><select name="category">
                        <?php 
                        //Create php code to display Categories from database
                        //Create sql create to get all active category from database
                        //display on dropdown
                        $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                        //execute the sql query
                        $res = mysqli_query($conn,$sql);
                        
                        ?>
                        <option value="1">Food</option>
                        <option value="2">Snack</option>
                       
                    </select></td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" name="submit" value="Add Food"></td>
                </tr>
            </table>
        </form>
    </div>
</div>


<?php include("partials/footer.php");?>