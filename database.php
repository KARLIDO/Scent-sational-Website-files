<?php
$db_server = "localhost"; // Local server
$db_user = "root"; // Default MySQL user
$db_pass = ""; // Empty password by default for local MySQL
$db_name = "businessdb";

// Create connection
try{
    $conn = mysqli_connect ($db_server, $db_user, $db_pass, $db_name);
}
catch(mysqli_sql_exception){
    echo "Could not connect! <br>";
}
if($conn){
    if(isset($_POST["logout"])){
        // Reset cart and cart count
        $_SESSION['cart'] = array();
        $_SESSION['cart_count'] = 0;
        
        // Destroy the current session
        session_unset();
        session_destroy();
        
        // Redirect to the login page
        header("Location: index.php");
        exit(); // Terminate script execution after redirection
    }
   
}
else{
    echo"Could not connect!";
}

?>