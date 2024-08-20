<?php
// Include the connection file
include '../include/connection.php';

// Start session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit();
}

// Retrieve user ID from session
$userId = $_SESSION['user_id'];

// Function to fetch user's orders with order items and payment status
function fetchUserOrders($userId, $conn) {
    $orders = [];

    // Query to fetch user's orders
    $query = "SELECT * FROM orders WHERE user_id = '$userId' ORDER BY created_at DESC";
    $result = mysqli_query($conn, $query);

    // Check if query execution was successful
    if ($result && mysqli_num_rows($result) > 0) {
        // Fetch each order
        while ($order = mysqli_fetch_assoc($result)) {
            // Fetch order items for each order
            $orderId = $order['order_id'];
            $order['items'] = fetchOrderItems($orderId, $conn);
            
            // Fetch payment status for each order
            $order['payment_status'] = fetchPaymentStatus($orderId, $conn);

            $orders[] = $order;
        }
    }

    return $orders;
}

// Function to fetch order items for a given order ID
function fetchOrderItems($orderId, $conn) {
    $items = [];

    // Query to fetch order items
    $query = "SELECT * FROM order_items WHERE order_id = '$orderId'";
    $result = mysqli_query($conn, $query);

    // Check if query execution was successful
    if ($result && mysqli_num_rows($result) > 0) {
        // Fetch each order item
        while ($item = mysqli_fetch_assoc($result)) {
            $items[] = $item;
        }
    }

    return $items;
}

// Function to fetch payment status for a given order ID
function fetchPaymentStatus($orderId, $conn) {
    $paymentStatus = '';

    // Query to fetch payment status
    $query = "SELECT payment_status FROM payments WHERE order_id = '$orderId'";
    $result = mysqli_query($conn, $query);

    // Check if query execution was successful
    if ($result && mysqli_num_rows($result) > 0) {
        // Fetch payment status
        $row = mysqli_fetch_assoc($result);
        $paymentStatus = $row['payment_status'];
    }

    return $paymentStatus;
}

// Fetch user's orders with order items and payment status
$userOrders = fetchUserOrders($userId, $conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Orders</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.0.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .order-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .order-details {
            margin-bottom: 10px;
        }

        .order-items {
            list-style-type: none;
            padding-left: 0;
        }

        .order-item {
            padding: 10px;
            background-color: #f9f9f9;
            border-radius: 5px;
            margin-bottom: 5px;
        }

        .product-img {
            max-width: 100px;
            float: right;
            margin-left: 20px;
        }

        .cancel-link {
            color: red;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Your Orders</h1>
        <?php if (!empty($userOrders)): ?>
            <div class="row row-cols-1 row-cols-md-2 g-4">
                <?php foreach ($userOrders as $order): ?>
                    <div class="col">
                        <div class="card order-card">
                            <div class="card-body">
                                <h5 class="card-title">Ordered Item:</h5>
                                <div class="order-details">
                                <?php foreach ($order['items'] as $item): ?>
                                    <ul class="order-items">
                                        <li >
                                            <?php
                                            // Fetch product details based on product_id
                                            $productId = $item['product_id'];
                                            $productQuery = "SELECT P_picture1, product_name FROM products WHERE product_id = '$productId'";
                                            $productResult = mysqli_query($conn, $productQuery);
                                            if ($productResult && mysqli_num_rows($productResult) > 0) {
                                                $productData = mysqli_fetch_assoc($productResult);
                                                $productImage = $productData['P_picture1'];
                                                $productName = $productData['product_name'];
                                            }
                                            ?>
                                    <img src="../product_images/<?php echo $productImage; ?>" alt="<?php echo $productName; ?>" class="product-img">
                                    <p class="card-text">Product Name: <?php echo $productName; ?></p>
                                    <p class="card-text">Quantity:<?php echo $item['quantity']; ?></p>
                                    <p class="card-text">Price :RS<?php echo $item['price_per_unit']; ?></p>
                                    <p class="card-text">Total Amount: Rs<?php echo $order['total_amount']; ?></p>
                                    <p class="card-text">Order Status: <?php echo $order['order_status']; ?></p>
                                    <p class="card-text">Payment Status: <?php echo $order['payment_status']; ?></p>
                                    
                                   
                                        </li>
                                        </ul>
                                </div>
                               
                                    
                                            <div>
                                                
                                            </div>
                                            <a href="#" class="cancel-link float-center">Cancel Order</a>
                                      
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-center">No orders found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
