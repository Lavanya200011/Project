<?php
    $servername = "localhost";
$username = "adoptpet_db";
$password = "adoptpet_db";
$dbname = "adoptpet_db";

// Establish connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_name = $_POST['admin_name'];
    $password = $_POST['password'];

    // Debug output
    

    // SQL query
    $sql = "SELECT admin_name, password FROM admin_info WHERE admin_name = '$admin_name' AND password = '$password'";
    $result = $conn->query($sql);

    // Check if result is not empty
    if ($result->num_rows > 0) {
        echo "Login successful. Redirecting...";
        // Redirect
        header("Location:applications_form.php");
        exit();
    } else {
        // Display alert message
        echo "<script>alert('Invalid email or password.')</script>";

    }
}

// Close connection
$conn->close();
?>