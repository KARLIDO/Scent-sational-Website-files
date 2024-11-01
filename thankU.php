<!DOCTYPE html>  
<html lang="en">  
<head>  
   <meta charset="UTF-8">  
   <title>Payment</title>  
   <link rel="shortcut icon" type="image/x-icon" href="Images/logo2.png" />
   <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
      integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
      crossorigin="anonymous"
    />
   <style> 
/* Body and Main Section */
body {
    font-family: 'Roboto', sans-serif;
    background-image: url('Images/wallpaper.png');
    background-size: cover;
    background-position: center;
    margin: 0;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    padding-top: 0px;
}

main {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
    flex-direction: column;
}

header {
    background-color: #ffffff;
    box-shadow: 0 2px 4px rgba(0,0,0,.1);
    padding: 10px 0;
}

nav {
    display: flex;
    justify-content: center;
    align-items: center;
}

.primary-nav {
    list-style-type: none;
    margin: 0;
    padding: 0;
}

header img {
    max-width: 200px;
    max-height: 60px;
    transition: transform 0.3s ease;
}

header img:hover {
    transform: scale(1.05);
}

h2, p {
    text-align: center;
}

/* Button Section */
.button-section {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin-top: 20px;
}

button {
    padding: 10px 20px;
    background-color: darkorange;
    color: white;
    font-weight: bold;
    border: none;
    cursor: pointer;
    font-size: 16px;
    border-radius: 5px;
}

button:hover {
    background-color: #e68a00;
}

/* Responsive Design */
@media only screen and (max-width: 600px) {
    button {
        font-size: 14px;
    }
}

   </style>
</head>  
<header>
    <nav>
        <ul>
            <li class="primary-nav">
                <center><a href="catalog2.php"><img src="Images/sslogo.png" alt="logo" /></a></center>
            </li>
        </ul>
    </nav>
</header>
<body>
    <main>
        <h2>Thank You for Your Payment!</h2>
        <p>Your payment has been successfully processed. We appreciate your business!</p>
        
        <div class="button-section">
            <!-- Continue Shopping Button -->
            <form action="catalog2.php" method="post" style="display: inline;">
                <button type="submit" name="continue_shopping">Continue Shopping</button>
            </form>

            <!-- Sign Out Button -->
            <form action="index.php" method="post" style="display: inline;">
                <button type="submit" name="signout">Sign Out</button>
            </form>
        </div>
    </main>

    <!-- PHP Scripts -->
    <?php
        // Start the session
        session_start();

        // Handle Continue Shopping Button
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['continue_shopping'])) {
            // Clear the cart and wishlist only
            $_SESSION['cart'] = [];
            $_SESSION['wishlist'] = [];

            // Redirect to catalog2.php
            header("Location: catalog2.php");
            exit();
        }

        // Handle Sign Out Button
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signout'])) {
            // Terminate the session completely and redirect to index.php
            session_unset();
            session_destroy();
            header("Location: index.php");
            exit();
        }
    ?>
</body>
</html>
