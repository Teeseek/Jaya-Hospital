<?php
session_start();
include("db_connect.php");

// Check if the user is logged in
if (!isset($_SESSION['valid'])) {
    header("Location: login.php");
    exit();
}

// Hide all errors
ini_set('display_errors', '0');
error_reporting(0);

// Alternatively, hide only specific types of errors
// ini_set('display_errors', '1');
// error_reporting(E_ERROR | E_WARNING | E_PARSE);



$email = $_SESSION['email'];// Get the logged-in user's ID from the session
$email = mysqli_real_escape_string($con, $_POST['email']);
 // Get the logged-in user's email from the session

// Prepare the SQL query with placeholders
$stmt = $con->prepare("SELECT prescription, notes FROM appointments WHERE patient_email = ?");
$stmt->bind_param("s", $email); // Bind the email parameter
$stmt->execute();

// Get the result
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $prescription = $row['prescription'] ?? 'No prescription available';
    $notes = $row['notes'] ?? 'No notes available';
} else {
    $prescription = 'No prescription available';
    $notes = 'No notes available';
}

// Close the statement and connection
$stmt->close();
$con->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home.css">
    <title>Prescription and Notes</title>
</head>
<body>
    <nav class="navbar">
        <!-- Navbar code here -->
    </nav>
    <main>
        <div class="main-box">
            <h2>Your Prescription and Notes</h2>
            <div class="prescription-notes">
                <p><strong>Prescription:</strong></p>
                <p><?php echo htmlspecialchars($prescription); ?></p>
                <p><strong>Notes:</strong></p>
                <p><?php echo htmlspecialchars($notes); ?></p>
            </div>
        </div>
    </main>
</body>
</html>
<?php
include("db_connect.php");

// Start session to check if admin is logged in
session_start();

