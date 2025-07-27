<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Handle form data
    $name = $_POST['name'];
    $breed = $_POST['breed'];
    $category = $_POST['category'];
    $age = $_POST['age'];
    $is_stray = isset($_POST['is_stray']) ? $_POST['is_stray'] : "No"; // Default to No if not set
    $pin_code = $_POST['pin_code'];
    $gender = isset($_POST['gender']) ? $_POST['gender'] : ""; // Handle if gender is not selected
    $description = $_POST['description'];

    // File upload handling
    $target_dir = "uploads/"; // Directory where images will be stored
    $target_file = $target_dir . basename($_FILES["animal_image"]["name"]);

// Prepare and bind SQL statement
$stmt = $conn->prepare("INSERT INTO animals (animal_name, breed, category, age, is_stray, pin_code, gender, description, image_path) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssisssss", $name, $breed, $category, $age, $is_stray, $pin_code, $gender, $description, $target_file);

// Execute the statement
if ($stmt->execute()) {
    echo "New record created successfully";
header("Location:animalADD.php");

} else {
    echo "Error: " . $stmt->error;
}

// Close statement
$stmt->close();

    // Move uploaded file to destination directory
    move_uploaded_file($_FILES["animal_image"]["tmp_name"], $target_file);
}
?>
