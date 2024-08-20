<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login Form</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            background-image: url('./projectpictures/backgroundlogin.jpg');
       
        }
        .container-fluid { margin-top:30px;
            border: 2px red none;
            height: fit-content;
            padding: 50px 30px 30px 30px;
        }
        .container.innercont {
            border: 2px black solid;
            height: fit-content;
            z-index: 0;
        }
        .row {
            border: 6px orange solid;
        }
        .col-md-6 {
            border: 2px black solid;
        }
        .col-md-6:first-child {
            position: relative;
            background-image: url('./projectpictures/naruto.png'), linear-gradient(to right, black 50%, orange 50%);
            border-right: 2px solid black;
            display: flex;
            background-repeat: no-repeat;
            background-size:contain;
            justify-content: center;
        }
        .col-md-6:first-child img {
            width: 200px;
            transform: translateX(-8px);
        }
        .col-md-6:last-child {
            justify-content: center;
            border: 2px solid black;
           
            background: linear-gradient(43deg, rgba(250,248,236,1) 15%, rgba(196,200,199,1) 25%, rgba(193,199,198,1) 35%, rgba(165,167,167,1) 41%, rgba(213,219,218,1) 45%, rgba(174,177,177,1) 49%, rgba(174,175,175,1) 53%, rgba(200,205,205,1) 63%, rgba(181,177,182,1) 72%, rgba(245,237,247,1) 76%, rgba(214,213,214,1) 78%, rgba(219,212,221,1) 88%);
            background-repeat: no-repeat;
            background-size: cover;
        }
        .form-floating {
            display: flex;
            border: 2px black none;
            backdrop-filter: blur(20px);
            background: transparent;
            position: relative;
        }
        .login {
            font-weight: bold;
            font-size: 60px;
            color: Orange;
            font-family: animation-play-state paused;
            font-variant: small-caps;
        }
        .form-control {
            padding-left: 40px;
            width: 100%;
            position: relative;
        }
        .form-floating span {
            position: absolute;
            width: 20px;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            color: red;
            cursor: pointer;
        }
        .link-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }
        .google-login-btn {
            background-color: #dc3545;
            color: white;
        }
        .sign-up {
            margin-left: 30%;
        }
        .notification{
        transform:translateY(-450px);
        z-index: 1;
       }
    
    </style>
</head>
<body>

    <div class="container-fluid">
        <div class="container col-lg col-sm col-md innercont">
            <div class="row">
                <div class="col-md-6">
                <a href="login.php"><i class="fa fa-reply-all" aria-hidden="true" style="color:white; font-size:30px;"></i></a> 

                    <img src="/project/projectpictures/logo.png" alt="logo" class="mx-auto mt-50 d-flex align-self-center">
                </div>
                <div class="col-md-6">
                    <h3 class="text-center login">Login</h3>
                    <form action="/project/function/login.php" method="Post" class="d-grid align-self-center" id="loginForm">
                        <div class="form-floating mb-3 mt-3">
                            <input type="text" class="form-control" id="Username" placeholder="Enter Username" name="Username">
                            <label for="Username">Username</label>
                            <span onclick="togglePasswordVisibility(event, 'pwd', 'showPassword')"><i class="fa fa-user"></i></span>
                        </div>
                        <div class="form-floating mt-3 mb-3">
                            <input type="text" class="form-control" id="pwd" placeholder="Enter password" name="pswd">
                            <label for="pwd">Password</label>
                            <span id="showPassword" onclick="togglePasswordVisibility(event, 'pwd', 'showPassword')"><i class="fa fa-lock"></i></span>
                        </div>
                        <div class="link-container">
                            <a href="forgotpassword.php">Forgot Password</a>
                            <div class="form-check align-self-end">
                                <input class="form-check-input d-flex align-self-end" type="checkbox" id="remember" />
                                <label class="form-check-label" for="remember">Remember me</label>
                            </div>
                        </div>
                        <button class="btn btn-success radius-2 w-50" style="margin-left:130px;" name="button">Login</button>
                    </form>
                    <h3 class="text-center mt-2">OR</h3>
                   
                    <!-- "Don't have an account? Sign Up" link -->
                    <div class="link-container mt-3">
                        <p class="text-center sign-up">Don't have an account? <a href="register.php">Sign Up</a></p>
                    </div>
                </div>
            </div> <div class="col-md-12">
          <div class="notification text-center" id="signup-notification">  
            <?php
           if (isset($_GET['message']) && isset($_GET['class'])) {
            $notificationMessage = $_GET['message'];
            $notificationClass = $_GET['class'];
        
            // Display the success notification
            echo '<div class="alert ' . $notificationClass . ' alert-dismissible fade show" role="alert">' .
                $notificationMessage .
                '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' .
                '</div>';
        }
            
            ?> 
</div>

        </div>
    </div>
    
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    
    <script>
        // Function to toggle password visibility
        function togglePasswordVisibility(event, passwordFieldId, iconId) {
            event.preventDefault();
            var passwordField = document.getElementById(passwordFieldId);
            var icon = document.getElementById(iconId);

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                icon.innerHTML = '<i class="fa fa-unlock"></i>';
            } else {
                passwordField.type = 'password';
                icon.innerHTML = '<i class="fa fa-lock"></i>';
            }
        }
        setTimeout(function() {
        document.getElementById("signup-notification").style.display = "none";
    }, 3000);
    </script>
</body>
</html>
