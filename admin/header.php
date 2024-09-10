<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css">
  <title>Admin Dashboard</title>
  <style>
    .sidebar {
      height: 100vh;
      background-color: #343a40;
      height: 1600px;
    }
    .sidebar ul {
      list-style: none;
      padding-left: 0;
    }
    .sidebar li {
      padding: 10px;
    }
    .sidebar li a {
      color: #fff;
      text-decoration: none;
    }
    .navbar {
      background-color: #343a40;
      color: #fff;
    }
  </style>
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-2 sidebar">
        <ul>
          <li><a href="index.php">Dashboard</a></li>
          <li><a href="orders.php">Orders</a></li>
          <li><a href="products.php">Products</a></li>
          <li><a href="account.php">Account</a></li>
          <li><a href="add_product.php">Add New Product</a></li>
          <li><a href="help.php">Help</a></li>
        </ul>
      </div>
      <div class="col-md-10">
        <nav class="navbar">
          <div class="container-fluid">
            <span class="navbar-brand">Countryside Cultivators CO</span>
            <ul class="navbar-nav flex-row">
              <li class="nav-item">
                <a class="nav-link" href="logout.php?logout=1">Sign Out</a>
              </li>
            </ul>
          </div>
        </nav>