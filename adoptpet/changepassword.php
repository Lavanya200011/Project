<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Change Password</title>
<style>
    body {
        background-image: url("./images/pet1.jpg");
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
    
    .container {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        width: 90%;
        max-width: 400px;
    }
    
    .container h2 {
        margin-top: 0;
    }
    
    .form-group {
        margin-bottom: 15px;
    }
    
    .form-group label {
        display: block;
        margin-bottom: 5px;
    }
    
    .form-group input {
        width: 95%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }
    
    .btn-container {
        display: flex;
        justify-content: space-between;
    }

    .btn {
        background-color: rgb(3,155,0);
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 3px;
        cursor: pointer;
        width: calc(50% - 5px); /* Adjust width to allow space between buttons */
    }
    
    .btn:hover {
        background-color: #0056b3;
    }

    .cancel-btn {
        background-color: rgb(3,155,0);/* Adjust color as needed */
    }

    @media only screen and (max-width: 600px) {
        .container {
            width: 100%;
            max-width: none;
        }
    }
</style>
</head>
<body>

<div class="container">
    <center>
    <h2>Change Password</h2>
    </center>
    <form action="#" method="post">
        <div class="form-group">
            <input type="password" id="old-password" name="old-password" placeholder=" old password" required>
        </div>
        <div class="form-group">
            <input type="password" id="new-password" name="new-password" placeholder=" new password" required>
        </div>
        <div class="form-group">
            <input type="password" id="confirm-password" name="confirm-password" placeholder=" confirm password" required>
        </div>
        <div class="btn-container">
            <button type="button" class="btn cancel-btn" onclick="window.location.href='profilepage.php'">Cancel</button>
            <button type="submit" class="btn">Submit</button>
        </div>
    </form>
</div>

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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $oldPassword = $_POST['old-password'];
    $newPassword = $_POST['new-password'];
    $confirmPassword = $_POST['confirm-password'];

    // Check if the new password matches the confirm password
    if ($newPassword !== $confirmPassword) {
        echo "<script>alert('New password and confirm password do not match. Please try again.')</script>";
    } else {
        // Update password in the database
        // Example query: UPDATE users SET password = '$newPassword' WHERE password = '$oldPassword'
        // Make sure to use proper SQL escaping and hashing methods in a real-world scenario to prevent SQL injection and enhance security
        $sql = "UPDATE users SET password = '$newPassword' WHERE password = '$oldPassword'";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Password updated successfully.')</script>";
        } else {
            echo "Error updating password: " . $conn->error;
        }
    }
}

// Close the connection
$conn->close();
?>
</body>
</html>
