<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    $_SESSION['redirect_after_login'] = 'change_info';
    header("Location: ../user_area/loginform.php");
    exit();
}

// Include connection to your database
include '../include/connection.php';

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the field to be changed from the query parameter
    $field = $_GET['field'];

    // Validate the field to prevent any potential security issues or unwanted changes
    $allowed_fields = array('email', 'username', 'phone');
    if (in_array($field, $allowed_fields)) {
        // Get the new value from the form
        $new_value = $_POST['new_' . $field];

        // Update the user information in the database
        $user_id = $_SESSION['user_id'];
        $sql = "UPDATE users SET $field = '$new_value' WHERE id = $user_id";

        if ($conn->query($sql) === TRUE) {
            // Redirect back to the profile page after the change is made
            header("Location: ../profile.php");
            exit();
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        // Invalid field specified
        echo "Invalid field specified.";
        exit();
    }
}

$conn->close();
?>
