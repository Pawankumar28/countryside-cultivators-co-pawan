<?php
include('connection.php');
$stmt = $conn->prepare("SELECT * FROM products WHERE product_category='other' LIMIT 4");
$stmt->execute();
$other = $stmt->get_result();//array
?>