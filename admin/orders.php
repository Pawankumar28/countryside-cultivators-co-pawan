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
        
        <h2>ORDERS</h2>
        <?php if(isset($_GET['order_updated'])){?>
          <p class="text-center" style="color:green;"><?php echo $_GET['order_updated'];?></p>
          <?php }?>

        <?php if(isset($_GET['order_failed'])){?>
          <p class="text-center" style="color:red;"><?php echo $_GET['order_failed'];?></p>
          <?php }?>

          <?php if(isset($_GET['order_deleted'])){?>
          <p class="text-center" style="color:green;"><?php echo $_GET['order_deleted'];?></p>
          <?php }?>

        <?php if(isset($_GET['order_deleted_failed'])){?>
          <p class="text-center" style="color:red;"><?php echo $_GET['order_deleted_failed'];?></p>
          <?php }?>

        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>Order ID</th>
                <th>Order Status</th>
                <th>User ID</th>
                <th>Order Date and Time</th>
                <th>user Phone</th>
                <th>User Address</th>
                <th>Edit</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($orders as $order){?>
  
                <tr>
                 <td><?php echo $order['order_id'];?></td>
                 <td><?php echo $order['order_status'];?></td>
                 <td><?php echo $order['user_id'];?></td>
                 <td><?php echo $order['order_date'];?></td>
                 <td><?php echo $order['user_phone'];?></td>
                 <td><?php echo $order['user_address'];?></td>
                 <td><a class="btn btn-primary" href="edit_order.php?order_id=<?php echo $order['order_id'];?>">Edit</a></td>
                 <td><a class="btn btn-danger" href="delete_orders.php?order_id=<?php echo $order['order_id']?>">Delete</a></td>
                </tr>
              <?php }?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</body>
</html>