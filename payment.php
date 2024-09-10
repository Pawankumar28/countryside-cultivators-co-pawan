<?php
session_start();

if(isset($_POST['order_pay_btn'])){
    $order_status = $_POST['order_status'];
    $order_total_price = $_POST['order_total_price'];
}
?>

<?php include('layouts/header.php');?>
<!--payment-->
    <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-weight-bold">PAYMENT</h2>
            <hr>
        </div>
        <div class="mx-auto container text-center">
            <form method="POST" action="complete_payment.php">
                <?php if(isset($_SESSION['total']) && $_SESSION['total'] != 0){?>
                    <?php $amount = strval($_SESSION['total']);?>
                    <p>Total Payment:Rs.<?php echo $_SESSION['total'];?></p>
                    <p>Cash On Dilevery</p>
                    <input class="btn btn-primary" type="submit" name="pay" value="cash on dilevery">
            </form>
            <form method="POST" action="complete_payment.php">
                <?php }else if(isset($_POST['order_status']) && $_POST['order_status'] == "not paid"){?>
                <?php $amount = strval($_POST['order_total_price']);?> 
                    <p>Total Payment:Rs.<?php echo $_POST['order_total_price'];?></p>
                    <p>Cash On Dilevery</p>
                    <input class="btn btn-primary" type="submit" name="pay" value="cash on dilevery">
            </form>
                <?php }else{ header("location:payment.php?error=something went wrong") ?>
                    <p>You dont have an Order</p>
                <?php  } ?> 
        </div>
    </section>

  <?php include('layouts/footer.php');?>