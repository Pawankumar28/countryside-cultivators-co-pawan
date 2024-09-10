<?php 
session_start();

include('server/connection.php');
//change order_status to paid
if(isset($_GET['order_id']) && isset($_GET['user_id'])){

        $order_id = $_GET['order_id'];
        $order_status = "paid";
        $user_id = $_SESSION['user_id'];
        //change order_status to paid
        $stmt = $conn->prepare("UPDATE orders SET order_status=? where order_id=?");
        $stmt->bind_param('si',$order_status,$order_id);
        $stmt->execute();
        $stmt->store_result();
        //store payment info in database
        $stmt1 = $conn->prepare("INSERT INTO payments (order_id,user_id)
        VALUES (?,?);");

        $stmt1->bind_param('ii',$order_id,$user_id);
        $stmt1->execute();
        $stmt->store_result();
        //go to user account
        header("location: ../account.php?payment_message=paid successfully ,thanks for your purchase");
}else{
    //header("location:index.php");
    //exit;
}
?>

<?php include('layouts/header.php'); ?>
    <section>
        <div>
            <meta charset="utf-8">
                <style type="text/css">
                    body{
                        padding: 0;
                        margin: 0;
                        background: #fff;
                    }
                    h1{
                        font-size: 1.5rem;
                        margin: 0;
                        padding: 0;
                        text-align: center;
                        font-family: 'arial';
                        padding-top: 90px;
                        text-decoration-color: green;
                    }
                    h2{
                        font-size: 1.0rem;
                        margin: 0;
                        padding: 0;
                        text-align: center;
                        font-family: 'arial';
                        padding-top: 10px;
                        text-decoration-color: green;
                    }
                </style>
                <div class="mx-auto container text-left">
                    <form method = "POST" >
                        <h1>Thank you for your Order</h1>
                        <hr>
                        <h1>Order Placed Successfully</h1>
                        <h2>You will recive your order within 10Days</h2>
                        <h2>If you have any Questions or want to Cancel the Order</h2>
                        <h2>Please Contact us either by our Email or Phone Number</h2>
                    </form>
                </div>
        </div>
    </section>
    
<?php include('layouts/footer.php');?> 