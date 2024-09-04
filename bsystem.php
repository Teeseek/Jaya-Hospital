<?php

include("db_connect.php");



// Start session to check if admin is logged in

session_start();



// Fetch unique doctor names from the 'doctors' table

$doctor_names = [];

$doctor_query = "SELECT DISTINCT name FROM doctors ORDER BY name";

$doctor_result = mysqli_query($con, $doctor_query);

while ($row = mysqli_fetch_assoc($doctor_result)) {

    $doctor_names[] = $row['name'];

}



// Handle form submissions with Prepared Statements

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['action'])) {

        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;



        if ($_POST['action'] === 'save_note') {

            $note = isset($_POST['note']) ? $_POST['note'] : '';



            // Prepare statement to update notes

            $stmt = $con->prepare("UPDATE appointments SET notes = ? WHERE id = ?");

            $stmt->bind_param("si", $note, $id);

            $stmt->execute();

            $stmt->close();

        } elseif ($_POST['action'] === 'mark_done') {

            // Fetch the note and patient name before updating status using prepared statements

            $stmt = $con->prepare("SELECT notes, patient_name FROM appointments WHERE id = ?");

            $stmt->bind_param("i", $id);

            $stmt->execute();

            $stmt->bind_result($note, $patient_name);

            $stmt->fetch();

            $stmt->close();



            // Add the note to the user's medical history

            if (!empty($patient_name)) {

                $stmt = $con->prepare("UPDATE users SET medical_history = CONCAT(COALESCE(medical_history, ''), '\n', ?) WHERE full_name = ?");

                $stmt->bind_param("ss", $note, $patient_name);

                $stmt->execute();

                $stmt->close();

            }



            // Mark the appointment as done

            $stmt = $con->prepare("UPDATE appointments SET status = 'done' WHERE id = ?");

            $stmt->bind_param("i", $id);

            $stmt->execute();

            $stmt->close();



            // Redirect to avoid re-submission on page refresh

            header("Location: bsystem.php");

            exit();

        }

    }

}



// Fetch doctor filter value

$doctor_filter = isset($_POST['doctor_name']) ? mysqli_real_escape_string($con, $_POST['doctor_name']) : '';



// Fetch appointments from the database with optional filtering and only active appointments

$query = "SELECT * FROM appointments WHERE status = 'active'";

if ($doctor_filter) {

    $query .= " AND doctor_name = '$doctor_filter'";

}

$result = mysqli_query($con, $query);

?>



<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Appointments</title>

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

        .form-container {

            margin-bottom: 20px;

        }

        button {

            padding: 5px 10px;

            background-color: #4CAF50;

            color: white;

            border: none;

            border-radius: 4px;

            cursor: pointer;

        }

        button:hover {

            background-color: #45a049;

        }

        /* Optional: Style the filter form */

        .filter-form {

            margin-bottom: 20px;

        }

        .filter-form label {

            margin-right: 10px;

        }

        .filter-form select {

            padding: 5px;

            margin-right: 10px;

        }

        .filter-form input[type="submit"] {

            padding: 5px 10px;

            background-color: #008CBA;

            color: white;

            border: none;

            border-radius: 4px;

            cursor: pointer;

        }

        .filter-form input[type="submit"]:hover {

            background-color: #007B9E;

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

        <h1>Appointments List</h1>



        <!-- Filter Form -->

        <form method="post" action="" class="filter-form">

            <label for="doctor_name">Filter by Doctor:</label>

            <select id="doctor_name" name="doctor_name" required>

                <option value="">Select a doctor</option>

                <?php foreach ($doctor_names as $doctor_name): ?>

                    <option value="<?php echo htmlspecialchars($doctor_name); ?>" <?php echo ($doctor_filter === $doctor_name) ? 'selected' : ''; ?>>

                        <?php echo htmlspecialchars($doctor_name); ?>

                    </option>

                <?php endforeach; ?>

            </select>

            <input type="submit" value="Filter">

        </form>



        <table>

            <thead>

                <tr>

                    <th>ID</th>

                    <th>Patient Name</th>

                    <th>Patient Email</th>

                    <th>Patient Phone</th>

                    <th>Medical Condition</th>

                    <th>Doctor Name</th>

                    <th>Appointment Date</th>

                    <th>Created At</th>

                    <th>Actions</th> <!-- New column for actions -->

                </tr>

            </thead>

            <tbody>

                <?php if(mysqli_num_rows($result) > 0): ?>

                    <?php while ($row = mysqli_fetch_assoc($result)): ?>

                        <tr>

                            <td><?php echo htmlspecialchars($row['id']); ?></td>

                            <td><a href="bsystem_details.php?name=<?php echo urlencode($row['patient_name']); ?>"><?php echo htmlspecialchars($row['patient_name']); ?></a></td>

                            <td><?php echo htmlspecialchars($row['patient_email']); ?></td>

                            <td><?php echo htmlspecialchars($row['patient_phone']); ?></td>

                            <td><?php echo htmlspecialchars($row['medical_condition']); ?></td>

                            <td><?php echo htmlspecialchars($row['doctor_name']); ?></td>

                            <td><?php echo htmlspecialchars($row['appointment_date']); ?></td>

                            <td><?php echo htmlspecialchars($row['created_at']); ?></td>

                            <td>

                                <!-- Mark as Done Form -->

                                <form method="post" action="" onsubmit="return confirm('Are you sure you want to mark this appointment as done?');">

                                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">

                                    <input type="hidden" name="action" value="mark_done">

                                    <button type="submit">Mark as Done</button>

                                </form>

                            </td>

                        </tr>

                    <?php endwhile; ?>

                <?php else: ?>

                    <tr>

                        <td colspan="9">No active appointments found.</td>

                    </tr>

                <?php endif; ?>

            </tbody>

        </table>

    </div>

</body>

</html>

