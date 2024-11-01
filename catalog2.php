<?php
    // Start the session
    session_start();

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
// Handle add to wishlist action
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_to_wishlist'])) {
  $wishlistItem = [
      'name' => $_POST['item_name'],
      'price' => $_POST['item_price'],
      'image' => $_POST['item_image'],
  ];

  // If the wishlist array doesn't exist, create it
  if (!isset($_SESSION['wishlist'])) {
      $_SESSION['wishlist'] = [];
  }

  // Check if item already exists in the wishlist
  $exists = false;
  foreach ($_SESSION['wishlist'] as $item) {
      if ($item['name'] === $wishlistItem['name']) {
          $exists = true;
          break;
      }
  }

  // Add the item to the wishlist if it doesn't already exist
  if (!$exists) {
      $_SESSION['wishlist'][] = $wishlistItem;
      $_SESSION['wishlist_added'] = true;  // Set the session flag for animation
  } else {
      echo "Item already in wishlist: " . $wishlistItem['name'];
  }

  // Redirect to avoid form resubmission
  header("Location: " . $_SERVER['REQUEST_URI']);
  exit();
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
  body {
  height: 100%;
  margin: 0;
  font-family: "Montserrat";
  max-width: 100%;
  overflow-x: hidden;
  background-image: url('Images/wallpaper.png');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    min-height: 100vh; 
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
    .search-bar {
        position: absolute; /* or fixed, depending on your preference */
        top: -200px; /* Adjusts the vertical position */
        
       
        width: 80%; /* Adjusts width if needed */
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
.signout-button {
    background-color: orange;
    color: white;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    margin-top: 10px;
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

.fore-container {
    display: grid;
    grid-template-columns: repeat(3, 1fr); /* Three items per row */
    gap: 20px; /* Space between items */
}

/* Individual items */
.fore {
    background-color: #f9f9f9;
    padding: 15px;
    text-align: center;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

.fore img {
    width: 100%;
    max-width: 200px;
    height: 300px; /* Ensure all images have the same height */
    object-fit: cover; /* Crops the image to fit within the given width and height */
    border-radius: 10px;
}

.fore h3 {
    font-size: 18px;
    margin: 10px 0;
}

.fore p {
    font-size: 16px;
    font-weight: bold;
}
.fore button {
    background-color: #ff6f00;
    color: #fff;
    border: none;
    padding: 10px 15px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s ease;
}

/* Change button color on hover */
.fore button:hover {
    background-color: #e65b00;
}
.gif-banner {
            width: 100%; /* Cover the full width */
            height: 200px; /* Set the height */
            object-fit: cover; /* Adjusts the image without stretching */
            margin-top: 3px;
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
.feedback-form {
    background-color: #f9f9f9; /* Light background */
    padding: 20px; /* Spacing around the form */
    border-radius: 8px; /* Rounded corners */
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); /* Subtle shadow */
    margin-bottom: 20px; /* Space below the section */
    max-width: 500px; /* Set a maximum width for the form */
    margin-left: auto; /* Center the form */
    margin-right: auto;
}

.feedback-form h4 {
    font-size: 1.5em; /* Larger heading font */
    margin-bottom: 15px; /* Space below the heading */
    color: #333; /* Darker color for the heading */
}

.feedback-form label {
    font-size: 1em; /* Normal size labels */
    color: #333; /* Dark label color */
    display: block; /* Block display for labels */
    margin-bottom: 5px; /* Space below each label */
}

.feedback-form input[type="text"],
.feedback-form input[type="email"],
.feedback-form textarea {
    width: 100%; /* Full-width inputs and textarea */
    padding: 10px; /* Spacing inside inputs */
    border: 1px solid #ccc; /* Border around inputs */
    border-radius: 4px; /* Rounded corners */
    margin-bottom: 15px; /* Space below inputs */
    font-size: 1em; /* Standard font size */
    box-sizing: border-box; /* Ensure padding is included in width */
}

.feedback-form textarea {
    resize: vertical; /* Allow vertical resizing only */
}

.feedback-form button[type="submit"] {
    background-color: #4CAF50; /* Green background */
    color: white; /* White text */
    padding: 10px 15px; /* Button padding */
    font-size: 1em; /* Standard font size */
    border: none; /* Remove borders */
    border-radius: 4px; /* Rounded corners */
    cursor: pointer; /* Pointer cursor on hover */
    transition: background-color 0.3s ease; /* Smooth hover effect */
}

.feedback-form button[type="submit"]:hover {
    background-color: #45a049; /* Darker green on hover */
}

.search-bar form {
    display: flex;
    justify-content: center; /* Center the form horizontally */
    margin-top: 30px; /* Add some space above */
}

.search-bar input[type="text"] {
    width: 300px; /* Set the width of the input */
    padding: 10px; /* Add padding inside the input */
    border: 2px solid #ccc; /* Border style */
    border-radius: 25px 0 0 25px; /* Rounded corners (left side) */
    font-size: 16px; /* Set the font size */
    outline: none; /* Remove the outline on focus */
    transition: border-color 0.3s ease; /* Smooth transition on focus */
}

input[type="text"]:focus {
    border-color: #ffa500; /* Change border color on focus (orange-like color) */
}

.search-bar button {
    padding: 10px 20px; /* Add padding inside the button */
    border: 2px solid #ffa500; /* Border color matching the input's focus state */
    border-left: none; /* Remove the left border */
    background-color: #ffa500; /* Button background color (orange-like) */
    color: white; /* Button text color */
    cursor: pointer; /* Change cursor to pointer on hover */
    border-radius: 0 25px 25px 0; /* Rounded corners (right side) */
    font-size: 16px; /* Set the font size */
    transition: background-color 0.3s ease; /* Smooth transition on hover */
}

.search-bar button:hover {
    background-color: #ff8c00; /* Darker orange on hover */
}
/* Add this CSS to your stylesheet */
.blink-animation {
    animation: blink 1s alternate ease-in-out 10;
}

@keyframes blink {
    from { color: #FF6347; } /* Highlight color */
    to { color: #FFFFFF; }   /* Original color */
}

/* Wishlist link animation style */
/* Wishlist button animation */
@keyframes wishlist-blink {
    0%, 100% { 
        background-color: #FF6347; /* original color */
        transform: scale(1); /* original size */
        color: #FFFFFF;
    }
    50% {
        background-color: #FFD700; /* highlighted color */
        transform: scale(1.2); /* increased size */
        color: #000000; /* text color change for contrast */
    }
}


/* Apply animation to wishlist link */
.wishlist-link.animated {
    animation: wishlist-blink 2s ease-in-out;
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
.search-bar form {
    display: flex;
    justify-content: center; /* Center the form horizontally */
    margin-top: 80px; /* Add some space above */
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
    <div class="search-bar">
    <form method="GET" action="">
        <input type="text" name="search" placeholder="Search fragrances...">
        <button type="submit">Search</button>
    </form>
</div>
    <div>
    
        <img src="Images/rd.gif" alt="Banner GIF" class="gif-banner">
        <?php
       $searchQuery = isset($_GET['search']) ? strtolower($_GET['search']) : '';
                // Array of drink items with name, description, and price
                $forever = array(
                  array(
                    "name" => "Combo-1", 
                    "image" => "Images/combo1.png", 
                    "description" => "Ragbha + Rouge 5", 
                    "price" => "850.00"
                ),
                  array(
                    "name" => "Combo-2", 
                    "image" => "Images/combo2.png", 
                    "description" => "Charuto + ROSE Seduction", 
                    "price" => "720.00"
                ),
                array(
                  "name" => "Combo-3", 
                  "image" => "Images/combo3.png", 
                  "description" => "Suave + Philos", 
                  "price" => "820.00"
              ),
                  array(
                    "name" => "Combo-4", 
                    "image" => "Images/combo4.png", 
                    "description" => "Barakkat + Ramz Lattafa", 
                    "price" => "820.00"
                ),
              );




              // Loop through each drink item and display it
              echo "<div class='fore-container'>"; // Start container for items
              foreach ($forever as $fore) {
                if ($searchQuery === '' || 
        strpos(strtolower($fore['name']), $searchQuery) !== false || 
        strpos(strtolower($fore['description']), $searchQuery) !== false) {
                  echo "<div class='fore'>";
                  echo "<a href='item.php?name=" . urlencode($fore['name']) . "'>";
                  echo "<img src='" . $fore['image'] . "' alt='" . $fore['name'] . "'>";
                  echo "<h3>" . $fore['name'] . "</h3>";
                  echo "</a>";
                  
                  // Check if price is available
                  if($fore['price'] != 'N/A') {
                      echo "<p><strong>Price: R</strong> " . $fore['price'] . "</p>";
                  } else {
                      echo "<p><strong>Price:</strong> N/A</p>";
                  }
                }
                  echo "<form action='' method='post'>";
                  echo "<input type='hidden' name='item_name' value='" . $fore['name'] . "'>";
                  echo "<input type='hidden' name='item_price' value='" . $fore['price'] . "'>";
                  echo "<input type='hidden' name='item_image' value='". $fore['image'] ."'>";
                  echo "</form>";
                  echo "</div>"; // Close individual item
              }
              echo "</div>";
              ?>
    </div>
        <h2>Fragrances</h2>
        <div class="col2">
        
        <div class="card">
        <div class="catalog">
            <?php
             $searchQuery = isset($_GET['search']) ? strtolower($_GET['search']) : '';
                // Array of drink items with name, description, and price
                $forever = array(
                  array(
                    "name" => "Raghba", 
                    "image" => "Images/raghba.jpg", 
                    "description" => "Raghba by Lattafa is a sweet and spicy fragrance that combines vanilla, oud, and incense to create a luxurious and exotic scent. It's ideal for those who love a deep, long-lasting fragrance.", 
                    "price" => "499.00"
                ),
                    array(
                      "name" => "Yara", 
                      "image" => "Images/yaraLattafa.jpg", 
                      "description" => "Yara by Lattafa is a captivating fragrance that blends fruity and floral notes to create a harmonious and enchanting scent. It's perfect for those who appreciate a soft, feminine aroma that leaves a lasting impression.", 
                      "price" => "580.00"
                  ),
                  array(
                    "name" => "Mousuf", 
                    "image" => "Images/mousuf.jpg", 
                    "description" => "Mousuf is a warm and inviting fragrance with rich woody notes, perfect for those who seek a scent that exudes sophistication and elegance. It's a versatile perfume that can be worn on any occasion.", 
                    "price" => "380.00"
                ),
               
              array(
                "name" => "Hayati", 
                "image" => "Images/haayti2.jpg", 
                "description" => "Hayati is a delightful blend of fruity and floral notes, creating a fresh and invigorating fragrance. This scent is perfect for daily wear, offering a vibrant and uplifting aroma.", 
                "price" => "499.00"
            ),
            array(
              "name" => "Oud Al Layl", 
              "image" => "Images/oudallayl.png", 
              "description" => "Oud Al Layl is a rich and intense oud fragrance, featuring deep, woody notes combined with subtle hints of spice. This perfume is perfect for those who appreciate a strong and bold scent.", 
              "price" => "480.00"
          ),
          array(
            "name" => "Asad", 
            "image" => "Images/asadlattafa.jpg", 
            "description" => "Asad is a powerful fragrance with a unique blend of warm spices and woody notes, creating a masculine and commanding scent. It's ideal for evening wear or special occasions.", 
            "price" => "549.00"
        ),
        array(
              "name" => "Ramz Gold & Silver", 
              "image" => "Images/ramzLattafa.jpg", 
              "description" => "Ramz Gold & Silver is a luxurious fragrance that exudes elegance and charm. With its blend of floral and oriental notes, this perfume is perfect for those who appreciate sophistication and refinement.", 
              "price" => "500.00"
          ),
          array(
            "name" => "Heiba", 
            "image" => "Images/heibah.jpg", 
            "description" => "Heiba is a rich and elegant fragrance with a blend of woody and spicy notes. It's perfect for those who enjoy a sophisticated and long-lasting scent.", 
            "price" => "549.00"
        ),
        array(
          "name" => "Suave", 
          "image" => "Images/suave.jpg", 
          "description" => "Suave is a refined fragrance that combines fresh and aromatic notes, creating a clean and sophisticated scent. It's ideal for everyday wear, offering a subtle yet captivating aroma.", 
          "price" => "399.00"
      ),
      array(
        "name" => "Zara", 
        "image" => "Images/zaraman.jpg", 
        "description" => "Zara is a fresh and vibrant fragrance with a blend of citrus and floral notes. It's perfect for those who enjoy a light and refreshing scent that can be worn daily.", 
        "price" => "399.00"
    ),
    array(
      "name" => "Oud Imperious", 
      "image" => "Images/imperious.jpg", 
      "description" => "Oud Imperious is a sophisticated fragrance with a rich blend of oud and woody notes, enhanced by subtle hints of spice. This scent is perfect for those who seek a bold and distinctive aroma.", 
      "price" => "480.00"
  ),
  array(
    "name" => "Berries Weekend", 
    "image" => "Images/bw.png", 
    "description" => "Berries Weekend is a fruity and playful fragrance with a blend of sweet berries and floral notes. It's ideal for a casual outing or a weekend adventure, offering a fun and refreshing scent.", 
    "price" => "380.00"
),
array(
  "name" => "Killer Oud", 
  "image" => "Images/killeroudME.jpg", 
  "description" => "Killer Oud is a deep and intense fragrance with a powerful blend of oud and smoky notes. This perfume is perfect for those who want to make a bold statement with their scent.", 
  "price" => "680.00"
),
array(
  "name" => "Barakat", 
  "image" => "Images/Barakkat.jpg", 
  "description" => "Barakat is a luxurious fragrance with a rich blend of oud and oriental spices. It's ideal for those who appreciate a deep and exotic scent that lasts throughout the day.", 
  "price" => "380.00"
),
array(
  "name" => "Badee Al'oud", 
  "image" => "Images/Badeealoud.jpg", 
  "description" => "Badee Al'oud is a captivating fragrance with a blend of oud and floral notes, creating a balanced and sophisticated scent. This perfume is perfect for special occasions and evening wear.", 
  "price" => "680.00"
),
array(
  "name" => "Intense Men", 
  "image" => "Images/intenseman.jpg", 
  "description" => "Intense Men is a bold and masculine fragrance with a powerful blend of woody and spicy notes. It's perfect for those who want a strong and long-lasting scent.", 
  "price" => "399.00"
),
array(
  "name" => "Pura", 
  "image" => "Images/pura.png", 
  "description" => "Pura is a fresh and invigorating fragrance with a blend of citrus and aquatic notes. It's ideal for those who enjoy a light and refreshing scent that can be worn daily.", 
  "price" => "480.00"
),
array(
              "name" => "Charutcho", 
              "image" => "Images/charuto.jpg", 
              "description" => "Charutcho is a sophisticated fragrance with a rich blend of tobacco and woody notes. It's perfect for those who enjoy a bold and distinctive scent that exudes confidence.", 
              "price" => "399.00"
          ),
          array(
            "name" => "Rose Seduction", 
            "image" => "Images/roseseduction.jpg", 
            "description" => "Rose Seduction is a romantic and alluring fragrance with a blend of rose and floral notes. It's ideal for those who appreciate a soft and feminine scent that leaves a lasting impression.", 
            "price" => "380.00"
        ),
        array(
          "name" => "Rouge", 
          "image" => "Images/rouge5.jpg", 
          "description" => "Rouge is a luxurious fragrance with a rich blend of warm spices and floral notes, creating a sophisticated and captivating scent. It's perfect for special occasions or evening wear.", 
          "price" => "449.00"
      ),
      array(
        "name" => "Lush Cherry", 
        "image" => "Images/lushcherry.jpg", 
        "description" => "Lush Cherry is a delightful and playful fragrance with a sweet blend of cherry and floral notes. It's ideal for those who enjoy a fun and fruity scent that can be worn daily.", 
        "price" => "450.00"
    ),
    array(
      "name" => "Raghba Wood Intense", 
      "image" => "Images/raghba2.jpg", 
      "description" => "Raghba Wood Intense is a deep and intense fragrance with a powerful blend of oud and smoky notes. It's perfect for those who want to make a bold statement with their scent.", 
      "price" => "480.00"
  ),
  array(
    "name" => "Bavaria", 
    "image" => "Images/bavariathegemstone.jpg", 
    "description" => "Bavaria is a luxurious fragrance with a rich blend of oud and oriental spices. It's ideal for those who appreciate a deep and exotic scent that lasts throughout the day.", 
    "price" => "500.00"
  ),
  array(
    "name" => "Hayati", 
    "image" => "Images/hayaati.jpg", 
    "description" => "Hayati is a delightful blend of fruity and floral notes, creating a fresh and invigorating fragrance. This scent is perfect for daily wear, offering a vibrant and uplifting aroma.", 
    "price" => "499.00"
),
array(
  "name" => "Asad", 
  "image" => "Images/asadlattafa.jpg", 
  "description" => "Asad is a powerful fragrance with a unique blend of warm spices and woody notes, creating a masculine and commanding scent. It's ideal for evening wear or special occasions.", 
  "price" => "549.00"
)
);




                // Loop through each drink item and display it
                echo "<div class='fore-container'>"; // Start container for items
                foreach ($forever as $fore) {
                  if ($searchQuery === '' || 
                  strpos(strtolower($fore['name']), $searchQuery) !== false || 
                  strpos(strtolower($fore['description']), $searchQuery) !== false) {
                    echo "<div class='fore'>";
                    echo "<a href='item.php?name=" . urlencode($fore['name']) . "'>";
                    echo "<img src='" . $fore['image'] . "' alt='" . $fore['name'] . "'>";
                    echo "<h3>" . $fore['name'] . "</h3>";
                    echo "</a>";
                    
                    // Check if price is available
                    if($fore['price'] != 'N/A') {
                        echo "<p><strong>Price: R</strong> " . $fore['price'] . "</p>";
                    } else {
                        echo "<p><strong>Price:</strong> N/A</p>";
                    }
                
                    echo "<form action='' method='post'>";
                    echo "<input type='hidden' name='item_name' value='" . $fore['name'] . "'>";
                    echo "<input type='hidden' name='item_price' value='" . $fore['price'] . "'>";
                    echo "<input type='hidden' name='item_image' value='". $fore['image'] ."'>";
                    echo "<button type='submit' name='add_to_wishlist' onclick='triggerBlink()'>Add to Wishlist</button>";
                    echo "</form>";

                    echo "</div>"; // Close individual item
                }
              }
                echo "</div>";
                ?>
                
        </div>
        
        </div>
        </div>
        <div id="wishlistPopup" class="popup">
    
</div>
        <div id="wishlist-button" style="position: fixed; bottom: 20px; right: 20px;">
    <a href="wishlist.php" class="wishlist-link">Wishlist <img src="Images/wishlist.png" alt="Wishlist Icon" style="width: 20px; height: 20px; vertical-align: middle; margin-right: 5px;"></a>
</div>
    </main>

    <footer>
    <div class="footer-container">
        <!-- Payment methods section -->
        <div class="payment-methods">
            <h4>Payment Methods</h4>
            <img src="Images/visa.png" alt="Visa">
            <img src="Images/mastercard.png" alt="MasterCard">
            <img src="Images/paypal.png" alt="PayPal">
        </div>

        <!-- Feedback/Enquiries Form -->
        <div class="feedback-form">
            <h4>Feedback / Enquiries</h4>
            <form action="submit_feedback.php" method="post">
                <label for="name">Your Name:</label>
                <input type="text" id="name" name="name" required>
                
                <label for="email">Your Email:</label>
                <input type="email" id="email" name="email" required>
                
                <label for="message">Your Message:</label>
                <textarea id="message" name="message" rows="4" required></textarea>
                
                <button type="submit">Submit</button>
            </form>
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
<script>
  // Add this JavaScript to your script file or within a <script> tag
  window.addEventListener("load", function() {
        <?php if (isset($_SESSION['wishlist_added'])): ?>
            const wishlistLink = document.querySelector(".wishlist-link");
            wishlistLink.classList.add("blink-animation");
            setTimeout(() => wishlistLink.classList.remove("blink-animation"), 4000);

            <?php unset($_SESSION['wishlist_added']); // Clear the session flag ?>
        <?php endif; ?>
    });
    window.addEventListener('DOMContentLoaded', (event) => {
    const wishlistLink = document.querySelector('.wishlist-link');

    <?php if (isset($_SESSION['wishlist_added']) && $_SESSION['wishlist_added']): ?>
        wishlistLink.classList.add('animated'); // Trigger the animation

        <?php unset($_SESSION['wishlist_added']); ?> // Clear session flag

        // Remove the animated class after 2 seconds to reset the button
        setTimeout(() => {
            wishlistLink.classList.remove('animated');
        }, 7000);
    <?php endif; ?>
});




</script>

</body>
</html>
<?php
 if(isset ($_POST["logout"])){
    // Reset cart and cart count
    unset($_SESSION['cart']);
    unset($_SESSION['cart_count']);
    unset($_SESSION['wishlist']);
    
    // Destroy the current session
    session_destroy();
    
    // Start a new session
    session_start();

    // Redirect to the login page
    header("Location: index.php");
    exit(); // Terminate script execution after redirection
    
}
?>

