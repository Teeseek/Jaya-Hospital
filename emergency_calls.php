<?php
include("db_connect.php"); // Include your database connection file

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = mysqli_real_escape_string($con, $_POST['full_name']);
    $medical_condition = mysqli_real_escape_string($con, $_POST['medical_condition']);
    $situation = mysqli_real_escape_string($con, $_POST['situation']);
    $location = mysqli_real_escape_string($con, $_POST['location']);
    $contact_info = mysqli_real_escape_string($con, $_POST['contact_info']);

    // Insert the data into the emergency_calls table
    $sql = "INSERT INTO emergency_calls (full_name, medical_condition, situation, location, contact_info)
            VALUES ('$full_name', '$medical_condition', '$situation', '$location', '$contact_info')";

    if (mysqli_query($con, $sql)) {
        echo "Emergency call recorded successfully!";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Call An Ambulance</title>
    <link rel="stylesheet" href="style.css">
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
</body>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            animation: fadeIn 1s ease-in-out;
            animation-delay: 0s;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .form-container {
            background-color: #ffffff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            width: 350px;
            text-align: center;
        }
        .form-container h2 {
            color: #333333;
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: 700;
            letter-spacing: 1px;
        }
        .form-container input, .form-container textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #dddddd;
            border-radius: 5px;
            font-size: 16px;
            color: #333333;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
        }
        .form-container input:focus, .form-container textarea:focus {
            border-color: #80bdff;
            outline: none;
            box-shadow: 0 0 8px rgba(128, 189, 255, 0.5);
        }
        .form-container input[type="submit"] {
            background-color: #007bff;
            color: #ffffff;
            border: none;
            cursor: pointer;
            font-size: 18px;
            padding: 12px;
            border-radius: 5px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .form-container input[type="submit"]:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }
        .form-container input[type="submit"]:active {
            transform: translateY(0);
        }
    </style>
    <script>
        // Request location access and autofill the location field
        function autofillLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;
                    document.getElementById('location').value = `Latitude: ${latitude}, Longitude: ${longitude}`;
                }, function(error) {
                    alert("Unable to retrieve your location. Please enter it manually.");
                });
            } else {
                alert("Geolocation is not supported by your browser. Please enter your location manually.");
            }
        }

        // Call the function to autofill location on page load
        window.onload = autofillLocation;
    </script>
</head>
<body>
    <div class="form-container">
        <h2>Call an Ambulance</h2>
        <form method="POST" action="">
            <input type="text" name="full_name" placeholder="Full Name" required>
            <input type="text" name="medical_condition" placeholder="Medical Condition" required>
            <textarea name="situation" placeholder="Describe the situation" rows="4" required></textarea>
            <input type="text" name="location" id="location" placeholder="Location" required>
            <input type="text" name="contact_info" placeholder="Contact Info" required>
            <input type="submit" value="Submit">
            <a href="index.html">Home</a>
        </form>
    </div>
</body>
</html>
<style>
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