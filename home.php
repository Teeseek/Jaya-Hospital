<?php
session_start();
include("db_connect.php");

// Check if the user is logged in
if (!isset($_SESSION['valid'])) {
    header("Location: login.php");
    exit();
}

$id = $_SESSION['id']; // Get the logged-in user's ID from the session

// Handle form submission to update user information
if (isset($_POST['update'])) {
    $updated_name = mysqli_real_escape_string($con, $_POST['full_name']);
    $updated_email = mysqli_real_escape_string($con, $_POST['email']);
    $updated_phone = mysqli_real_escape_string($con, $_POST['phone_number']);
    $updated_age = (int) $_POST['age'];
    $updated_mykad = mysqli_real_escape_string($con, $_POST['mykad']);
    $updated_address = mysqli_real_escape_string($con, $_POST['address']);
    $updated_insurance = mysqli_real_escape_string($con, $_POST['insurance']);
    $updated_emergency_contact_name = mysqli_real_escape_string($con, $_POST['emergency_contact_name']);
    $updated_emergency_contact_relationship = mysqli_real_escape_string($con, $_POST['emergency_contact_relationship']);
    $updated_emergency_contact_phone = mysqli_real_escape_string($con, $_POST['emergency_contact_phone']);
    $updated_allergies = mysqli_real_escape_string($con, $_POST['allergies']);
    $updated_gender = mysqli_real_escape_string($con, $_POST['gender']);
    $updated_date_of_birth = mysqli_real_escape_string($con, $_POST['date_of_birth']);
    $updated_consent_for_information_sharing = isset($_POST['consent_for_information_sharing']) ? 1 : 0;

    $update_query = "UPDATE users SET 
        full_name='$updated_name', 
        email='$updated_email', 
        phone_number='$updated_phone', 
        age=$updated_age, 
        mykad='$updated_mykad', 
        address='$updated_address', 
        insurance='$updated_insurance', 
        emergency_contact_name='$updated_emergency_contact_name',
        emergency_contact_relationship='$updated_emergency_contact_relationship',
        emergency_contact_phone='$updated_emergency_contact_phone',
        allergies='$updated_allergies',
        gender='$updated_gender', 
        date_of_birth='$updated_date_of_birth',
        consent_for_information_sharing=$updated_consent_for_information_sharing
        WHERE id=$id";
    
    if (mysqli_query($con, $update_query)) {
        echo "<div class='message'><p>Information updated successfully.</p></div>";
    } else {
        echo "<div class='message'><p>Error updating information: " . mysqli_error($con) . "</p></div>";
    }
}

