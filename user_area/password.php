<?php
// Include your database connection file
include '../include/connection.php';
session_start();
$notification = array('message' => '');
//Check if the user is logged in
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    
    // Validate and sanitize form data (not shown here, but highly recommended)
    
    // Retrieve current password from database
    $user_id = $_SESSION['user_id'];
    $query = "SELECT user_pass FROM users WHERE user_id = $user_id";
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $stored_password = $row['user_pass'];
        
        // Verify if current password matches stored password
        if (password_verify($current_password, $stored_password)) {
            // Verify if new password and confirm password match
            if ($new_password == $confirm_password) {
                // Hash the new password
                $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
                
                // Update password in the database
                $update_query = "UPDATE users SET user_pass='$hashed_password' WHERE user_id=$user_id";
                if (mysqli_query($conn, $update_query)) {
                    // Password updated successfully
                    $notification['message'] = "Password changed successfully.";
                } else {
                    $notification['message'] = "Error updating password: " . mysqli_error($conn);
                }
            } else {
                $notification['message'] = "New password and confirm password do not match.";
            }
        } else {
            $notification['message'] = "Current password is incorrect.";
        }
    } else {
        $notification['message'] = "User not found.";
    }
    
    // Close database connection
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        // Script to hide notification message after 5 seconds
        setTimeout(function() {
            document.getElementById('notification').style.display = 'none';
        }, 5000);
    </script>
    <style>
        .linktoback{
            margin-left:500px;
        }
        </style>
</head>
<body>
    <div class="container">
        <h2 class="mt-5 mb-4">Change Password</h2>
        <!-- Display notification message -->
        <?php if (!empty($notification['message'])): ?>
            <div class="alert alert-<?php echo (strpos($notification['message'], 'successfully') !== false) ? 'success' : 'danger'; ?>" id="notification">
                <?php echo $notification['message']; ?>
            </div>
        <?php endif; ?>
        
        <!-- Change password form -->
      
        <form action="" method="POST">
            <div class="mb-3">
                <label for="current_password" class="form-label">Current Password:</label>
                <input type="password" id="current_password" name="current_password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="new_password" class="form-label">New Password:</label>
                <input type="password" id="new_password" name="new_password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm New Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Change Password</button>
        </form>
        <a href="cart.php"class="linktoback">back to cart</a>
    </div>

</body>
</html>
