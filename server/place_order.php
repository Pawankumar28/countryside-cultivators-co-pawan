<?php
session_start();
include('connection.php');

// If the user is not logged in, redirect to the login page
if(!isset($_SESSION['logged_in'])){
    header("location: ../checkout.php?message=please login/register to place an order");
    exit;
} else {
    // If the 'place_order' button is pressed
    if(isset($_POST['place_order'])) {
        // 1. Get user info from the form and store in the database
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $city = $_POST['city'];
        $address = $_POST['address'];
        $order_cost = $_SESSION['total'];
        $order_status = "not paid";
        $user_id = $_SESSION['user_id'];
        $order_date = date('Y-m-d H:i:s'); // Corrected date format to uppercase 'Y' for 4-digit year

        // Prepare the SQL query to insert order details
        $stmt = $conn->prepare("INSERT INTO orders (order_cost, order_status, user_id, user_phone, user_city, user_address, order_date)
                                VALUES (?, ?, ?, ?, ?, ?, ?);");
        
        // Bind the parameters to the SQL query
        $stmt->bind_param('isiisss', $order_cost, $order_status, $user_id, $phone, $city, $address, $order_date);
        
        // Execute the query and check if successful
        $stmt_status = $stmt->execute();

        if ($stmt_status) {
            echo "<script>
                    alert('Order placed successfully! Your order ID is " . $stmt->insert_id . "');
                    window.location.href = '../index.php';
                  </script>";
        }

        // 2. Get the order ID for the newly inserted order
        $order_id = $stmt->insert_id;

        // 3. Get products from the session cart and insert into order_items
        foreach($_SESSION['cart'] as $key => $product) {
            $product_id = $product['product_id'];
            $product_name = $product['product_name'];
            $product_image = $product['product_image'];
            $product_price = $product['product_price'];
            $product_quantity = $product['product_quantity'];

            // Prepare the SQL query to insert each product in order_items
            $stmt1 = $conn->prepare("INSERT INTO order_items (order_id, product_id, product_name, product_image, user_id, order_date)
                                     VALUES (?, ?, ?, ?, ?, ?)");

            // Bind the parameters to the SQL query
            try {
                $stmt1->bind_param('iissis', $order_id, $product_id, $product_name, $product_image, $user_id, $order_date);
                $stmt1->execute();
            } catch (Exception $e) {
                echo "Error occurred: " . $e->getMessage();
                exit; // It's good to exit after error handling to stop further execution
            }
        }

        // 5. Store the order ID in the session to use in payment processing
        $_SESSION['order_id'] = $order_id;

        // 6. Redirect to the payment page with a success message
        header("location: ../payment.php?order_status=order placed successfully");
        exit;
    }
}
?>
