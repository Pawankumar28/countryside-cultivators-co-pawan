<?php include('layouts/header.php');?>
<?php session_start();?>



<!--home-->
  <section id="home">
    <div class="container">
      <h2> New Equipments </h2>
      <h1>BEST PRICES!</h1>
      <h3><p><span>Quality Products<br>For the most affordable prices!</span></p></h3>
    </div>
  </section>

<!--brand-->
  <section id="brand" >
    <div class="row">
      <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/imgs/John-Deere-logo-2017_v_rgb-scaled.jpg"/>
        <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/imgs/logo01.jpg"/>
          <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/imgs/logo.jpg">
            <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/imgs/logo03.jpg"/>
    </div>
  </section>

<!--featured-->
  <section id="featured" class="my-5 pb-5">
    <div class="container text-center mt-5 py-5">
      <h3>Our Featured Products</h3>
        <hr>
          <p>Here you can check out our new featured products</p>
    </div>
        <div class="row mx-auto container-fluid">
        
        <?php include('server/get_featured_products.php'); ?>
        <?php while($row = $featured_products->fetch_assoc()){ ?>
        
          <div class="product text-center col-lg-3 col-md-4 col-sm-12">
          <img class="img-fluid mb-3" src="assets/imgs/<?php echo $row['product_image']; ?>">
            <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
            <h4 class="p-price">Rs.<?php echo $row['product_price']; ?></h4>
            <a href="<?php echo "single_product.php?product_id=". $row['product_id'];?>"><button class="btn buy-btn">buy now</button></a>
          </div>
        <?php } ?>
    </div>
  </section>

<!--banner-->
  <section id="banner" class="my-5 py-5">
    <div class="container">
      <h4 class="text-center">Affordable Farming Equipments</h4>
      <hr class="mx-auto">
        <h1 class="text-center">We have a wide range of Equipments and Other Products</h1>
    </div>
  </section>
      
<!--equipment-->
  <section id="equipment" class="my-5">
    <div class="container text-center mt-5 py-5">
      <h3>EQUIPMENT</h3>
        <hr>
          <p>Here you can check out our Farming Equipments</p>
    </div>
        <div class="row mx-auto container-fluid">

        <?php include('server/get_equipment.php');?>
        <?php while($row = $equipment->fetch_assoc()){?>

          <div class="product text-center col-lg-3 col-md-4 col-sm-12">
          <img class="img-fluid mb-3" src="assets/imgs/<?php echo $row['product_image'];?>">
            <h5 class="p-name"><?php echo $row['product_name'];?></h5>
            <h4 class="p-price">Rs.<?php echo $row['product_price'];?></h4>
            <a href="<?php echo"single_product.php?product_id=".$row['product_id'];?>"><button class="buy-btn">Buy Now</button></a>
          </div>
        <?php }?>
    </div>
  </section>

<!--fittings-->
  <section id="fittings" class="my-5">
    <div class="container text-center mt-5 py-5">
      <h3>FITTINGS</h3>
      <hr>
      <p>Here you can check out some Fittings</p>
    </div>
          <div class="row mx-auto container-fluid">

          <?php include('server/get_fittings.php');?>
          <?php while($row=$fittings->fetch_assoc()){?>

              <div class="product text-center col-lg-3 col-md-4 col-sm-12">
              <img class="img-fluid mb-3" src="assets/imgs/<?php echo $row['product_image'];?>">
                    
                <h5 class="p-name"><?php echo $row['product_name'];?></h5>
                <h4 class="p-price">Rs.<?php echo $row['product_price'];?></h4>
                <a href="<?php echo"single_product.php?product_id=". $row['product_id'];?>"><button class="buy-btn">Buy Now</button></a>
              </div>
          <?php }?>
          </div>
  </section>

<!--tools-->
  <section id="tools" class="my-5">
    <div class="container text-center mt-5 py-5">
      <h3>TOOLS</h3>
      <hr>
      <p>Here you can check out some TOOLS</p>
    </div>
        <div class="row mx-auto container-fluid">

          <?php include('server/get_tools.php');?>
          <?php while($row=$tools->fetch_assoc()){?>

              <div class="product text-center col-lg-3 col-md-4 col-sm-12">
              <img class="img-fluid mb-3" src="assets/imgs/<?php echo $row['product_image'];?>">
                  
              <h5 class="p-name"><?php echo $row['product_name'];?></h5>
              <h4 class="p-price">Rs.<?php echo $row['product_price'];?></h4>
              <a href="<?php echo"single_product.php?product_id=". $row['product_id'];?>"><button class="buy-btn">buy now</button></a>
              </div>
          <?php }?>
        </div>
  </section>

<!--other-->
  <section id="other" class="my-5">
    <div class="container text-center mt-5 py-5">
      <h3>OTHER PRODUCTS</h3>
      <hr>
      <p>Here you can check out some Other Products</p>
    </div>
        <div class="row mx-auto container-fluid">

          <?php include('server/get_other.php');?>
          <?php while($row=$other->fetch_assoc()){?>

            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img class="img-fluid mb-3" src="assets/imgs/<?php echo $row['product_image'];?>">
                
            <h5 class="p-name"><?php echo $row['product_name'];?></h5>
            <h4 class="p-price">Rs.<?php echo $row['product_price'];?></h4>
            <a href="<?php echo"single_product.php?product_id=". $row['product_id'];?>"><button class="buy-btn">Buy Now</button></a>
            </div>
          <?php }?>
        </div>
  </section>

<?php include('layouts/footer.php');?>