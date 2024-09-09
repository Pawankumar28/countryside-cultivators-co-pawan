<?php 
    session_start();
    include('server/connection.php');

    if(!isset($_SESSION['logged_in'])){
    header("location:login.php");
    exit;
    }
    if(isset($_GET['logout'])){
        if(isset($_SESSION['logged_in'])){
            unset($_SESSION['logged_in']);
            unset($_SESSION['user_email']);
            unset($_SESSION['user_name']);
            header("loaction: login.php");
            exit;
        }
    }
    if(isset($_POST['change_password'])){
                $password = $_POST['password'];
                $confirmpassword = $_POST['confirmpassword'];
                $user_email = $_SESSION['user_email'];
                //if passwors dont match
            if($password !== $confirmpassword){
                header("location: account.php?error=passwords do not match");
            //if passwords less than 6 characters
            }else if(strlen($password) < 6 ){
                header("location: account.php?error=password must be at least 6 characters");
            }else{
                $stmt = $conn->prepare("UPDATE users SET user_password=? where user_email=?");
                $stmt->bind_param('ss',md5($password),$user_email);

                if($stmt->execute()){
                    header("location: account.php?message=password has been updated successfully");
                }else{
                    header("location:account.php?error=could not update password");
                }
            }
    }
//get orders
    if(isset($_SESSION['logged_in'])){
        $user_id = $_SESSION['user_id'];
        $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id=? ");
        $stmt->bind_param('i',$user_id);
        $stmt->execute();
        $orders = $stmt->get_result();//array
    }
?>

<?php include('layouts/header.php');?>
<!--account-->
    <section class="my-5 py-5">
        <div class="row container mx-auto">
            <div class="text-center mt-3 pt-5 col-lg-6 col-md-12 col-sm-12">
                <h3 class="font-weight-bold">ACCOUNT INFO</h3>
                <hr class="mx-auto">
                <div class="account-info">
                    
                    <p>User Name : <span><?php if(isset($_SESSION['user_name'])){echo $_SESSION['user_name'];}?></span></p>
                    <p>User Email : <span><?php if(isset($_SESSION['user_email'])){echo $_SESSION['user_email'];}?></span></p>
                    <p><a href="#orders" id="orders-btn">Your Orders</a></p>
                    <p><a href="account.php?logout=1" type="submit" class="btn" id="logout-btn">Logout</a></p>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12">
                <form id="account-form" method="POST" action="account.php">
                    <p class="text-center" style="color:red"><?php if(isset($_GET['error'])){echo $_GET['error']; }?></p>
                    <p class="text-center" style="color:green"><?php if(isset($_GET['message'])){echo $_GET['message']; }?></p>
                    <h3>Change Password</h3>
                    <hr class="mx-auto">
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" id="account-password" name="password" placeholder="Password" required/>
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" class="form-control" id="account-confirm-password" name="confirmpassword" placeholder="Confirm Password" required/>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="change password" name="change_password" class="btn" id="change-pass-btn">

                    </div>
                </form>
            </div>
        </div>
    </section>

<!--orders-->
    <section id="orders" class="orders container my-5 py-3">
        <div class="container mt-2">
            <h2 class="font-weight-bold text-center">YOUR ORDERS</h2>
            <hr class="mx-auto">
        </div>
            <table class="mt-5 pt-5">
                <tr>
                    <th>Order ID</th>
                    <th>Order Cost</th>
                    <th>Order Status</th>
                    <th>Order Date and Time</th>
                    <th>Order Details</th>
                </tr>
                    <?php while($row = $orders->fetch_assoc() ){ ?>
                        <tr>
                            <td>
                                <span><?php echo $row['order_id'];?></span>
                            </td>
                            <td>
                                <span><?php echo $row['order_cost'];?></span>
                            </td>
                            <td>
                                <span><?php echo $row['order_status'];?></span>
                            </td>
                            <td>
                                <span><?php echo $row['order_date'];?></span>
                            </td>
                            <td>
                                <form method="POST" action="order_details.php">
                                    <input type="hidden" value="<?php echo $row['order_status'];?>"name="order_status"> 
                                    <input type="hidden" value="<?php echo $row['order_id'];?>" name="order_id">
                                    <input class="btn order-details-btn" name="order_details_btn" type="submit" value="details">
                                </form>
                            </td>
                        </tr>
                    <?php }?>
            </table>
    </section>

    <?php include('layouts/footer.php');?>