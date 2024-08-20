<?php
// Start the session
session_start();
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    $_SESSION['redirect_after_login'] = 'cart';
    header('Location: ../user_area/loginform.php');
    exit(); // Stop further execution of the script
}

// Include the connection file
include '../include/connection.php';

include '../include/header.php';

// Function to calculate the total price of an item (rate * quantity)
function calculatePrice($rate, $quantity) {
    return $rate * $quantity;
}

// Fetch cart items from the database
function fetchCartItems() {
    global $conn;

    $userId = $_SESSION['user_id'];

    $cart_query = "SELECT c.*, p.product_name, p.product_price, p.P_picture1
                   FROM cart c
                   JOIN products p ON c.product_id = p.product_id
                   WHERE c.user_id = '$userId'";
    $cart_result = mysqli_query($conn, $cart_query);

    $cartItems = [];

    if ($cart_result && mysqli_num_rows($cart_result) > 0) {
        while ($row = mysqli_fetch_assoc($cart_result)) {
            $cartItems[] = $row;
        }
    }

    return $cartItems;
}

// Fetch cart items from the database
$cartItems = fetchCartItems();

// Function to calculate the grand total of all items in the shopping cart
function calculateGrandTotal($userId) {
    global $conn;

    $grandTotal = 0;

    $cart_query = "SELECT c.quantity, p.product_price
                   FROM cart c
                   JOIN products p ON c.product_id = p.product_id
                   WHERE c.user_id = '$userId'";
    $cart_result = mysqli_query($conn, $cart_query);

    if ($cart_result && mysqli_num_rows($cart_result) > 0) {
        while ($row = mysqli_fetch_assoc($cart_result)) {
            $productPrice = $row['product_price'];
            $quantity = $row['quantity'];
            $grandTotal += calculatePrice($productPrice, $quantity);
        }
    }

    return $grandTotal;
}

// Function to count the total number of products in the cart
function countTotalProductsInCart($userId) {
    global $conn;

    $count_query = "SELECT COUNT(*) AS total_products FROM cart WHERE user_id = '$userId'";
    $count_result = mysqli_query($conn, $count_query);

    if ($count_result && mysqli_num_rows($count_result) > 0) {
        $row = mysqli_fetch_assoc($count_result);
        return $row['total_products'];
    }

    return 0;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <!-- Add your CSS styles here -->
    <style>
        /* Add your CSS styles here */
        /* Example CSS for table styling */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="cart">
            <div class="notification text-center" id="signup-notification">
                <?php
                if (isset($_GET['message']) && isset($_GET['class'])) {
                    $notificationMessage = $_GET['message'];
                    $notificationClass = $_GET['class'];

                    // Display the error notification
                    echo '<div class="alert ' . $notificationClass . ' alert-dismissible fade show" role="alert">' .
                        $notificationMessage .
                        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' .
                        '</div>';
                }
                ?>

                <h2>Shopping Cart</h2>
                <?php if (!empty($cartItems)) : ?>
                <form method="post" action="../function/update_remove.php">
                    <table>
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Size</th>
                                <th>Quantity</th>
                                <th>Rate</th>
                                <th>Total Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cartItems as $item) : ?>
                                <?php
                                // Extract item details
                                $cartId = $item['cart_id'];
                                $productName = $item['product_name'];
                                $productRate = $item['product_price'];
                                $productImage = $item['P_picture1'];
                                $quantity = $item['quantity'];
                                $size = $item['size'];

                                // Calculate total price
                                $totalPrice = calculatePrice($productRate, $quantity);
                                ?>
                                <tr>
                                    <td><img src="../product_images/<?php echo $productImage; ?>" alt="<?php echo $productName; ?>" style="width: 50px; height: 50px;"></td>
                                    <td><?php echo $productName; ?></td>
                                    <td><input type="number" value="<?php echo $size; ?>" name="updateSize_<?php echo $cartId; ?>" min="36" max="42"></td>
                                    <td><input type="number" value="<?php echo $quantity; ?>" name="updateQuantity_<?php echo $cartId; ?>" min="1"></td>
                                    <td>Rs. <?php echo $productRate; ?></td>
                                    <td>Rs. <?php echo $totalPrice; ?></td>
                                    <td>
                                        <button type="submit" name="update">Update</button>
                                        <button type="submit" name="remove" value="<?php echo $cartId; ?>">Remove</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php if (!empty($cartItems)) : ?>
                        <button type="submit" name="clear_cart">Clear Cart</button>
                    <?php endif; ?>
                </form>
                <div>
                    <a href="shop.php?id=1">Continue Shopping</a>
                    <h3>Grand Total: Rs. <?php echo calculateGrandTotal($_SESSION['user_id']); ?></h3>
                    <!-- Display the total number of products in the cart -->
                    <h3>Total Products in Cart: <?php echo countTotalProductsInCart($_SESSION['user_id']); ?></h3>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addressModal">
                        Checkout
                    </button>
                </div>
                <?php else : ?>
                <p>Your cart is empty.</p>
                <a href="shop.php?id=1">Start Shopping</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Address Modal -->
    <div class="modal fade" id="addressModal" tabindex="-1" aria-labelledby="addressModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addressModalLabel">Enter Your Address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Address Form -->
                   <!-- Address Form -->
<form method="post" action="khalti.php">
    <div class="mb-3">
        <label for="address" class="form-label">Address</label>
        <input type="text" class="form-control" id="address" name="address" required>
    </div>
    <div class="mb-3">
        <label for="phone" class="form-label">Phone</label>
        <input type="text" class="form-control" id="phone" name="phone" required>
    </div>
    <div class="mb-3">
        <label for="payment_method" class="form-label">Payment Method</label>
        <select class="form-select" id="payment_method" name="payment_method" required>
            <!-- <option value="esewa">eSewa</option> -->
            <option value="khalti">Khalti</option>
            <!-- <option value="cash">Cash on Delivery</option> -->
        </select>
    </div>
    
    <button type="submit" class="btn btn-primary" value="place order" name="placeorder"></button>
</form>

                </div>
            </div>
        </div>
    </div>

</body>

</html>
<?php
 
include '../include/footer.php';
?>
