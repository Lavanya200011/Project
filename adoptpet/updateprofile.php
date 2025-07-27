<?php
session_start(); // Initialize session

if(isset($_POST["save"])){

    // Check if email is set in session
    if(!isset($_SESSION['email']) || empty($_SESSION['email'])) {
        die("Error: Email not found in session.");
    }

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

    // Get updated form data
    $name = $_POST['name'];
    $phone = $_POST['phone'];

    // Validate form data (example)
    if(empty($name) || empty($phone)) {
        die("Error: Name and phone cannot be empty.");
    }

    // Sanitize form data (example - use prepared statements for security)
    $name = $conn->real_escape_string($name);
    $phone = $conn->real_escape_string($phone);

    // Retrieve user information from the session
    $email = $_SESSION['email'];

    // Prepare SQL statement to update user information
    $sql = "UPDATE users SET name = '$name', mobile = '$phone' WHERE email = '$email'";

    // Execute SQL statement
    if ($conn->query($sql) === TRUE) {
        header("location:profilepage.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }

    // Close connection
    $conn->close();
}
?>
