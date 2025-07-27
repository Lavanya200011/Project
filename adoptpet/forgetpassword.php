<?php
// To Remove unwanted errors
error_reporting(0);

// Start or resume a session
session_start();

// Add your connection Code
include "connection.php";

// Important Files (Please check your file path according to your folder structure)
require "./PHPMailer/src/PHPMailer.php";
require "./PHPMailer/src/SMTP.php";
require "./PHPMailer/src/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

// Function to send OTP via email
function sendMail($send_to, $otp, $name) {
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "tls";
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Enter your email ID
    $mail->Username = "girishkhedikar3399@gmail.com";
    $mail->Password = "lyfl gduo vzfk iuiv";

    // Your email ID and Email Title
    $mail->setFrom("girishkhedikar3399@gmail.com", "PetAdoption");

    $mail->addAddress($send_to);

    // You can change the subject according to your requirement!
    $mail->Subject = "Account Activation";

    // You can change the Body Message according to your requirement!
    $mail->Body = "Hello, {$name}\nYour account password reset OTP {$otp}.";

    try {
        $mail->send();
        return true;
    } catch (Exception $e) {
        echo "<script>alert('Failed to send OTP. Error: {$mail->ErrorInfo}');</script>";
        return false;
    }
}

// Function to store OTP in the database
function storeOTP($email, $otp) {
    global $conn;

    // Delete any existing OTP for this email
    $sql_delete = "DELETE FROM verification WHERE email = '$email'";
    $conn->query($sql_delete);

    // Insert new OTP into the database
    $sql_insert = "INSERT INTO verification (email, otp) VALUES ('$email', '$otp')";
    if ($conn->query($sql_insert) === TRUE) {
        return true;
    } else {
        return false;
    }
}

// Function to verify OTP and update user password
function verifyOTP($conn) {
    if (isset($_POST["submit-button"])) {
        $submitted_otp = $_POST["otp"];
        $email = $_POST["email"];
        $new_password = $_POST["new-password"];
        $confirm_password = $_POST["confirm-password"];

        // Retrieve the stored OTP from the database
        $sql_check = "SELECT * FROM verification WHERE email = '$email'";
        $result = $conn->query($sql_check);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
         
            $stored_otp = $row["otp"];

            if ($submitted_otp == $stored_otp) {
                // OTP is correct, update user password
                if ($new_password == $confirm_password) {
                    
                    $sql_update = "UPDATE users SET password = '$new_password' WHERE email = '$email'";
                    if ($conn->query($sql_update) === TRUE) {
                        // Password updated successfully
                        echo "<script>
                        alert('Password updated successfully. Proceed to login with the new password.');
                        window.location='login.php';
                        </script>";
                    } else {
                        echo "<script>alert('Error updating password.');</script>";
                    }
                } else {
                    echo "<script>alert('New password and confirm password do not match.');</script>";
                }
            } else {
                echo "<script>alert('Invalid OTP.');</script>";
            }
        } else {
            echo "<script>alert('Email not found.');</script>";
        }
    }
}

// Send OTP and store in the database if send-otp button is clicked
if (isset($_POST["send-otp"])) {
    $send_to_email = $_POST["email"];
    $verification_otp = mt_rand(100000, 999999);
    $send_to_name = "user"; // Set the name of the user if available

    if (sendMail($send_to_email, $verification_otp, $send_to_name)) {
        if (storeOTP($send_to_email, $verification_otp)) {
            $_SESSION["otp_sent"] = true;
            echo "<script>alert('OTP has been sent to your email.');</script>";
        } else {
            echo "<script>alert('Failed to store OTP. Please try again later.');</script>";
        }
    } else {
        echo "<script>alert('Failed to send OTP. Please try again later.');</script>";
    }
}

// Call the verifyOTP function
verifyOTP($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="forgetpassword.css">
<body>
<div class="container">
        <h1>Forgot Password</h1>
        <form id="forgot-password-form" method="post">
        <input type="email" id="email" name="email" placeholder="Enter your email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" required>
        <br>
            <button type="submit" name="send-otp" onclick="storeEmail()">Send OTP</button>
            <br>
            <input type="number" id="otp" name="otp" placeholder="Enter OTP" >
            <br>
            <input type="password" id="new-password" name="new-password" placeholder="New Password" >
            <br>
            <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm Password" >
            <br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <button type="cancel" id="cancel-button" name="cancel-button" ><a href="login.php"     style=" text-decoration: none; color:#fff;">Cancel</a></button>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <button type="submit" id="submit-button" name="submit-button">Submit</button>
        </form>
    </div>
</body>
</html>
