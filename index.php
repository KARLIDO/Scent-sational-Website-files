<?php 
include 'database.php';
session_start(); // Start session to store user data if needed

if (isset($_POST["logout"])) {
    // Reset cart and cart count
    unset($_SESSION['cart']);
    unset($_SESSION['cart_count']);
    
    // Destroy the current session
    session_destroy();
    
    // Start a new session
    session_start();

    // Redirect to the login page
    header("Location: index.php");
    exit();
}

if (isset($_POST['signin'])) {  
    $db_user = mysqli_real_escape_string($conn, trim($_POST['username']));  
    $db_pass = trim($_POST['password']);
    
    if (empty($db_user) || empty($db_pass)) {
        echo "<p class='error'>Please enter both username and password.</p>";
    } else {
        // Retrieve user data from the database
        $sql = "SELECT * FROM users WHERE username = '$db_user'"; // Correct column name
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            
            // Verify the password
            if (password_verify($db_pass, $user['password'])) {
                // Password matches, user is verified
                $_SESSION['username'] = $db_user;  // Store user info in session if needed
                header("Location: catalog2.php");
                $_SESSION['cart'] = [];
                $_SESSION['cart_count'] = 0;
                $_SESSION['wishlist'] = [];
                exit();
            } else {
                echo "<p class='error'>Invalid username or password</p>";
            }
        } else {
            echo "<p class='error'>Invalid username or password</p>";
        }
    }
   
}
?>

<!DOCTYPE html>
<html lang="en">
<title>Scent-sational</title>
<link rel="shortcut icon" type="image/x-icon" href="Images/logo2.png" />
<head>
   
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
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            Username:<br>
            <input type="text" name="username"><br>
            Password:<br>
            <input type="password" name="password"><br>
            <input type="submit" name="signin" value="Sign In">
        </form>
        <p>If you don't have an account, please <a href="index3.php">sign up</a>.</p>
    </main>
    <footer>
        <!-- Footer content -->
    </footer>
</body>
</html>
