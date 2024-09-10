<?php
session_start();
include('../server/connection.php');
?>

<?php 
if(!isset($_SESSION['admin_logged_in'])){//remove ! if it dosent work
 header('location:login.php');
 exit;
}
if(isset($_GET['order_id'])){

$order_id = $_GET['order_id'];
$stmt = $conn->prepare("DELETE FROM orders where order_id=?");
$stmt->bind_param('i',$order_id);

if($stmt->execute()){
  header('location:index.php?deleted_successfully=order has been deleted successfully');
}else{
  header('location:index.php?deleted_failure=could not delete order');
  }
}
?>