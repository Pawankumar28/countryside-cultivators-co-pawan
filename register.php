<?php
session_start();

include('server/connection.php');
    //if user is already registed take to account page
if(isset($_SESSION['logged_in'])){
    header('location:account.php');
   exit;
}    
if(isset($_POST['register'])){

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirmpassword = $_POST['confirmpassword'];
//if passwors dont match
if($password !== $confirmpassword){
    header('location:register.php?error=passwords do not match');
//if passwords less than 6 characters
}else if(strlen($password) < 6 ){
    header('location:register.php?error=password must be at least 6 characters');
//if there is no error 
}else{
        //check whether user exists
        $stmt1 = $conn->prepare("SELECT count(*) FROM users where user_email=?");
        $stmt1->bind_param('s',$email);
        $stmt1->execute();
        $stmt1->bind_result($num_rows);
        $stmt1->store_result();
        $stmt1->fetch();
        //user already exists with existing email
        if($num_rows != 0){
            header('location:register.php?error=user with this email already exists');
        }else{
                //creates new user
                $stmt = $conn->prepare("INSERT INTO users (user_name,user_email,user_password)
                                VALUES (?,?,?)");
                $stmt->bind_param('sss',$name,$email,md5($password));//md5 hashes the password
                //if account is created successfully
                if($stmt->execute()){
                    $_SESSION['user_email'] = $email;
                    $_SESSION['user_name'] = $name;
                    $_SESSION['logged_in'] = true;
                    header('location:account.php?message=you have registerd successfully');
                //account could not be created
                        }else{
                            header('location:register.php?error=couldent create an account at the moment');
             }        
        }
    }
}
?>

<?php include('layouts/header.php');?>
<!--register-->
    <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-wiight-bold">REGISTER</h2>
            <hr class="mx-auto">
        </div>
        <form id="register-form" method="POST" action="register.php">
            <p style="color:red;"><?php if(isset($_GET['error'])){ echo $_GET['error'] ;}?></p>
        <div class="mx-auto container">
            <form id="register-form">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" id="register-name" name="name" placeholder="Enter Your Name" required/>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" id="register-email" name="email" placeholder="Enter Your Email" required/>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" id="register-password" name="password" placeholder="Enter Your Password" required/>
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" class="form-control" id="register-confirm-password" name="confirmpassword" placeholder="Confirm Your Password" required/>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn" id="register-btn" name="register" value="Register"/>
            </form> 
        </div>
                <div class="form-group">
                    <a id="login-url" href="login.php" class="btn">Do you have an Account? Login</a>
                </div>
        </form>
     </section>
     
 <?php include('layouts/footer.php');?>