<?php
    // Start the session
    session_start();
    if (!isset($_SESSION['wishlist'])) {
        $_SESSION['wishlist'] = array();
    }
    
    if (isset($_POST['add_to_wishlist'])) {
        $item = array(
            'name' => $_POST['item_name'],
            'price' => $_POST['item_price'],
            'image' => $_POST['item_image']
        );
    
        // Check if item already exists in the wishlist
        foreach ($_SESSION['wishlist'] as $wish_item) {
            if ($wish_item['name'] == $item['name']) {
                echo "Item is already in your wishlist!";
                exit;
            }
        }
    
        // Add item to wishlist
        $_SESSION['wishlist'][] = $item;
    
        header('Location: wishlist.php');
    }

    // Function to add item to cart
    function addToCart($item) {
      $item['price'] = floatval(str_replace('R', '', $item['price'])); // Remove 'R' and convert to float
      $item['quantity'] = 1; // Set the initial quantity to 1
      $_SESSION['cart'][] = $item;
      // Increment cart count
      $_SESSION['cart_count'] = isset($_SESSION['cart_count']) ? $_SESSION['cart_count'] + 1 : 1;
      return true; // Return true indicating successful addition to cart
  }
  if(isset($_POST['add_to_cart'])) {
    // Get item details from POST data
    $itemName = $_POST['item_name'];
    $itemPrice = $_POST['item_price'];

    // Add item to cart
    if(addToCart(array("name" => $itemName, "price" => $itemPrice))) {
        // Increment cart count only if item was successfully added
        $_SESSION['cart_count'] = isset($_SESSION['cart_count']) ? $_SESSION['cart_count'] + 1 : 1;
    }
    
}

  // Check if the Add to Cart button is clicked
  if(isset($_POST['add_to_cart'])) {
      // Get item details from POST data
      $itemName = $_POST['item_name'];
      $itemPrice = $_POST['item_price'];

      // Add item to cart
      addToCart(array("name" => $itemName, "price" => $itemPrice));
      
  }
  if(isset($_POST['add_to_wishlist'])) {
    // Add the item to the wishlist (you can save it to the session or database)
    $itemName = $_POST['item_name'];
    $itemPrice = $_POST['item_price'];
    $itemImage = $_POST['item_image'];

    // Implement the logic for adding the item to the wishlist
    // Example: $_SESSION['wishlist'][] = array('name' => $itemName, 'price' => $itemPrice, 'image' => $itemImage);
    echo "Item added to wishlist: " . $itemName;
}

  if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    // Initialize cart and cart count if not already set
    if(!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
    if(!isset($_SESSION['cart_count'])) {
        $_SESSION['cart_count'] = 0;
    }
}
 


?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Scent-sational</title>
    <link rel="shortcut icon" type="image/x-icon" href="Images/logo2.png" />
    <link rel="stylesheet" href="Catalog2.css">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="navbar.css" />
    <link
      href="https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="./css/preloader.css" />
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
      integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
      crossorigin="anonymous"
    />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="./js/preloader.js"></script>
    <style>
        .no-js #loader {
    display: none;
}

.js #loader {
    display: block;
    position: absolute;
    left: 100px;
    top: 0;
}

.se-pre-con {
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url(https://j2n9a3i8.stackpathcdn.com/wp-content/uploads/2014/08/Preloader_11.gif) center no-repeat white;
}
header img {
    max-width: 500px;
    max-height: 100px;
    margin-top: -10px; /* Adjust this value as needed */
}
        nav>ul>li {
    display: inline-block;
  }
  
  nav {
    position: fixed;
    top: 0;
    width: 100%;
  
    background-color: white;
    overflow: auto;
    padding: 10px 30px 20px 10px;
  }
  
  .primary-nav {
    float: left;
    font-size: 20px;
  }
  
  .primary-nav>a {
    letter-spacing: 5px;
  }
  
  .primary-nav>img {
    width: 30px;
  }
  
  .secondary-nav>a {
    letter-spacing: 1px;
    color: rgba(0, 0, 0, 0.6);
    font-size: 15px;
    letter-spacing: 3px;
    padding-right: 20px;
  }
  
  .secondary-nav {
    float: right;
    margin-right: 10px;
    margin-left: 10px;
    font-size: 20px;
  }
  
  nav>ul>li>a {
    color: black;
    font-family: helvetica;
    text-decoration: none;
  }
  
  nav>ul>li>a:hover {
    color: #cb4335;
    transition: .7s ease;
  }
  body, html {
  height: 100%;
  margin: 0;
  font-family: "Montserrat";
  max-width: 100%;
  overflow-x: hidden;
}
/* General CSS */
header {
    width: 100%;
    background-color: white;
    z-index: 1000; /* Ensures the header stays on top of the content */
    position: fixed;
    top: 0;
    left: 0;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1); /* Adds a slight shadow for a clean look */
}

