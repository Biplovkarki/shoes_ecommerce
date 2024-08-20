<?php
include('../include/connection.php');

// Initialize notification variables
$notification = array('message' => '', 'class' => '');

if (isset($_POST['insert_cat'])) {
    $cat_title = $_POST['cat_title'];
    $lowercase_title = strtolower($cat_title);

    // Check if the input contains only spaces
    if (empty(trim($cat_title))) {
        $notification['message'] = 'Please enter a valid category name';
        $notification['class'] = 'alert-danger';
    } else {
        $select_query = "SELECT * FROM categories WHERE cat_title = '$cat_title'";
        $result_select = mysqli_query($conn, $select_query);
        $number = mysqli_num_rows($result_select);

        if ($number > 0) {
            $notification['message'] = 'This category is already in the database';
            $notification['class'] = 'alert-danger';
        } else {
            $insert_query = "INSERT INTO categories (cat_title) VALUES ('$cat_title')";
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
                <input type="text" class="form-control" id="cat_title" placeholder="Enter category" name="cat_title" required>
                <label for="cat_title">Category</label>
            </div>
            <button type="submit" class="btn btn-primary my-1" name="insert_cat">Insert</button>
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