// Get the patient name from the URL parameter
if (isset($_GET['name'])) {
    $patient_name = mysqli_real_escape_string($con, $_GET['name']);
    
    // Fetch details from the appointments table based on patient name
    $appointment_sql = "SELECT * FROM appointments WHERE patient_name = '$patient_name'";
    $appointment_result = mysqli_query($con, $appointment_sql);
    
    if (mysqli_num_rows($appointment_result) > 0) {
        $appointment = mysqli_fetch_assoc($appointment_result);
    } else {
        $appointment = null;
        echo "<p>No appointment details found for the selected patient.</p>";
    }

    // Fetch details from the users table based on patient name
    $user_sql = "SELECT * FROM users WHERE full_name = '$patient_name'";
    $user_result = mysqli_query($con, $user_sql);

    // Fetch medicine names for dropdown
    $medicine_names = [];
    $medicine_query = "SELECT DISTINCT name FROM medicines ORDER BY name";
    $medicine_result = mysqli_query($con, $medicine_query);
    while ($row = mysqli_fetch_assoc($medicine_result)) {
        $medicine_names[] = $row['name'];
    }
    
    if (mysqli_num_rows($user_result) > 0) {
        $user = mysqli_fetch_assoc($user_result);
    } else {
        $user = null; // No user details found
    }
} else {
    echo "<p>No patient name provided.</p>";
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        $prescription_medicine = isset($_POST['prescription_medicine']) ? mysqli_real_escape_string($con, $_POST['prescription_medicine']) : '';
        
        if ($_POST['action'] === 'save_note') {
            $note = isset($_POST['note']) ? mysqli_real_escape_string($con, $_POST['note']) : '';
            mysqli_query($con, "UPDATE appointments SET notes = '$note', prescription = '$prescription_medicine' WHERE id = $id");
            $appointment['notes'] = $note;
            
            // Optionally update the user's medical history with the new note
            $patient_name = mysqli_real_escape_string($con, $_POST['patient_name']);
            mysqli_query($con, "UPDATE users SET medical_history = CONCAT(COALESCE(medical_history, ''), '\n', '$note') WHERE full_name = '$patient_name'");
        } elseif ($_POST['action'] === 'appointment_done') {
            $result = mysqli_query($con, "SELECT notes, patient_name FROM appointments WHERE id = $id");
            $row = mysqli_fetch_assoc($result);
            $note = isset($row['notes']) ? $row['notes'] : '';
            $patient_name = isset($row['patient_name']) ? $row['patient_name'] : '';
            
            // Add the note to the users table
            if (!empty($patient_name)) {
                mysqli_query($con, "UPDATE users SET medical_history = CONCAT(COALESCE(medical_history, ''), '\n', '$note') WHERE full_name = '$patient_name'");
            }
            
            // Delete the appointment
            mysqli_query($con, "DELETE FROM appointments WHERE id = $id");
            // Redirect to avoid re-submission on page refresh
            header("Location: adminhome.php");
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin.css">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <title>Patient Details</title>
    
    <style>
        body {
            display: flex;
            margin: 0;
        }
        
        .content {
            flex: 1;
            padding: 20px;
            margin-left: 220px;
        }
        textarea {
            width: 100%;
            height: 200px;
            box-sizing: border-box;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
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
            margin-top: 20px;
        }
        .quill-container {
            height: 300px;
        }
    </style>
</head>
<body>
    
    <div class="content">
    <h1>Patient Details</h1>
    <?php if ($user): ?>
        <h2>Patient Information</h2>
        <table>
            <tr>
                <th>Full Name</th>
                <td><?php echo htmlspecialchars($user['full_name']); ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo htmlspecialchars($user['email']); ?></td>
            </tr>
            <tr>
                <th>Phone Number</th>
                <td><?php echo htmlspecialchars($user['phone_number']); ?></td>
            </tr>
            <tr>
                <th>Age</th>
                <td><?php echo htmlspecialchars($user['age']); ?></td>
            </tr>
            <tr>
                <th>MyKad</th>
                <td><?php echo htmlspecialchars($user['mykad']); ?></td>
            </tr>
            <tr>
                <th>Address</th>
                <td><?php echo htmlspecialchars($user['address']); ?></td>
            </tr>
            <tr>
                <th>Insurance</th>
                <td><?php echo htmlspecialchars($user['insurance']); ?></td>
            </tr>
            <tr>
                <th>Allergies</th>
                <td><?php echo htmlspecialchars($user['allergies']); ?></td>
            </tr>
            <tr>
                <th>Gender</th>
                <td><?php echo htmlspecialchars($user['gender']); ?></td>
            </tr>
            <tr>
                <th>Date of Birth</th>
                <td><?php echo htmlspecialchars($user['date_of_birth']); ?></td>
            </tr>
            <tr>
                <th>Emergency Contact Name</th>
                <td><?php echo htmlspecialchars($user['emergency_contact_name']); ?></td>
            </tr>
            <tr>
                <th>Emergency Contact Relationship</th>
                <td><?php echo htmlspecialchars($user['emergency_contact_relationship']); ?></td>
            </tr>
            <tr>
                <th>Emergency Contact Phone</th>
                <td><?php echo htmlspecialchars($user['emergency_contact_phone']); ?></td>
            </tr>
            <tr>
                <th>Consent for Information Sharing</th>
                <td><?php echo htmlspecialchars($user['consent_for_information_sharing']); ?></td>
            </tr>
        </table>
    <?php else: ?>
        <p>No user details found for the selected patient.</p>
    <?php endif; ?>

    <?php if ($appointment): ?>
        <h2>Appointment Information</h2>
        <table>
            <tr>
                <th>Patient Name</th>
                <td><?php echo htmlspecialchars($appointment['patient_name']); ?></td>
            </tr>
            <tr>
                <th>Medical Condition</th>
                <td><?php echo htmlspecialchars($appointment['medical_condition']); ?></td>
            </tr>
            <tr>
                <th>Doctor Name</th>
                <td><?php echo htmlspecialchars($appointment['doctor_name']); ?></td>
            </tr>
            <tr>
                <th>Appointment Date</th>
                <td><?php echo htmlspecialchars($appointment['appointment_date']); ?></td>
            </tr>
            <tr>
                <th>Created At</th>
                <td><?php echo htmlspecialchars($appointment['created_at']); ?></td>
            </tr>
            <tr>
                <th>Prescription</th>
                <td><?php echo htmlspecialchars($appointment['prescription']); ?></td>
            </tr>
        </table>
        </div>
    <?php endif ?>
</div>

    

</body>

</html>