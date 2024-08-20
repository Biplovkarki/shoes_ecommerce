<?php
session_start();
include '../include/connection.php';

// Notification
$notification = array('message' => '');

if(isset($_POST['login'])) {
    // Retrieve submitted email and password
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validate input fields
    if(empty($email) || empty($password)) {
        $notification['message'] = 'Please enter both email and password.';
        $notification['class'] = 'alert-danger';
    } else {
        // Query the database to fetch user record
        $query = "SELECT * FROM users WHERE user_email = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        if($result->num_rows > 0) {
            $user = mysqli_fetch_assoc($result);
            // Verify password
            if(password_verify($password, $user['user_pass'])) {
                // Password is correct, set session
                $_SESSION['user_id'] = $user['user_id']; // Setting user ID in session
                $_SESSION['user_email'] = $user['user_email'];
                $_SESSION['user_name'] = $user['user_name'];
                $_SESSION['user_phone'] = $user['user_phone'];
                $notification['message'] = 'Successfully logged in.';
              

                // Redirect to the desired page after successful login
                if(isset($_SESSION['redirect_after_login'])) {
                    $redirect_page = $_SESSION['redirect_after_login'];
                    unset($_SESSION['redirect_after_login']); // Clear redirect session variable
                    header("Location: ../user_area/$redirect_page.php?id=$product_id&message=" . urlencode($notification['message']) );
                    exit();
                } else {
                    // Default redirect if no specific page requested
                    header("Location: ../user_area/shop.php?message=" . urlencode($notification['message']));
                    exit();
                }
            } else {
                // Password is incorrect
                $notification['message'] = 'Incorrect email or password.';
              
            }
        } else {
            // User with submitted email not found
            $notification['message'] = 'User not found.';
           
        }
    }

    // Redirect to login page with notification if login fails
    header("location: ../user_area/loginform.php?message=" . urlencode($notification['message']));
    exit();
}
?>
