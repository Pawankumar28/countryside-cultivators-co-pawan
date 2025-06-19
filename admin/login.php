 <?php 
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start session
session_start();
include('../server/connection.php');

// Function to log debug messages to a file
function debug_log($message) {
    $log_file = 'debug.log';
    $timestamp = date('Y-m-d H:i:s');
    file_put_contents($log_file, "[$timestamp] $message\n", FILE_APPEND);
}

// Debug: Check if session started successfully
if (!session_id()) {
    debug_log("Session failed to start.");
    die("Session failed to start.");
}

// Redirect to index.php if already logged in
if (isset($_SESSION['admin_logged_in'])) {
    debug_log("Already logged in, redirecting to index.php.");
    header('location: index.php');
    exit();
}

if (isset($_POST['login_btn'])) {
    $email = trim($_POST['email']); // Remove whitespace
    $password = trim($_POST['password']); // Remove whitespace, plain text

    // Debug: Log the email and password being checked
    debug_log("Attempting login with email: '$email' and password: '$password'");

    // Verify database connection
    if ($conn->connect_error) {
        debug_log("Database connection failed: " . $conn->connect_error);
        die("Database connection failed: " . $conn->connect_error);
    }

    // Prepare statement to fetch admin details
    $stmt = $conn->prepare("SELECT admin_id, admin_name, admin_email, admin_password FROM admins WHERE admin_email = ? AND admin_password = ? LIMIT 1");
    if (!$stmt) {
        debug_log("Prepare failed: " . $conn->error);
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param('ss', $email, $password);
    
    if ($stmt->execute()) {
        $stmt->bind_result($admin_id, $admin_name, $admin_email, $admin_password);
        $stmt->store_result();

        // Debug: Log the number of rows found
        debug_log("Number of rows found: " . $stmt->num_rows());

        if ($stmt->num_rows() == 1) {
            $stmt->fetch();
            
            // Set session variables
            $_SESSION['admin_id'] = $admin_id;
            $_SESSION['admin_name'] = $admin_name;
            $_SESSION['admin_email'] = $admin_email;
            $_SESSION['admin_logged_in'] = true;

            // Debug: Log success
            debug_log("Login successful for admin_id: $admin_id, admin_name: $admin_name, admin_email: $admin_email");
            
            header('location: index.php?message=logged in successfully');
            exit();
        } else {
            // Debug: Log failure and fetch all admins to compare
            debug_log("No matching admin found for email: '$email' and password: '$password'");
            
            // Fetch all admins to debug
            $debug_stmt = $conn->query("SELECT admin_email, admin_password FROM admins");
            if ($debug_stmt) {
                while ($row = $debug_stmt->fetch_assoc()) {
                    debug_log("Admin in database - Email: '" . $row['admin_email'] . "', Password: '" . $row['admin_password'] . "'");
                }
            }

            header('location: login.php?error=could not verify your account');
            exit();
        }
    } else {
        debug_log("Query execution failed: " . $stmt->error);
        header('location: login.php?error=Something went wrong with the database query');
        exit();
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
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
 
    .navbar {
      background-color: #343a40;
      color: #fff;
      width: 100%;
      text-align: left;
      padding-left: 235px;
    }
    .container {
      margin: auto;
      width: 500px;
      max-width: 90%;
    }
    .container form {
      width: 100%;
      height: 100%;
      padding: 20px;
      background: white;
      border-radius: 4px;
      box-shadow: 0 8px 16px rgba(0,0,0,0.3);
    }
    .container form h2 {
      text-align: center;
      margin-bottom: 24px;
      color: #222;
    }
    .container form .form-control {
      width: 100%;
      height: 40px;
      background: white;
      border-radius: 4px;
      border: 1px solid silver;
      margin: 10px 0 18px 0;
      padding: 0 10px;
    }
    .container form .btn {
      margin-left: 50%;
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
<body>
  <div>
    <nav class="navbar">
      <div class="container">
        <span class="navbar-brand">Countryside Cultivators CO</span>
      </div>
    </nav>
  </div>

  <!-- Login Section -->
  <section class="my-8 py-5">
    <div class="mx-auto container">
      <div class="text-center mt-5 pt-2">
        <h2 class="form-weight-bold">ADMIN SIGN IN</h2>
        <hr class="mx-auto">
      </div>
      <form id="login-form" method="POST" action="login.php">
        <p style="color:red" class="text-center">
          <?php if (isset($_GET['error'])) { echo htmlspecialchars($_GET['error']); } ?>
        </p>
        <div class="form-group mt-2">
          <label>Email</label>
          <input type="email" class="form-control" id="login-email" name="email" placeholder="Enter Email Address" value="admin@gmail.com" required/>
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="password" class="form-control" id="login-password" name="password" placeholder="Enter Password" value="123456" required/>
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