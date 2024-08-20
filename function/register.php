<?php
include '../include/connection.php';

// Notification
$notification = array('message' => '');

// Clicking on signup
if (isset($_POST['signup'])) {
    $U_name = isset($_POST['username']) ? trim($_POST['username']) : "";
    $U_email = isset($_POST['email']) ? trim($_POST['email']) : "";
    $U_phone = isset($_POST['phone']) ? trim($_POST['phone']) : "";
    $U_pswd = isset($_POST['password']) ? $_POST['password'] : "";
    $U_cpswd = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : "";

    // Check for empty or whitespace-only fields
    if (
        empty($U_name) ||
        empty($U_email) ||
        empty($U_phone) ||
        empty($U_pswd) ||
        empty($U_cpswd)
    ) {
        $notification['message'] = 'Fields cannot be empty or contain only spaces';
       
    } elseif ($U_pswd !== $U_cpswd) {
        $notification['message'] = 'Password and Confirm Password do not match';
       
    } else {
        $select_query = "SELECT * FROM users WHERE user_email='$U_email'";
        $result_select_email = mysqli_query($conn, $select_query);
        $number_email = mysqli_num_rows($result_select_email);

        $select_query = "SELECT * FROM users WHERE user_phone='$U_phone'";
        $result_select_phone = mysqli_query($conn, $select_query);
        $number_phone = mysqli_num_rows($result_select_phone);

        if ($number_email > 0) {
            $notification['message'] = 'This email is already taken';
            $notification['class'] = 'alert-danger';
        } elseif ($number_phone > 0) {
            $notification['message'] = 'This phone number is already taken';
  } else {
            // Hash the password using Bcrypt
            $hashed_password = password_hash($U_pswd, PASSWORD_BCRYPT);

            // Insert into the database
            $insert_query = "INSERT INTO `users` (user_name, user_email, user_phone, user_pass) VALUES (
                '" . mysqli_real_escape_string($conn, $U_name) . "',
                '" . mysqli_real_escape_string($conn, $U_email) . "',
                '" . mysqli_real_escape_string($conn, $U_phone) . "',
                '" . mysqli_real_escape_string($conn, $hashed_password) . "'
            )";

            if (mysqli_query($conn, $insert_query)) {
                // Successful registration
                $notification['message'] = 'User registered successfully';
                $notification['class'] = 'alert-success';
                header("location: ../user_area/loginform.php?message=" . urlencode($notification['message']));
                exit();
            } else {
                // Registration error
                $notification['message'] = 'Error registering user: ' . mysqli_error($conn);
                $notification['class'] = 'alert-danger';
            }
        }
    }

    // Append notification data to the URL for registration page
    header("location: ../user_area/register.php?message=" . urlencode($notification['message']));
    exit();
}
?>
