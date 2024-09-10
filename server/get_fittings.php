<?php
include('connection.php');
$stmt = $conn->prepare("SELECT * FROM products WHERE product_category='fittings' LIMIT 4");
$stmt->execute();
$fittings = $stmt->get_result();//array
?>