<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jaya Hospital</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@100..900&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: "Kumbh Sans", sans-serif;
            text-decoration: none;
        }
        /* Nav */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background: rgb(0, 255, 162);
            font-family: sans-serif;
            padding-right: 15px;
            padding-left: 15px;
            padding-top: 10px;
            padding-bottom: 20px;
            z-index: 1000;
        }
        .navdiv {
            display: flex;
            align-items: center;
            justify-content: space-between; /* Distributes space evenly between items */
            margin-right: 550px;
        }
        .logo {
            flex-shrink: 0; /* Prevents the logo from shrinking */
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
        .search-bar-container {
            margin-top: 100px; /* Adjust based on the height of your navbar */
            text-align: center;
            padding: 20px;
        }
        .search-bar {
            width: 100%;
            max-width: 600px;
            padding: 10px;
            border: 2px solid rgb(0, 255, 162);
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }
        .title {
            width: 90%;
            color: rgb(0, 255, 162);
            position: relative;
            text-align: center;
            top:15%;
            left: 5%;
            margin-top: 20px;
        }
        .title h2 {
            font-size: 60px;
        }
        .container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            width: 100%;
            max-width: 1200px;
            margin: 20px auto; /* Center align and add some margin */
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
        /* For Footer */
        h1, h2, h3, p, a {
            margin: 15px 0;
        }
        a {
            color: black;
        }
        a:hover {
            cursor: auto;
        }
        .contain, .cont {
            display: flex;
            justify-content: space-evenly;
        }
        .wrap {
            display: inline;
            justify-content: space-around;
            align-items: center;
        }
        body {
            background: linear-gradient(rgba(255, 254, 254, 0.5), rgba(0, 0, 0, 0.5)), url('bgaboutus.png');
        }

/* Media Queries */
@media screen and (max-width: 600px) {
    .navbar{
    padding-right: 0px;
    padding-left: 0px;
    }
    .navdiv {
    margin-right: 0px;
    }
    .logo img{
    width: 85px;
    }
    .navdiv li {
    padding: 0px;
    }
    .navdiv li a {
    font-size: 12px;
    margin-right:8px;
    }
    
    li a:hover {
    font-size: 10%;
    }
    h1{
        font-size: 22px;
    }
    h2{
    font-size: 20px;
    }
}
    </style>
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

    <!-- Search Bar -->
    <div class="search-bar-container">
        <input type="text" id="searchBar" class="search-bar" placeholder="Search for doctors...">
    </div>

    <div class="title">
        <h2>Meet our doctors!</h2>
    </div>

    <div class="container" id="doctorContainer">
                <?php
        include 'db_connect.php';  // Connect to your database

        $sql = "SELECT * FROM doctors";  // Query to fetch doctor details
        $result = mysqli_query($con, $sql);  // Execute query

        // Loop through the result set and display each doctor's profile
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
                </div>
            </div>';
        }
        ?>
    </div>

    <footer>
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
        <br>
        <hr>
    </footer>

    <script>
        document.getElementById('searchBar').addEventListener('input', function() {
            var searchTerm = this.value.toLowerCase();
            var cards = document.querySelectorAll('.profile-card');

            cards.forEach(function(card) {
                var name = card.querySelector('.info h2').textContent.toLowerCase();
                var bio = card.querySelector('.info p').textContent.toLowerCase();
                
                if (name.includes(searchTerm) || bio.includes(searchTerm)) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>
