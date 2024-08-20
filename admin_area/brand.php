<?php
include('../include/connection.php');

// Initialize notification variables
$notification = array('message' => '', 'class' => '');

// Insert new brand
if (isset($_POST['insert_brand'])) {
    $brand_title = isset($_POST['brand_title']) ? $_POST['brand_title'] : '';
    $lowercase_title = strtolower($brand_title);

    // Check if the input contains only spaces
    if (empty(trim($brand_title))) {
        $notification['message'] = 'Please enter a valid brand name';
        $notification['class'] = 'alert-danger';
    } else {
        $select_query = "SELECT * FROM brands WHERE brand_name='$brand_title'";
        $result_select = mysqli_query($conn, $select_query);
        $number = mysqli_num_rows($result_select);

        if ($number > 0) {
            $notification['message'] = 'This brand is already inside the database';
            $notification['class'] = 'alert-danger';
        } else {
            if (empty($_FILES["brand_image"]["name"])) {
                $notification['message'] = 'Please upload an image';
                $notification['class'] = 'alert-danger';
            } else {
                $target_dir = "../brand_images/";
                $target_file = $target_dir.basename($_FILES["brand_image"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                // Check if the uploaded file already exists
                if (file_exists($target_file)) {
                    $notification['message'] = 'File already exists';
                    $notification['class'] = 'alert-danger';
                } else {
                    // Move the uploaded file to the target directory
                    if (move_uploaded_file($_FILES["brand_image"]["tmp_name"], $target_file)) {
                        // Your existing image upload code here

                        $insert_query = "INSERT INTO brands (brand_name, brand_image) VALUES ('$brand_title', '$target_file')";
                        $result = mysqli_query($conn, $insert_query);

                        if ($result) {
                            $notification['message'] = 'Brand inserted successfully';
                            $notification['class'] = 'alert-success';
                        } else {
                            $notification['message'] = 'Error inserting brand';
                            $notification['class'] = 'alert-danger';
                        }
                    } else {
                        $notification['message'] = 'Error moving uploaded file to destination folder';
                        $notification['class'] = 'alert-danger';
                    }
                }
            }
        }
    }
}

// Fetch data from the 'brands' table
$brand_select = "SELECT * FROM brands";
$result_brand = mysqli_query($conn, $brand_select);
?>
<!-- Rest of your HTML code -->


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brand List</title>
    <style>
        .insert.bg-light.mt-3 {
            border-radius: 30px;
            height: 300px;
            width: 99%;
        }

        .view.bg-light.mt-3 {
            border-radius: 30px;
            width: 99%;
        }
    </style>
</head>

<body>

    <div class="container insert bg-light mt-3">
    <?php
        // Display notification
        if (!empty($notification['message'])) {
            echo '<div id="notification" class="alert ' . $notification['class'] . ' alert-dismissible fade show" role="alert">
                  ' . $notification['message'] . '
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
        }
        ?>
        <h2 class="text-center">Insert Brand</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-floating mb-3 mt-3">
                <input type="text" class="form-control" id="brand" placeholder="Enter Brand" name="brand_title" required>
                <label for="brand_title">Brand</label>
            </div>
            <div class="form-floating mb-3 mt-3">
                <input type="file" class="form-control" id="brand_image" name="brand_image" required>
                <label for="brand_image">Brand Image</label>
            </div>
            <button type="submit" class="btn btn-primary my-1" name="insert_brand" value="insert_button">Insert</button>
        </form>
    </div>
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
            // Loop through the result set and display each row
            while ($row = mysqli_fetch_assoc($result_brand)) {
                echo '<tr>';
                echo '<td>' . $row['brand_name'] . '</td>';
                echo '<td><img src="' . $row['brand_image'] . '" alt="' . $row['brand_name'] . '" style="max-width: 100px; max-height: 100px;"></td>';
                echo '</tr>';
            }
            ?>

        </tbody>
    </table>
</div>
    <script>
        //prevent from resubmisson of form
        if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
        // Hide the notification after 3 seconds
        setTimeout(function () {
            var notification = document.getElementById('notification');
            if (notification) {
                notification.style.display = 'none';
            }
        }, 3000);
    </script>

</body>

</html>
