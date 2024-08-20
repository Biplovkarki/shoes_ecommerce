<?php
session_start();

include '../include/header.php';
include '../include/connection.php';
// Fetch all brands
$brand_select = "SELECT * FROM brands";
$result_brand = mysqli_query($conn, $brand_select);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Image Row</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .scrolling-wrapper {
            overflow-x: auto;
            white-space: nowrap;
            padding: 10px; /* Adjust padding as needed */
        }

        .brand-container {
            display: inline-block;
            margin-right: 10px; /* Adjust margin as needed */
            border: 1px solid #ddd; /* Add a border for a frame effect */
            text-align: center; /* Center align text */
            /* Add pointer cursor to indicate clickability */
            padding: 5px; /* Add padding for spacing within the frame */
            height: fit-content; /* Set a fixed height for the container */
            width: 70px; /* Set a fixed width for the container */
            box-sizing: border-box; /* Include padding and border in the total width and height */
            position: relative; /* Add relative positioning */
        }

        .brand-container img {
            height: 100%; /* Set the image height to 100% of the container */
            width: auto; /* Maintain the aspect ratio */
            object-fit: contain;
            aspect-ratio: 3/2;
        }
        .Card-content{
    width:330px;
}
.card-content.card-footer button.btn-success {
    display: inline-block;
    width: 180px; /* Increase the width */
    /* Adjust padding */
    font-size: 20px; /* Increase font size */
    text-align: center;
    text-decoration: none;
    cursor: pointer;
    margin-left:80px;
    border-radius: 5px;
    transition: background-color 0.3s ease-in-out;
}
        .brand-name {
            display: none; /* Hide the brand name by default */
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(255, 255, 255, 0.8); /* Add a semi-transparent background */
            padding: 5px;
            font-size: 12px;
            white-space: pre-line;
        }

        .brand-container.active .brand-name {
            display: block; /* Show the brand name for the active brand */
        }

        .brand-container:hover {
            border: 2px solid #007bff;
        }

        .col-md-2,
        .col-md-10 {
            gap: 2px;
            border: 2px red solid;
        }

        .slider {
            padding: 20px;
            width: 200px;
            position: auto;
            height: 450px;
            margin-top: 20px;
            /* overflow-y: scroll; */
        }

        .slider li {
            border: 2px red none;
            list-style: none;
            margin-bottom: 5px;
            margin-left: -15px;
            backdrop-filter: blur(10px);

        }

        .slider li a {
            padding: 5px;
            text-decoration: none;
            font-weight: bold;
            color: black;
            margin-left: 10px;
            transition: color 0.3s;

        }

        .slider h3 {
            color: #dc3545;
        }

        .slider ul {
            padding-left: 10px; /* Remove default padding for the list */
        }

        .slider li a.active,
        .slider li a:hover {
            color: black !important; /* Color for the active and hover states */
            text-decoration: underline; /* Underline for the active and hover states */
        }

        .slider li a.active::after,
        .slider li a:hover::after {
            content: none; /* Remove content from ::after pseudo-element */
        }

        .col-md-10 {
            padding: 20px; /* Add padding as needed */
        }

        .card-img-top {
            width: 100%;
            height: 150px;
            object-fit: contain;
        }

        .product-container {
            width: 100%;
        }
    

        .Card-content-product {
            display: grid;
            column-gap: 2px;
            width: 265px;
            height: fit-content;
            padding: 2px;
            background: transparent;
            margin-left: 0px;
            border: 2px red solid;
        }

        .Card-content-product .card {
            width: 102%;
            margin-left: -10px;
            background: transparent;
            backdrop-filter: blur(10px);

        }

        

        .Card-content-product {
            padding-left: 15px;
        }

        .brand-container.active {
            border: 2px solid #007bff !important;
            background: #ebebe0 !important; /* Add !important to override other styles */
        }
    </style>

</head>

