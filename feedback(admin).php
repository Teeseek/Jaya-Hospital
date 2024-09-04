<?php
include("db_connect.php");

// Start session to check if admin is logged in
session_start();



// Fetch feedback from the database
$result = mysqli_query($con, "SELECT * FROM feedback");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>
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
            position: fixed;
        }
        .navbar header {
            font-size: 1.5em;
            margin-bottom: 20px;
            font-weight: bold;
            color: white;
            margin-bottom: 20px;
            border-radius: 10px;
    transition: background-color 0.3s;
        }
        .navbar a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: #a4a8ac;
            margin-bottom: 5px;
            border-radius: 4px;
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
    </style>
</head>
<body>
    <div class="navbar">
        <header>Admin Panel</header>
        <a href="adminhome.php">Patients</a>
        <a href="feedback(admin).php">Feedback</a>
        <a href="add_doctor.php">Doctors</a>
        <a href="bsystem.php">Appointments </a>
        <a href="adminmedicines.php">Medicine Library</a>
        <a href="stafflogin.php">Log Out</a>
    </div>
    <div class="content">
        <h1>Feedback List</h1>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Feedback</th>
                    <th>Created_At</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['username']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['feedback']); ?></td>
                        <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