header img {
    max-width: 500px;
    max-height: 100px;
    margin-top: -10px;
}

nav>ul>li {
    display: inline-block;
}

/* Responsive Design for Screens with max-width of 600px */
@media (max-width: 600px) {
    header {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1000;
        background-color: white;
        max-height: 400px; /* Adjust header height for small screens */
        font-size: 12px;  
    }

    header img {
        max-width: 300px; /* Adjust logo size */
        max-height: 80px;
        margin-top: -5px;
    }

    /* Push down content to avoid overlapping */
  
    
    .primary-nav, .secondary-nav {
        display: block;
        text-align: center; /* Center the navigation for small screens */
    }

    nav>ul>li {
        display: block; /* Stack nav items vertically */
        margin: 2px 0; /* Add spacing between items */
    }

    /* Adjust the appearance of the secondary navigation */
    .secondary-nav>a {
       
        padding: 5px;
    }
}


.pxtext {
  position: relative;
  top: -40%;
  width: 100%;
  padding-left: 0%;
  left: 20px;
}

.border {
  color: white;
  margin: 0;
  font-size: 10vh;
  font-family: "Montserrat";
  font-weight: 700;
  letter-spacing: 1px;
  color: black;
}

.border>p {
  text-shadow: 0px 1px 2px rgba(0, 0, 0, 0.6);
}

.pxtext>p>a {
  background-color: black;
  text-align: center;
  color: white;
  border-radius: 16px;
  padding: 10px 10px 10px 10px;
  margin-bottom: 10px;
  text-decoration: none;
  box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.6);
  transition: .5s ease;
}

.pxtext>p>a:hover {
  background-color: #cb4335;
  box-shadow: 1px 1px 5px rgba(203, 67, 53, 0.6);
  font-size: 20px;
  transition: .5s;
}

.row {
  display: flex;
  flex-direction: row;
}

.col {
  width: 50%;
  padding: 40px 20px 40px 20px;
}

.overlay-image {
  position: relative;
  width: 100%;
  box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.6);
  border-radius: 7px;
}

/* Original image */

.overlay-image .image {
  display: block;
  width: 100%;
  height: 100%;
  border-radius: 7px;
  object-fit: cover;
}

/* Original text overlay */

.overlay-image .text {
  color: #fff;
  font-size: 4vw;
  line-height: 1.5em;
  font-weight: bold;
  text-shadow: 2px 2px 2px #000;
  text-align: center;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 100%;
}

.overlay-image .hover {
  position: absolute;
  top: 0;
  height: 100%;
  width: 100%;
  opacity: 0;
  transition: 0.5s ease;
}

/* New overlay appearance on hover */

.overlay-image:hover .hover {
  opacity: 1;
}

.overlay-image .normal {
  transition: 0.5s ease;
}

.overlay-image:hover .normal {
  opacity: 0;
}

.overlay-image .hover {
  background-color: rgba(0, 0, 0, 0.5);
}

#about-us {
  margin: 0 10% 0 10%;
}

section h1 {
  font-size: 40px;
  text-align: center;
}

section p {
  color: #000;
  font-size: 1.2vw;
  line-height: 1.25em;
  padding: 0 0 1em 0;
  text-align: justify;
}

.foot {
  margin: 0 10% 0 10%;
}

footer {
  background-color: #1b212b;
  color: white;
}

.col>ul>li>a {
  color: white;
  text-decoration: none;
}

.col>ul>li {
  list-style-type: none;
}

.col>ul>li>a:hover {
  color: brown;
}

.col>ul {
  margin: 0;
  padding: 0;
}

a {
  color: cadetblue;
  text-decoration: none;
}

.footer-container {
    display: flex;
    justify-content: space-between;
    padding: 20px;
    background-color: #333;
    color: #fff;
}

.payment-methods img {
    width: 50px;
    margin: 0 10px;
}

.contact-info {
    text-align: left;
}

.social-icons img {
    width: 30px;
    margin: 0 10px;
}

.social-icons a {
    display: inline-block;
}

.contact-info p {
    margin: 5px 0;
}

h4 {
    font-size: 18px;
    margin-bottom: 10px;
}

.copyright {
    background-color: #222;
    text-align: center;
    padding: 10px;
    color: #ccc;
    font-size: 14px;
}

figcaption {
  text-align: center;
  color: #000;
  font-weight: bold;
  font-size: 20px;
}

.item>a>img {
  box-shadow: 1px 1px 10px rgba(0, 0, 0, 0.6);
  border-radius: 7px;
}

