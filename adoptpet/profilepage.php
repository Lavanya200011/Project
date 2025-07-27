<?php
require("connection.php");
session_start();


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user information from the database
$email = $_SESSION['email']; // Assuming you store the email in the session after login
$sql = "SELECT * FROM users WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // User exists, fetch user data
    $row = $result->fetch_assoc();
    $name = $row['name'];
    $phone = $row['mobile'];
    $profile_image_path= $row['profile_image'];
    // Add more fields as needed

    // Close the result set
    $result->close();
} else {
    // Handle the case where user data is not found
    echo "User data not found.";
}

// Close the connection
$conn->close();
?>



<!DOCTYPE html>
<html>
<head>
    <title>Profile Page</title>
    <link rel="stylesheet" href="profilepage.css">
    <script src="profilepage.js"></script>
</head>
<body>

<header>
    <div class="container position">
        <div id="branding">
            <h1><span class="highlight">My profile</span><img src="logo.png" alt=""></h1>
        </div>
        <nav>
            <ul>
            <li><a href="home.php?loggedin=true">Home</a></li>
                <li class="current"><a href="#profile-info">personal details</a></li>
                <li><a href="applicationform.php">Apply for adoption</a></li>
                <li><a href="changepassword.php">Change password</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </div>
</header>
<br><br>

<div class="container">
    <div class="profile-image" onclick="displayIcon()">
        <br>
        <img id="uploadedImage" src="<?php echo $profile_image_path;?>" alt="Uploaded Image" style="display: block; width: 200px; height: 200px;">
        <br><br><br><br>
        <div class="upload-form">
            <form name="imageUploadForm" id="imageUploadForm" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input type="file" id="profileImageInput" name="profile_image" accept="image/*" onchange="previewImage(event)">
                <label for="profileImageInput"><i class="camera-icon">&#128247;</i></label>
                <button type="submit">Upload</button>
            </form>
        </div>
    </div>

    <div class="profile-info" id="profile-info">
        <h2>Personal Details</h2>
        <form id="profile-info1" method="post" action="updateprofile.php">
            <div class="info-box">
                <strong>Name:</strong><input type="text" name="name" value="<?php echo $name ?>" readonly>
            </div>
            <div class="info-box">
                <strong>Email:</strong><input type="email" name="email" value="<?php echo $email; ?>" readonly>
            </div>
            <div class="info-box">
                <strong>Phone:</strong><input type="text" name="phone" value="<?php echo $phone; ?>" readonly>
            </div>
            <br><br>
            <center>
            <div class="info-edit">
                <button id="edit" type="button" name="edit" onclick="toggleEdit()">Edit</button>
                <button id="save" type="submit" name="save"  onclick="saveChanges()" style="display: none;">Save</button>
            </div>
            </center>
    </div>
</div>
<br><br><br><br>


<center>
    <h2>Payment History</h2>
    <ul>
        <li><a href="payment_history.html">View Payment History</a></li>
    </ul>
</center>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection parameters
    $servername = "localhost";
    $username = "adoptpet_db";
    $password = "adoptpet_db";
    $database = "adoptpet_db";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // File upload directory
    $target_dir = "upload_profile_image/";

    // Upload profile image
    $profile_image_file = basename($_FILES['profile_image']['name']);
    $profile_image_path = $target_dir . $profile_image_file;
    move_uploaded_file($_FILES['profile_image']['tmp_name'], $profile_image_path);

    // Retrieve user information from the database
$email = $_SESSION['email']; // Assuming you store the email in the session after login

    // Prepare SQL statement to insert profile image path into the database
    $sql = "UPDATE users SET profile_image = '$profile_image_path' WHERE email = '$email'";

    // Execute SQL statement
    if ($conn->query($sql) === TRUE) {
        header("location:profilepage.php");
        // Image path updated successfully
        $conn->close();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>
</body>
</html>
