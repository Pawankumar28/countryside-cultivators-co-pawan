<?php
session_start();
include('../server/connection.php');
?>

<?php 
if(!isset($_SESSION['admin_logged_in'])){//remove ! if it dosent work
 header('location:login.php');
 exit;
}
if(isset($_GET['product_id'])){

$product_id = $_GET['product_id'];
$stmt = $conn->prepare("DELETE FROM products where product_id=?");
$stmt->bind_param('i',$product_id);

if($stmt->execute()){
  header('location:products.php?deleted_successfully=product has been deleted successfully');
}else{
  header('location:products.php?deleted_failure=could not delete product');
  }
}
?>
