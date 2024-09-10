<?php
include('connection.php');
$stmt = $conn->prepare("SELECT * FROM products WHERE product_category='equipment' LIMIT 4");
$stmt->execute();
$equipment = $stmt->get_result();//array
?>