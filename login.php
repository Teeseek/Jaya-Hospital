<?php
session_start();
include("db_connect.php");

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Handle login form submission
if (isset($_POST['login_submit'])) {
    $email = mysqli_real_escape_string($con, $_POST['login_email']);
    $password = $_POST['login_password'];

    $stmt = $con->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $stored_password = $row['password'];

        if ($password === $stored_password) {
            $_SESSION['valid'] = true;
            $_SESSION['id'] = $row['id'];
            header("Location: home.php");
            exit();
        } else {
            $login_error = "Invalid email or password!";
        }
    } else {
        $login_error = "Invalid email or password!";
    }

    $stmt->close();
}

// Handle signup form submission
if (isset($_POST['signup_submit'])) {
    $full_name = mysqli_real_escape_string($con, $_POST['signup_full_name']);
    $email = mysqli_real_escape_string($con, $_POST['signup_email']);
    $password = $_POST['signup_password'];

    // Check if email already exists
    $stmt = $con->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 0) {
        // Insert new user
        $stmt->close();
        $stmt = $con->prepare("INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $full_name, $email, $password);
        if ($stmt->execute()) {
            $signup_success = "Registration successful! Please log in.";
        } else {
            $signup_error = "Registration failed! Please try again.";
        }
    } else {
        $signup_error = "Email already exists! Please use a different email.";
    }

    $stmt->close();
    $con->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="register.css">
    <title>Jaya Hospital</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@100..900&display=swap" rel="stylesheet">
</head>

<body>
    <nav class="navbar">
        <!-- Navbar: Logo + Doctors + Emergency Hotline + About Us -->
        <div class="navdiv">
            <div class="logo">
                <a href="index.html"><img src="Images/jayalogo.png" width="120px"> </a>
            </div>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="Details(AboutUs).html">About Us</a></li>
                <li><a href="display_doctors.php">Doctors</a></li>
                <li><a href="login.php">Booking</a></li>
                <li><a href="FeedbackForm.php">Reviews</a></li>
                <li><a href="login.php">Log In</a></li>
                <li><a href="stafflogin.php">Staff</a></li>
            </ul>
        </div>
    </nav>
    <div class="loginandsignup">
        <!-- Signup Section -->
        <div class="signup-section">
            <header>Sign Up</header>
            <div class="separator">
                <div class="line"></div>
            </div>
            <br>
            <form id="signup-form" action="login.php" method="POST">
                <input type="text" name="signup_full_name" placeholder="Full name" required>
                <input type="email" name="signup_email" placeholder="Email address" required>
                <input type="password" name="signup_password" placeholder="Password" required>
                <button type="submit" class="btn" name="signup_submit">Sign up</button>
            </form>
            <?php if (isset($signup_error)) { echo "<p class='error'>$signup_error</p>"; } ?>
            <?php if (isset($signup_success)) { echo "<p class='success'>$signup_success</p>"; } ?>
        </div>

        <!-- Login Section -->
        <div class="login-section">
            <header>Login</header>
            <div class="separator">
                <div class="line"></div>
            </div>
            <br>
            <form id="login-form" action="login.php" method="POST">
                <input type="email" name="login_email" placeholder="Email address" required>
                <input type="password" name="login_password" placeholder="Password" required>
                <button type="submit" class="btn" name="login_submit">Login</button>
            </form>
            <?php if (isset($login_error)) { echo "<p class='error'>$login_error</p>"; } ?>
        </div>
    </div>

    <script src="script.js"></script>
</body>
<!--Copyright-->
<footer>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <hr>
    <div class="contain">
        <div class="item1">
        <h1>Jaya Hospital Inc.©</h1>
        <p>Departments and Contact Numbers:</p>
        <p>Cardiology: +60 4-789 0123</p>
        <p>Pediatrics: +60 4-890 1234</p>
        <p>Surgery: +60 4-901 2345</p>
        <p>Radiology: +60 4-012 3456</p>
        </div>
        <div class="item2">
        <h1>Address:</h1>
        <h2>46 Jalan Hospital,</h2>
        <h2>Georgetown, 10450 Penang,</h2>
        <h2>Malaysia</h2> <br><br><br><br><br><br><br>
        <h1>All Rights Reserved.</h1>
        </div>
        <div class="item3">
            <h1>Networks:</h1>
            <div class="wrap">
                <div class="button3"><img src="Images/instagram.png" width="50px" height="50px"></div>
                <span>Instagram</span>
                <div class="button3 twitter"><img src="Images/X.png"width="50px" height="50px"></div>
                <span>Twitter</span>
                <div class="button3 instagram"><img src="Images/facebook.png"width="50px" height="50px"></div>
                <span>FaceBook</span>
                <div class="button3 linkedin"><img src="Images/linkedin.png"width="50px" height="50px"></div>
                <span>LinkedIn</span>
            </div>
        </div>
    </div>
</footer>
</html>
<style>
* {
    font-family: "Kumbh Sans", sans-serif;
    text-decoration: none;
}

body {
    background: linear-gradient(rgba(255, 254, 254, 0.5), rgba(0, 0, 0, 0.5)), url('bgaboutus.png');
    background-repeat: no-repeat;
    background-position: center;
    background-attachment: fixed;
    min-height: 150vh; /* Adjust this value as needed */
    margin: 0;
    padding: 0;
}

/* Navbar */
.navbar {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    background: rgb(0, 255, 162);
    font-family: sans-serif;
    padding-right: 15px;
    padding-left: 15px;
    z-index: 1000;
}

.navdiv {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-right: 550px;
}

.logo {
    flex-shrink: 0;
}

.navdiv ul {
    display: flex;
    list-style: none;
    margin: 0;
    padding: 0;
}

.navdiv li {
    padding: 10px;
}

.navdiv li a {
    color: rgb(0, 0, 0);
    font-size: 18px;
    font-weight: bold;
    margin-right: 25px;
    transition: color 0.3s ease;
}

li a:hover {
    color: white;
    font-size: 130%;
}


/* Login */
.loginandsignup {
    position: absolute;
    top: 20%;
    left: 35%;
    width: 460px;
    height: 640px;
    border-radius: 12px;
    padding: 20px 30px 120px;
    background: #429e9d;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.login-section {
    position: absolute;
    left: 50%;
    bottom: -88%;
    transform: translateX(-50%);
    width: 450px;
    padding: 10px 300px;
    background: #fff;
    border-radius: 300px;
    height: 100%;
    transition: all 0.6s ease;
}

.login-section header,
.signup-section header {
    font-size: 30px;
    text-align: center;
    color: #fff;
    font-weight: 600;
    cursor: pointer;
}

.login-section header {
    color: #333;
    opacity: 0.6;
}

.separator {
    margin-top: 20px;
    display: flex;
    align-items: center;
    gap: 20px;
}

.separator .line {
    width: 100%;
    height: 1px;
    background: #ccc;
}

.loginandsignup form {
    display: flex;
    flex-direction: column;
    gap: 20px;
    margin-top: 30px;
}

form input {
    outline: none;
    border: none;
    padding: 10px 15px;
    font-size: 16px;
    color: #333;
    font-weight: 400;
    border-radius: 8px;
    background: #fff;
}

.login-section input {
    border: 1px solid #aaa;
}

form a {
    color: #333;
}

.signup-section form a {
    color: #fff;
}

form .btn {
    margin-top: 15px;
    border: none;
    padding: 10px 15px;
    border-radius: 8px;
    font-size: 18px;
    font-weight: 500;
    cursor: pointer;
    background-color: white;
}

.loginandsignup header:hover {
    font-size: 250%;
    color: rgb(79, 173, 255);
    transition: font-size 0.25s;
    border-color: rgb(140, 242, 255);
    border-radius: 10px;
    border-width: 110%;
}

form .btn:hover {
    font-size: 115%;
    color: rgb(79, 173, 255);
    transition: background-color 1s, font-size 0.25s;
    background-color: rgb(0, 255, 162);
    border-color: rgb(140, 242, 255);
    border-radius: 10px;
    border-width: 110%;
}

.login-section .btn {
    background: #303f9f;
    color: #fff;
    border: none;
}

.loginandsignup.active .login-section {
    bottom: -12%;
    border-radius: 300px;
    box-shadow: 0 -5px 10px rgba(0, 0, 0, 0.1);
}

.loginandsignup.active .login-section header {
    opacity: 1;
}

.loginandsignup.active .signup-section header {
    opacity: 0.6;
}

/* Footer */
h1, h2, h3, p, a {
    margin: 15px 0;
}

a {
    display: block;
    color: #3498db;
    text-decoration: none;
}

.contan, .contain, .cont {
    display: flex;
    justify-content: space-evenly;
}

.wrap {
    display: inline;
    justify-content: space-around;
    align-items: center;
}



.close-btn:hover,
.close-btn:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

p {
    font-size: 18px;
}




</style>