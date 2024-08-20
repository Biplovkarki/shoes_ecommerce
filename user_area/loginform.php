<?php
    include('../include/connection.php');
    
//    // Check if the user is not logged in
// if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
//     // Redirect the user to the login page
//     header('Location: ../user_area/loginform.php');
//     exit(); // Stop further execution of the script
// }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #000;
            color: #fff;
        }

        .container {
            margin-top: 50px;
        }

        h2 {
            color: #FFA500; /* Orange */
        }

        label {
            color: #FFA500; /* Orange */
        }

        .form-control {
            background-color: #333; /* Dark Gray */
            color: #FFA500; /* Orange */
        }

        .btn-primary {
            background-color: #FFA500; /* Orange */
            border-color: #FFA500; /* Orange */
        }

        .btn-primary:hover {
            background-color: #FF8C00; /* Darker Orange */
            border-color: #FF8C00; /* Darker Orange */
        }

        .btn-primary:focus {
            box-shadow: 0 0 0 0.25rem rgba(255, 140, 0, 0.5); /* Focus color - darker orange */
        }

        .logo {
            max-width: 100px;
            height: auto;
            margin-bottom: 20px;
        }

        .icon {
            color: #FFA500; /* Orange */
            font-size: 24px;
            margin-right: 5px;
        }
        button{
            display:flex;
            margin-left:230px;
        }
    </style>
    <title>Login - Shoe Website</title>
</head>
<body>
<div class="container mt-5">
    <img src="../projectpictures/logo.png" alt="Pich Shoes Logo" class="logo">
    <h2 class="text-center">Login</h2>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <!-- Notification -->
            <!-- Login Form -->
            <form action="../function/login.php" method="post">
                <div class="mb-3">
                    <label for="email" class="form-label"><i class="icon fas fa-envelope"></i> Email</label>
                    <input type="email" class="form-control" id="email" name="email" required value="<?php echo isset($_COOKIE['remember_email']) ? $_COOKIE['remember_email'] : ''; ?>">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label"><i class="icon fas fa-lock"></i> Password</label>
                    <input type="password" class="form-control" id="password" name="password" required value="<?php echo isset($_COOKIE['remember_password']) ? $_COOKIE['remember_password'] : ''; ?>">
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <input type="checkbox" id="remember" name="remember" <?php echo isset($_COOKIE['remember_email']) ? 'checked' : ''; ?>>
                        <label for="remember" class="form-check-label">Remember Me</label>
                    </div>
                    <a href="forgotpassword.php">Forgot Password?</a>
                </div>
                <button type="submit" class="btn btn-primary" name="login">Login</button>
            </form>
            <div class="mt-3">
                <p class="text-center">Don't have an account? <a href="register.php">Become a Member</a></p>
            </div>
        </div>
    </div>
    <div class="notification text-center" id="signup-notification">  
    <?php
    if (isset($_GET['message'])) {
        $notificationMessage = $_GET['message'];
      
        
        // Display the error notification
        echo '<div style="color: orange;">' . $notificationMessage . '</div>';


    }
    ?>
</div>

<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
    setTimeout(function() {
        document.getElementById("signup-notification").style.display = "none";
    }, 3000);
</script>
</body>
</html>