// Fetch user data from the 'users' table
$query = mysqli_query($con, "SELECT 
    full_name, email, phone_number, age, mykad, address, insurance, emergency_contact_name, 
    emergency_contact_relationship, emergency_contact_phone, allergies, 
    gender, date_of_birth, consent_for_information_sharing 
    FROM users WHERE id = $id");

// Check if the query returned a result
if ($query && mysqli_num_rows($query) > 0) {
    $result = mysqli_fetch_assoc($query);
    $res_FullName = $result['full_name'] ?? '';
    $res_Email = $result['email'] ?? '';
    $res_Phone = $result['phone_number'] ?? '';
    $res_Age = $result['age'] ?? '';
    $res_Mykad = $result['mykad'] ?? '';
    $res_Address = $result['address'] ?? '';
    $res_Insurance = $result['insurance'] ?? '';
    $res_EmergencyContactName = $result['emergency_contact_name'] ?? '';
    $res_EmergencyContactRelationship = $result['emergency_contact_relationship'] ?? '';
    $res_EmergencyContactPhone = $result['emergency_contact_phone'] ?? '';
    $res_Allergies = $result['allergies'] ?? '';
    $res_Gender = $result['gender'] ?? '';
    $res_DateOfBirth = $result['date_of_birth'] ?? '';
    $res_ConsentForInformationSharing = $result['consent_for_information_sharing'] ?? '';
} else {
    echo "User not found.";
    exit(); // Stop further execution if user is not found
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home.css">
    <title>Home</title>
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
                <li><a href="appointments.php">Booking</a></li>
                <li><a href="FeedbackForm.php">Reviews</a></li>
                <li><a href="stafflogin.php">Staff</a></li>
                <li><a href="logout.php" style="color: red;">Log Out</a></li>

            </ul>
        </div>
    </nav>
</head>
</head>
<body>
    
    </div>
    <main>
        <div class="main-box top">
            <div class="top">
                <div class="box">
                    <p>Hello <b><?php echo htmlspecialchars($res_FullName); ?></b>, Welcome To <b>Jaya Hospital</b></p>
                </div>
                <div class="box">
                    <p>Your email is <b><?php echo htmlspecialchars($res_Email); ?></b>.</p>
                </div>
                <?php

include("db_connect.php");

// Assuming the POST data is correctly sent and sanitized
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Fetch and sanitize the patient name from POST data
    $updated_name = mysqli_real_escape_string($con, $_POST['full_name']);
} else {
    // Handle the case where POST data is not available
    $updated_name = '';
}
?>
                <body>
    <button class="mh" onclick="location.href='prescription_notes.php?name=<?php echo urlencode($res_FullName); ?>'">Medical History</button>
</body>
</html>
            </div>

            <!-- Editable User Information Table -->
            <div class="user-info">
                <h2>Your Information</h2>
                <form action="" method="post">
                    <table>
                        <tr>
                            <th>Field</th>
                            <th>Value</th>
                        </tr>
                        <tr>
                            <td>Full Name</td>
                            <td><input type="text" name="full_name" value="<?php echo htmlspecialchars($res_FullName); ?>" required></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><input type="email" name="email" value="<?php echo htmlspecialchars($res_Email); ?>" required></td>
                        </tr>
                        <tr>
                            <td>Phone Number</td>
                            <td><input type="text" name="phone_number" value="<?php echo htmlspecialchars($res_Phone); ?>"></td>
                        </tr>
                        <tr>
                            <td>Age</td>
                            <td><input type="number" name="age" value="<?php echo htmlspecialchars($res_Age); ?>"></td>
                        </tr>
                        <tr>
                            <td>MyKad</td>
                            <td><input type="text" name="mykad" value="<?php echo htmlspecialchars($res_Mykad); ?>"></td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td><input type="text" name="address" value="<?php echo htmlspecialchars($res_Address); ?>"></td>
                        </tr>
                        <tr>
                            <td>Insurance</td>
                            <td><input type="text" name="insurance" value="<?php echo htmlspecialchars($res_Insurance); ?>"></td>
                        </tr>
                        <tr>
                            <td>Emergency Contact Name</td>
                            <td><input type="text" name="emergency_contact_name" value="<?php echo htmlspecialchars($res_EmergencyContactName); ?>"></td>
                        </tr>
                        <tr>
                            <td>Emergency Contact Relationship</td>
                            <td><input type="text" name="emergency_contact_relationship" value="<?php echo htmlspecialchars($res_EmergencyContactRelationship); ?>"></td>
                        </tr>
                        <tr>
                            <td>Emergency Contact Phone</td>
                            <td><input type="text" name="emergency_contact_phone" value="<?php echo htmlspecialchars($res_EmergencyContactPhone); ?>"></td>
                        </tr>
                        <tr>
                            <td>Gender</td>
                            <td>
                                <select name="gender">
                                    <option value="" <?php echo $res_Gender == '' ? 'selected' : ''; ?>>Select Gender</option>
                                    <option value="Male" <?php echo $res_Gender == 'Male' ? 'selected' : ''; ?>>Male</option>
                                    <option value="Female" <?php echo $res_Gender == 'Female' ? 'selected' : ''; ?>>Female</option>
                                    <option value="Other" <?php echo $res_Gender == 'Other' ? 'selected' : ''; ?>>Other</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Date of Birth</td>
                            <td><input type="date" name="date_of_birth" value="<?php echo htmlspecialchars($res_DateOfBirth); ?>"></td>
                        </tr>
                    
                        <tr>
                            <td>Allergies</td>
                            <td><textarea name="allergies"><?php echo htmlspecialchars($res_Allergies); ?></textarea></td>
                        </tr>
                        <tr>
                            <td>Consent for Information Sharing</td>
                            <td><input type="checkbox" name="consent_for_information_sharing" <?php echo $res_ConsentForInformationSharing ? 'checked' : ''; ?>></td>
                        </tr>
                    </table>
                    <div class="field">
                        <input type="submit" class="btn" name="update" value="Update Information">
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>

<style>
    .main-box.top {
    margin-top: 40px; /* Adjust this value as needed */
}

.top .box {
    margin-top: 20px; /* Adjust this value if you need to control spacing between boxes */
}

    .user-info {
        margin-top: 20px;
    }

    .user-info table {
        width: 100%;
        border-collapse: collapse;
        margin: 0 auto;
    }

    .user-info th, .user-info td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    .user-info th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

.mh{ background-color: white;
    color: black;
    border: none;
    padding-top: 40px;    
    padding-left: 30px;
    padding-right: 30px;
    border-radius: 8px;
    font-size: 18px;
    font-weight: 500;
    cursor: pointer;
    display: flex;
    justify-content: center;
    margin-top: 20px;
}
.mh:hover{
    background-color: gainsboro;
    transform: scale(1.05);
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

* {
    font-family: "Kumbh Sans", sans-serif;
    text-decoration: none;
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



</style>