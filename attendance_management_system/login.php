<?php
session_start();

// Only run this if form was submitted via POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $_SESSION['loggedin'] = true;
    $_SESSION['email'] = $email; // Optional, store user info

    // Check if email and password were set in POST
    if (isset($_POST['email']) && isset($_POST['password'])) {

        $email = $_POST['email'];
        $password = $_POST['password'];

       

        // DB Connection
        $conn = new mysqli("localhost", "root", "", "attendance_db");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Query to check credentials
        $sql = "SELECT * FROM teacher WHERE email = ? AND password = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $email, $password); // s for string
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $_SESSION['email'] = $email;
            header("Location: main.php");
            exit();
        } else {
            // Show error message if login fails
            echo "<script>
                alert('Invalid email or password');
                window.location.href = 'login.html';
            </script>";
        }

        $stmt->close();
        $conn->close();

    } else {
        echo "Email or password not set in POST data.";
    }

} else {
    // Block direct GET access to this page
    header("Location: login.html");
    exit();
}
?>
