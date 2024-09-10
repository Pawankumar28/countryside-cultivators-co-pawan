<?php 
session_start();
include('../server/connection.php');

if(isset($_GET['product_id'])){

$product_id=$_GET['product_id'];
$stmt = $conn->prepare("SELECT * FROM products WHERE product_id= ?");
$stmt->bind_param('i',$product_id);
$stmt->execute();
$products = $stmt->get_result();//array

}else if(isset($_POST['edit_btn'])){

    $product_id = $_POST['product_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $color = $_POST['color'];
    $category = $_POST['category'];

    $stmt = $conn->prepare("UPDATE products SET product_name=?, product_description=?, product_price=?,
    product_color=?, product_category=? where product_id=?");
    $stmt->bind_param('sssssi',$title,$description,$price,$color,$category,$product_id);

    if($stmt->execute()){
        header('location:products.php?edit_success_message=product has been updated successfully');
    }else{
        header('location:products.php?edit_failure_message=error occured try again');
    }

}else{
    header('products.php');
    exit;
}
?>

<?php include('header.php')?>

        <h2>EDIT PRODUCT</h2>
        <div class="table-responsive">
          <div class="mx-auto container">
              <form id="edit-form" method="POST" action="edit_product.php">
                  <p style="color :red;"><?php if(isset($_GET['error'])){echo $_GET['error'];}?></p>
                    <div class="form-group mt-2">

                    <?php foreach($products as $product){?>

                    <input type="hidden" name="product_id" value="<?php echo $product['product_id'];?>" >
                        <label>Title</label>
                        <input type="text" class="form-control" id="product-name" value="<?php echo $product['product_name']?>" name="title" placeholder="title" required>
                    </div>
                    <div class="form-group mt-2">
                        <label>Description</label>
                        <input type="text" class="form-control" id="product-desc" value="<?php echo $product['product_description']?>" name="description" placeholder="description" required>
                    </div>
                    <div class="form-group mt-2">
                        <label>Price</label>
                        <input type="text" class="form-control" id="product-price" value="<?php echo $product['product_price']?>" name="price" placeholder="price" required>
                    </div>
                    <div class="form-group mt-2">
                        <label>color</label>
                        <input type="text" class="form-control" id="produc-color" value="<?php echo $product['product_color']?>" name="color" placeholder="color" required>
                    </div>
                    <div class="form-group mt-2">
                        <label>Category</label>
                          <select class="form-select" required name="category">
                              <option value="fittings">Fittings</option>
                              <option value="equipment">Equipment</option>
                              <option value="tools">Tools</option>
                              <option value="other">Other</option>
                          </select>
                    </div>
                    <?php }?>
                    <div class="form-group mt-3">
                        <input type="submit" class="btn btn-primary" name="edit_btn" value="edit">
                    </div>
              </form>
          </div>
      </div>
      </div>
    </div>
  </div>
</body>
</html>