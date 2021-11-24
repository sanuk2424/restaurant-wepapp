<?php include("partials/menu.php"); ?>
    <!-- Main Content Section start here  -->
    <div class="main_content">
        <div class="wrapper">
            <h1>Dashboard</h1>
            <br/><br/>
            <?php 
        
        if(isset($_SESSION['login'])){
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        ?>

            <div class="col-4 text-center">
                <h1>5</h1>
                <br />
                Categories
            </div>

            <div class="col-4 text-center">
                <h1>5</h1>
                <br />
                Categories
            </div>

            <div class="col-4 text-center">
                <h1>5</h1>
                <br />
                Categories
            </div>

            <div class="col-4 text-center">
                <h1>5</h1>
                <br />
                Categories
            </div>
            <div class="clearfix"></div>
            
        </div>
    </div>
    <!-- Maint Content Section end here  -->

  <?php  include("partials/footer.php"); ?>