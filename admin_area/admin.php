<?php
include '../include/connection.php';
$notification = array('message' => '', 'class' => '');

if (isset($_POST['insert_ad'])) {
    // Retrieve form data
    $name = mysqli_real_escape_string($conn, $_POST['Name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $password = mysqli_real_escape_string($conn, $_POST['pswd']);

    // Check for empty values
    if (empty($name) || empty($email) || empty($phone) || empty($password)) {
        $notification['message'] = 'All fields are required!';
        $notification['class'] = 'alert alert-danger';
    } else {
        // Check if email already exists
        $checkEmailQuery = "SELECT * FROM `admin` WHERE ad_email = '$email'";
        $resultEmailCheck = mysqli_query($conn, $checkEmailQuery);

        if (mysqli_num_rows($resultEmailCheck) > 0) {
            $notification['message'] = 'Email already exists!';
            $notification['class'] = 'alert alert-danger';
        } else {
            // Hash the password using MD5 (for demonstration purposes; use bcrypt in production)
            $hashedPassword = md5($password);

            // Insert data into the database
            $insertQuery = "INSERT INTO `admin` (ad_name, ad_email, ad_phone, ad_password) VALUES ('$name', '$email', '$phone', '$hashedPassword')";
            $resultInsert = mysqli_query($conn, $insertQuery);

            if ($resultInsert) {
                $notification['message'] = 'Registration successful!';
                $notification['class'] = 'alert alert-success';
            } else {
                $notification['message'] = 'something wrong! ';
                $notification['class'] = 'alert alert-danger';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login Form</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
   </style> 
</head>
<body>
<div class="container-fluid">
            <div class="col-md-12">
            <?php
        // Display notification
        if (!empty($notification['message'])) {
            echo '<div id="notification" class="alert ' . $notification['class'] . ' alert-dismissible fade show" role="alert">
                  ' . $notification['message'] . '
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
        }
        ?>
                <h3 class="text-center reg">Add admin</h3>
                <form action="" method="POST">
                    <div class="mb-3 mt-3">
                        <label for="Name" class="form-label">Name:</label>
                        <input type="text" class="form-control" id="Name" placeholder="Enter Name" name="Name" required>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone number:</label>
                        <input type="text" class="form-control" id="phone" placeholder="Enter phone" name="phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="pwd" class="form-label">Password:</label>
                        <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd" required>
                    </div>
                    <button type="submit" class="btn btn-primary signup mb-2 " name="insert_ad">Insert</button>
                </form>
            </div>
        </div>
        

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
<script>
     setTimeout(function () {
            var notification = document.getElementById('notification');
            if (notification) {
                notification.style.display = 'none';
            }
        }, 3000);
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>
</body>
</html>