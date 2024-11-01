<?php
    // Start the session
    session_start();

    
    // Function to add item to cart
    function addToCart($item) {
        $item['price'] = floatval(str_replace('R', '', $item['price'])); // Remove 'R' and convert to float
        $item['quantity'] = 1; // Set the initial quantity to 1
        $_SESSION['cart'][] = $item;
        // Increment cart count
        $_SESSION['cart_count'] = isset($_SESSION['cart_count']) ? intval($_SESSION['cart_count']) + 1 : 1;
    }

    // Check if the Add to Cart button is clicked
    if(isset($_POST['add_to_cart'])) {
        // Get item details from POST data
        $itemName = $_POST['item_name'];
        $itemPrice = $_POST['item_price'];
        $itemImage =$_POST['item_image'];
        

        // Add item to cart
        addToCart(array("name" => $itemName, "price" => $itemPrice ,"image" => $itemImage));
    }
 // Handle add to wishlist action
if (isset($_POST['add_to_wishlist'])) {
    $wishlistItem = [
        'name' => $_POST['item_name'],
        'price' => $_POST['item_price'],
        'image' => $_POST['item_image'],
    ];

    // If the wishlist array doesn't exist, create it
    if (!isset($_SESSION['wishlist'])) {
        $_SESSION['wishlist'] = [];
    }

    // Add the item to the wishlist
    $_SESSION['wishlist'][] = $wishlistItem;

    echo "Item added to wishlist: " . $wishlistItem['name'];
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
    background-color: #ff0000; /* Red background color */
    color: #fff; /* White text color */
    padding: 10px 20px; /* Padding around the button text */
    border: none; /* No border */
    border-radius: 5px; /* Rounded corners */
    cursor: pointer; /* Change cursor to pointer on hover */
    font-size: 16px; /* Font size */
    transition: background-color 0.3s ease; /* Smooth transition for background color */
}

/* Hover effect for the Signout button */
.signout-button:hover {
    background-color: #cc0000; /* Darker red background color on hover */
}
/* Container for the item details */
.item-details {
    background: linear-gradient(180deg, rgba(255, 255, 255, 1) 0%, rgba(255, 255, 255, 0.8) 50%, rgba(255, 255, 255, 0) 100%);
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    width: 300px;
    margin: 20px auto;
    text-align: center;
    transition: background 0.3s ease-in-out;
}

/* Image styling */
.item-details img {
    width: 100%;
    height: auto;
    border-radius: 8px;
    margin-bottom: 15px;
}

/* Heading styling */
.item-details h3 {
    font-size: 22px;
    margin-bottom: 10px;
}

/* Price styling */
.item-details p {
    font-size: 18px;
    margin-bottom: 15px;
}

/* Button styling */
.item-details button {
    background-color: #ff6f00;
    color: white;
    border: none;
    padding: 10px 15px;
    margin-top: 10px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s ease;
    width: 100%;
}

/* Button hover effect */
.item-details button:hover {
    background-color: #e65b00;
}