<body>
    <div class="container-fluid">
        <div class="scrolling-wrapper">
            <?php
            while ($brand_row = mysqli_fetch_assoc($result_brand)) {
                $id = $brand_row['brand_id'];
                $image = $brand_row['brand_image'];
                $brand_name = $brand_row['brand_name'];
            ?>
                <div class="brand-container" data-brand-id="<?php echo $id; ?>">
                    <a href="?id=<?php echo $id; ?>" onclick=" return activateBrand(<?php echo $id; ?>, '<?php echo $brand_name; ?>');">
                        <img src="../brand_images/<?php echo $image; ?>" alt="<?php echo $brand_name; ?>" class="img-fluid">
                    </a>

                    <div class="brand-name small"><?php echo $brand_name; ?></div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <?php
    if (isset($_GET['id'])) {
    ?>
        <div class="container-fluid mt-3">
            <div class="row pe-2">
                <div class="col-md-2 bg-light">
                    <div class="slider">

                        <?php
                        if (isset($_GET['id'])) {
                            $selectedBrandId = mysqli_real_escape_string($conn, $_GET['id']);
                            $category_select = "SELECT * FROM shoes_category WHERE brand_id = '$selectedBrandId'";

                            echo '<h3 class="h3  text-start">Category</h3>';
                            $selectedBrandId = $_GET['id'];

                            // Fetch and display categories based on the selected brand_id
                            $result_category = mysqli_query($conn, $category_select);

                            echo '<ul>';
                            while ($category_row = mysqli_fetch_assoc($result_category)) {
                                $categoryId = $category_row['shoes_id'];
                                $categoryName = $category_row['shoes_name'];
                                echo '<li><a href="?id=' . $selectedBrandId . '&category=' . urlencode($categoryId) . '" class="d-block mb-2" data-category-id="' . $categoryId . '">' . $categoryName . '</a></li>';
                            }
                            echo '</ul>';
                        }

                        ?>
                    </div>
                </div>
                <div class="col-md-10">
                    <?php
                    if (isset($_GET['id'])) {
                        $selectedBrandId = $_GET['id'];

                        // Fetch the brand details based on the selected brand_id
                        $brand_select_query = "SELECT * FROM brands WHERE brand_id = $selectedBrandId";
                        $result_brand = mysqli_query($conn, $brand_select_query);

                        // Check if the query was successful
                        if ($result_brand) {
                            $brand_row = mysqli_fetch_assoc($result_brand);
                            $brand_name = $brand_row['brand_name'];

                            // Display the brand name
                            echo '<h4 class="brand-name-display mb-4 mx-3">' . $brand_name . ' </h4>';

                            // Fetch products based on the selected brand and category
                            $selectedCategoryId = isset($_GET['category']) ? $_GET['category'] : null;

                            if ($selectedCategoryId !== null) {
                                $product_select = "SELECT * FROM products WHERE brand_id = $selectedBrandId AND shoes_id = $selectedCategoryId";
                            } else {
                                $product_select = "SELECT * FROM products WHERE brand_id = $selectedBrandId";
                            }

                            $result_product = mysqli_query($conn, $product_select);

                            echo '<div class="container-fluid"><div class="row">';

                            while ($product_row = mysqli_fetch_assoc($result_product)) {
                                $productId = $product_row['product_id'];
                                $productName = $product_row['product_name'];
                                $productImage = $product_row['P_picture1'];
                                $productPrice = $product_row['product_price'];
                                ?>
                                <div class="col-md-3 col-sm-6 mb-2 Card-content">
                                    <div class="card ">
                                        <img src="../product_images/<?php echo $productImage; ?>" class="card-img-top" alt="<?php echo $productName; ?>">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $productName; ?></h5>
                                            <p class="card-text">Price: Rs. <?php echo $productPrice; ?></p>
                                        </div>
                                        <div class="card-footer d-flex justify-content-center align-items-center">
                                           
                                            <button class="btn btn-success "  data-bs-toggle="tooltip" data-bs-placement="bottom" title="Add to Cart" onclick="addToCart(<?php echo $productId; ?>)">
                                                <i class="bi bi-cart"></i> Add to Cart
                                            </button>
                                           
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }

                            echo '</div></div>';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>

    <?php
    } else {
        // SQL query to fetch the latest 20 products ordered by product_id in descending order
        $query = "SELECT * FROM products ORDER BY product_id DESC LIMIT 20";
        $result = mysqli_query($conn, $query);

        if ($result) {
            // Fetch data and loop through the results
            // Counter to keep track of cards in a row
            echo "<div class='container '>";
            echo "<p class='h3 mx-4 mt-3 mb-2 else-text'>Products</p>";
            echo " <div class='row mt-4 p-4 mx-4 border border-2 product-container'>";

            while ($row = mysqli_fetch_assoc($result)) {
                // Access individual columns in the $row array
                $productId = $row['product_id'];
                $productName = $row['product_name'];
                $productImage = $row['P_picture1'];
                $productImage2 = $row['P_picture2'];
                $productImage3 = $row['P_picture3'];
                $productImage4 = $row['P_picture4'];
                $productImage5 = $row['P_picture5'];
                $productPrice = $row['product_price'];
                // ... add more columns as needed

                // Perform operations with the fetched data
                echo "
                <div class='col-md-3 col-sm-6 mb-3 Card-content-product'>
                    <div class='card '>
                        <img src='../product_images/$productImage' class='card-img-top' alt='$productName'>
                        <div class='card-body'>
                            <h5 class='card-title'>$productName</h5>
                            <p class='card-text'>Price: Rs. $productPrice</p>
                        </div>
                        <div class='card-footer d-flex justify-content-between align-items-center'>
                        
                            <button class='btn btn-success mx-5' style='font-size:14px;' data-bs-toggle='tooltip' data-bs-placement='bottom' title='Add to Cart' onclick='addToCart($productId)'>
                                <i class='bi bi-cart'></i> Add to Cart
                            </button>
                        </div>
                    </div>
                </div>";

            }
            echo "</div></div>";
        }
    }

    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var urlParams = new URLSearchParams(window.location.search);
            var activeBrandId = urlParams.get('id');

            if (activeBrandId) {
                // Add the 'active' class to the active brand on page load
                var activeBrand = document.querySelector('.brand-container[data-brand-id="' + activeBrandId + '"]');
                if (activeBrand) {
                    activeBrand.classList.add('active');
                    activeBrand.style.border = '1px solid #ddd';
                }
            }
        });

        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
        // Check if there is an active brand in localStorage

        document.addEventListener("DOMContentLoaded", function () {
            // Fetch the selected brand ID from the URL
            var urlParams = new URLSearchParams(window.location.search);
            var selectedBrandId = urlParams.get('id');

            // Example: Add event listeners to slider links
            var sliderLinks = document.querySelectorAll('.slider li a');

            sliderLinks.forEach(function (link) {
                link.addEventListener('click', function (event) {
                    event.preventDefault();

                    // Remove 'active' class from links that are not clicked
                    sliderLinks.forEach(function (sliderLink) {
                        if (sliderLink !== link) {
                            sliderLink.classList.remove('active');
                        }
                    });

                    // Add 'active' class to the clicked link
                    link.classList.add('active');

                    // Fetch and display products for the selected category (shoes_id)
                    var selectedCategoryId = link.getAttribute('data-category-id');

                    // Reload the page with the selected category in the URL
                    window.location.href = '?id=' + selectedBrandId + '&category=' + encodeURIComponent(selectedCategoryId);
                });
            });

            // Highlight the active category link on page load
            var activeCategoryId = urlParams.get('category');
            if (activeCategoryId) {
                var activeLink = document.querySelector('.slider li a[data-category-id="' + activeCategoryId + '"]');
                if (activeLink) {
                    activeLink.classList.add('active');
                }
            }
        });

        function activateBrand(id, name) {
            // Add the 'active' class to the clicked brand
            var brandContainers = document.querySelectorAll('.brand-container');
            brandContainers.forEach(function (container) {
                container.classList.remove('active');
                container.style.border = '1px solid #ddd';
            });

            var clickedBrand = document.querySelector('.brand-container[data-brand-id="' + id + '"]');
            clickedBrand.classList.add('active');
            clickedBrand.style.border = '2px solid #007bff';

            // Display the brand name
            var brandNameDisplay = document.querySelector('.brand-name-display');
            if (brandNameDisplay) {
                brandNameDisplay.textContent = name;
            }

            // Optionally, you can store the active brand ID in localStorage
            localStorage.setItem('activeBrandId', id);
        }
    </script>
    <script>
       

        function addToCart(productId) {
            // Redirect to item.php with the product ID
            window.location.href = 'item.php?id=' + productId;
        }
    </script>
</body>

</html>

<?php
include '../include/footer.php';
?>