.item:hover {
  filter: brightness(50%);
  transition: .5s ease;
}
.slide-container {
    position: relative;
    display: inline-block;
    bottom: 0;
    
    
}
.slide-container .shade {
    position: relative;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 50px; /* Adjust the height of the shade as needed */
    background: linear-gradient(transparent, rgba(0, 0, 0, 0.7)); /* Create a gradient shade effect */
    z-index: 1; /* Ensure the shade appears below the paragraph */
   
    
}

#lif-slide .shade {
    position: absolute; /* Ensure consistent positioning */
    bottom: 0;
    left: 0;
    width: 100%; /* Adjust width as needed */
    height: 30%; /* Adjust height as needed */
    background: linear-gradient(to bottom, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.5));/* Adjust the gradient as needed */
}
.mySlides {
    width: 100%; /* Set the width to 100% */
    height:  cover; /* Set the maximum height to occupy the full height */
    object-fit: cover; /* Maintain aspect ratio and cover the entire space */
    display: block; /* Make sure it behaves as a block element */
    margin: 0 auto; /* Center the image horizontally */
}
#lif-slide {
    position: relative;
    width: 100%; /* Occupy the full width of the container */
    height: 100vh; /* Occupy the full height of the viewport */
    overflow: hidden;
    text-align: center;
    background-color: rgb(255, 255, 255); /* Optional: Set a background color */
    
}
        #lif-slide p{
            font-size: 15px;
        }
        .slider-container {
    position: relative;
    width: 100%;
    height: 100%; /* Set a fixed height for the slideshow container */
    display: flex;
    align-items: center; /* Vertically center the slides */
    justify-content: center; /* Horizontally center the slides */
    
}
.w3-button {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background-color: transparent;
        border: none;
        color: white;
        font-size: 24px;
        cursor: pointer;
        z-index: 2; /* Ensure buttons appear above images */
    }

    .w3-display-left {
        left: 0;
    }

    .w3-display-right {
        right: 0;
    }
    .dot-container {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
        }

        .dot {
            display: inline-block;
            width: 10px;
            height: 10px;
            background-color: #bbb;
            border-radius: 50%;
            margin: 0 5px;
            cursor: pointer;
        }

        .active {
            background-color: #717171;
        }
        .paragraph-container {
    position: relative;
    bottom: 10px; /* Adjust the distance from the bottom as needed */
    left: 10px; /* Adjust the distance from the left as needed */
    z-index: 2; /* Ensure the paragraph appears above the shade */
    margin-top: 0;
}

.fixed-paragraph {
    position:relative;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 80%; /* Adjust the width as needed */
    background-color: rgba(0, 0, 0, 0.7); /* Semi-transparent background */
    padding: 20px; /* Adjust padding as needed */
    color: white;
    font-size: 16px;
    display: none; /* Hide all paragraphs by default */
    margin-top: -600px;
    
}
footer img{
  max-width: 400px;
  max-height: 200px;
}
.signout-button {
    background-color: orange;
    color: white;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    margin-top: 10px;
}

/* Hover effect for the Signout button */
.signout-button:hover {
    background-color: #cc0000; /* Darker red background color on hover */
  }
main {
    padding: 20px;
    margin-top: 80px;
}

h2 {
    text-align: center;
    font-family: Arial, sans-serif;
    margin-bottom: 20px;
}

.col2 {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    grid-gap: 20px;
}

.card {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
}

.wish-container {
    display: grid;
    grid-template-columns: repeat(3, 1fr); /* Ensure three items per row */
    gap: 20px; /* Space between items */
}

.wish-item {
    background-color: #f9f9f9;
    padding: 15px;
    text-align: center;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 100%; /* Make sure each item takes up full space of the grid column */
    height: 400px; /* Set a fixed height for uniformity */
}

.wish-item img {
    width: 100%;
    height: 250px; /* Fix the image height for consistency */
    object-fit: cover; /* Ensure the image is cropped nicely */
    border-radius: 10px;
}

.wish-item h3 {
    font-size: 18px;
    margin: 10px 0;
}

.wish-item p {
    font-size: 16px;
    font-weight: bold;
}
.gif-banner {
            width: 100%; /* Cover the full width */
            height: 200px; /* Set the height */
            object-fit: cover; /* Adjusts the image without stretching */
            margin-top: 10px;
        }
        #wishlist-button .wishlist-link {
    display: inline-block;
    padding: 10px 20px;
    background-color: orange;
    color: white;
    border-radius: 5px;
    text-decoration: none;
    font-weight: bold;
}

#wishlist-button .wishlist-link:hover {
    background-color: darkorange;
}


@media (max-width: 768px) {
  main {
    padding: 20px;
    margin-top: 200px;
}
    .col2 {
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    }
    .fore-container {
    display: grid;
    grid-template-columns: repeat(2, 1fr); /* Three items per row */
    gap: 20px; /* Space between items */
}
.wish-container {
        grid-template-columns: repeat(2, 1fr); /* Adjust to two items per row on smaller screens */
    }
}

    </style>
