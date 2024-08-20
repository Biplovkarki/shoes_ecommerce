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
    <title>Registration Form - Shoe Website</title>
</head>
<body>
    <div class="container">
        <img src="../projectpictures/logo.png" alt="Pich Shoes Logo" class="logo">
        <h2 class="text-center">Registration Form</h2>
        <div class="row justify-content-center">
            <div class="col-md-6 mt-3">
            
                <form action="../function/register.php" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label"><i class="icon fas fa-user"></i> Full Name</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label"><i class="icon fas fa-envelope"></i> Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label"><i class="icon fas fa-phone"></i> Phone</label>
                        <input type="phone" class="form-control" id="phone" name="phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label"><i class="icon fas fa-lock"></i> Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label"><i class="icon fas fa-lock"></i> Confirm Password</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="signup"> Register</button>
                </form>
                <div class="mt-3">
                <p class="text-center"><a href="loginform.php">already a Member</a></p>
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
    </div>
    <script>
        setTimeout(function() {
        document.getElementById("signup-notification").style.display = "none";
    }, 3000);
    </script>
</body>
</html>
