<?php
// Database connection parameters
$servername = "localhost"; // Change this to your database server
$username = "adoptpet_db"; // Change this to your database username
$password = "adoptpet_db"; // Change this to your database password
$dbname = "adoptpet_db"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
