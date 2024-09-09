<?php 
session_start();
include('../server/connection.php');
?>
<?php 
if(isset($_GET['order_id'])){

    $order_id=$_GET['order_id'];
    $stmt = $conn->prepare("SELECT * FROM orders WHERE order_id= ?");
    $stmt->bind_param('i',$order_id);
    $stmt->execute();
    $order = $stmt->get_result();//array

  }elseif(isset($_POST['edit_order'])){

    $order_status = $_POST['order_status'];
    $order_id = $_POST['order_id'];
    $stmt = $conn->prepare("UPDATE orders SET order_status=? where order_id=?");
    $stmt->bind_param('si',$order_status,$order_id);

    if($stmt->execute()){
      header('location:index.php?order_updated=order has been updated successfully');
    }else{
      header('location:index.php?order_failed=error occured try again');
    }
    }else{
        header('location:index.php');
        exit;
    }
?>

<?php include('header.php')?>

        <h2>EDIT ORDER</h2>
        <div class="table-responsive">
          <div class="mx-auto container">
              <form id="edit-order-form" method="POST" action="edit_order.php">
                  <?php foreach($order as $r){?>

                    <p style="color:red;"><?php if(isset($_GET['error'])){echo $_GET['error'];}?></p>
                      <div class="form-group my-3">
                          <label>order-id</label>
                          <p class="my-4"><?php echo $r['order_id']?></p>
                      </div>
                      <div class="form-group mt-3">
                          <label>order-price</label>
                          <p class="my-4"><?php echo $r['order_cost']?></p>
                      </div>
                      <input type="hidden" name="order_id" value="<?php echo $r['order_id'];?>">
                        <div class="form-group my-3">
                            <label>order-status</label>
                              <select class="form-select" required name="order_status">
                              <option value="not paid" <?php if($r['order_status']=='not paid'){echo "selected";}?>>Not-Paid</option>
                              <option value="paid" <?php if($r['order_status']=='paid'){echo "selected";}?>>Paid</option>
                             
                              </select>
                        </div>
                      <div class="form-group my-3">
                          <label>Order-Date</label>
                          <p class="my-4"><?php echo $r['order_date']?></p>
                      </div>
                      <div class="form-group mt-3">
                        <input type="submit" class="btn btn-primary" name="edit_order" value="edit">
                      </div>
                  <?php }?>
              </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>