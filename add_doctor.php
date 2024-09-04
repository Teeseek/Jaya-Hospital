<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add/Edit Doctor</title>
    <style>
        /* Existing styles */
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
        h2 {
            font-size: 1.8em;
            color: #333;
            margin-bottom: 20px;
        }
        .toggle-form-button {
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
            margin-bottom: 20px;
            margin-left: 225px;
        }
        .toggle-form-button:hover {
            background-color: #45a049;
        }
        .form-container {
            display: none;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
            position: relative;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="file"],
        textarea {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        textarea {
            resize: vertical;
        }
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .error-message {
            color: red;
            margin-top: 10px;
        }
        .success-message {
            color: green;
            margin-top: 10px;
        }
        .container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            width: 100%;
            max-width: 1200px;
            margin: 20px auto;
        }
        .profile-card {
            background-color: #1a1a2e;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            color: #fff;
            text-align: center;
            transition: transform 0.3s ease;
        }
        .profile-card:hover {
            background-color: #1a1a2e;
            transition: transform 0.3s ease;
            transform: scale(1.03);
        }
        .profile-card img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }
        .info {
            padding: 15px;
        }
        .info h2 {
            font-size: 1.5em;
            margin-bottom: 10px;
            color: #ff4757;
        }
        .info p {
            margin-bottom: 5px;
        }
        .info p strong {
            font-weight: bold;
        }
        .close-button {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #f44336;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            text-align: center;
            line-height: 20px;
            font-size: 16px;
            font-weight: bold;
        }
        .close-button:hover {
            background-color: #e53935;
        }
        
        /* Search bar styles */
        .search-container {
            max-width: 600px;
            margin: 20px auto;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .search-container input[type="text"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .search-container button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            margin-left: 10px;
            cursor: pointer;
            font-size: 16px;
        }
        .search-container button:hover {
            background-color: #45a049;
        }
    </style>
    <script>
        function toggleForm() {
            var form = document.getElementById("formContainer");
            if (form.style.display === "none" || form.style.display === "") {
                form.style.display = "block";
            } else {
                form.style.display = "none";
            }
        }

        function showEditForm(id, name, gender, ethnicity, specialized_area, languages_spoken, bio, image) {
            document.getElementById("editFormContainer").style.display = "block";
            document.getElementById("edit_id").value = id;
            document.getElementById("edit_name").value = name;
            document.getElementById("edit_gender").value = gender;
            document.getElementById("edit_ethnicity").value = ethnicity;
            document.getElementById("edit_specialized_area").value = specialized_area;
            document.getElementById("edit_languages_spoken").value = languages_spoken;
            document.getElementById("edit_bio").value = bio;
            document.getElementById("edit_current_image").src = 'doctor/' + image;
        }

        function hideEditForm() {
            document.getElementById("editFormContainer").style.display = "none";
        }

        function searchDoctors() {
            let input, filter, cards, cardContainer, h2, i, txtValue;
            input = document.getElementById("doctorSearch");
            filter = input.value.toUpperCase();
            cardContainer = document.getElementById("doctorContainer");
            cards = cardContainer.getElementsByClassName("profile-card");
            for (i = 0; i < cards.length; i++) {
                h2 = cards[i].querySelector(".info h2");
                txtValue = h2.textContent || h2.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    cards[i].style.display = "";
                } else {
                    cards[i].style.display = "none";
                }
            }
        }
    </script>
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
        <!-- Search Bar -->
        <div class="search-container">
            <input type="text" id="doctorSearch" onkeyup="searchDoctors()" placeholder="Search for doctors by name...">
            <button onclick="searchDoctors()">Search</button>
        </div>

        <!-- Add New Doctor Form -->
        <button class="toggle-form-button" onclick="toggleForm()">+ Add New Doctor</button>
        <div id="formContainer" class="form-container">
            <button class="close-button" onclick="toggleForm()">X</button>
            <form action="add_doctor.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="gender">Gender:</label>
                    <input type="text" id="gender" name="gender" required>
                </div>
                <div class="form-group">
                    <label for="ethnicity">Ethnicity:</label>
                    <input type="text" id="ethnicity" name="ethnicity" required>
                </div>
                <div class="form-group">
                    <label for="specialized_area">Specialized Area:</label>
                    <input type="text" id="specialized_area" name="specialized_area" required>
                </div>
                <div class="form-group">
                    <label for="languages_spoken">Languages Spoken:</label>
                    <input type="text" id="languages_spoken" name="languages_spoken" required>
                </div>
                <div class="form-group">
                    <label for="bio">Bio:</label>
                    <textarea id="bio" name="bio" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <label for="image">Profile Image:</label>
                    <input type="file" id="image" name="image" accept="image/*" required>
                </div>
                <input type="submit" value="Add Doctor">
            </form>
        </div>

        <!-- Edit Doctor Form -->
        <div id="editFormContainer" class="form-container">
            <button class="close-button" onclick="hideEditForm()">X</button>
            <form action="edit_doctor.php" method="post" enctype="multipart/form-data">
                <input type="hidden" id="edit_id" name="edit_id">
                <div class="form-group">
                    <label for="edit_name">Name:</label>
                    <input type="text" id="edit_name" name="edit_name" required>
                </div>
                <div class="form-group">
                    <label for="edit_gender">Gender:</label>
                    <input type="text" id="edit_gender" name="edit_gender" required>
                </div>
                <div class="form-group">
                    <label for="edit_ethnicity">Ethnicity:</label>
                    <input type="text" id="edit_ethnicity" name="edit_ethnicity" required>
                </div>
                <div class="form-group">
                    <label for="edit_specialized_area">Specialized Area:</label>
                    <input type="text" id="edit_specialized_area" name="edit_specialized_area" required>
                </div>
                <div class="form-group">
                    <label for="edit_languages_spoken">Languages Spoken:</label>
                    <input type="text" id="edit_languages_spoken" name="edit_languages_spoken" required>
                </div>
                <div class="form-group">
                    <label for="edit_bio">Bio:</label>
                    <textarea id="edit_bio" name="edit_bio" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <label>Current Profile Image:</label>
                    <img id="edit_current_image" src="" alt="Current Image" style="max-width: 100px; max-height: 100px;">
                </div>
                <div class="form-group">
                    <label for="edit_image">New Profile Image (optional):</label>
                    <input type="file" id="edit_image" name="edit_image" accept="image/*">
                </div>
                <input type="submit" value="Update Doctor">
            </form>
        </div>

        <!-- Doctor Profiles -->
        <div id="doctorContainer" class="container">
            <!-- PHP code to dynamically generate doctor profiles here -->
            <?php
            include 'db_connect.php';
            $sql = "SELECT * FROM doctors";
            $result = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                echo '
                <div class="profile-card">
                    <img src="doctor/' . $row['profile_img'] . '" alt="Doctor Image">
                    <div class="info">
                        <h2>' . $row['name'] . '</h2>
                        <p><strong>Gender:</strong> ' . $row['gender'] . '</p>
                        <p><strong>Ethnicity:</strong> ' . $row['ethnicity'] . '</p>
                        <p><strong>Specialized Area:</strong> ' . $row['specialized_area'] . '</p>
                        <p><strong>Languages Spoken:</strong> ' . $row['languages_spoken'] . '</p>
                        <p><strong>Bio:</strong> ' . $row['bio'] . '</p>
                        <button onclick="showEditForm(' . $row['id'] . ', \'' . $row['name'] . '\', \'' . $row['gender'] . '\', \'' . $row['ethnicity'] . '\', \'' . $row['specialized_area'] . '\', \'' . $row['languages_spoken'] . '\', \'' . $row['bio'] . '\', \'' . $row['profile_img'] . '\')">Edit</button>
                    </div>
                </div>';
            }
            ?>
        </div>
    </div>
</body>
</html>