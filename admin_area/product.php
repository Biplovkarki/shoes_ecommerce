<?php
include('../include/connection.php');

$notification = array('message' => '', 'class' => '');

if (isset($_POST['insert_product'])) {
    $product_title = isset($_POST['prod_name']) ? $_POST['prod_name'] : '';
    $product_desc = isset($_POST['prod_descp']) ? $_POST['prod_descp'] : '';
    $product_cat = isset($_POST['prod_cat']) ? $_POST['prod_cat'] : '';
    $product_brand = isset($_POST['product_brand']) ? $_POST['product_brand'] : '';
    $prod_price = isset($_POST['prod_price']) ? $_POST['prod_price'] : '';

    $prod_image1 = $_FILES['main_image']['name'];
    $prod_image2 = $_FILES['picture2']['name'];
    $prod_image3 = $_FILES['picture3']['name'];
    $prod_image4 = $_FILES['picture4']['name'];
    $prod_image5 = $_FILES['picture5']['name'];

    $temp_image1 = $_FILES['main_image']['tmp_name'];
    $temp_image2 = $_FILES['picture2']['tmp_name'];
    $temp_image3 = $_FILES['picture3']['tmp_name'];
    $temp_image4 = $_FILES['picture4']['tmp_name'];
    $temp_image5 = $_FILES['picture5']['tmp_name'];

    // Validate if any of the fields contain only spaces
    if (
      empty(trim($product_title)) ||
      empty(trim($product_desc)) ||
      empty(trim($product_cat)) ||
      empty(trim($product_brand)) ||
      empty(trim($prod_price)) ||
      empty(trim($prod_image1)) ||
      empty(trim($prod_image2)) ||
      empty(trim($prod_image3)) ||
      empty(trim($prod_image4)) ||
      empty(trim($prod_image5))
    ) {
        $notification['message'] = 'Fields cannot contain only spaces';
        $notification['class'] = 'alert-danger';
    } elseif (
        $product_title == '' or
        $product_desc == '' or
        $product_cat == '' or
        $product_brand == '' or
        $prod_price == '' or
        $prod_image1 == '' or
        $prod_image2 == '' or
        $prod_image3 == '' or
        $prod_image4 == '' or
        $prod_image5 == ''
    ) {
        $notification['message'] = 'Empty field cannot be inserted';
        $notification['class'] = 'alert-danger';
    } else {
        // Continue with the rest of your form processing logic

        // Check if all uploaded images are unique within the same column
        $uniqueImagesInColumn = count(array_unique([$prod_image1, $prod_image2, $prod_image3, $prod_image4, $prod_image5])) === count([$prod_image1, $prod_image2, $prod_image3, $prod_image4, $prod_image5]);

        if (!$uniqueImagesInColumn) {
            $notification['message'] = 'Images in the same column should be different';
            $notification['class'] = 'alert-danger';
        } else {
            move_uploaded_file($temp_image1, "../product_images/$prod_image1");
            move_uploaded_file($temp_image2, "../product_images/$prod_image2");
            move_uploaded_file($temp_image3, "../product_images/$prod_image3");
            move_uploaded_file($temp_image4, "../product_images/$prod_image4");
            move_uploaded_file($temp_image5, "../product_images/$prod_image5");

            // Insert into the database
            $insert_query = "INSERT INTO `products` (product_name, p_description, cat_id, brand_id, product_price, P_picture1, P_picture2, P_picture3, P_picture4, P_picture5) VALUES (
              '" . mysqli_real_escape_string($conn, $product_title) . "',
              '" . mysqli_real_escape_string($conn, $product_desc) . "',
              '" . mysqli_real_escape_string($conn, $product_cat) . "',
              '" . mysqli_real_escape_string($conn, $product_brand) . "',
              '" . mysqli_real_escape_string($conn, $prod_price) . "',
              '" . mysqli_real_escape_string($conn, $prod_image1) . "',
              '" . mysqli_real_escape_string($conn, $prod_image2) . "',
              '" . mysqli_real_escape_string($conn, $prod_image3) . "',
              '" . mysqli_real_escape_string($conn, $prod_image4) . "',
              '" . mysqli_real_escape_string($conn, $prod_image5) . "'
            )";

            if (mysqli_query($conn, $insert_query)) {
                $notification['message'] = 'Product inserted successfully';
                $notification['class'] = 'alert-success';
            } else {
                $notification['message'] = 'Error inserting product: ' . mysqli_error($conn);
                $notification['class'] = 'alert-danger';
            }
        }
    }
}
?>

