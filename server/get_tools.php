<?php
include('connection.php');
$stmt = $conn->prepare("SELECT * FROM products WHERE product_category='tools' LIMIT 4");
$stmt->execute();
$tools = $stmt->get_result();//array
?>