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
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Debug output
    

    // SQL query
    $sql = "SELECT * FROM VetLogin WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    // Check if result is not empty
    if ($result->num_rows > 0) {
        echo "Login successful. Redirecting...";
        // Redirect
        header("Location: Vet_admin.php");
        exit();
    } else {
        // Display alert message
        echo "<script>alert('Invalid email or password.')</script>";
    }
}

// Close connection
$conn->close();
?>
