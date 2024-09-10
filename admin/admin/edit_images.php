<?php 
session_start();
include('../server/connection.php');
?>
<?php
if(isset($_GET['product_id'])){
    $product_id = $_GET['product_id'];
    $product_name = $_GET['product_name'];
    }else{
   header('loaction:products.php');
}
?>

<?php include('header.php')?>

        <h2>EDIT IMAGE</h2>
        <div class="table-responsive">
          <div class="mx-auto container">
              <form id="edit-image-form" method="POST" enctype="multipart/form-data" action="update_images.php">
                <p style="color :red;"><?php if(isset($_GET['error'])){echo $_GET['error'];}?></p>

                  <input type="hidden" name="product_id" value="<?php echo $product_id;?>" >
                  <input type="hidden" name="product_name" value="<?php echo $product_name;?>" >
                    <div class="form-group mt-2">
                        <label>Image1</label>
                        <input type="file" class="form-control" id="image1"  name="image1" placeholder="image1" required>
                    </div>
                    <div class="form-group mt-2">
                        <label>Image2</label>
                        <input type="file" class="form-control" id="image2"  name="image2" placeholder="image2" required>
                    </div>
                    <div class="form-group mt-2">
                        <label>Image3</label>
                        <input type="file" class="form-control" id="image3" name="image3" placeholder="image3" required>
                    </div>
                    <div class="form-group mt-2">
                        <label>Image4</label>
                        <input type="file" class="form-control" id="image4" name="image4" placeholder="image4" required>
                    </div>
                    <div class="form-group mt-3">
                        <input type="submit" class="btn btn-primary" name="update_images" value="edit">
                    </div>
              </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>