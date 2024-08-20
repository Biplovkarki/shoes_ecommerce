<?php
include('../include/connection.php');

// Initialize notification variables
$notification = array('message' => '', 'class' => '');

if (isset($_POST['insert_shoes'])) {
    $shoes_name = mysqli_real_escape_string($conn, $_POST['shoes_name']);
    $brand_id = isset($_POST['product_brand']) ? $_POST['product_brand'] : '';

    $lowercase_title = strtolower($shoes_name);

    // Check if the input contains only spaces
    if (empty(trim($shoes_name))) {
        $notification['message'] = 'Please enter a valid category name';
        $notification['class'] = 'alert-danger';
    } else {
        $select_query = "SELECT * FROM `shoes_category` WHERE shoes_name = '$shoes_name'";
        $result_select = mysqli_query($conn, $select_query);
        $number = mysqli_num_rows($result_select);

        if ($number > 0) {
            $notification['message'] = 'This category is already in the database';
            $notification['class'] = 'alert-danger';
        } else {
            $insert_query = "INSERT INTO `shoes_category` (shoes_name, brand_id) VALUES ('$shoes_name', '$brand_id')";
            $result = mysqli_query($conn, $insert_query);

            if ($result) {
                $notification['message'] = 'Category inserted successfully';
                $notification['class'] = 'alert-success';
            } else {
                $notification['message'] = 'Error inserting category';
                $notification['class'] = 'alert-danger';
            }
        }
    }
}
?>

<style>
    .container.bg-light.mt-3 {
        border-radius: 30px;
        height: fit-content;
        width: 99%;
    }

    .notification {
        display: none;
        padding: 15px;
        border-radius: 8px;
        font-size: 16px;
        width: 300px;
        text-align: center;
        z-index: 9999;
    }


</style>

<body>
    <div class="container bg-light mt-3">
    <?php
        // Display notification
        if (!empty($notification['message'])) {
            echo '<div id="notification" class="alert ' . $notification['class'] . ' alert-dismissible fade show" role="alert">
                  ' . $notification['message'] . '
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
        }
        ?>
        <h2 class="text-center">Insert Category</h2>
        
        <form action="" method="post">
            <div class="form-floating mb-3 mt-3">
                <input type="text" class="form-control" id="shoes_name" placeholder="Enter shoes category" name="shoes_name" required>
                <label for="shoes_name"> Shoes Category</label>
            </div>
            <div class="container-fluid">
    <label for="product_brand" class="form-label">Brand</label>
    <select class="form-select form-select-md" name="product_brand" id="product_brand"  placeholder="product_brand" required>
      <option selected>Select Brands</option>
      <?php
      $select_brand="SELECT * FROM  brands ";
      $result_brand=mysqli_query($conn,$select_brand);
      while($row=mysqli_fetch_assoc($result_brand)){
      $brand_name=$row['brand_name'];
      $brand_id=$row['brand_id'];
      echo "<option value='$brand_id'>$brand_name</option>";
      }
      ?>
    </select>
  </div>
            <button type="submit" class="btn btn-primary my-1" name="insert_shoes">Insert</button>
        </form>

        <script>
            //prevent from resubmisson of form
            if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
            // JavaScript function to show the notification and hide after 3 seconds
            setTimeout(function () {
            var notification = document.getElementById('notification');
            if (notification) {
                notification.style.display = 'none';
            }
        }, 3000);
        </script>
    </div>
</body>
