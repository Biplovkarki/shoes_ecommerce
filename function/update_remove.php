<?php
// Start the session
session_start();

// Include the connection file
include '../include/connection.php';

// Check if the user is not logged in
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    // Redirect the user to the login page
    header('Location: ../user_area/loginform.php');
    exit(); // Stop further execution of the script
}

// Check if the form is submitted for update or remove
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the 'update' button is clicked
    if (isset($_POST['update'])) {
        foreach ($_POST as $key => $value) {
            if (strpos($key, 'updateSize_') !== false) {
                $cartId = substr($key, strlen('updateSize_'));
                $size = $_POST['updateSize_' . $cartId];
                $quantity = $_POST['updateQuantity_' . $cartId];
                
                // Update the size and quantity in the cart table
                $update_query = "UPDATE cart SET size = '$size', quantity = '$quantity' WHERE cart_id = '$cartId'";
                mysqli_query($conn, $update_query);
            }
        }
        
        // Redirect back to the shopping cart page with a success message
        header('Location: ../user_area/cart.php?message=Cart items updated successfully&class=alert-success');
        exit();
    } 
    // Check if the 'remove' button is clicked
    elseif (isset($_POST['remove'])) {
        $cartId = $_POST['remove'];
        
        // Remove the item from the cart table
        $remove_query = "DELETE FROM cart WHERE cart_id = '$cartId'";
        mysqli_query($conn, $remove_query);
        
        // Redirect back to the shopping cart page with a success message
        header('Location: ../user_area/cart.php?message=Item removed from the cart&class=alert-success');
        exit();
    }
    if (isset($_POST['clear_cart'])) {
        // Clear the cart for the current user
        $userId = $_SESSION['user_id'];
        $clear_query = "DELETE FROM cart WHERE user_id = '$userId'";
        mysqli_query($conn, $clear_query);
        
        // Redirect back to the shopping cart page with a success message
        header('Location: ../user_area/cart.php?message=Cart cleared successfully&class=alert-success');
        exit();
    }
} else {
    // If the form is not submitted via POST method, redirect to the shopping cart page
    header('Location: ../user_area/cart.php');
    exit();
}
?>
