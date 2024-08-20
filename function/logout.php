<?php
session_start();

// Logout logic
if (isset($_SESSION['user_id'])) {
    // Unset specific session variables
    unset($_SESSION['user_id']);
    unset($_SESSION['user_email']);

    // Destroy the session
    session_destroy();

    // Regenerate session ID to prevent session fixation attacks
    session_regenerate_id(true);
}

// Redirect to the login page after logout
header("Location: /project/user_area/loginform.php");
exit();
?>
