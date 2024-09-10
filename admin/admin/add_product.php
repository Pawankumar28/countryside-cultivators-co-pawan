<?php 
session_start();
include('../server/connection.php');

if(!isset($_SESSION['admin_logged_in'])){
    header('location:login.php');
   exit;
  }

?>

  <?php include('header.php'); ?>
        <h2>CREATE PRODUCT</h2>
        <div class="table-responsive">
          <div class="mx-auto container">
              <form id="create-form" method="POST" enctype="multipart/form-data" action="create_product.php">
                  <p style="color :red;"><?php if(isset($_GET['error'])){echo $_GET['error'];}?></p>
                    <div class="form-group mt-2">
                    <input type="hidden" name="product_id" value="<?php echo $product['product_id'];?>" >
                        <label>Title</label>
                        <input type="text" class="form-control" id="product-name"  name="name" placeholder="Enter Product Name" required>
                    </div>
                    <div class="form-group mt-2">
                        <label>Description</label>
                        <input type="text" class="form-control" id="product-desc"  name="description" placeholder="Enter Product Description" required>
                    </div>
                    <div class="form-group mt-2">
                        <label>Price</label>
                        <input type="text" class="form-control" id="product-price"  name="price" placeholder="Enter Product Price" required>
                    </div>
                    <div class="form-group mt-2">
                        <label>Color</label>
                        <input type="text" class="form-control" id="produc-color"  name="color" placeholder="Enter Product Color" required>
                    </div>
                    <div class="form-group mt-2">
                        <label>Category</label>
                        <select class="form-select" required name="category">
                            <option value="fittings">Fittings</option>
                            <option value="fittings">Equipment</option>
                            <option value="tools">Tools</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="form-group mt-2">
                        <label>Image1</label>
                        <input type="file" class="form-control" id="image1"  name="image1" placeholder="Enter Image 1" required>
                    </div>
                    <div class="form-group mt-2">
                        <label>Image2</label>
                        <input type="file" class="form-control" id="image2"  name="image2" placeholder="Enter Image 2" required>
                    </div>
                    <div class="form-group mt-2">
                        <label>Image3</label>
                        <input type="file" class="form-control" id="image3" name="image3" placeholder="Enter Image 3" required>
                    </div>
                    <div class="form-group mt-2">
                        <label>Image4</label>
                        <input type="file" class="form-control" id="image4" name="image4" placeholder="Enter Image 4" required>
                    </div>
                    <div class="form-group mt-3">
                        <input type="submit" class="btn btn-primary" name="create_product" value="Create">
                    </div>
              </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>