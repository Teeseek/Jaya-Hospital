<?php
include("db_connect.php");

// Start session to check if admin is logged in
session_start();

// Ensure user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: stafflogin.php");
    exit();
}

// Get the email from the session
$email = $_SESSION['email'];

// Fetch user ID and name from the admin table based on email
$result_id_query = mysqli_query($con, "SELECT id, admin FROM admin WHERE email = '$email'");
if ($result_id_query) {
    if (mysqli_num_rows($result_id_query) > 0) {
        $admin = mysqli_fetch_assoc($result_id_query);
        $user_id = $admin['id'];
        $admin_name = $admin['admin']; // Fetch the admin name
    } else {
        echo "User not found in admin table.";
        exit();
    }
} else {
    echo "Failed to retrieve user ID from admin table: " . mysqli_error($con);
    exit();
}

// Handle search form submission
$search_query = '';
if (isset($_POST['search'])) {
    $search_name = mysqli_real_escape_string($con, $_POST['full_name']);
    $search_query = "WHERE full_name LIKE '%$search_name%'";
}

// Fetch user details from the users table based on search query
$result = mysqli_query($con, "SELECT * FROM users $search_query");
if (!$result) {
    die("Failed to execute query on users table: " . mysqli_error($con));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home</title>
    <style>
        * {
    font-family: "Kumbh Sans", sans-serif;
    text-decoration: none;
}
body {
    display: flex;
    margin: 0;
}
.navbar {
    width: 200px;
    background-color: #111;
    padding: 20px;
    height: 100vh;
    position:fixed;
}
.navbar header {
    font-size: 1.5em;
    margin-bottom: 20px;
    font-weight: bold;
    color: white;
}
.navbar a {
    display: block;
    padding: 10px;
    text-decoration: none;
    color: #a4a8ac;
    margin-bottom: 20px;
    border-radius: 10px;
    transition: background-color 0.3s;
}
.navbar a:hover {
    background-color: white;
}
.content {
    flex: 1;
    padding: 20px;
    margin-left: 220px;
}
table {
    width: 100%;
    border-collapse: collapse;
}
table, th, td {
    border: 1px solid #ddd;
}
th, td {
    padding: 10px;
    text-align: left;
}
th {
    background-color: #f4f4f4;
}
.welcome-message {
    font-size: 24px;
    margin-bottom: 20px;
}
.welcome-message .welcome-text {
    color: black;
}
.welcome-message .admin-name {
    color: green;
}
    </style>
</head>
<body>
    <div class="navbar">
        <header>Admin Panel</header>
        <a href="adminhome.php">Patients</a>
        <a href="feedback.php">Feedback</a>
        <a href="add_doctor.php">Doctors</a>
        <a href="bsystem.php">Appointments</a>
        <a href="adminmedicines.php">Medicine Library</a>
        <a href="stafflogin.php">Log Out</a>
    </div>
    <div class="content">
        <h1 class="welcome-message">
            <span class="welcome-text">Welcome, </span>
            <span class="admin-name"><?php echo htmlspecialchars($admin_name); ?></span>
        </h1>
        <h2>Manage Patients</h2>
        
        <form method="post">
            <input type="text" name="full_name" placeholder="Enter patient name">
            <input type="submit" name="search" value="Search">
        </form>
        
        <h2>Patient List</h2>
        <table>
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Age</th>
                    <th>MyKad</th>
                    <th>Address</th>
                    <th>Insurance</th>
                    <th>Allergies</th>
                    <th>Gender</th>
                    <th>Date of Birth</th>
                    <th>Emergency Contact Name</th>
                    <th>Emergency Contact Relationship</th>
                    <th>Emergency Contact Phone</th>
                    <th>Consent for Information Sharing</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><a href="medical_history.php?name=<?php echo urlencode($row['full_name']); ?>"><?php echo htmlspecialchars($row['full_name']); ?></a></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['phone_number']); ?></td>
                        <td><?php echo htmlspecialchars($row['age']); ?></td>
                        <td><?php echo htmlspecialchars($row['mykad']); ?></td>
                        <td><?php echo htmlspecialchars($row['address']); ?></td>
                        <td><?php echo htmlspecialchars($row['insurance']); ?></td>
                        <td><?php echo htmlspecialchars($row['allergies']); ?></td>
                        <td><?php echo htmlspecialchars($row['gender']); ?></td>
                        <td><?php echo htmlspecialchars($row['date_of_birth']); ?></td>
                        <td><?php echo htmlspecialchars($row['emergency_contact_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['emergency_contact_relationship']); ?></td>
                        <td><?php echo htmlspecialchars($row['emergency_contact_phone']); ?></td>
                        <td><?php echo htmlspecialchars($row['consent_for_information_sharing']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
