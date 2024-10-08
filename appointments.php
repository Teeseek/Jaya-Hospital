
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jaya Hospital</title>
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
                <a href = "index.html"><img src="Images/jayalogo.png" width="120px"> </a>
            </div>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="Details(AboutUs).html">About Us</a></li>
                <li><a href="display_doctors.php">Doctors</a></li>
                <li><a href="appointments.php">Booking</a></li>
                <li><a href="FeedbackForm.php">Reviews</a></li>
                <li><a href="login.php">Log In</a></li>
                <li><a href="stafflogin.php">Staff</a></li>
            </ul>        
        </div>
    </nav>
    <br><br><br>
    <br><br><br> 
    <br><br><br>

        <h2>Book an Appointment</h2>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $servername = "sql305.infinityfree.com";
            $username = "if0_37226912";
            $password = "uj3MOvFr54G";
            $dbname = "if0_37226912_jaya_hospital";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $patient_name = $_POST['patient_name'];
            $medical_condition = $_POST['medical_condition'];
            $doctor_name = $_POST['doctor_name'];
            $appointment_date = $_POST['appointment_date'];

            $sql = "INSERT INTO appointments (patient_name, medical_condition, doctor_name, appointment_date) 
                    VALUES ('$patient_name', '$medical_condition', '$doctor_name', '$appointment_date')";

            if ($conn->query($sql) === TRUE) {
                echo "<p>New appointment booked successfully.</p>";
            } else {
                echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
            }

            $conn->close();
        }
        ?>
<div class="container">
        <form action="" method="POST">
            <label for="patient_name">Full Name:</label>
            <input type="text" id="patient_name" name="patient_name" required>
            <label for="medical_condition">Medical Condition:</label>
            <input type="text" id="medical_condition" name="medical_condition" required>

<label for="doctor_name">Select Doctor:</label>
            <select id="doctor_name" name="doctor_name" required>
                <option value="">Select a doctor</option>
                <option value="Dr. Chen Wei">Dr. Chen Wei (Orthopedics)</option>
                <option value="Dr. David Kim">Dr. David Kim (Dermatology)</option>
                <option value="Dr. Alexander Johnson">Dr. Alexander Johnson (Neurology, Epileptology)</option>
                <option value="Dr. Sofia Ivanova">Dr. Sofia Ivanova (Pulmonology)</option>
                <option value="Dr. David Li">Dr. David Li (Radiology)</option>
                <option value="Dr. Emma Robinson">Dr. Emma Robinson (Endocrinology)</option>
                <option value="Dr. John Smith">Dr. John Smith (Orthopedics)</option>
                <option value="Dr. Amina Mohamed">Dr. Amina Mohamed (Oncology)</option>
                <option value="Dr. Carlos Lopez">Dr. Carlos Lopez (Anesthesiology)</option>
                <option value="Dr. Elena Petrova">Dr. Elena Petrova (Obstetrics and Gynecology)</option>
                <option value="Dr. Emily Nguyen">Dr. Emily Nguyen (Immunology)</option>
                <option value="Dr. Fatima Al-Salem">Dr. Fatima Al-Salem (Endocrinology)</option>
                <option value="Dr. Isabelle Martin">Dr. Isabelle Martin (Pulmonology)</option>
                <option value="Dr. Jose Martinez">Dr. Jose Martinez (Urology)</option>
                <option value="Dr. Lucy Wang">Dr. Lucy Wang (Ophthalmology)</option>
                <option value="Dr. Maria Gonzalez">Dr. Maria Gonzalez (Gastroenterology)</option>
                <option value="Dr. Michael Johnson">Dr. Michael Johnson (Psychiatry)</option>
                <option value="Dr. Nabil Hussein">Dr. Nabil Hussein (Nephrology)</option>
                <option value="Dr. Priya Patel">Dr. Priya Patel (Pediatrics)</option>
                <option value="Dr. Sergey Ivanov">Dr. Sergey Ivanov (Radiology)</option>
                <option value="Dr. Hana Yamada">Dr. Hana Yamada (Rheumatology)</option>
            </select>

            <label for="appointment_date">Appointment Date:</label>
            <input type="date" id="appointment_date" name="appointment_date" required>

            <button type="submit">Submit</button>
        </form>
    </div>
</body>
<!--Copyright-->
<footer>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
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
    /* styles.css */
body {
    font-family: Arial, sans-serif;
    background-color: #f7f7f7;
    margin: 0;
    padding: 0;
}

.container {
    width: 100%;
    max-width: 600px;
    margin: 100px auto 50px; /* Added top margin to push the container down */
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    background-color:rgb(0, 255, 162);
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    margin-bottom: 20px;
}

form {
    display: flex;
    flex-direction: column;
}

label {
    margin-bottom: 5px;
}

input, select {
    margin-bottom: 15px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

button {
    padding: 10px;
    background-color: #007BFF;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button:hover {
    background-color: #0056b3;
}

</style>

<?php while ($row = mysqli_fetch_assoc($result)): ?>
    <tr>
        <td><?php echo htmlspecialchars($row['id']); ?></td>
        <td><a href="bsystem_details.php?name=<?php echo urlencode($row['patient_name']); ?>"><?php echo htmlspecialchars($row['patient_name']); ?></a></td>
        <td><?php echo htmlspecialchars($row['medical_condition']); ?></td>
        <td><?php echo htmlspecialchars($row['doctor_name']); ?></td>
        <td><?php echo htmlspecialchars($row['appointment_date']); ?></td>
        <td><?php echo htmlspecialchars($row['created_at']); ?></td>
    </tr>
<?php endwhile; ?>
