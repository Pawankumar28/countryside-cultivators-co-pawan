<?php

include('server/connection.php');
$stmt = $conn->prepare("SELECT * FROM products");
$stmt->execute();
$products = $stmt->get_result();
?>

<?php include('layouts/header.php');?>
<!--shop-->
    <section id="shop" class="my-5 py-5">
        <div class="container text-center mt-9 py-5">
            <h3>OUR PRODUCTS</h3>
            <hr>
            <p>Here you can check out Our Products</p>
        </div>
        <div class="row mx-auto container">
            <?php while($row = $products->fetch_assoc()){?>
         
                <div onclick="window.location.href='single_product.php';"class="product text-center col-lg-3 col-md-4 col-sm-12">
                    <img class="img-fluid mb-3" src="assets/imgs/<?php echo $row['product_image'];?>">
                    <h5 class="p-name"><?php echo $row['product_name'];?></h5>
                    <h4 class="p-price">Rs.<?php echo $row['product_price'];?></h4>
                    <a href="<?php echo"single_product.php?product_id=". $row['product_id'];?>"><button class="btn buy-btn">Buy Now</button></a>
                </div>
            <?php } ?>
        </div>
    </section>

<?php include('layouts/footer.php');?>