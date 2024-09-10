<?php 
session_start();
include('../server/connection.php');

if(isset($_SESSION['admin_logged_in'])){
    header('location:login.php');
   exit();

}
if(isset($_POST['login_btn'])){

    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $stmt = $conn->prepare("SELECT admin_id,admin_name,admin_email,admin_password FROM admins WHERE admin_email=? AND admin_password=? LIMIT 1");
    $stmt->bind_param('ss',$email,$password);
    
    if($stmt->execute()){
        $stmt->bind_result($admin_id,$admin_name,$admin_email,$admin_password);
        $stmt->store_result();

        if($stmt->num_rows() == 1){
        $stmt->fetch();

        $_SESSION['admin_id'] = $admin_id;
        $_SESSION['admin_name'] = $admin_name;
        $_SESSION['admin_email'] = $admin_email;
        $_SESSION['admin_logged_in'] = true;

        header('location: index.php?message=logged in successfully');
        }else{
          header('location: login.php?error=could not verify your account');  
        }
    }else{
        //error
        header('location: login.php?error=something went wrong');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css">
  <title>Admin Dashboard</title>
  <style>
    *{
      margin:0;
      padding:0;
      box-sizing: border-box;
    }
 
    .navbar {
      background-color: #343a40;
      color: #fff;
      width: 100%;
      text-align: left;
      padding-left: 235px;
    }
    .container{
      margin: auto;
      width: 500px;
      max-width: 90%;
    }
    .container form{
      width: 100%;
      height: 100%;
      padding: 20px;
      background: white;
      border-radius: 4px;
      box-shadow: 0 8px 16px rgba(0,0,0,0.3);
    }
    .container form h2{
      text-align: center;
      margin-bottom: 24px;
      color: #222;
    }
    .container form .form-comtrol{
      width: 100%;
      height: 40px;
      background: white;
      border-radius: 4px;
      border: 1px solid silver;
      margin: 10px 0 18px 0;
      padding: 0 10px;
    }
    .container form .btn{
      margin-left:50% ;
      transform: translateX(-50%);
      width: 120px;
      height: 34px;
      border: none;
      outline: none;
      background: green;
      cursor: pointer;
      font-size: 16px;
      text-transform: uppercase;
      color: white;
    }
  </style>
</head>
<div >
    <nav class="navbar">
      <div class="container">
    
        <span class="navbar-brand">Countryside Cultivators CO</span>
     
      </div>
    </nav>
  </div>
<body>
 <!--login-->
 <section class="my-8 py-5">
        <div class="mx-auto container">
          <div class=" text-center mt-5 pt-2">
              <h2 class="form-weight-bold">ADMIN SIGN IN</h2>
              <hr class="mx-auto">
          </div>
            <form id="login-form" enctype="multipart/form-data" method="POST" action="login.php" >
                <p style="color:red" class="text-center"><?php if(isset($_GET['error'])){ echo $_GET['error'];}?></p>
                  <div class="form-group mt-2">
                      <label>Email</label>
                      <input type="text" class="form-control" id="login-email" name="email" placeholder="Enter Email Address" required/>
                  </div>
                  <div class="form-group">
                      <label>Password</label>
                      <input type="password" class="form-control" id="login-password" name="password" placeholder="Enter Password" required/>
                  </div>
                  <br>
                  <div class="form-group">
                      <input type="submit" class="btn" id="login-btn" name="login_btn" value="login"/>
                  </div>
            </form>
        </div>
 </section>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>