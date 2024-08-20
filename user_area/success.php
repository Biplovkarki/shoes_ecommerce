<?php
session_start();

// Include the connection file
include '../include/connection.php';

// Include the header file
include '../include/header.php';

// Function to insert payment information into the database
function insertPaymentInfo($orderId, $paymentAmount, $paymentMethod, $paymentStatus, $paymentDate) {
    global $conn;

    $insertQuery = "INSERT INTO payments (order_id, payment_amount, payment_method, payment_status, payment_date) 
                    VALUES ('$orderId', '$paymentAmount', '$paymentMethod', '$paymentStatus', '$paymentDate')";

    if (mysqli_query($conn, $insertQuery)) {
        return true; // Insertion successful
    } else {
        return false; // Insertion failed
    }
}

// Check if the payment status is passed as a query parameter
if (isset($_GET['status'])) {
    // Assuming you have retrieved payment-related data from the payment gateway
    $paymentId = $_GET['payment_id'];
    $orderId = $_GET['order_id'];
    $paymentAmount = $_GET['payment_amount'];
    $paymentMethod = $_GET['payment_method'];
    $paymentDate = date('Y-m-d H:i:s'); // Assuming the payment date is the current date and time

    // Check the payment status
    if ($_GET['status'] === 'success') {
        $paymentStatus = 'completed'; // Payment is successful
    } else {
        $paymentStatus = 'pending'; // Payment is pending
    }

    // Insert payment information into the database
    if (insertPaymentInfo($orderId, $paymentAmount, $paymentMethod, $paymentStatus, $paymentDate)) {
        // Update payment status to 'completed' if payment is successful through eSewa
        if ($paymentMethod === 'esewa' && $paymentStatus === 'completed') {
            $updateQuery = "UPDATE payments SET payment_status = 'completed' WHERE payment_id = '$paymentId'";
            mysqli_query($conn, $updateQuery);
        }

        // Display appropriate message based on payment status
        if ($paymentStatus === 'completed') {
            echo '<h2>Payment Successful</h2>';
            echo '<p>Thank you for your payment. Your payment has been successfully processed.</p>';
        } else {
            echo '<h2>Payment Pending</h2>';
            echo '<p>Your payment is pending. Please wait for confirmation.</p>';
        }
    } else {
        echo '<h2>Error</h2>';
        echo '<p>There was an error processing your payment. Please contact customer support for assistance.</p>';
    }
} else {
    // If the payment status is not provided, redirect the user to an appropriate page
    header('Location: ../user_area/cart.php'); // Redirect to the home page or another relevant page
    exit();
}

// Include the footer file
include '../include/footer.php';
?>

 <body>
    <form action="https://uat.esewa.com.np/epay/transrec" method="GET">
    <input value="<?php echo $paymentAmount; ?>" name="amt" type="hidden">
    <input value="EPAYTEST" name="scd" type="hidden">
    <input type="hidden" name="pid" value="<?php echo $order['order_id']; ?>"> <!-- Use order_id instead of product_id -->
    <input value="<?php echo $paymentId; ?>" name="rid" type="hidden"> <!-- Assuming $paymentId is the payment ID -->
    <input value="Submit" type="submit">
    </form>
</body>
