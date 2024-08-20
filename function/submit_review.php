<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    // If user is not logged in, redirect to login page
    header("Location: ../user_area/loginform.php");
    exit(); // Stop further execution
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_review'])) {
    // Include database connection
    include '../include/connection.php';

    // Get form data
    $productId = $_POST['product_id'];
    $userId = $_SESSION['user_id'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];
    $currentTimestamp = date('Y-m-d H:i:s');

    // Validate data
    // You can add more validation as per your requirements
    if (empty($rating) || empty($comment)) {
        // Handle validation error
        header("Location: ../user_area/item.php?id=$productId&message=Please fill in all fields&class=alert-danger");
        exit();
    }

    // Insert review into database
    $insert_review_query = "INSERT INTO reviews (product_id, user_id, ratings, review_text,review_date) VALUES ('$productId', '$userId', '$rating', '$comment','$currentTimestamp')";
    $insert_result = mysqli_query($conn, $insert_review_query);

    if ($insert_result) {
        // Review submitted successfully
        header("Location: ../user_area/item.php?id=$productId&message=Review submitted successfully&class=alert-success");
        exit();
    } else {
        // Error inserting review
        header("Location: ../user_area/item.php?id=$productId&message=Error submitting review. Please try again&class=alert-danger");
        exit();
    }
} else {
    // If form is not submitted via POST method, redirect to the item page
    header("Location: ../user_area/item.php?id=$productId");
    exit();
}
?>
