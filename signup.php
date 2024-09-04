<?php
include("db_connect.php");

if (isset($_POST['submit'])) {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if email already exists
    $verify_query = mysqli_query($con, "SELECT email FROM users WHERE email='$email'");
    
    if (mysqli_num_rows($verify_query) > 0) {
        echo "<div class='message'>
                <p>This email is already in use. Please try another one!</p>
            </div> <br>";
        echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button></a>";
    } else {
        $insert_query = mysqli_query($con, "INSERT INTO users(full_name, email, password) VALUES('$full_name', '$email', '$password')") or die("Error occurred");

        if ($insert_query) {
            echo "<div class='message'>
                    <p>Registration successful!</p>
                /div> <br>";
            echo "<a href='login.php'><button class='btn'>Login Now</button></a>";
        }
    }
} else {
?>
<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jaya Hospital</title>
    <link rel="stylesheet" href="register.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@100..900&display=swap" rel="stylesheet">
</head>
<body>
    <nav class="navbar">
        <!-- Navbar: Logo + Doctors + Emergency Hotline + About Us -->
        <div class="navdiv">
            <div class="logo">
                <a href="index.html"><img src="Images/jayalogo.png" width="120px"></a>
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
    <div class="container">
        <div class="box form-box">
            <header>Sign Up</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="full_name">Full Name</label>
                    <input type="text" name="full_name" id="full_name" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>
                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Register">
                </div>
                <div class="links">
                    Already a member? <a href="login.php">Sign In</a>
                </div>
            </form>
        </div>
    </div>
</body>
<!--Copyright-->
<footer>
    <br>
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
<?php } ?>

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