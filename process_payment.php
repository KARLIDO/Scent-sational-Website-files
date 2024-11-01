<?php
session_start();
require 'database.php'; // Include the database connection

// Get the submitted card details and other form data
$card_number = $_POST['card_number'] ?? '';
$expiry_date = $_POST['expiry_date'] ?? '';
$cvv = $_POST['cvv'] ?? '';
$email = $_POST['contact_email'] ?? ''; // Get the email from the form

// Validate card details
$isValid = preg_match('/^\d{16}$/', $card_number) &&           // Check if card number is 16 digits
           preg_match('/^(0[1-9]|1[0-2])\/\d{2}$/', $expiry_date) &&  // Check valid expiry date format (MM/YY)
           preg_match('/^\d{3}$/', $cvv);                     // Check if CVV is 3 digits

// Ensure all address fields are set
$line1 = $_POST['line1'] ?? '';
$line2 = $_POST['line2'] ?? '';
$city = $_POST['city'] ?? '';
$region = $_POST['region'] ?? '';
$country = $_POST['country'] ?? '';
$code = $_POST['code'] ?? '';
$totalAmount = $_POST['totalAmount'] ?? '';

// If validation is successful, attempt to save data to the database
if ($isValid) {
    // Prepare the SQL statement with placeholders
    $sql = "INSERT INTO invoice (username, email, line1, line2, city, region, country, postal_code, total_amount)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Use prepared statements to prevent SQL injection
    if ($stmt = mysqli_prepare($conn, $sql)) {
        $username = $_SESSION['username'] ?? 'Guest';
        mysqli_stmt_bind_param($stmt, "ssssssssd", $username, $email, $line1, $line2, $city, $region, $country, $code, $totalAmount);

        // Execute and check for errors
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            // Redirect to thankU.php on success
            header("Location: thankU.php");
            exit();
        } else {
            echo "Error: Could not execute the query. " . mysqli_error($conn);
        }
    } else {
        echo "Error: Could not prepare the SQL statement.";
    }
} else {
    // Redirect back to payment.php with an error message if validation fails
    header("Location: payment.php?error=Invalid card details. Please try again.");
    exit();
}
?>
