<?php

// Include the connection file
include '../include/connection.php';
session_start();
$userId = $_SESSION['user_id']; 
// Function to fetch total amount from the orders table
function fetchTotalAmount($userId) {
    global $conn;

    // Query to fetch total amount from orders table
    $query = "SELECT total_amount, order_id FROM orders WHERE user_id = '$userId' ORDER BY order_id DESC LIMIT 1";

    // Execute the query
    $result = mysqli_query($conn, $query);

    // Check if query execution was successful
    if ($result && mysqli_num_rows($result) > 0) {
        // Fetch the total amount
        $row = mysqli_fetch_assoc($result);
        return array('total_amount' => $row['total_amount'], 'order_id' => $row['order_id']);
    }

    return false;
}

// Example usage:
// Assuming you have the user ID stored in a session variable

// Fetch total amount for the user from the orders table
$orderData = fetchTotalAmount($userId);

if ($orderData) {
    $totalAmount = $orderData['total_amount'];
    $orderId = $orderData['order_id'];

    // Use the $totalAmount and $orderId in your Khalti payment initiation code
    // ...
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://a.khalti.com/api/v2/epayment/initiate/',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '{
            "return_url": "http://localhost/project/user_area/success.php",
            "website_url": "https://127.0.0.1/",
            "amount": "' . $totalAmount . '",
            "purchase_order_id": "' . $orderId . '",
            "purchase_order_name": "Order Name", // You can provide the order name dynamically if needed
            "customer_info": {
                "name": "Test Bahadur",
                "email": "test@khalti.com",
                "phone": "9800000001"
            }
        }',
        CURLOPT_HTTPHEADER => array(
            'Authorization: key live_secret_key_68791341fdd94846a146f0457ff7b455',
            'Content-Type: application/json',
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    if (!empty($response)) {
        $responseData = json_decode($response, true);

        if (isset($responseData['payment_url'])) {
            $paymentUrl = $responseData['payment_url'];
            header("Location: $paymentUrl");
        } else {
            echo "Payment URL not found in response.";
        }
    } else {
        echo "Empty response received.";
    }
} else {
    echo "Failed to fetch order data.";
}

?>
