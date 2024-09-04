<?php
include("db_connect.php");
session_start();

if (isset($_GET['name'])) {
    $patient_name = mysqli_real_escape_string($con, $_GET['name']);

    // Fetch all appointments for the patient
    $appointments_sql = "
        SELECT a.*, GROUP_CONCAT(m.name SEPARATOR ', ') AS medicines
        FROM appointments a
        LEFT JOIN appointment_medicines am ON a.id = am.appointment_id
        LEFT JOIN medicines m ON am.medicine_id = m.id
        WHERE a.patient_name = '$patient_name'
        GROUP BY a.id
        ORDER BY a.appointment_date DESC
    ";
    $appointments_result = mysqli_query($con, $appointments_sql);

    if (mysqli_num_rows($appointments_result) > 0):
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin.css">
    <title>Medical History</title>
</head>
<body>
    <div class="content">
        <h1>Medical History for <?php echo htmlspecialchars($patient_name); ?></h1>
        
        <?php while ($appointment = mysqli_fetch_assoc($appointments_result)): ?>
            <div class="appointment-details">
                <h2>Appointment on <?php echo htmlspecialchars($appointment['appointment_date']); ?></h2>
                <table>
                    <tr>
                        <th>Medical Condition</th>
                        <td><?php echo htmlspecialchars($appointment['medical_condition']); ?></td>
                    </tr>
                    <tr>
                        <th>Doctor Name</th>
                        <td><?php echo htmlspecialchars($appointment['doctor_name']); ?></td>
                    </tr>
                    <tr>
                        <th>Prescription</th>
                        <td><?php echo htmlspecialchars($appointment['prescription']); ?></td>
                    </tr>
                    <tr>
                        <th>Notes</th>
                        <td><?php echo nl2br(htmlspecialchars($appointment['notes'])); ?></td>
                    </tr>
                </table>
            </div>
        <?php endwhile; ?>
        
    </div>
</body>
</html>
<?php
    else:
        echo "<p>No medical history found for the selected patient.</p>";
    endif;
} else {
    echo "<p>No patient name provided.</p>";
}
?>
