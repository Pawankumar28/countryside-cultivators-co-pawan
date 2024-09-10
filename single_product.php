<?php
include('server/connection.php');

if(isset($_GET['product_id'])){

    $product_id = $_GET['product_id'];
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param("i",$product_id);
    $stmt->execute();
    $products = $stmt->get_result();//array
    //no product id was found
}else{
        header('location: index.php');
    }
?>

<?php include('layouts/header.php');?>
<!--single product-->
    <section class=" container single-product my-5 pt-5">
        <div class="row mt-5">

            <?php while($row = $products->fetch_assoc()){ ?>

                <div class="col-lg-5 col-md-6  col-md-12">
                    <img class="img-fluid w-100 pb-1" src="assets/imgs/<?php echo $row['product_image']; ?>" height="200px" id="mainimg"/>
                    <div class="small-img-group">
                        <div class="small-img-col">
                            <img src="assets/imgs/<?php echo $row['product_image']; ?>" width="100%" class="small-img"/>
                        </div>
                        <div class="small-img-col">
                            <img src="assets/imgs/<?php echo $row['product_image2']; ?>" width="100%" class="small-img"/>
                        </div>
                        <div class="small-img-col">
                            <img src="assets/imgs/<?php echo $row['product_image3']; ?>" width="100%" class="small-img"/>
                        </div>
                        <div class="small-img-col">
                            <img src="assets/imgs/<?php echo $row['product_image4']; ?>" width="100p%" class="small-img"/>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-12 col-12">
                    <h4>Products</h4>
                    <h3 class="py-4"><?php echo $row['product_name']; ?></h3>
                    <h2><?php echo $row['product_price']; ?></h2>
                        <form method="POST" action="cart.php">
                            <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>"/>       
                            <input type="hidden" name="product_image" value="<?php echo $row['product_image']; ?>"/>
                            <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>"/>
                            <input type="hidden" name="product_price" value="<?php echo $row['product_price']; ?>"/>
                            <input type="number" name="product_quantity" value="1"/>
                            <button class="btn buy-btn" type="submit" name="add_to_cart">Add to Cart</button>
                        </form>
                    <h4 class="mt-5 mb-5">Product Details</h4>
                    <span><?php echo $row['product_description']; ?></span>
                </div>
            <?php } ?>
        </div>
    </section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        var mainimg = document.getElementById("mainimg");
        var smallimg = document.getElementsByClassName("small-img");
        for(let i=0; i<4; i++){
            smallimg[i].onclick = function(){
                mainimg.src = smallimg[i].src;
            }
        }
    </script>

<?php include('layouts/footer.php');?>