/* Fading white background on hover */
.item-details:hover {
    background: linear-gradient(180deg, rgba(255, 255, 255, 0.9) 0%, rgba(255, 255, 255, 0.6) 50%, rgba(255, 255, 255, 0) 100%);
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



/* Responsive adjustments for smaller screens */
@media (max-width: 600px) {
    .item-details {
        flex-direction: column; /* Stack image and content vertically */
        align-items: center;
        margin-top: 200px;
    }

    .item-content {
        flex-direction: column;
        margin-right: 0; /* Remove side margin */
        align-items: center; /* Center content */
    }

    .item-image {
        margin-bottom: 20px; /* Add spacing between image and content */
        margin-right: 0;
    }

    .item-details img {
        max-width: 300px; /* Adjust image size for smaller screens */
        max-height: 300px;
    }

    .item-details p {
        width: 90%; /* Reduce text width to fit smaller screen */
        font-size: 13px; /* Adjust font size */
    }
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
    <?php
// Check if the item name is provided in the query parameters
if(isset($_GET['name'])) {
    // Get the item name from the query parameter
    $itemName = $_GET['name'];

    // Lookup the item details based on the name (you can fetch details from your database here)
    $itemDetails = getItemDetails($itemName); // Implement this function to retrieve item details

    // Display the item details
    ?>
    <div class="item-details">
        <img src="<?php echo $itemDetails['image']; ?>" alt="<?php echo $itemDetails['name']; ?>">
        <h3><?php echo $itemDetails['name']; ?></h3>
        <p><strong>Price: R</strong><?php echo $itemDetails['price']; ?></p>
        <form action="" method="post">
            <input type="hidden" name="item_name" value="<?php echo $itemDetails['name']; ?>">
            <input type="hidden" name="item_price" value="<?php echo $itemDetails['price']; ?>">
            <input type="hidden" name="item_image" value="<?php echo $itemDetails['image']; ?>">
            <button type="submit" name="add_to_cart" class="signout-button">Add To Cart</button>
        </form>

        <!-- Add to Wishlist form -->
        <form action="" method="post" onsubmit="return addToWishlist(this);">
            <input type="hidden" name="item_name" value="<?php echo $itemDetails['name']; ?>">
            <input type="hidden" name="item_price" value="<?php echo $itemDetails['price']; ?>">
            <input type="hidden" name="item_image" value="<?php echo $itemDetails['image']; ?>">
            <input type="hidden" name="item_id" value="<?php echo $item['id']; ?>">
            <button type="submit" name="add_to_wishlist" class="signout-button" >Add To Wishlist</button>
        </form>
       

        <p><strong>Description:</strong> <?php echo $itemDetails['description']; ?></p>
    </div>
    <?php
} else {
    // Redirect if item name is not provided
    header("Location: catalog.php");
    exit(); // Terminate script execution after redirection
}

// Function to retrieve item details (you can replace this with database query)
function getItemDetails($itemName)  {
        // Sample data - replace with actual database query
        $items = array(
            "C9 - Vanilla Ultra Shake" => array("name" => "C9 - Vanilla Ultra Shake", "image" => "Images/milk.png", "description" => "Change your diet and lifestyle with naturally flavoured, plant-powered protein. Forever Lite Ultra includes essential vitamins and minerals and is available in two flavours. This versatile product can be used to control your calorie consumption or as a filling protein drink to help you gain weight. N.B. Contains soy.", "price" => "2500.00"),
            "Forever ARGI+ (Stick Pack)"=> array("name" => "Forever ARGI+ (Stick Pack)","image" => "Images/6pack.png",  "description" => "Forever's ARGI+® is a stick pack with a powerful amino acid, L-Arginine, which aids in the production of nitric oxide, a key molecule in cardiovascular health. It supports optimal circulation and blood vessel health, cell division, and immune function. The pack also contains key nutrients like Vitamin D, B vitamins, grape skin, and pomegranate for antioxidant properties. It can be mixed with water or beverages, and pairs well with Forever Aloe Berry Nectar or Forever Aloe Vera Gel.", "price" => "1500.00"),
            "Forever Arctic Sea"=>array("name" => "Forever Arctic Sea","image" => "Images/sea.png",  "description" => "You can get an omega-3 supplement that is precisely balanced with Forever Arctic Sea® thanks to its unique oil blend. Anticipate that fish, calamari, and extra-virgin olive oil can boost your body's vitality in places like the digestive, immunological, brain, and ocular departments.", "price" => "650.00"),
            "Forever Multi-Maca"=>array("name" => "Forever Multi-Maca","image" => "Images/Forever Multi-Maca.png",  "description" => "With its unique combination of Maca and other natural components, Forever Multi-Maca® is made for both sexes and may help to induce a calm, happy mood as well as increase sexual desire.", "price" => "500.00"),
            "C9 - Chocolate Ultra Shake"=>array("name" => "C9 - Chocolate Ultra Shake","image" => "Images/C9 - Chocolate Ultra Shake.png",  "description" => "Plant-powered, naturally-flavored protein will transform your diet and way of life. Forever Lite Ultra comes in two tastes and is packed with essential vitamins and minerals. This adaptable product can be used as a satisfying protein drink to help you gain weight, or it can be used as a calorie counter. Note: contains soy.", "price" => "2500.00"),
            "Forever Fields Of Green"=>array("name" => "Forever Fields Of Green","image" => "Images/Forever Fields Of Green.png",  "description" => "Forever Fields of Greens® provides nutrients from barley grass, wheat grass, alfalfa and other vital greens! Not only is this supplement a convenient supply of green nourishment, but it also contains important phytonutrients and antioxidants.", "price" => "300.00"),
            "Najdia Eau de Parfum"=>array("name" => "Najdia Eau de Parfum", "image" => "Images/perfum.png", "description" => "Najdia Eau de Parfum is a captivating fragrance that exudes elegance and charm. With its sophisticated blend of floral and oriental notes, this perfume evokes a sense of timeless beauty and allure. The delicate floral bouquet is complemented by hints of exotic spices, creating a harmonious scent that is both alluring and unforgettable. Perfect for those who appreciate sophistication and refinement, Najdia Eau de Parfum is a versatile fragrance that can be worn for any occasion, leaving a lasting impression wherever you go.", "price" => "250.00"),
            "Musk Mood Perfume Spray 100ml Eau De Parfum High End"=>array("name" => "Musk Mood Perfume Spray 100ml Eau De Parfum High End","image" => "Images/perfum2.png",  "description" => "Musk Mood Perfume Spray is an embodiment of luxury and allure, presented in a generous 100ml Eau De Parfum bottle. This high-end fragrance captivates the senses with its exquisite blend of musky and floral notes, creating a scent that is both sensual and sophisticated. With each spritz, Musk Mood envelops you in a delicate veil of elegance, leaving a lingering trail of allure wherever you go. Perfect for those who appreciate the finer things in life, this perfume is a statement of refinement and sophistication, ideal for any occasion.", "price" => "250.00"),
            "Ameer Al Oud - Intense Oud"=>array("name" => "Ameer Al Oud - Intense Oud","image" => "Images/Ameer Al Oud - Intense Oud.png",  "description" => "Ameer Al Oud - Intense Oud is a captivating fragrance that exudes richness and sophistication. Encased in a sleek bottle, this perfume offers an intense olfactory experience with its blend of deep, woody oud and aromatic spices. With every spritz, Ameer Al Oud envelops you in a warm and luxurious aura, leaving a lasting impression of elegance and refinement. Perfect for those who seek a bold and distinctive scent, Ameer Al Oud - Intense Oud is the epitome of sophistication and allure.", "price" => "250.00"),
            "Sheikh Al Shuyukh Luxe"=>array("name" => "Sheikh Al Shuyukh Luxe","image" => "Images/Sheikh Al Shuyukh Luxe.png",  "description" => "Sheikh Al Shuyukh Luxe is a fragrance that epitomizes luxury and prestige. Encapsulated in a regal bottle, this perfume exudes an air of opulence and refinement. Its rich blend of exotic ingredients, including oud, spices, and floral notes, creates a scent that is both captivating and enduring. With each spray, Sheikh Al Shuyukh Luxe envelops the senses in a lavish embrace, leaving a trail of sophistication and elegance. Perfect for those who appreciate the finer things in life, this fragrance is a true statement of prestige and distinction.", "price" => "250.00"),
            "Hayaati Silver Fragrance for Men & Women 100ml Eau De Parfum"=>array("name" => "Hayaati Silver Fragrance for Men & Women 100ml Eau De Parfum","image" => "Images/Hayaati Silver Fragrance for Men & Women 100ml Eau De Parfum.png",  "description" => "Hayaati by Lattafa Perfumes is a unisex woody cologne that elevates traditional smell elements such as bergamot, cinnamon, and vanilla. This fragrance debuted in 2020.", "price" => "250.00"),
            "Oud Mood Reminiscence"=>array("name" => "Oud Mood Reminiscence","image" => "Images/Oud Mood Reminiscence.png",  "description" => "Top Notes: Saffron and Raspberry Heart Notes: Geraniums, Cardamom. Base notes: agarwood, sandalwood, musk, cedar, vetiver, cardamom What's in the box? 1x Oud mood silver perfume 100ml", "price" => "250.00"),
            "Dirham By Ard Al Zafran 100ml Eau De Parfum 100ml Unisex Perfume"=>array("name" => "Dirham By Ard Al Zafran 100ml Eau De Parfum 100ml Unisex Perfume","image" => "Images/Dirham By Ard Al Zafran 100ml Eau De Parfum 100ml Unisex Perfume.png",  "description" => "Dirham by Ard Al Zafran is a captivating unisex perfume that exudes elegance and allure in every spritz. With its 100ml Eau De Parfum formulation, it offers a long-lasting and intense fragrance experience. This enchanting scent blends notes of warm amber, sweet vanilla, and exotic spices, creating a rich and luxurious olfactory journey. Perfect for those who appreciate sophistication and refinement, Dirham is a fragrance that leaves a lasting impression, making it a versatile choice for any occasion.", "price" => "250.00"),
            "Dar Al Hae Oud Perfume 100ml - Eau De Parfum"=>array("name" => "Dar Al Hae Oud Perfume 100ml - Eau De Parfum","image" => "Images/Dar Al Hae Oud Perfume 100ml - Eau De Parfum.png",  "description" => "Dar Al Hae Oud Perfume, presented in a generous 100ml Eau De Parfum bottle, is a luxurious fragrance that embodies opulence and sophistication. With its captivating blend of oud, a prized ingredient known for its deep and woody aroma, this perfume evokes a sense of mystery and allure. Enhanced by hints of floral and spicy notes, Dar Al Hae Oud Perfume creates a harmonious symphony of scents that linger delicately on the skin, leaving a lasting impression wherever you go. Perfect for those who appreciate the finer things in life, this exquisite fragrance is sure to turn heads and leave a trail of elegance in its wake.", "price" => "250.00"),
            "Oud Mood Elixir Eau de Parfum 100ml Perfume"=>array("name" => "Oud Mood Elixir Eau de Parfum 100ml Perfume","image" => "Images/Oud Mood Elixir Eau de Parfum 100ml Perfume.png",  "description" => "Oud Mood Elixir Eau de Parfum is an enchanting fragrance presented in a 100ml bottle, exuding sophistication and allure. This perfume is a harmonious blend of rich oud, warm spices, and floral accords, creating a captivating olfactory experience. With each spray, Oud Mood Elixir envelops the senses in a luxurious veil of scent, leaving a lasting impression of elegance and refinement. Perfect for those who seek a distinctive and memorable fragrance, Oud Mood Elixir is a true indulgence for the senses, suitable for any occasion where you want to leave a lasting impression.", "price" => "250.00"),
            "Deceive Self 100 Perfume For Her Eau De Parfum For Women Natural Spray"=>array("name" => "Deceive Self 100 Perfume For Her Eau De Parfum For Women Natural Spray","image" => "Images/Deceive Self 100 Perfume For Her Eau De Parfum For Women Natural Spray.png",  "description" => "Deceive Self 100 Perfume For Her is a captivating fragrance crafted specifically for women, presented in a luxurious Eau De Parfum formulation. This perfume offers a unique blend of floral and fruity notes, creating a scent that is both alluring and empowering. With its natural spray application, Deceive Self 100 envelops the senses in a delicate veil of sophistication, leaving a lasting impression wherever you go. Perfect for those who embrace their femininity with confidence, this fragrance is an expression of self-assurance and individuality, making it a perfect choice for any occasion.", "price" => "100.00"),
            "Yara" => array(
              "name" => "Yara", 
              "image" => "Images/yaraLattafa.jpg", 
              "description" => "Yara by Lattafa is a captivating fragrance that blends fruity and floral notes to create a harmonious and enchanting scent. It's perfect for those who appreciate a soft, feminine aroma that leaves a lasting impression.", 
              "price" => "580.00"
          ),
          "Mousuf" => array(
              "name" => "Mousuf", 
              "image" => "Images/mousuf.jpg", 
              "description" => "Mousuf is a warm and inviting fragrance with rich woody notes, perfect for those who seek a scent that exudes sophistication and elegance. It's a versatile perfume that can be worn on any occasion.", 
              "price" => "380.00"
          ),
          "Raghba" => array(
              "name" => "Raghba", 
              "image" => "Images/raghba.jpg", 
              "description" => "Raghba by Lattafa is a sweet and spicy fragrance that combines vanilla, oud, and incense to create a luxurious and exotic scent. It's ideal for those who love a deep, long-lasting fragrance.", 
              "price" => "499.00"
          ),
          "Hayati" => array(
              "name" => "Hayati", 
              "image" => "Images/haayti2.jpg", 
              "description" => "Hayati is a delightful blend of fruity and floral notes, creating a fresh and invigorating fragrance. This scent is perfect for daily wear, offering a vibrant and uplifting aroma.", 
              "price" => "499.00"
          ),
          "Oud Al Layl" => array(
              "name" => "Oud Al Layl", 
              "image" => "Images/oudallayl.png", 
              "description" => "Oud Al Layl is a rich and intense oud fragrance, featuring deep, woody notes combined with subtle hints of spice. This perfume is perfect for those who appreciate a strong and bold scent.", 
              "price" => "480.00"
          ),
          "Asad" => array(
              "name" => "Asad", 
              "image" => "Images/asadlattafa.jpg", 
              "description" => "Asad is a powerful fragrance with a unique blend of warm spices and woody notes, creating a masculine and commanding scent. It's ideal for evening wear or special occasions.", 
              "price" => "549.00"
          ),
          "Ramz Gold & Silver" => array(
              "name" => "Ramz Gold & Silver", 
              "image" => "Images/ramzLattafa.jpg", 
              "description" => "Ramz Gold & Silver is a luxurious fragrance that exudes elegance and charm. With its blend of floral and oriental notes, this perfume is perfect for those who appreciate sophistication and refinement.", 
              "price" => "500.00"
          ),
          "Heiba" => array(
              "name" => "Heiba", 
              "image" => "Images/heibah.jpg", 
              "description" => "Heiba is a rich and elegant fragrance with a blend of woody and spicy notes. It's perfect for those who enjoy a sophisticated and long-lasting scent.", 
              "price" => "549.00"
          ),
          "Suave" => array(
              "name" => "Suave", 
              "image" => "Images/suave.jpg", 
              "description" => "Suave is a refined fragrance that combines fresh and aromatic notes, creating a clean and sophisticated scent. It's ideal for everyday wear, offering a subtle yet captivating aroma.", 
              "price" => "399.00"
          ),
          "Zara" => array(
              "name" => "Zara", 
              "image" => "Images/zaraman.jpg", 
              "description" => "Zara is a fresh and vibrant fragrance with a blend of citrus and floral notes. It's perfect for those who enjoy a light and refreshing scent that can be worn daily.", 
              "price" => "399.00"
          ),
          "Oud Imperious" => array(
              "name" => "Oud Imperious", 
              "image" => "Images/imperious.jpg", 
              "description" => "Oud Imperious is a sophisticated fragrance with a rich blend of oud and woody notes, enhanced by subtle hints of spice. This scent is perfect for those who seek a bold and distinctive aroma.", 
              "price" => "480.00"
          ),
          "Berries Weekend" => array(
              "name" => "Berries Weekend", 
              "image" => "Images/bw.png", 
              "description" => "Berries Weekend is a fruity and playful fragrance with a blend of sweet berries and floral notes. It's ideal for a casual outing or a weekend adventure, offering a fun and refreshing scent.", 
              "price" => "380.00"
          ),
          "Killer Oud" => array(
              "name" => "Killer Oud", 
              "image" => "Images/killeroudME.jpg", 
              "description" => "Killer Oud is a deep and intense fragrance with a powerful blend of oud and smoky notes. This perfume is perfect for those who want to make a bold statement with their scent.", 
              "price" => "680.00"
          ),
          "Barakat" => array(
              "name" => "Barakat", 
              "image" => "Images/Barakkat.jpg", 
              "description" => "Barakat is a luxurious fragrance with a rich blend of oud and oriental spices. It's ideal for those who appreciate a deep and exotic scent that lasts throughout the day.", 
              "price" => "380.00"
          ),
          "Badee Al'oud" => array(
              "name" => "Badee Al'oud", 
              "image" => "Images/Badeealoud.jpg", 
              "description" => "Badee Al'oud is a captivating fragrance with a blend of oud and floral notes, creating a balanced and sophisticated scent. This perfume is perfect for special occasions and evening wear.", 
              "price" => "680.00"
          ),
          "Intense Men" => array(
              "name" => "Intense Men", 
              "image" => "Images/intenseman.jpg", 
              "description" => "Intense Men is a bold and masculine fragrance with a powerful blend of woody and spicy notes. It's perfect for those who want a strong and long-lasting scent.", 
              "price" => "399.00"
          ),
          "Pura" => array(
              "name" => "Pura", 
              "image" => "Images/pura.png", 
              "description" => "Pura is a fresh and invigorating fragrance with a blend of citrus and aquatic notes. It's ideal for those who enjoy a light and refreshing scent that can be worn daily.", 
              "price" => "480.00"
          ),
          "Charutcho" => array(
              "name" => "Charutcho", 
              "image" => "Images/charuto.jpg", 
              "description" => "Charutcho is a sophisticated fragrance with a rich blend of tobacco and woody notes. It's perfect for those who enjoy a bold and distinctive scent that exudes confidence.", 
              "price" => "399.00"
          ),
          "Rose Seduction" => array(
              "name" => "Rose Seduction", 
              "image" => "Images/roseseduction.jpg", 
              "description" => "Rose Seduction is a romantic and alluring fragrance with a blend of rose and floral notes. It's ideal for those who appreciate a soft and feminine scent that leaves a lasting impression.", 
              "price" => "380.00"
          ),
          "Rouge" => array(
              "name" => "Rouge", 
              "image" => "Images/rouge5.jpg", 
              "description" => "Rouge is a luxurious fragrance with a rich blend of warm spices and floral notes, creating a sophisticated and captivating scent. It's perfect for special occasions or evening wear.", 
              "price" => "449.00"
          ),
          "Lush Cherry" => array(
              "name" => "Lush Cherry", 
              "image" => "Images/lushcherry.jpg", 
              "description" => "Lush Cherry is a delightful and playful fragrance with a sweet blend of cherry and floral notes. It's ideal for those who enjoy a fun and fruity scent that can be worn daily.", 
              "price" => "450.00"
          ),
          "Raghba Wood Intense" => array(
              "name" => "Raghba Wood Intense", 
              "image" => "Images/raghba2.jpg", 
              "description" => "Raghba Wood Intense is a deep and intense fragrance with a powerful blend of oud and smoky notes. It's perfect for those who want to make a bold statement with their scent.", 
              "price" => "480.00"
          ),
          "Bavaria" => array(
              "name" => "Bavaria", 
              "image" => "Images/bavariathegemstone.jpg", 
              "description" => "Bavaria is a luxurious fragrance with a rich blend of oud and oriental spices. It's ideal for those who appreciate a deep and exotic scent that lasts throughout the day.", 
              "price" => "500.00"
          ),
          "Combo-1" => array(
              "name" => "Ragbha + Rouge 5", 
              "image" => "Images/combo1.png", 
              "description" => "Ragbha + Rouge 5", 
              "price" => "850.00"
          ),
          "Combo-2" => array(
              "name" => "Charuto + ROSE Seduction", 
              "image" => "Images/combo2.png", 
              "description" => "Charuto + ROSE Seduction", 
              "price" => "720.00"
          ),
          "Combo-3" => array(
              "name" => "Suave + Philos", 
              "image" => "Images/combo3.png", 
              "description" => "Suave + Philos", 
              "price" => "820.00"
          ),
          "Combo-4" => array(
              "name" => "Barakkat + Ramz Lattafa", 
              "image" => "Images/combo4.png", 
              "description" => "Barakkat + Ramz Lattafa", 
              "price" => "820.00"
          ),
          



            // Add details for other items
        );

        // Return item details based on the name
        return isset($items[$itemName]) ? $items[$itemName] : null;
    }
?>
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

        <!-- Contact and Social Media section -->
        <div class="contact-info">
            <h4>Contact Us</h4>
            <p>Address: 123 Birdwatch Lane, Nature Town</p>
            <p>Phone: +27 123 456 789</p>

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
if(isset($_POST["logout"])){
    // Reset cart and cart count
    unset($_SESSION['cart']);
    unset($_SESSION['cart_count']);

    // Destroy the current session
    session_destroy();

    // Start a new session
    session_start();

    // Redirect to the login page
    header("Location: index.php");
    exit(); // Terminate script execution after redirection
}

?>