<style>
    .container.bg-light.mt-3 {
        width: 70%;
        border-radius: 30px;
        padding: 50px;
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
        <form action="" method="post" enctype="multipart/form-data">
            <h3 class="text-center">Insert product</h3>
            <div class="mb-3">
                <label for="prod_name" class="form-label">Product Name</label>
                <input type="text" class="form-control" name="prod_name" id="prod_name" placeholder="Enter product" required />
            </div>
            <div class="mb-3">
                <label for="prod_descp" class="form-label">Description</label>
                <!-- Replace the input field with a textarea -->
                <textarea class="form-control" rows="5" name="prod_descp" id="prod_descp" placeholder="Enter description" required></textarea>
            </div>
            <div class=" mb-3 row">
                <div class="col">
                    <label for="prod_cat" class="form-label">Category</label>
                    <select class="form-select form-select-md" name="prod_cat" id="prod_cat" placeholder="product_cat" required>
                        <option selected> select category</option>
                        <?php
                        $select_cat = "SELECT * FROM categories ";
                        $result_cat = mysqli_query($conn, $select_cat);
                        while ($row = mysqli_fetch_assoc($result_cat)) {
                            $category_title = $row['cat_title'];
                            $category_id = $row['cat_id'];
                            echo "<option value='$category_id'>$category_title</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col">
                    <label for="product_brand" class="form-label">Brand</label>
                    <select class="form-select form-select-md" name="product_brand" id="product_brand" placeholder="product_brand" required>
                        <option selected>Select Brands</option>
                        <?php
                        $select_brand = "SELECT * FROM  brands ";
                        $result_brand = mysqli_query($conn, $select_brand);
                        while ($row = mysqli_fetch_assoc($result_brand)) {
                            $brand_name = $row['brand_name'];
                            $brand_id = $row['brand_id'];
                            echo "<option value='$brand_id'>$brand_name</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class=" mb-3 row">
                <div class="col">
                    <label for="prod_price" class="form-label">Price</label>
                    <input type="text" class="form-control" name="prod_price" id="prod_price" placeholder="Enter price" />
                </div>
                <div class="col">
                    <label for="shoes_type" class="form-label">Shoes Category</label>
                    <select class="form-select form-select-md" name="shoes_type" id="shoes_type" placeholder="shoes_type" required>
                        <option selected> select shoes category</option>
                        <?php
                        $select_shoes = "SELECT * FROM shoes_category ";
                        $result_shoes = mysqli_query($conn, $select_shoes);
                        while ($row = mysqli_fetch_assoc($result_shoes)) {
                            $shoes_title = $row['shoes_name'];
                            $shoes_id = $row['shoes_id'];
                            echo "<option value='$shoes_id'>$shoes_title</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label for="main_image" class="form-label">Main picture</label>
                <input type="file" class="form-control" id="main_image" name="main_image" placeholder="main_image" />
            </div>
            <div class="mb-3 row">
                <div class="col">
                    <label for="picture2" class="form-label">Right picture</label>
                    <input type="file" class="form-control" id="picture2" name="picture2" placeholder="picture2" />
                </div>
                <div class="col">
                    <label for="picture3" class="form-label">Left picture</label>
                    <input type="file" class="form-control" id="picture3" name="picture3" placeholder="picture3" />
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col">
                    <label for="picture4" class="form-label">Bottom picture</label>
                    <input type="file" class="form-control" id="picture4" name="picture4" placeholder="picture4" />
                </div>
                <div class="col">
                    <label for="picture5" class="form-label">Top picture</label>
                    <input type="file" class="form-control" id="picture5" name="picture5" placeholder="picture5" />
                </div>
            </div>

            <div class="d-flex justify-content-start mb-3">
                <button type="submit" class="btn btn-info " style="width: 150px;" name="insert_product">Insert</button>
            </div>
        </form>
    </div>

    <script>
        //prevent from resubmission of form
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
        // Hide the notification after 3 seconds
        setTimeout(function() {
            var notification = document.getElementById('notification');
            if (notification) {
                notification.style.display = 'none';
            }
        }, 3000)
    </script>
</body>
