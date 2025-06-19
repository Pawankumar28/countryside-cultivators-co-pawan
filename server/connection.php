<?php
$host = 'loaclhost';
$user = 'root';
$password = ''; // Your MySQL password
$database = 'php_project';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>