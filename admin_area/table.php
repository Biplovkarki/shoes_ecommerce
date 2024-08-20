<?php
include '../include/connection.php'
?>
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
    <title>Document</title>
</head>
<body>
<div class="container view bg-light mt-3">
    <h2 class="text-center">View Brands</h2>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Brand Name</th>
                <th scope="col">Brand Image</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $brand_select = "SELECT * FROM brands";
$result_brand = mysqli_query($conn, $brand_select);
            // Loop through the result set and display each row
            while ($row = mysqli_fetch_assoc($result_brand)) {
                echo '<tr>';
                echo '<td>' . $row['brand_name'] . '</td>';
                echo '<td><img src="' . $row['brand_image'] . '" alt="' . $row['brand_name'] . '" style="max-width: 100px; max-height: 100px;"></td>';
                echo '</tr>';
                
            }
            ?>
</body>
</html>