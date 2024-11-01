<?php
session_start();

// Check if the Pay Now button is clicked
function calculateTotal() {
    $total = 0;
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            $total += (float)$item['price'] * (int)$item['quantity'];
        }
    }
    return $total;
}

$totalAmount = calculateTotal() ;

// Store address data in the session if needed
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['address'] = [
        'line1' => $_POST['line1'] ?? '',
        'line2' => $_POST['line2'] ?? '',
        'city' => $_POST['city'] ?? '',
        'region' => $_POST['region'] ?? '',
        'country' => $_POST['country'] ?? '',
        'code' => $_POST['code'] ?? ''
    ];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script type="text/javascript">
function shippingRequiredPayFast (formReference) {
let cont = true;
for( let i = 0; i < formReference.elements.length; i++ ) {

if( formReference.elements[i].className !== 'shipping' )
continue;

if( formReference.elements[i].name === 'line2' )
continue;

if( !cont )
continue;

if( formReference.elements[i].name === 'country' ) {
if( formReference.elements[i].selectedIndex === 0 ) {
cont = false;
alert ( 'Select a country' );
}
} else{
if( 0 === formReference.elements[i].value.length || /^\s*$/.test( formReference.elements[i].value ) ) {
cont = false;
alert ( 'Complete all the mandatory address fields' );
}
}
}
if( !cont ) {
return cont;
}
}
</script>
 <script type="text/javascript">
function customQuantitiesPayFast (formReference) {
formReference['amount'].value = formReference['amount'].value * formReference['custom_quantity'].value;
return true;
}
</script>
 <script type="text/javascript">
function actionPayFastJavascript ( formReference ) {
let shippingValid = shippingRequiredPayFast( formReference );
let shippingValidOrOff = typeof shippingValid !== 'undefined' ? shippingValid : true; 
let customValid = shippingValidOrOff ? customQuantitiesPayFast( formReference ) : false;
 if (typeof shippingValid !== 'undefined' && !shippingValid) {
return false;
}
if (typeof customValid !== 'undefined' && !customValid) {
return false;
}
return true;
 }
</script>
<style>
           body {
    font-family: 'Roboto', sans-serif;
    background-image: url('Images/wallpaper.png');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}


/* Header Styles */
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


form {
    max-width: 600px;
    margin: 50px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

table {
    width: 100%;
}

table tr {
    border-bottom: 1px solid #ddd;
}

table td, table th {
    padding: 10px;
}

input[type="number"], input[type="text"], select {
    width: calc(100% - 20px);
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

input[type="image"] {
    cursor: pointer;
}

.required {
    color: red;
}

@media screen and (max-width: 600px) {
    form {
        padding: 10px;
    }
}

    </style>
</head>
<body>
<header>
        <nav>
            <ul>
        <li class="primary-nav">
            
            <center> <a href="catalog2.php"><img src="Images/sslogo.png" alt="logo" /></a></center>
           </li>
           
           
        </nav>
    </header>
  
    <form action="payment.php" method="POST">
    <form action="payment.php" method="POST">
    <label for="total">Total :R<?php echo $totalAmount; ?></label><br>
   

    <label for="line1">Address Line 1:</label>
    <input type="text" name="line1" id="line1" value="<?php echo htmlspecialchars($_SESSION['address']['line1']); ?>" required>

    <label for="line2">Address Line 2:</label>
    <input type="text" name="line2" id="line2" value="<?php echo htmlspecialchars($_SESSION['address']['line2']); ?>">

    <label for="city">City:</label>
    <input type="text" name="city" id="city" value="<?php echo htmlspecialchars($_SESSION['address']['city']); ?>" required>

    <label for="region">Region/State:</label>
    <input type="text" name="region" id="region" value="<?php echo htmlspecialchars($_SESSION['address']['region']); ?>" required>

    <label for="country">Country:</label>
    <input type="text" name="country" id="country" value="<?php echo htmlspecialchars($_SESSION['address']['country']); ?>" required>

    <label for="code">Postal/Zip Code:</label>
    <input type="text" name="code" id="code" value="<?php echo htmlspecialchars($_SESSION['address']['code']); ?>" required>

    <button type="submit" name="payNow">Pay Now</button>
</form>
    
    <!-- Display address form fields here for user input -->

</body>
</html>