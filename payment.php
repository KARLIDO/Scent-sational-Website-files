<?php  
session_start();
require 'database.php';

// Retrieve address fields from POST
$line1 = $_POST['line1'] ?? '';
$line2 = $_POST['line2'] ?? '';
$city = $_POST['city'] ?? '';
$region = $_POST['region'] ?? '';
$country = $_POST['country'] ?? '';
$code = $_POST['code'] ?? '';


// Retrieve payment fields
$card_number = $_POST['card_number'] ?? '';
$expiry_date = $_POST['expiry_date'] ?? '';
$cvv = $_POST['cvv'] ?? '';
$email = $_POST['contact_email'] ?? '';
  
// Calculate the total amount  
function calculateTotalWithDelivery($amount) {
    return $amount + 250;
}

// Get the cart total and add the delivery fee
$cartTotal = calculateCartTotal();
$totalAmount = calculateTotalWithDelivery($cartTotal);
  
// Get the address from the session  


  
function calculateCartTotal() {
    $total = 0;
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            $total += $item['price'] * $item['quantity'];
        }
    }
    return $total;
}
if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    // Initialize cart and cart count if not already set
   
}

?>   
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

/* Table Styles */
table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    background-color: #f9f9f9;
}

table img {
    max-width: 100px;
    height: auto;
}

th, td {
    padding: 15px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #e9e9e9;
    font-weight: bold;
}

tr:hover {
    background-color: #f2f2f2;
}

/* Form Styles */
form {
    display: flex;
    flex-direction: column;
    max-width: 400px;
    padding: 20px;
    background-color: #ffffff;
    border: 1px solid #ddd;
    border-radius: 5px;
}

input[type="text"],
input[type="email"],
input[type="submit"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    font-size: 16px;
    border: 1px solid #ddd;
    border-radius: 3px;
    box-sizing: border-box;
}

button {
    padding: 10px;
    background-color: darkorange;
    color: white;
    font-weight: bold;
    border: none;
    cursor: pointer;
    font-size: 16px;
}

button:hover {
    background-color: #e68a00;
}

/* Payment Logo Section */
.payment-logo img {
    width: 50px;
    margin: 5px;
    vertical-align: middle;
}

/* Totals */
p {
    text-align: right;
    font-weight: bold;
    font-size: 1.2em;
    margin: 20px 0;
}

/* Responsive Design */
@media only screen and (max-width: 600px) {
    table img {
        max-width: 70px;
    }
    
    th, td {
        padding: 8px;
    }

    form {
        width: 100%;
        padding: 15px;
    }

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
            
            <center> <a href="catalog2.php"><img src="Images/sslogo.png" alt="logo" /></a></center>
           </li>
           
           
        </nav>
    </header>
<body>  


<i class="fa fa-user-circle" aria-hidden="true"></i><?php
if (isset($_SESSION['username'])) {
echo $username;
} ?>

<h3>Items in Your Cart</h3>
<table>
    <tr>
        <th>Item</th>
        <th>Name</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Total</th>
    </tr>

    <?php if(isset($_SESSION['cart'])): ?>
        <?php foreach($_SESSION['cart'] as $item): ?>
            <tr>
                <td><img src="<?php echo $item['image']; ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" width="50"></td>
                <td><?php echo htmlspecialchars($item['name']); ?></td>
                <td><?php echo 'R' . number_format((float)$item['price'], 2, '.', ''); ?></td>
                <td><?php echo (int)$item['quantity']; ?></td>
                <td><?php echo 'R' . number_format((float)$item['price'] * (int)$item['quantity'], 2, '.', ''); ?></td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td colspan="5">Your cart is empty.</td></tr>
    <?php endif; ?>
</table>
<h2>Payment Details</h2>
<p>Total Amount: R<?php echo $totalAmount; ?> (includes R250 delivery fee)</p>
<form action="process_payment.php" method="POST">
    <!-- Address details as hidden fields -->
    <input type="hidden" name="line1" value="<?php echo htmlspecialchars($line1); ?>">
    <input type="hidden" name="line2" value="<?php echo htmlspecialchars($line2); ?>">
    <input type="hidden" name="city" value="<?php echo htmlspecialchars($city); ?>">
    <input type="hidden" name="region" value="<?php echo htmlspecialchars($region); ?>">
    <input type="hidden" name="country" value="<?php echo htmlspecialchars($country); ?>">
    <input type="hidden" name="code" value="<?php echo htmlspecialchars($code); ?>">
    <input type="hidden" name="totalAmount" value="<?php echo htmlspecialchars($totalAmount); ?>">

    <!-- Card Payment Details -->
    <div class="payment-logo">
    <img src="Images/visa.png" alt="Visa">
    <img src="Images/mastercard.png" alt="Mastercard">
    <img src="Images/paypal.png" alt="paypal">
</div>


    <label for="card_number">Card Number:</label><br>
    <input type="text" name="card_number" id="card_number" maxlength="16" required pattern="\d{16}" title="Enter a 16-digit card number"><br>
    
    <label for="expiry_date">Expiry Date (MM/YY):</label><br>
    <input type="text" name="expiry_date" id="expiry_date" maxlength="5" required pattern="(0[1-9]|1[0-2])\/\d{2}" title="Enter a valid expiry date (e.g., 09/24)"><br>

    <label for="cvv">CVV:</label><br>
    <input type="text" name="cvv" id="cvv" maxlength="3" required pattern="\d{3}" title="Enter a 3-digit CVV"><br>

    <label for="contact_email">Contact Email Address:</label><br>
    <input type="email" name="contact_email" id="contact_email" required placeholder="example@example.com" title="Enter a valid email address"><br>

    <button type="submit" name="submit_payment">Pay Now</button>
</form>

</body>  
</html>