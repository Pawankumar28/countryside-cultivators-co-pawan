<?php 
session_start();

if(!isset($_SESSION['logged_in'])){
    header("location:login.php");
    exit;
}

    if(isset($_POST['add_to_cart'])){
    //if user has alredy added product to cart
    if(isset($_SESSION['cart'])){

        $products_array_ids = array_column($_SESSION['cart'],"product_id");//[2,3,4,10,15]->array will return product id
        //if product has been added or not to the cart
        if(!in_array($_POST['product_id'], $products_array_ids) ){

            $product_id  = $_POST['product_id'];
            $product_array = array(
                            'product_id' =>  $_POST['product_id'],
                            'product_name' => $_POST['product_name'],
                            'product_price' => $_POST['product_price'],
                            'product_image' => $_POST['product_image'],
                            'product_quantity'=> $_POST['product_quantity']
            );
            //product id acts as unique id for product array which has array stored inside array. eg-> [2=>[],3=>[],5=>[]]
        $_SESSION['cart'][$product_id] = $product_array;
        //product has already been added
        }else{
            echo '<script>aleart("product was alredy added to cart");</script>';
             }
    //if this is the first product
    }else{
        $product_id = $_POST['product_id'];
        $product_name  = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_image = $_POST['product_image'];
        $product_quantity = $_POST['product_quantity'];

        $product_array = array(
            'product_id' => $product_id,
            'product_name' => $product_name, 
            'product_price' => $product_price,
            'product_image' => $product_image,
            'product_quantity'=> $product_quantity
        );
        //product id acts as unique id for product array which has array stored inside array. eg-> [2=>[],3=>[],5=>[]]
    $_SESSION['cart'][$product_id] = $product_array;
    }
    //calculate total
    calculatetotalcart();
    //remove from cart
    }else if(isset($_POST['product_id'])){
        $product_id  = $_POST['product_id'];
        unset($_SESSION['cart'][$product_id]);
        //calculate total
    calculatetotalcart();

    }else if( isset($_POST['edit_quantity']) ){
        //we get id and quantity from the form
        $product_id = $_POST['product_id'];
        
        $product_quantity = $_POST['product_quantity'];
        //get product array from session
        $product_array = $_SESSION['cart'][$product_id];
        //update product quantity
        $product_array['product_quantity'] = $product_quantity;
        //return the array back
        $_SESSION['cart'][$product_id] = $product_array;
        //calculate total
        calculatetotalcart();
    }else{
    ///header('location:index.php');*
    }
    function calculatetotalcart(){
        $total = 0;
        foreach($_SESSION['cart'] as $key => $value){
            $product = $_SESSION['cart'][$key];
            $price = $product['product_price'];
            $quantity = $product['product_quantity'];
            $total = $total + ($price * $quantity);
        }
        $_SESSION['total'] = $total;
    }
?>

<?php include('layouts/header.php');?>
<!--cart-->
    <section class="cart container my-5 py-5">
        <div class="container text-center mt-5">
            <h3>YOUR CART</h3>
            <hr>
        </div>
        <table class="mt-5 pt-5">
        <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Subtotal</th>
        </tr>
        <?php if(isset($_SESSION['cart'])){?>

        <?php foreach($_SESSION['cart'] as $key => $value){ ?>
        <tr>
            <td>
                <div class="product-info">
                    <img src="assets/imgs/<?php echo $value['product_image']; ?>">
                    <div>
                        <p><?php echo $value['product_name']; ?></p>
                            <small><span>Rs.</span><?php echo $value['product_price']; ?></small>
                        <br>
                        <form method="POST" action="cart.php">
                              <input type="hidden" name="product_id" value="<?php echo $value['product_id'];?>">
                              <input type="submit" name="remove_product" class="btn remove-btn" value="remove"/>
                        </form>
                    </div>
                </div>
            </td>
            <td>
                <form method="POST" action="cart.php">
                    <input type="hidden" name="product_id" value="<?php echo $value['product_id'];?>">
                    <input type="number" name="product_quantity" value="<?php echo $value['product_quantity'];?>">
                    <input type="submit" class="btn edit-btn" value="edit" name="edit_quantity"/>
                </form>
            </td>
            <td>
                <span></span>
                <span class="product-price">Rs.<?php echo $value['product_quantity'] * $value['product_price'];?></span>
            </td>
        </tr>
        <?php }?>
        <?php }?>
        </table>
        <div class="cart-total">   
        <table>
            <tr>
                <td>Total</td>
                    <?php if(isset($_SESSION['cart'])){?>
                    <td>Rs.<?php echo $_SESSION['total'];?></td>
                    <?php }?>
            </tr>
        </table>
        </div>
                <div class="checkout-container">
                    <form method="POST" action="checkout.php">
                        <input type="submit" class="btn checkout-btn" value="checkout" name="checkout">
                    </form> 
                </div>
    </section>

<?php include('layouts/footer.php');?>