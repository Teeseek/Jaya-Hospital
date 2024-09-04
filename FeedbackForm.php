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
    <link rel="stylesheet" href="style.css">
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
                <li><a href="login.php">Booking</a></li>
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
    top: 0;
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
    margin-top: -50px;
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



.lang-menu:hover ul {
    display: block;
}

/* Basic Info */
@keyframes bounce {
    0%,
    20%,
    50%,
    80%,
    100% {
    transform: translateY(0);
    }
    40% {
    transform: translateY(-30px);
    }
    60% {
    transform: translateY(-15px);
    }
}

.introduction {
    width: 90%;
    color: rgb(0, 255, 162);
    position: absolute;
    top: 15%;
    left: 5%;
    text-align: center;
    animation: bounce;
    animation-duration: 2s;
    animation-delay: 0ms;
}

.introduction h2 {
    font-size: 60px;
}

.introduction p {
    font-size: 20px;    
    color: black;
}

/* The Booking + Ambulance Buttons */
.buttons {
    display: flex;
    justify-content: center;
    padding: -10px;
}

#button1 {
    background-color: black;
    color: white;
    border: 2px solid black;
    border-radius: 15px;
    padding: 15px 30px;
    font-size: 20px;
    cursor: pointer;
    display: block;
    margin: 0 auto;
    transition: background-color 0.3s ease, color 0.3s ease, transform 0.3s ease;
    font-size: 50px;
}

#button1:hover {
    background-color: rgb(61, 255, 181);
    color: black;
    transform: scale(1.1);
    background:url(https://media.bizj.us/view/img/11684257/gettyimages-1234036542*1200xx2121-1198-0-33.jpg);
}

#button2 {
    background-color: black;
    color: white;
    border: 2px solid black;
    border-radius: 15px;
    padding: 15px 30px;
    font-size: 20px;
    cursor: pointer;
    display: block;
    margin: 0 auto;
    transition: background-color 0.3s ease, color 0.3s ease, transform 0.3s ease;
    font-size: 50px;
}

#button2:hover {
    background-color: rgb(61, 255, 181);
    color: black;
    transform: scale(1.1);
    background:url(https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTApZAL3voiLfcH3zpbglQdu_arYHK5DuiB7Q&s);
}

/* Info Cards */
@keyframes appear{
    from {
        opacity: 0;
        scale: 0.5;
    }
    to {
        opacity: 1;
        scale: 1;
    }
}


.card {
    display: flex;
    margin-bottom: 20px;
    border-bottom: 2px solid #ccc;
    padding-bottom: 20px;
    animation: appear linear;
    animation-timeline: view();
    animation-range: entry 0% cover 30%;
    animation-timing-function: ease-in;
}

#card1 {
    margin-top: 500px;
}

#cardimg1 {
    margin-left: 200px;

}

#cardimg2 {
    margin-right: 200px;
}

#inf1 {
    margin-left: 135px;
}

.card-img {
    flex: 1.5;
    margin-right: 100px;
}

.card-img img {
    width: 100%;
    height: auto;
    border-radius: 10px;
}

.card-content {
    flex: 2;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.card-content h1, .card-content h2, .card-content p {
    margin: 0;
    padding: 0 0 10px 0;
}

.card-content p {
    margin-top: 10px;
    margin-right: 300px;
}

.card:nth-child(even) {
    flex-direction: row-reverse;
}

.card:nth-child(even) .card-img {
    margin-right: 0;
    margin-left: 20px;
}

.card:nth-child(even) .card-content {
    margin-left: 200px;
}

/* Login */
.loginandsignup {
    position: absolute;
    top: 25%;
    left: 35%;
    width: 460px;
    height: 640px;
    border-radius: 12px;
    padding: 20px 30px 120px;
    background: #303f9f;
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

</style>