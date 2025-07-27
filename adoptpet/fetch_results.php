<?php
// Database connection parameters
$servername = "localhost";
$username = "adoptpet_db";
$password = "adoptpet_db";
$dbname = "adoptpet_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get filter parameters from the AJAX request
$category = $_GET['category'];
$gender = $_GET['gender'];
$breed = $_GET['breed'];
$pincode = $_GET['pincode'];


// Build SQL query based on filter parameters
// Build SQL query based on filter parameters
$sql = "SELECT * FROM animals WHERE category = '$category' AND gender = '$gender' AND breed = '$breed' AND pin_code = '$pincode'";


$result = $conn->query($sql);

// Check if there are any rows returned
if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        // Generate HTML for each animal profile
        echo '<div class="profile">';
        echo '<a href="animalprofile.php?id=' . $row["id"] . '">'; // Pass the ID as a query parameter
        echo '<img src="' . $row["image_path"] . '" alt="Profile">';
        echo '</a>';
        echo '<hr>';
        echo '<p>' . $row["animal_name"] . '</p>';
        echo '</div>';
    }
} else {
    echo "0 results";
}

// Close database connection
$conn->close();
?>
