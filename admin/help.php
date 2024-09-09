<?php 
session_start();
include('../server/connection.php');

if(!isset($_SESSION['admin_logged_in'])){
  header('location:login.php');
 exit;
}
  $stmt = $conn->prepare("SELECT * FROM orders");
  $stmt->execute();
  $orders = $stmt->get_result();//array
?>

<?php include('header.php')?>

        <h2>HELP</h2>
        
        <div class="table-responsive">
            <div class="container mt-3">
                <p>Please contact admin@gmail.com</p>
                <p>Please call 1234567890</p>
            </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>