<?php // Start the session
// Include your connection file

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // If logged in, fetch the user profile information
    $user_email = $_SESSION['user_email'];
    $user_name = $_SESSION['user_name'];
    $user_phone = $_SESSION['user_phone'];
} else {
    // If not logged in, set default values or redirect to login page
    $user_message = 'Please <a href="../user_area/loginform.php">login</a> to see your profile';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Your Website Title</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
     
    <!-- Your additional stylesheets can be added here -->
    <style>
        .navbar-brand{
            margin-left:5px;
        }
       
        .collapse {
            margin-right:360px;
        }
        .nav-link{
            margin:5px;
            @media(max-width:576px) {
          
            margin:2px;
        }  
        }
        .mid{
            margin:21px;
            @media(max-width:576px) {
           margin:2px;
            
        }  
        }
        .mid:hover {
            transform: scale(1.25,1.5);
            @media(max-width:576px) {
            transform:none;
            }
            
        }
        
        .navbar{
            height:80px;
        @media(max-width:576px) {
            height:auto;
            
        }
        }
        .badge {
      position: absolute;
     transform:translate(-9px,-8px);
      color: white;
      padding: 5px 10px;
      border-radius: 50%;
      font-size: 16px;
    }
    .navbar-icon{
        margin-right:30px;
    }
    .email-profile {
    display: flex;
    align-items: center;
}

.email-profile a {
    margin-left: 200px; /* Adjust as needed */
}

    </style>
    
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" >
                <img src="/project/projectpictures/logo.png" alt="Shoeshub logo" style=" width:150px;" class="rounded-pill">
            </a>

            <!-- Toggler/collapsibe Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <!-- Add your navigation links here -->
                    <!-- <li class="nav-item">
                        <a class="nav-link mid" href="home.php">Home</a>
                    </li> -->
                    <!-- <li class="nav-item">
                        <a class="nav-link mid" href="#about">About</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link mid" href="newstand.php">Newstand </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mid" href="shop.php">shop</a>
                    </li>
                    <!-- Add more navigation links as needed -->
                </ul>
            </div>
            <div class="navbar-icon">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php"><i class="fas fa-shopping-cart" aria-hidden="true" style="color:aliceblue;"></i></a>
                    </li>
                    <li class="nav-item">
                        <!-- Button trigger modal -->
                        <a class="nav-link" data-bs-toggle="modal" data-bs-target="#profileModal">
                            <i class="fa fa-user" aria-hidden="true" style="color:aliceblue;"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Profile Modal -->
    <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="profileModalLabel">User Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Display user profile information -->
                    <?php if (isset($_SESSION['user_id'])) : ?>
                        <p class="email-profile">
    Email: <?php echo $user_email; ?>
    <!-- <a href="../user_area/profile.php"><button type="button" class="btn btn-secondary f-right">Profile</button></a> -->
</p>
                        <p>Username: <?php echo $user_name; ?></p>
                        <p>Phone: <?php echo $user_phone; ?></p>
                        <p><a href="user_orders.php">Order_list</a><p>
                        <p><a href="password.php">change password</a><p>
                    <?php else : ?>
                        <!-- Display login message if not logged in -->
                        <?php echo $user_message; ?>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <!-- If logged in, show logout button -->
                    <?php if (isset($_SESSION['user_id'])) : ?>
                        <a href="../function/logout.php"><button type="button" class="btn btn-secondary">Logout</button></a>
                    <?php endif; ?>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