</head>
<body>
<header>
        <nav>
            <ul>
        <li class="primary-nav">
            
           <a href="catalog2.php"><img src="Images/sslogo.png" alt="logo" /></a>
           
          
           <li class="secondary-nav"><a href="catalog2.php">FRAGRANCES</a></li>
          <li class="secondary-nav"><a href="cart.php">Cart <i class="fas fa-shopping-cart"></i> (<?php echo isset($_SESSION['cart_count']) ? $_SESSION['cart_count'] : 0; ?>)</a></li>
            <li class="secondary-nav"> <i class="fa fa-user-circle" aria-hidden="true"></i> <?php
                if (isset($_SESSION['username'])) {
                    echo $username;
                } else {
                    echo "<a href='index.php'>Sign In</a>";
                    echo "<a href='index3.php'>Sign Up</a>";
                }
            ?></li>
            <li class="secondary-nav"> <form action="index.php" method="post">
                <input type="submit" name="logout" value="SIGNOUT" class="signout-button">
            </form></li>
        </nav>
    </header>

    <main>
    <div class="col2">
        <div class="card">
        <div class="catalog">
        <h2>Your Wishlist</h2>
<div class="wish-container">
    <?php
    // Function to remove an item from the wishlist
    function removeFromWishlist($index) {
        unset($_SESSION['wishlist'][$index]);
        $_SESSION['wishlist'] = array_values($_SESSION['wishlist']); // Re-index the array
    }

    // Check if the delete button is pressed
    if (isset($_POST['remove_from_wishlist'])) {
        removeFromWishlist($_POST['index']);
    }

    if (!empty($_SESSION['wishlist'])) {
        foreach ($_SESSION['wishlist'] as $index => $wish_item) {
            echo "<div class='wish-item'>";
            echo "<img src='" . htmlspecialchars($wish_item['image']) . "' alt='" . htmlspecialchars($wish_item['name']) . "'>";
            echo "<h3>" . htmlspecialchars($wish_item['name']) . "</h3>";
            echo "<p>Price: R" . htmlspecialchars($wish_item['price']) . "</p>";

            // Add to Cart form
            echo "<form action='cart.php' method='post'>";
            echo "<input type='hidden' name='item_name' value='" . htmlspecialchars($wish_item['name']) . "'>";
            echo "<input type='hidden' name='item_price' value='" . htmlspecialchars($wish_item['price']) . "'>";
            echo "<input type='hidden' name='item_image' value='" . htmlspecialchars($wish_item['image']) . "'>";
            echo "<button type='submit' name='add_to_cart'>Add to Cart</button>";
            echo "</form>";

            // Delete button form
            echo "<form action='' method='post' style='margin-top: 10px;'>";
            echo "<input type='hidden' name='index' value='" . $index . "'>";
            echo "<button type='submit' name='remove_from_wishlist'>Delete</button>";
            echo "</form>";

            echo "</div>";
        }
    } else {
        echo "<p>Your wishlist is empty.</p>";
    }
    ?>
</div>
</div>
</div>
</div>

<footer>
    <div class="footer-container">
        <!-- Payment methods section -->
        <div class="payment-methods">
            <h4>Payment Methods</h4>
            <img src="Images/visa.png" alt="Visa">
            <img src="Images/mastercard.png" alt="MasterCard">
            <img src="Images/paypal.png" alt="PayPal">
        </div>

        <!-- Contact and Social Media section -->
        <div class="contact-info">
            <h4>Contact Us</h4>
            <p>Address: 116 Clearwater Road, Lynnwood Glen</p>
            <p>Phone: +27 67 105 9444</p>

            <div class="social-icons">
                <a href="https://instagram.com" target="_blank">
                    <img src="Images/instagram.png" alt="Instagram">
                </a>
                <a href="https://twitter.com" target="_blank">
                    <img src="Images/twitter.png" alt="Twitter">
                </a>
                <a href="https://tiktok.com" target="_blank">
                    <img src="Images/tiktok.png" alt="TikTok">
                </a>
            </div>
        </div>
    </div>

    <!-- Copyright line -->
    <div class="copyright">
        <p>&copy; 2024 Scent-sational. All rights reserved.</p>
    </div>
</footer>
</main>

</body>
</html>
<?php
 if(isset ($_POST["logout"])){
    // Reset cart and cart count
    unset($_SESSION['cart']);
    unset($_SESSION['cart_count']);
    
    // Destroy the current session
    session_destroy();
    
    // Start a new session
    session_start();

    // Redirect to the login page
    header("Location: index.html");
    exit(); // Terminate script execution after redirection
    
}
?>

