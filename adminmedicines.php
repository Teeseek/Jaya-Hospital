<?php
include("db_connect.php"); // Include your database connection file

// Handle form submission for adding a new medicine
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_medicine'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $price = mysqli_real_escape_string($con, $_POST['price']);
    
    // Handle image upload
    $image_filename = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image_filename = basename($_FILES['image']['name']);
        $target_file = 'Images/' . $image_filename;
        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
    }

    $sql = "INSERT INTO medicines (name, description, price, image_filename) VALUES ('$name', '$description', '$price', '$image_filename')";
    mysqli_query($con, $sql);
}

// Handle form submission for editing an existing medicine
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_medicine'])) {
    $medicine_id = mysqli_real_escape_string($con, $_POST['medicine_id']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $price = mysqli_real_escape_string($con, $_POST['price']);
    
    // Handle image upload
    $image_filename = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image_filename = basename($_FILES['image']['name']);
        $target_file = 'Images/' . $image_filename;
        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
        $sql = "UPDATE medicines SET name='$name', description='$description', price='$price', image_filename='$image_filename' WHERE id='$medicine_id'";
    } else {
        $sql = "UPDATE medicines SET name='$name', description='$description', price='$price' WHERE id='$medicine_id'";
    }
    
    mysqli_query($con, $sql);
}

// Search functionality
$search_query = '';
if (isset($_GET['search'])) {
    $search_query = mysqli_real_escape_string($con, $_GET['search']);
}

$sql = "SELECT * FROM medicines WHERE name LIKE '%$search_query%' OR description LIKE '%$search_query%'";
$result = mysqli_query($con, $sql);

// Fetch a single medicine if editing
$edit_medicine = null;
if (isset($_GET['edit_id'])) {
    $edit_id = mysqli_real_escape_string($con, $_GET['edit_id']);
    $edit_result = mysqli_query($con, "SELECT * FROM medicines WHERE id='$edit_id'");
    $edit_medicine = mysqli_fetch_assoc($edit_result);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Medicines</title>
    <style>
        * {
        font-family: "Kumbh Sans", sans-serif;
        text-decoration: none;
        }
        body {
            display: flex;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .navbar {
            width: 200px;
            background-color: #111;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            height: 100vh;
            position: fixed;
        }
        .navbar header{
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
        .form-container, .edit-form-container {
            margin-top: 20px;
            padding: 20px;
            background-color: #fff;
            border: 2px solid #4CAF50;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: none; /* Hidden by default */
            position: relative;
        }
        .form-container input, .form-container textarea, 
        .edit-form-container input, .edit-form-container textarea {
            display: block;
            margin-bottom: 10px;
            padding: 10px;
            width: calc(100% - 20px); /* Adjusted to match padding */
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .form-container input[type="submit"], 
        .edit-form-container input[type="submit"] {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            border-radius: 5px;
        }
        .form-container input[type="submit"]:hover, 
        .edit-form-container input[type="submit"]:hover {
            background-color: #45a049;
        }
        .add-button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 24px;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            text-align: center;
            line-height: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .add-button:hover {
            background-color: #45a049;
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
        .search-container {
            margin-bottom: 20px;
        }
        .search-container input[type="text"] {
            padding: 10px;
            width: 100%;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
        }
        .search-container input[type="submit"] {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
            margin-top: 10px;
        }
        .search-container input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
    <script>
        function showEditForm(medicineId, name, description, price, image) {
            document.getElementById("edit-form").style.display = "block";
            document.getElementById("edit_medicine_id").value = medicineId;
            document.querySelector("#edit-form [name='name']").value = name;
            document.querySelector("#edit-form [name='description']").value = description;
            document.querySelector("#edit-form [name='price']").value = price;
            // No way to pre-set file input value, just a placeholder or preview can be shown
        }

        function hideEditForm() {
            document.getElementById("edit-form").style.display = "none";
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
        <h1>Manage Medicines</h1>

        <!-- Search Bar -->
        <div class="search-container">
            <form action="" method="get">
                <input type="text" name="search" placeholder="Search medicines..." value="<?php echo htmlspecialchars($search_query); ?>">
                <input type="submit" value="Search">
            </form>
        </div>

        <!-- Edit Form (hidden by default, visible when editing) -->
        <div class="edit-form-container" id="edit-form">
            <button class="close-button" onclick="hideEditForm()">×</button>
            <h2>Edit Medicine</h2>
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" id="edit_medicine_id" name="medicine_id">
                <input type="text" name="name" placeholder="Medicine Name" required>
                <textarea name="description" placeholder="Description"></textarea>
                <input type="number" name="price" placeholder="Price" step="0.01" required>
                <input type="file" name="image">
                <input type="submit" name="edit_medicine" value="Update Medicine">
            </form>
        </div>

        <!-- Display the list of medicines -->
        <h2>Medicine List</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['description']); ?></td>
                        <td><?php echo htmlspecialchars($row['price']); ?></td>
                        <td>
                            <?php if ($row['image_filename']): ?>
                                <img src="Images/<?php echo htmlspecialchars($row['image_filename']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>" style="width: 100px;">
                            <?php else: ?>
                                No Image
                            <?php endif; ?>
                        </td>
                        <td><a href="#" onclick="showEditForm(<?php echo $row['id']; ?>, '<?php echo htmlspecialchars(addslashes($row['name'])); ?>', '<?php echo htmlspecialchars(addslashes($row['description'])); ?>', '<?php echo htmlspecialchars($row['price']); ?>', '<?php echo htmlspecialchars($row['image_filename']); ?>')">Edit</a></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Form to add new medicine -->
        <button class="add-button" onclick="document.getElementById('form-container').style.display = 'block'">+</button>
        <div class="form-container" id="form-container">
            <button class="close-button" onclick="document.getElementById('form-container').style.display = 'none'">×</button>
            <h2>Add Medicine</h2>
            <form action="" method="post" enctype="multipart/form-data">
                <input type="text" name="name" placeholder="Medicine Name" required>
                <textarea name="description" placeholder="Description"></textarea>
                <input type="number" name="price" placeholder="Price" step="0.01" required>
                <input type="file" name="image">
                <input type="submit" name="add_medicine" value="Add Medicine">
            </form>
        </div>
    </div>
</body>
</html>
