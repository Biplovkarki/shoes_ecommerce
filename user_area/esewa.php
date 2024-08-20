<?php
session_start();
// Include the connection file
include '../include/connection.php';

// Include the header file
include '../include/header.php';

// Include the file containing the URL variable
include '../function/url.php';

// Function to fetch cart items
function fetchCartItems($userId) {
    global $conn;

    $cartItems = [];

    $cart_query = "SELECT c.*, p.product_price
                   FROM cart c
                   JOIN products p ON c.product_id = p.product_id
                   WHERE c.user_id = '$userId'";
    $cart_result = mysqli_query($conn, $cart_query);

    if ($cart_result && mysqli_num_rows($cart_result) > 0) {
        while ($row = mysqli_fetch_assoc($cart_result)) {
            $cartItems[] = $row;
        }
    }

    return $cartItems;
}

// Function to calculate grand total
function calculateGrandTotal($userId) {
    global $conn;

    $grandTotal = 0;

    $cartItems = fetchCartItems($userId);

    foreach ($cartItems as $item) {
        $productPrice = $item['product_price'];
        $quantity = $item['quantity'];
        $grandTotal += $productPrice * $quantity;
    }

    return $grandTotal;
}

// Function to fetch total amount from orders
function fetchTotalAmountFromOrders($userId) {
    global $conn;

    $totalAmount = 0;

    $order_query = "SELECT SUM(total_amount) AS total FROM orders WHERE user_id = '$userId'";
    $order_result = mysqli_query($conn, $order_query);

    if ($order_result && mysqli_num_rows($order_result) > 0) {
        $row = mysqli_fetch_assoc($order_result);
        $totalAmount = $row['total'];
    }

    return $totalAmount;
}

// Fetch the necessary data from the cart or session
// For demonstration, let's assume you have variables $totalPrice and $cartItems
// Replace these with your actual data fetching logic

// Call the calculateGrandTotal function to get the total price
$totalPrice = calculateGrandTotal($_SESSION['user_id']); // Assuming this calculates the total price

// Call the fetchCartItems function to get cart items
$cartItems = fetchCartItems($_SESSION['user_id']); // Assuming this fetches cart items

// Call the fetchTotalAmountFromOrders function to get total amount from orders
$totalAmountFromOrders = fetchTotalAmountFromOrders($_SESSION['user_id']);

?>

<body>
    <form action="<?php echo $url; ?>" method="POST"> <!-- Change the action to esewa.php -->
        <!-- Include hidden input fields to pass data to esewa.php -->
        <input type="hidden" name="tAmt" value="<?php echo $totalAmountFromOrders + 10 + 20 + 50; ?> ">
        <input type="hidden" name="amt" value="<?php echo $totalAmountFromOrders; ?>">
        <!-- Add other hidden input fields as needed -->
        <input type="hidden" name="txAmt" value="10">
        <input type="hidden" name="psc" value="20">
        <input type="hidden" name="pdc" value="50">
        <input type="hidden" name="pid" value="<?php echo $order_id; ?>"> <!-- Use order_id instead of product_id -->
        <input type="hidden" name="scd" value="EPAYTEST">
        <input type="hidden" name="su" value="<?php echo $successurl; ?>">
        <input type="hidden" name="fu" value="<?php echo $failureurl; ?>">
        <input type="submit" value="Pay with eSewa">
    </form>
</body>

<?php
// Include the footer file
include '../include/footer.php';
?>
