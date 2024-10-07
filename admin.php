<?php
include("db_connect.php");

if (isset($_POST['submit'])) {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $admin_pin = $_POST['admin_pin']; // Retrieve admin pin from form

    // Check if the admin pin is correct
    if ($admin_pin === '123') {
        // Check if email already exists in the admin table
        $verify_query = mysqli_query($con, "SELECT email FROM admin WHERE email='$email'");
        
        if (mysqli_num_rows($verify_query) > 0) {
            echo "<div class='message'>
                    <p>This email is already in use. Please try another one!</p>
                </div> <br>";
            echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button></a>";
        } else {
            // Insert into admin table
            $insert_query = mysqli_query($con, "INSERT INTO admin(admin, email, password) VALUES('$full_name', '$email', '$password')") or die("Error occurred");

            if ($insert_query) {
                echo "<div class='message'>
                        <p>Registration successful!</p>
                    </div> <br>";
                echo "<a href='login.php'><button class='btn'>Login Now</button></a>";
            }
        }
    } else {
        echo "<div class='message'>
                <p>Invalid admin pin. Please try again.</p>
            </div> <br>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
                <div class="field input">
                    <label for="admin_pin">Admin Pin</label>
                    <input type="password" name="admin_pin" id="admin_pin" autocomplete="off" required>
                </div>
                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Register">
                </div>
                <div class="links">
                    <a href="stafflogin.php">Staff</a>
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
<style>
    * {
    font-family: "Kumbh Sans", sans-serif;
    text-decoration: none;
}
body {
    background: linear-gradient(rgba(255, 254, 254, 0.5), rgba(0, 0, 0, 0.5)), url('bgaboutus.png');
}
.container{
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 90vh;
}
.box{
    background: #fdfdfd;
    display: flex;
    flex-direction: column;
    padding: 25px 25px;
    border-radius: 20px;
    box-shadow: 0 0 128px 0 rgba(0,0,0,0.1),
                0 32px 64px -48px rgba(0,0,0,0.5);
}
.form-box{
    width: 450px;
    margin: 0px 10px;
}
.form-box header{
    font-size: 25px;
    font-weight: 600;
    padding-bottom: 10px;
    border-bottom: 1px solid #e6e6e6;
    margin-bottom: 10px;
}
.form-box form .field{
    display: flex;
    margin-bottom: 10px;
    flex-direction: column;
    padding: 0px 10px;

}
.form-box form .input input{
    height: 40px;
    width: 100%;
    font-size: 16px;
    padding: 0 3px;
    border-radius: 5px;
    border: 1px solid #ccc;
    outline: none;
}
.btn{
    height: 45px;
    background: rgba(76,68,182,0.808);
    border: 0;
    border-radius: 5px;
    color: #fff;
    font-size: 15px;
    cursor: pointer;
    transition: all .3s;
    margin-top: 10px;
    padding: 0px 10px;
}
.btn:hover{
    opacity: 0.82;
}
.submit{
    width: 100%;
}
.links{
    margin-bottom: 15px;
}

/********* Home *****************/

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

.message{
    text-align: center;
    background: #f9eded;
    padding: 15px 0px;
    border:1px solid #699053;
    border-radius: 5px;
    margin-bottom: 10px;
    color: red;
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

/* Media Queries */
@media screen and (max-width: 600px) {
    .navbar{
    padding-right: 0px;
    padding-left: 0px;
    }
    .navdiv {
    margin-right: 0px;
    }
    .logo img{
    width: 85px;
    }
    .navdiv li {
    padding: 0px;
    }
    .navdiv li a {
    font-size: 12px;
    margin-right:8px;
    }
    
    li a:hover {
    font-size: 10%;
    }
    h1{
        font-size: 22px;
    }
    h2{
    font-size: 20px;
    }
}
</style>