<?php
include '../include/header.php';
include '../include/connection.php';
?>
<style>
    /* Add specific styles for newstand.php */
    .card-img-top {
        width: 100%;
        height: 150px;
        object-fit: contain;
    }

    .Card-content {
        width: 250px;
        height: fit-content;
        padding: 5px auto auto 20px;
        margin-left: 0px;
    }

    .card-footer button {
        font-size: 12px;
    }

    .vertical-menu {
        width: 200px;
        position: relative;
        height: 350px;
        overflow-y: scroll;
    }

    .vertical-menu a {
        background-color: #eee;
        color: black;
        display: block;
        padding: 12px;
        text-decoration: none;
    }

    .vertical-menu a:hover {
        background-color: #ccc;
        transform: scale(1);
    }

    .vertical-menu a.active {
        background-color: #04AA6D;
        color: white;
    }

    .vertical-menu a {
        display: flex;
        gap: 1.5rem;
    }

    .brand-search-container {
        margin-bottom: 10px;
        padding: 10px;
        border-bottom: 1px solid #ddd;
    }

    .brand-search-input {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
.Card-content{
    width:340px;
}

    .card-footer button.btn-success {
    display: inline-block;
    width: 180px; /* Increase the width */
    /* Adjust padding */
    font-size: 20px; /* Increase font size */
    text-align: center;
    text-decoration: none;
    cursor: pointer;
    border-radius: 5px;
    transition: background-color 0.3s ease-in-out;
}




</style>

<!-- first child -->
<div class="bg-light">
    <h3 class="text-center">NewStand</h3>
</div>

<div class="row">
    <div class="col-md-10">
        <?php
        // Fetch categories
        $category_select = "SELECT * FROM categories";
        $result_category = mysqli_query($conn, $category_select);

        while ($category_row = mysqli_fetch_assoc($result_category)) {
            $categoryId = $category_row['cat_id'];
            $categoryName = $category_row['cat_title'];

            echo '<div class="row mx-1 my-3">';
            echo '<h4 class="">' . $categoryName . '</h4>';

            // Fetch products based on category and brand (if selected)
            $brandFilter = isset($_GET['brand']) ? "AND brand_id = " . $_GET['brand'] : "";
            $product_select = "SELECT * FROM products WHERE cat_id = $categoryId $brandFilter";
            $result_product = mysqli_query($conn, $product_select);

            // Check if there are products in this category
            if (mysqli_num_rows($result_product) > 0) {
                while ($product_row = mysqli_fetch_assoc($result_product)) {

                    $productId = $product_row['product_id'];
                    $productName = $product_row['product_name'];
                    $productImage = $product_row['P_picture1'];
                    $productPrice = $product_row['product_price'];

                    echo '<div class="col-md-3 col-sm-6 mb-2 Card-content">';
                    echo '<div class="card">';
                    echo '<img src="../product_images/' . $productImage . '" class="card-img-top" alt="' . $productName . '">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . $productName . '</h5>';
                    echo '<p class="card-text">price: Rs.' . $productPrice . '</p>';
                    echo '</div>';
                    echo '<div class="card-footer d-flex justify-content-between align-items-center">';
                    echo '<button class="btn btn-success mx-5" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Add to Cart" onclick="addToCart(' . $productId . ')">';
echo '<i class="bi bi-cart"></i> Add to Cart';
echo '</button>';
            
                 echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                // No products in this category
                echo '<p>No products available in this category.</p>';
            }

            echo '</div>';
        }
        ?>
    </div>

    <!-- sidenav -->
    <div class="col-md-2 bg-secondary p-0 container-fluid" style="height: fit-content;">
        

        <!-- Brands Loop -->
        <h3 class="text-center p-2 mb-0 bg-danger">Brands</h3>
        <div class="vertical-menu">
            <!-- Brands Search Form -->
        
            <input type="text" class="form-control brand-search-input" placeholder="Search Brands" name="search" id="searchInputSidebar">
       

        <?php
        $searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
        ?>
            <?php
            $brand_select = "SELECT * FROM brands";
            $result_brand = mysqli_query($conn, $brand_select);

            while ($brand_row = mysqli_fetch_assoc($result_brand)) {
                $brandId = $brand_row['brand_id'];
                $image = $brand_row['brand_image'];
                $name = $brand_row['brand_name'];

                // Check if the brand matches the search query
                if (empty($searchQuery) || stripos($name, $searchQuery) !== false) {
                    // Check if the current brand is active
                    $isActive = isset($_GET['brand']) && $_GET['brand'] == $brandId ? 'active' : '';

                    echo '
                    <a href="?brand=' . $brandId . '" class="' . $isActive . '">
                        <img src="../brand_images/' . $image . '" alt="' . $name . '" style="width: 40px; height: 40px; object-fit: contain;">
                        <span>' . $name . '</span>
                    </a>';
                }
            }
            ?>
        </div>
    </div>
</div>
<script>
    // Initialize Bootstrap tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });
</script>
<script>
    // Brands Search and Cancel Logic
    document.addEventListener("DOMContentLoaded", function () {
        // Sidebar search
        var searchInputSidebar = document.getElementById('searchInputSidebar');
        searchInputSidebar.addEventListener('input', function () {
            // Fetch and display matching brands dynamically
            var searchQuerySidebar = searchInputSidebar.value.trim().toLowerCase();
            filterBrands(searchQuerySidebar, true);
        });

        function filterBrands(query, isSidebar = false) {
            var verticalMenu = document.querySelector(isSidebar ? '.vertical-menu' : '.row .Card-content');

            // Hide all brands initially
            var brands = verticalMenu.querySelectorAll('a');
            brands.forEach(function (brand) {
                brand.style.display = 'none';
            });

            // Display only the matching brands
            brands.forEach(function (brand) {
                var brandName = brand.querySelector('span').textContent.toLowerCase();
                if (brandName.includes(query)) {
                    brand.style.display = 'flex';
                }
            });
        }
    });
</script>
<script>
    function addToCart(productId) {
        // Redirect to item.php with the product ID
        window.location.href = 'item.php?id=' + productId;
    }
</script>

<script>
    //prevent from resubmission of form
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }

</script>
<?php include '../include/footer.php'; ?>
