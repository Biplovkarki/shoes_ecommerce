<?php
// Include the header file


// Check if the payment status is passed as a query parameter
if (isset($_GET['status']) && $_GET['status'] === 'failed') {
    echo '<h2>Payment Failed</h2>';
    echo '<p>Unfortunately, your payment was not successful. Please try again later or contact customer support for assistance.</p>';
} else {
    // If the payment status is not provided or is not 'failed', redirect the user to an appropriate page
    header('Location: ../user_area/cart.php'); // Redirect to the home page or another relevant page
    exit();
}

// Include the footer file
include '../include/footer.php';
?>
