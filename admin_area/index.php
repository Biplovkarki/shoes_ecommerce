<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <title>shoeshub/--admin area--/</title>
    <style>
        .sidebar-link.active {
    background-color: white; /* Change to the desired active background color */
    border-right: 3px solid #007bff; /* Change to the desired active border color */
}

.sidebar-link:hover {
    background-color:white; /* Change to the desired hover background color */
    border-right: 3px solid #007bff; /* Change to the desired hover border color */
}
        .container-fluid {
    border: 2px red none;
    margin: 0;
    padding: 0;
   
}

.sidebar {
    background-color: aquamarine;
    border: 4px #1f1a1a none;
    top: 0;
    position: fixed; /* Set position to fixed */
    left: 0;
    padding: 20px;
    height: 100vh;
    overflow: hidden;
    width:200px;
    transition: all 0.5s linear;
}

.sidebar-content {
    margin: 60px 30px 30px auto;
}

.sidebar-link{
    list-style: none;
    padding: 1rem;
    margin: 4px -30px;
    border-radius: 8px;
    transition: all 0.5s ease-in-out;
}
.sidebar-link a {
    text-decoration: none;
    font-family: "Poppins", sans-serif;
    display: flex;
    align-items: center;
    gap: 1.5rem;
    font-weight: bold;
    font-size: 16px;
    color: black;
}

.main-content {
    height: fit-content;
    width:100%; /* Set width to 100% */
    border: 2px red solid;
    margin-left: 0; /* Adjust margin to the desired value, or leave it as 0 */
}
.navbar{
 max-width: 100%;
 padding:10px;
}
 </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <div class="sidebar">
                    <ul class="sidebar-content">
                    <li class="sidebar-link <?php echo empty($_GET) ? 'active' : (isset($_GET['dashboard']) ? 'active' : ''); ?>">
    <a href="index.php?dashboard">
        <span>Dashboard</span>
        <i class="fa-solid fa-gauge"></i>
    </a>
</li> 
                        <li class="sidebar-link <?php echo isset($_GET['profile']) ? 'active' : ''; ?>">
                            <a href="index.php?profile">
                                <span>profile</span>
                              
                            </a>
                        </li>
                        <li class="sidebar-link <?php echo isset($_GET['brand']) ? 'active' : ''; ?>">
                            <a href="index.php?brand">
                                <span>Brands</span>
                              
                            </a>
                        </li>
                        <li class="sidebar-link <?php echo isset($_GET['category']) ? 'active' : ''; ?>">
                            <a href="index.php?category">
                                <span>Category</span>
                                
                            </a>
                        </li>
                        <li class="sidebar-link <?php echo isset($_GET['product']) ? 'active' : ''; ?>">
                            <a href="index.php?product">
                                <span>products</span>
                                
                            </a>
                        </li>
                        <li class="sidebar-link <?php echo isset($_GET['shoes_cat']) ? 'active' : ''; ?>">
                            <a href="index.php?shoes_cat">
                                <span style="white-space:normal;">shoes category</span>
                                
                            </a>
                        </li>
                        <li class="sidebar-link <?php echo isset($_GET['add_admin']) ? 'active' : ''; ?>">
                            <a href="index.php?add_admin">
                                <span style="white-space:normal;">admin</span>
                                
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-10">
                <div class="main-content">
                    <!-- Move the navbar outside the container -->
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <div class="container-fluid">
                            <span class="navbar-brand">Welcome, Admin</span>
                            <!-- Navbar Toggler -->
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <!-- Navbar Content -->
                            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <!-- Replace 'profile-image.jpg' with the path to your profile image -->
                                        <img src="/project/projectpictures/bear.jpg" alt="Profile Image" class="nav-link rounded-circle" style="width: 60px; height: 60px; object-fit: contain;">
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>

                    <div class="container">
                        <?php
                            if(isset($_GET['category'])){
                                include('category.php');
                            }
                            if(isset($_GET['brand'])){
                                include('brand.php');
                            }
                            if(isset($_GET['product'])){
                                include('product.php');
                            }
                            if(isset($_GET['shoes_cat'])){
                                include('shoes_cat.php');
                            }
                            if(isset($_GET['add_admin'])){
                                include('admin.php');
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--script-->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var sidebarLinks = document.querySelectorAll('.sidebar-link a');

            sidebarLinks.forEach(function (link) {
                link.addEventListener('click', function () {
                    sidebarLinks.forEach(function (innerLink) {
                        innerLink.classList.remove('active');
                    });

                    this.classList.add('active');
                });
            });

            // Handle initial activation based on current URL
            var currentUrl = window.location.href;
            sidebarLinks.forEach(function (link) {
                var hrefValue = link.querySelector('a').getAttribute('href');
                if (currentUrl.endsWith(hrefValue)) {
                    link.classList.add('active'); // Add the class to the active link
                }
            });
        });
    </script>
</body>
</html>
