<?php 
session_start();
include('../server/connection.php');

if(!isset($_SESSION['admin_logged_in'])){
    header('location:login.php');
   exit();
}
?>

<?php include('header.php'); ?>

        <h2>ACCOUNT</h2>
        <?php if(isset($_GET['order_updated'])){?>
          <p class="text-center" style="color:green;"><?php echo $_GET['order_updated'];?></p>
          <?php }?>

        <?php if(isset($_GET['order_failed'])){?>
          <p class="text-center" style="color:red;"><?php echo $_GET['order_failed'];?></p>
          <?php }?>

        <div class="table-responsive">
            <div class="container">
                <p>Admin ID : <?php echo $_SESSION['admin_id'];?></p>
                <p>Admin Name : <?php echo $_SESSION['admin_name'];?></p>
                <p>Admin Email : <?php echo $_SESSION['admin_email'];?></p>
            </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>