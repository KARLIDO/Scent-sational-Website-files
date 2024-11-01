<?php 
require 'database.php';

if(isset ($_POST["logout"])){
    // Reset cart and cart count
    unset($_SESSION['cart']);
    unset($_SESSION['cart_count']);
    
    // Destroy the current session
    session_destroy();
    
    // Start a new session
    session_start();

    // Redirect to the login page
    header("Location: catalog2.php");
    exit(); // Terminate script execution after redirection
}

if (isset($_POST['submit'])) {  
    $username = mysqli_real_escape_string($conn, trim($_POST['username']));
    $password = mysqli_real_escape_string($conn, trim($_POST['password']));
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $address = mysqli_real_escape_string($conn, trim($_POST['address']));

    if (empty($username) || empty($password) || empty($email) || empty($address)) {
        echo "<p class='error'>Please fill in all fields.</p>";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, password, email, address) VALUES ('$username', '$hashed_password', '$email', '$address')";
        
        if (mysqli_query($conn, $sql)) {  
            echo "Registration successful! Redirecting to sign-in page...";
            header("refresh:2;url=index.php");  
        } else {  
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);  
        }  
    }
}  

?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="index.css">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
<title>Scent-sational</title>
<link rel="shortcut icon" type="image/x-icon" href="Images/logo2.png" />
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
          main {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 70vh;
        }

        form {
            display: flex;
            flex-direction: column;
            width: 300px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-family: 'Roboto', sans-serif;
            background-color: #f9f9f9;
        }

        /* Form input styles */
        input[type="text"],
        input[type="password"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }

        /* Submit button styles */
        input[type="submit"] {
            background-color: darkorange;
            color: #fff;
            cursor: pointer;
            font-weight: 500;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        /* Link to signup */
        p {
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
        }

        p a {
            color: #007bff;
            text-decoration: none;
        }

        p a:hover {
            text-decoration: underline;
        }

        /* Error message styling */
        .error {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }
</style>
</head>
<body>
    <header>
    <nav>
            
        <li class="primary-nav">
            
            <center><img src="Images/sslogo.png" alt="logo" /></center>
           </li>
           
            
        </nav>
    </header>
    <main>
    
        <form action= "<?php htmlspecialchars ($_SERVER["PHP_SELF"])?>" method= "post">
        
            Username:<br>
            <input type="text"  name ="username" ><br>
            Password:<br>
            <input type="password" name ="password"><br>
            Email:<br>
            <input type="email" name ="email"><br>
            Address:<br>
            <input type="text" name ="address"><br>
            
            <input type="submit" name ="submit" value="Sign Up">
        </form>
    
        <p>Already have an account, please <a href="index.php">sign in</a>.</p>
    </main>
    <footer>
        <!-- Footer content -->
    </footer>
    <script src="js/script.js"></script>
</body>
</html>
