<?php
// Include database connection
require 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form input
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    
    // Insert the feedback into the database
    $sql = "INSERT INTO feedback (name, email, message) VALUES ('$name', '$email', '$message')";
    
    if (mysqli_query($conn, $sql)) {
        echo "Thank you for your feedback!";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>
