<?php
session_start();
include '../include/connection.php';
include '../include/header.php';
$message = '';
$class = '';
// Check if the product ID is set in the URL
if (isset($_GET['id'])) {
    $productId = mysqli_real_escape_string($conn, $_GET['id']);

    // Fetch product details based on the product ID
    $product_query = "SELECT p.*, b.brand_name, c.shoes_name 
                      FROM products p
                      JOIN brands b ON p.brand_id = b.brand_id
                      JOIN shoes_category c ON p.shoes_id = c.shoes_id
                      WHERE p.product_id = '$productId'";

    $result_product = mysqli_query($conn, $product_query);

    if ($result_product && mysqli_num_rows($result_product) > 0) {
        $product_details = mysqli_fetch_assoc($result_product);

        // Extract product details
        $productName = $product_details['product_name'];
        $productCategory = $product_details['shoes_name'];
        $productBrand = $product_details['brand_name'];
        $productDescription = $product_details['p_description'];
        $productPrice = $product_details['product_price'];
        $productImage = $product_details['P_picture1'];
        $productImage2 = $product_details['P_picture2'];
        $productImage3 = $product_details['P_picture3'];
        $productImage4 = $product_details['P_picture4'];
        $productImage5 = $product_details['P_picture5'];
      
        
        if (isset($_POST['add_to_cart'])) {
            
            $userId = $_SESSION['user_id']; // Assuming user is logged in
            $size = mysqli_real_escape_string($conn, $_POST['size']);
            $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);

            // Insert the product into the cart table
            $insert_query = "INSERT INTO cart (user_id, product_id, size, quantity,price) VALUES ('$userId', '$productId', '$size', '$quantity',$productPrice)";
            $insert_result = mysqli_query($conn, $insert_query);

            if ($insert_result) {
                // Success message
                $message = "Product added to cart successfully.";
                $class = "alert-success";
            } else {
                // Error message
                $message = "Error: Unable to add product to cart.";
                $class = "alert-danger";
            }
            
        }

      
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $productName; ?> Details</title>
    <!-- Add your CSS styles here -->
    <style>
       body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
  
        .container-fluid {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .col-md-7,
        .col-md-5 {
            flex: 0 0 48%;
            margin-bottom: 20px;
        }

        .small-image {
            width: 80px;
            height: 80px;
            margin-top: 10px;
            margin-bottom: 10px;
            cursor: pointer;
            transition: transform 0.3s ease-in-out;
        }

        .small-image:hover {
            transform: scale(1.2);
        }

        #mainImage {
            width: 100%;
            max-width: 400px;
            height: auto;
            border: 2px solid red;
        }

        .details {
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .details h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .details p {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .size-quantity,
        .add-to-cart,
        .add-to-fav {
            margin-top: 20px;
        }

        .quantity-control {
            display: flex;
            align-items: center;
        }

        .quantity-control button {
            margin: 0 5px;
            cursor: pointer;
        }

        .quantity-control input {
            width: 40px;
            text-align: center;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease-in-out;
        }

        .btn-primary {
            background-color: #007bff;
            color: #fff;
            border: none;
        }

        .btn-danger {
            background-color: #dc3545;
            color: #fff;
            border: none;
        }

        .btn-success {
            background-color: #28a745;
            color: #fff;
            border: none;
        }

        .reviews-container,
        .review-form,
        .related-product {
            margin-top: 20px;
            border: 2px solid red;
            padding: 20px;
            border-radius: 5px;
        }

        .related-products-container h2 {
            margin-left: 0;
        }

        .card {
            width: 100%;
            border: 1px solid #ddd;
            border-radius: 5px;
            overflow: hidden;
        }

        .card img {
            width: 100%;
            height: auto;
        }

        .star-rating {
            font-size: 24px;
        }

        .star-rating > span {
            color: #ccc; /* Colorless star */
        }

        .star-rating > span:hover,
        .star-rating > span:hover ~ span,
        .star-rating > span.filled {
            color: orange; /* Orange star */
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .col-md-7,
            .col-md-5 {
                flex: 0 0 100%;
            }
        }
    </style>
</head>

<body>
    <!-- Add your HTML structure for displaying product details -->
    <div class="container-fluid">
    <?php if (!empty($message)): ?>
    <div class="alert <?php echo $class; ?>" role="alert">
        <?php echo $message; ?>
    </div>
<?php endif; ?>
        <div class="row">
            <div class="col-md-7">
                <div class="row">
                    <div class="col-md-3">
                        <div class="small-image" onclick="changeImage('../product_images/<?php echo $productImage; ?>')">
                            <img src="../product_images/<?php echo $productImage; ?>" alt="<?php echo $productName; ?>" class="img-fluid">
                        </div>
                        <div class="small-image" onclick="changeImage('../product_images/<?php echo $productImage2; ?>')">
                            <img src="../product_images/<?php echo $productImage2; ?>" alt="<?php echo $productName; ?>" class="img-fluid">
                        </div>
                        <div class="small-image" onclick="changeImage('../product_images/<?php echo $productImage3; ?>')">
                            <img src="../product_images/<?php echo $productImage3; ?>" alt="<?php echo $productName; ?>" class="img-fluid">
                        </div>
                        <div class="small-image" onclick="changeImage('../product_images/<?php echo $productImage4; ?>')">
                            <img src="../product_images/<?php echo $productImage4; ?>" alt="<?php echo $productName; ?>" class="img-fluid">
                        </div>
                        <div class="small-image" onclick="changeImage('../product_images/<?php echo $productImage5; ?>')">
                            <img src="../product_images/<?php echo $productImage5; ?>" alt="<?php echo $productName; ?>" class="img-fluid">
                        </div>
                    </div>
                    <div class="col-md-9">
                        <img id="mainImage" src="../product_images/<?php echo $productImage; ?>" alt="<?php echo $productName; ?>" class="img-fluid">
                        
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="details">
                <?php
    $avg_rating_query = "SELECT AVG(ratings) AS avg_rating FROM reviews WHERE product_id = '$productId'";
    $avg_rating_result = mysqli_query($conn, $avg_rating_query);
    $avg_rating_row = mysqli_fetch_assoc($avg_rating_result);
    $avg_rating = round($avg_rating_row['avg_rating']); // Round the average rating to the nearest integer
    ?>
      <div class="star-rating">
        <?php
        // Loop to display filled stars up to the average rating
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $avg_rating) {
                echo '&#9733;'; // Filled star
            } else {
                echo '&#9734;'; // Empty star
            }
        }
        ?>
 
    </div>
                    <h1 class="center"><b><?php echo $productName; ?></b></h1>
                    <p><b>Category: <?php echo $productCategory; ?></b></p>
                    <p><b>Brand: <?php echo $productBrand; ?></b></p>
                    <p><b>Price: Rs. <?php echo $productPrice; ?></b></p>
                    <p>Description: <?php echo $productDescription; ?></p>
                    <!-- Add other product details as needed -->
                    <div class="size-quantity">
                    <form method="POST">
            <div class="size-quantity">
                <!-- Size selection -->
                <label for="size">Size:</label>
                <input type="number" id="size" name="size" min="36" max="42" value="36">
               

                <!-- Quantity selection -->
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" min="1" value="1">
            </div>

            <!-- Submit button -->
            <?php if (isset($_SESSION['user_id'])): ?>
    <!-- Display Add to Cart and Buy Now buttons only if the user is logged in -->
    <button class="btn btn-primary add-to-cart" type="submit" name="add_to_cart">Add to Cart</button>
    <button class="btn btn-success add-to-fav" type="submit" name="buy_now">Buy Now</button>
<?php else: ?>
    <!-- Display a message or redirect to the login form if the user is not logged in -->
    <p>Please <a href="../user_area/loginform.php">log in</a> to add items to your cart or make a purchase.</p>
<?php endif; ?>

                        </div>
                        
                </div>

                <!-- Reviews Section -->
                
            </div>
        </div>
    </div>
<div class="container">
<!-- Reviews Section -->
<div class="reviews-container">
    <h2>Product Reviews</h2>
    <?php
    ;
    // Fetch reviews for the product with user details
    $reviews_query = "SELECT r.*, u.user_name
    FROM reviews r
    INNER JOIN users u ON r.user_id = u.user_id
    WHERE r.product_id = '$productId'";
    $reviews_result = mysqli_query($conn, $reviews_query);
    
    if ($reviews_result && mysqli_num_rows($reviews_result) > 0) {
        while ($review = mysqli_fetch_assoc($reviews_result)) {
            // Display each review
            echo '<div class="review">';
            echo '<h5>' . $review['user_name'] . ' - ' . $review['review_date'] . '</h5>';// Display timestamp
            echo '<div class="star-rating">';
            for ($i = 1; $i <= 5; $i++) {
                if ($i <= $review['ratings']) {
                    echo '&#9733;'; // Filled star
                } else {
                    echo '&#9734;'; // Empty star
                }
            }
            echo '</div>';
            echo '<p><b>Review: </b>' . $review['review_text'] . '</p>';
            echo '</div>';
        }
    } else {
        echo '<p>No reviews found for this product.</p>';
    }
    if (isset($_SESSION['user_id'])) {
        // Check if the user has already submitted a review
        $user_review_query = "SELECT * FROM reviews WHERE product_id = '$productId' AND user_id = '".$_SESSION['user_id']."'";
        $user_review_result = mysqli_query($conn, $user_review_query);

        if (!$user_review_result || mysqli_num_rows($user_review_result) === 0) {
            // User has not submitted a review, display the review form
            ?>
            <!-- Review Form -->
            <div class="review-form">
                <h3>Add Your Review</h3>
                <form action="../function/submit_review.php" method="POST">
                    <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
                    <label for="rating">Rating:</label>
                    <select id="rating" name="rating">
                        <option value="1">1 Star</option>
                        <option value="2">2 Stars</option>
                        <option value="3">3 Stars</option>
                        <option value="4">4 Stars</option>
                        <option value="5">5 Stars</option>
                    </select>
                    <br>
                    <label for="comment">Comment:</label><br>
                    <textarea id="comment" name="comment" rows="4" cols="50"></textarea><br>
                    <button type="submit" name="submit_review">Submit Review</button>
                </form>
            </div>
            <?php
        } else {
            // User has already submitted a review
            echo '<p>You have already submitted a review for this product.</p>';
        }
    } else {
        // User is not logged in, prompt to log in
        $_SESSION['redirect_after_login'] = 'item.php?id=' . $productId;
        echo '<div class="container"><p>Please <a href="../user_area/loginform.php">log in</a> to submit a review.</p></div>';

    }
    ?>
</div>

<div class="container">
    <div class="related-product">
<div class="related-products-container">
    <h2>Related Products</h2>
    <div class="row">
   
        <?php
        // Fetch related products based on shoes_id
        $related_query = "SELECT * FROM products WHERE shoes_id = '$product_details[shoes_id]' AND product_id != '$productId' LIMIT 4";
        $related_result = mysqli_query($conn, $related_query);

        if ($related_result && mysqli_num_rows($related_result) > 0) {
            while ($related_product = mysqli_fetch_assoc($related_result)) {
                echo '<div class="col-md-3" >';
                echo '<div class="card">';
                echo '<img src="../product_images/' . $related_product['P_picture1'] . '" alt="' . $related_product['product_name'] . '" class="card-img-top" style="height:200px;">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . $related_product['product_name'] . '</h5>';
                echo '<p class="card-text">Price: Rs. ' . $related_product['product_price'] . '</p>';
                echo '<a href="item.php?id=' . $related_product['product_id'] . '" class="btn btn-primary">View Details</a>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<p>No related products found.</p>';
        }
        ?>
    </div>
</div>

    </div>
    <div class="notification text-center" id="signup-notification">  
    <?php
    if (isset($_GET['message']) && isset($_GET['class'])) {
        $notificationMessage = $_GET['message'];
        $notificationClass = $_GET['class'];
        
        // Display the error notification
        echo '<div class="alert ' . $notificationClass . ' alert-dismissible fade show" role="alert">' .
            $notificationMessage .
            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' .
            '</div>';
    }
    ?>
     <div class="notification text-center" id="signup-notification">  
    <?php
    if (isset($_GET['message']) && isset($_GET['class'])) {
        $notificationMessage = $_GET['message'];
        $notificationClass = $_GET['class'];
        
        // Display the error notification
        echo '<div class="alert ' . $notificationClass . ' alert-dismissible fade show" role="alert">' .
            $notificationMessage .
            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' .
            '</div>';
    }
    ?>
</div>
    <!-- Add your JavaScript and additional styling if necessary -->
    <script>
        function changeImage(newImage) {
            document.getElementById('mainImage').src = newImage;
        }

        function changeSize(value) {
            var sizeInput = document.getElementById('size');
            var currentSize = parseInt(sizeInput.value);
            var newSize = currentSize + value;

            if (newSize >= 36 && newSize <= 44) {
                sizeInput.value = newSize;
            }
        }

        function changeQuantity(value) {
            var quantityInput = document.getElementById('quantity');
            var currentQuantity = parseInt(quantityInput.value);
            var newQuantity = currentQuantity + value;

            if (newQuantity >= 1 && newQuantity <= 10) {
                quantityInput.value = newQuantity;
            }
        }

        function toggleStars() {
            // Implement logic to toggle stars when clicked
        }
        

    // Rest of your existing JavaScript code...
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }

    </script>
    <script>
    // Function to hide the message after 10 seconds
    function hideMessage() {
        var messageElement = document.querySelector('.alert');
        if (messageElement) {
            setTimeout(function() {
                messageElement.style.display = 'none';
            }, 3000); // Hide after 10 seconds (10000 milliseconds)
        }
    }
    
    // Call the hideMessage function when the page loads
    window.onload = function() {
        hideMessage();
    };
</script>

</body>

</html>

<?php
    } else {
        // Handle case where product details are not found
        echo "Product details not found.";
    }
} else {
    // Handle case where product ID is not set in the URL
    echo "Product ID not provided.";
}

include '../include/footer.php';
?>
