<?php 
session_start();
include('../server/connection.php');

if(!isset($_SESSION['admin_logged_in'])){//remove ! if it dosent work
  header('location:login.php');
  exit;
}
  $stmt = $conn->prepare("SELECT * FROM products");
  $stmt->execute();
  $products = $stmt->get_result();//array
?>

<?php include('header.php')?>

        <h2>PRODUCTS</h2>
          <?php if(isset($_GET['product_created'])){?>
          <p class="text-center" style="color:green;"><?php echo $_GET['product_created'];?></p>
          <?php }?>

          <?php if(isset($_GET['product_failed'])){?>
          <p class="text-center" style="color:red;"><?php echo $_GET['product_failed'];?></p>
          <?php }?>

          <?php if(isset($_GET['edit_success_message'])){?>
          <p class="text-center" style="color:green;"><?php echo $_GET['edit_success_message'];?></p>
          <?php }?>

          <?php if(isset($_GET['edit_failure_message'])){?>
          <p class="text-center" style="color:red;"><?php echo $_GET['edit_failure_message'];?></p>
          <?php }?>

          <?php if(isset($_GET['deleted_successfully'])){?>
          <p class="text-center" style="color:green;"><?php echo $_GET['deleted_successfully'];?></p>
          <?php }?>

          <?php if(isset($_GET['deleted_failure'])){?>
          <p class="text-center" style="color:red;"><?php echo $_GET['deleted_failure'];?></p>
          <?php }?>

          <?php if(isset($_GET['images_updated'])){?>
          <p class="text-center" style="color:green;"><?php echo $_GET['images_updated'];?></p>
          <?php }?>

          <?php if(isset($_GET['images_failed'])){?>
          <p class="text-center" style="color:red;"><?php echo $_GET['images_failed'];?></p>
          <?php }?>
          
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>Product ID</th>
                <th>Product Image</th>
                <th>Product Name</th>
                <th>Product Price</th>
                <th>Product Category</th>
                <th>Product Color</th>
                <th>Edit Images</th>
                <th>Edit</th>
                <th>Delete</th>
              </tr>
            </thead>
              <tbody>
                <?php foreach($products as $product){?>
              
                  <tr>
                  <td><?php echo $product['product_id'];?></td>
                  <td><img src="<?php echo "../assets/imgs/" .$product['product_image'];?>" style="width:70px; height:70px; "></td>
                  <td><?php echo $product['product_name'];?></td> 
                  <td><?php echo "Rs.".$product['product_price'];?></td>
                  <td><?php echo $product['product_category'];?></td>
                  <td><?php echo $product['product_color'];?></td>
                  <td><a class="btn btn-warning" href="<?php echo "edit_images.php?product_id=".$product['product_id']."&product_name=".$product['product_name'];?>">Edit images</a></td>
                  <td><a class="btn btn-primary" href="edit_product.php?product_id=<?php echo $product['product_id'];?>">Edit</a></td>
                  <td><a class="btn btn-danger" href="delete_product.php?product_id=<?php echo $product['product_id']?>">Delete</a></td>
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