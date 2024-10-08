<?php
// Include the database connection file
include("db_connect.php");

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Initialize variables for error and success messages
$error = '';
$success = '';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data and sanitize it
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $feedback = mysqli_real_escape_string($con, $_POST['feedback']);

    // Prepare the SQL statement
    $stmt = $con->prepare("INSERT INTO feedback (username, email, feedback) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $feedback);

    // Execute the statement and check if it was successful
    if ($stmt->execute()) {
        $success = "Feedback submitted successfully!";
    } else {
        $error = "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $con->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jaya Hospital</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@100..900&display=swap" rel="stylesheet">
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
                <li><a href="login.php">Appointment</a></li>
                <li><a href="FeedbackForm.php">Reviews</a></li>
                <li><a href="login.php">Log In</a></li>
                <li><a href="stafflogin.php">Staff</a></li>
            </ul>
        </div>
    </nav>
</head>
<body>

<form id="FeedbackForm" action="feedbackform.php" method="post" onsubmit="openPopup()">
    <br><br><br><br><br><br>
    <div class="wrapper">
        <div class ="container">
            <div class ="left"></div>
                <div class ="right">
        <h1>Tell us your honest opinion about Jaya Hospital!</h1>
        <br>
        <h2>Any form of feedback will be greatly appreciated!</h2>
        <input type="text" id="name" class="field" name="name" required placeholder="Jason...">
        <input type="email" id="email" class="field" name="email" required placeholder="Spam@gmail.com...">
        <textarea id="feedback" class="field" name="feedback" rows="4" required placeholder="Enter Your Feedback Here..."></textarea>
        <button type="reset" class="btn">Reset All</button>
        <button type="submit" class="btn" >Submit Feedback</button>
                </div>
        </div>
    </div>
    <div class="popup" id="popup">
        <img src="Images/Tick.jpg" id="tick">
        <h2>Thank you!</h2>
        <p>Your opinion has been submitted. Thanks again for reviewing!</p>
        <button type="button" class="btn" onclick="closePopup()">Sure</button>
    </div>
</form>

<footer>
    <br><br><br><br><br>
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
            <h2>Malaysia</h2> 
            <br><br><br><br><br><br><br>
            <h1>All Rights Reserved.</h1>
        </div>
        <div class="item3">
            <h1>Networks:</h1>
            <div class="wrap">
                <div class="button3"><img src="Images/instagram.png" width="50px" height="50px"></div>
                <span>Instagram</span>
                <div class="button3 twitter"><img src="Images/X.png" width="50px" height="50px"></div>
                <span>Twitter</span>
                <div class="button3 instagram"><img src="Images/facebook.png" width="50px" height="50px"></div>
                <span>FaceBook</span>
                <div class="button3 linkedin"><img src="Images/linkedin.png" width="50px" height="50px"></div>
                <span>LinkedIn</span>
            </div>
        </div>
    </div>
</footer>

<script>
document.getElementById("FeedbackForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent the form from submitting normally
    // Trigger the popup immediately
    openPopup();

    // Proceed with AJAX form submission
    const form = event.target;
    const formData = new FormData(form);
    
    fetch('feedbackform.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    });


function openPopup() {
    document.getElementById("popup").classList.add("open-popup");
}

function closePopup() {
    document.getElementById("popup").classList.remove("open-popup");
}

</script>

</body>
</html>


<style>
*{
    font-family: "Kumbh Sans",sans-serif;
    text-decoration: none;
    overflow-x: hidden;
}

.wrapper{
	position: relative;
	width: 100%;
	height: 100%;
	display: flex;
	justify-content: center;
	align-items: center;
	padding: 20px 100px;
}


.container{
	max-width: 1000px;
	display: grid;
	grid-template-columns: repeat(2, 1fr);
	justify-content: center;
	align-items: center;
	text-align: center;
	background-color: #fff;
	box-shadow: 0px 0px 19px 5px rgba(0,0,0,0.19);
    margin-right: 200px;
}

.left{
	background: url("Images/Hospitalimg.jpg") no-repeat center;
	background-size: cover;
	height: 100%;
}

.right{
	padding: 25px 70px;
}

h2{
	position: relative;
	padding: 0 0 10px;
	margin-bottom: 10px;
}


.field{
	width: 100%;
	border: 2px solid rgba(0, 0, 0, 0);
	outline: none;
	background-color: rgba(230, 230, 230, 0.6);
	padding: 0.5rem 1rem;
	font-size: 1.1rem;
	margin-bottom: 22px;
	transition: .3s;
}

.field:hover{
	background-color: rgba(0, 0, 0, 0.1);
}

textarea{
	min-height: 150px;
}

.btn{
    background-color: rgb(61, 255, 181);
    border-radius:8px;
    border-width: 10px;
    align-items: center;
}
.btn:hover{
    font-size: 115%;
    color:rgb(79, 173, 255);
    transition: background-color 1s,font-size 0.25s;
    border-color: rgb(140, 242, 255);
    border-radius: 10px;
    border-width: 110%;
}
.popup{
    width:500px;
    background:hsl(0, 0%, 100%);
    border-radius: 5px;
    position: absolute;
    top: 0%;
    left: 50%;
    transform: translate(-50%,-50%) scale(0.1);
    text-align: center;
    padding: 0 35px 35px;
    text-decoration-color: aliceblue;
    visibility: hidden;
    transition: transform 0.4s, top 0.4s;
}
.open-popup{
    visibility: visible;
    top: 50%;
    transform: translate(-50%,-50%) scale(1);
}
.close-popup {
    visibility: hidden;
    transition: transform 0.4s, top 0.4s;
}

#tick{
    width: 100px;
    margin-top: 70px;
    border-radius: 65%;
    box-shadow: 0 5px 8px rgba(0, 0, 0, 0.192);
}
.popup h2{
    font-size:40px;
    font-weight:500;
    margin:30px 0 10px;
}
.popup button{
    width: 100%;
    margin-top: 50px;
    padding: 10px 0;
    background: #8400ff;
    color:antiquewhite;
    border:0;
    outline:none;
    font-size: 20px;
    border-radius: 4.5px;
    cursor: pointer;
    box-shadow: 0 8px 8px rgba(0, 0, 0, 0.192);
}


* {
    font-family: "Kumbh Sans", sans-serif;
    text-decoration: none;
}

body {
    background: linear-gradient(rgba(255, 254, 254, 0.5), rgba(0, 0, 0, 0.5)), url('bgaboutus.png');
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



form .btn {
    margin-top: 15px;
    border: none;
    padding: 10px 15px;
    border-radius: 8px;
    font-size: 18px;
    font-weight: 500;
    cursor: pointer;
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

/* The Modal (background) */
.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgb(0, 0, 0);
    background-color: rgba(0, 0, 0, 0.4);
}

/* Modal Content */
.modal-content {
    background-color: #fefefe;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    max-width: 500px;
    border-radius: 5px;
}

/* The Close Button */
.close-btn {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
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
    .wrapper{
	position: relative;
	width: 100%;
	height: 50%;
	display: flex;
	justify-content: center;
	align-items: center;
	padding: 0px 0px;
}
.container{
	max-width: 100%;
	display: grid;
	grid-template-columns: repeat(2, 1fr);
	justify-content: center;
	align-items: center;
	text-align: center;
	background-color: #fff;
	box-shadow: 0px 0px 19px 5px rgba(0,0,0,0.19);
    margin-right: 0px;
}
.left{
	background: url("Images/Hospitalimg.jpg") no-repeat center;
	background-size: cover;
	height: 100%;
}
.right{
	padding: 0px 0px;
}
}

</style>
