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
    $mail->Body = "Hello, {$name}\nYour account activation OTP {$otp}.";
    
    if ($mail->send()) {
        return true;
    } else {
        return false;
    }
}

// Function to store OTP in the database
function storeOTP($email, $otp, $name) {
    global $conn;

    // Check if the email already exists in the verification table
    $sql_check = "SELECT * FROM verification WHERE email = '$email'";
    $result = $conn->query($sql_check);

    if ($result->num_rows > 0) {
        // Email exists, update the OTP value
        $sql_update = "UPDATE verification SET otp = '$otp' WHERE email = '$email'";
        if ($conn->query($sql_update) === TRUE) {
            // OTP updated successfully
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        // Email does not exist, insert a new record
        $sql_insert = "INSERT INTO verification (otp, email, name) VALUES ('$otp', '$email', '$name')";
        if ($conn->query($sql_insert) === TRUE) {
            // User data stored successfully
            echo "<script>
            alert('otp send successfully');
                   
        
                 </script>";
        } else {
            if($conn->error){
                echo "Email is already link with another account.Proceed to login or signup with another account";
            }
        }
    }
}

// Function to verify OTP and store user data
function verifyOTP($conn) {
    if (isset($_POST["signupButton"])) {
        // Get the submitted OTP and other form data
        $submitted_otp = $_POST["otp"];
        $email = $_POST["Email"];

        // Retrieve the stored OTP from the database
        $sql_check = "SELECT * FROM verification WHERE email = '$email'";
        $result = $conn->query($sql_check);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $stored_otp = $row["otp"];
            // Compare submitted OTP with stored OTP
            if ($submitted_otp == $stored_otp) {
                // OTP is correct, store user data in the users table
                $name = $row["name"];
                $password = $_POST["create-password"];
                $mobile = $_POST["mob-no"];
                // Insert user data into the users table
                $sql_insert_user = "INSERT INTO users (email, name,mobile, password) VALUES ('$email', '$name','$mobile', '$password')";
                if ($conn->query($sql_insert_user) === TRUE) {
                    // User data stored successfully
                    echo "<script>alert('Signup successful. proceed to login');</script>";
                    
                    header("location:login.php");
                } else {
                    if($conn->error){
                        echo "Email is already link with another account.Proceed to login or signup with another account";
                    }
                    
                }
            } else {
                // Invalid OTP
                echo "<script>alert('Invalid OTP.');</script>";
            }
        } else {
            // Email not found in the verification table
            echo "<script>alert('Email not found.');</script>";
        }
    }
}

// Send OTP and store in the database if send-otp button is clicked
if (isset($_POST["send-otp"])) {
    $send_to_email = $_POST["Email"];
    $verification_otp = mt_rand(100000, 999999);
    $send_to_name = $_POST["name"];

    if (sendMail($send_to_email, $verification_otp, $send_to_name)) {
        storeOTP($send_to_email, $verification_otp, $send_to_name);
        $_SESSION["otp_sent"] = true;
        echo "<script>alert('OTP has been sent to your email.');</script>";
    } else {
        echo "<script>alert('Failed to send OTP. Please try again later.');</script>";
    }
}

// Call the verifyOTP function
verifyOTP($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sign Up Page</title>
    <link rel="stylesheet" href="signup.css">
    <script>
      
    </script>
</head>
<body>
    <div class="container">
        <h1 id="sign-up">Sign Up</h1>
        <p id="err-msg"></p>
       
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" name="sign-up-form" onsubmit="return validateForm()">
    <br>
    <input type="email" placeholder="Enter Email" name="Email" <?php if(isset($_SESSION["otp_sent"])) { echo 'value="'.$_POST["Email"].'"'; } ?> >
    <input type="text" name="name" placeholder="Enter name " <?php if(isset($_SESSION["otp_sent"])) { echo 'value="'.$_POST["name"].'"'; } ?>>
    <br> 
    <button  name="send-otp" id="send-otp" onclick="hideSendOTP()">Send otp</button>
    <input type="number" placeholder="Enter Mobile Number" name="mob-no" >
    <input type="text" placeholder="Enter OTP" name="otp" >
    <input type="password" placeholder=" Create Password" name="create-password" >
    <input type="password" placeholder="Confirm Password" name="confirm-password" >
    <button id="signupButton" type="submit" name="signupButton">Sign Up</button>
</form>

        <p>Already have an account? <a href="login.php" style="text-decoration:none;">Log in</a></p>
    </div>


    
<footer>
<style>
    /* General styling */
    

    /* Button styling */
    .chat-button {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background-image: url('Chatlogo.png'); 
        background-size: cover;
        color: #fff;
        border: none;
        border-radius: 50%;
        width: 70px;
        height: 70px;
        font-size: 1.2rem;
        cursor: pointer;
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .chat-button:hover {
        transform: scale(1.35);
        box-shadow: 0 0 20px rgba(0, 0, 0, 1);
    }

    /* Popup styling */
    .chat-popup {
        display: none;
        position: fixed;
        bottom: 90px;
        right: 20px;
        width: 300px;
        border-radius: 20px;
        background-color: #fff;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        z-index: 9998;
        max-height: calc(100vh - 120px); /* Set maximum height */
        overflow-y: auto;
    }

    .chat-popup-header {
        background-color: rgb(3, 155, 0); /* Dark green */
        color: #fff;
        padding: 15px;
        border-top-left-radius: 20px;
        border-top-right-radius: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .chat-popup-header h3 {
        margin: 0;
        font-size: 1.2rem;
    }

    .chat-popup-body {
        padding: 15px;
    }

    .chat-popup-footer {
        padding: 15px;
        border-top: 1px solid #ccc;
    }

    .chat-input {
        width: calc(100% - 10px);
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-right: 5px;
    }

    .chat-option {
        background-color: rgb(3, 155, 0); /* Dark green */
        color: #fff;
        border: none;
        padding: 8px 15px;
        border-radius: 5px;
        margin-right: 5px;
        margin-bottom: 5px;
        cursor: pointer;
        display: block;
        width: 100%; /* Ensure buttons occupy full width */
        text-align: left;
    }

    /* Chat message styling */
    .chat-message {
        padding: 8px 15px;
        border-radius: 5px;
        margin-bottom: 5px;
    }

    .user-message {
        background-color: rgb(3, 155, 0); /* Dark green */
        color: #fff;
        float: right;
    }

    .bot-message {
        background-color: #f8f8f8;
        color: #000;
        float: left;
    }

    /* Cancel button */
    #close-chat {
        background-color: transparent;
        border: bold;
        color: #fff;
        cursor: pointer;
        font-size: 1.2rem;
    }

    #close-chat:hover {
        color: #f00;
    }
</style>
</head>
<body>
<!-- Button for opening and closing chat -->
<div class="chat-button" id="open-chat"></div>

<!-- Chat pop-up -->
<div class="chat-popup" id="chat-popup">
    <div class="chat-popup-header">
        <h3>Pet Bot</h3>
        <button id="close-chat">✕</button>
    </div>
    <div class="chat-popup-body" id="chat-popup-body">
        <div class="chat-message bot-message">Hello! How can I assist you today?</div>
    </div>
    <div class="chat-popup-footer">
        <button class="chat-option" id="option-1">About The Website</button>
        <button class="chat-option" id="option-2">How to adopt a pet</button>
        <button class="chat-option" id="option-3">Login & Profile</button>
        <button class="chat-option" id="option-4">Donation & Anonymous Donation</button>
        <button class="chat-option" id="option-5"> Vet Appointment</button>
        <button class="chat-option" id="option-6">Technical support</button>
        <!-- Add more options as needed -->
    </div>
</div>

<script>
    var chatPopup = document.getElementById('chat-popup');

    // Button click event to open and close chat pop-up
    document.getElementById('open-chat').addEventListener('click', function() {
        if (chatPopup.style.display === 'block') {
            chatPopup.style.display = 'none';
        } else {
            chatPopup.style.display = 'block';
        }
    });

    // Button click event to close chat pop-up
    document.getElementById('close-chat').addEventListener('click', function() {
        chatPopup.style.display = 'none';
    });

    // Event listeners for option buttons
    document.getElementById('option-1').addEventListener('click', function() {
        handleChat('About The Website');
    });
    document.getElementById('option-2').addEventListener('click', function() {
        handleChat('How to adopt a pet');
    });
    document.getElementById('option-3').addEventListener('click', function() {
        handleChat('Login & Profile');
    });
    document.getElementById('option-4').addEventListener('click', function() {
        handleChat('Donation & Anonymous Donation');
    });
    document.getElementById('option-5').addEventListener('click', function() {
        handleChat('Vet Appointment');
    });
    document.getElementById('option-6').addEventListener('click', function() {
        handleChat('Technical support');
    });

    // Function to handle user input and bot responses
    function handleChat(userSelection) {
        appendMessage('user', userSelection);
        // Call a function to generate bot's response based on user selection
        setTimeout(function() {
            generateResponse(userSelection);
        }, 500);
    }

    // Function to append messages to chat pop-up
    function appendMessage(sender, message) {
        var chatPopupBody = document.getElementById('chat-popup-body');
        var messageClass = (sender === 'user') ? 'user-message' : 'bot-message';
        var messageDiv = document.createElement('div');
        messageDiv.className = 'chat-message ' + messageClass;
        messageDiv.textContent = message;
        chatPopupBody.appendChild(messageDiv);
        chatPopupBody.scrollTop = chatPopupBody.scrollHeight;
    }

    // Function to generate bot response based on user selection
    function generateResponse(userSelection) {
        var response;
        switch (userSelection) {
            case 'About The Website':
                response = "Welcome to our site, dedicated to pet adoption, donations, and veterinary services. Find your furry friend and support their well-being!";
                break;
            case 'How to adopt a pet':
                response = "You can adopt a pet from the home page by applying filters, Now select a pet you want to adopt you will be able to adopt it. ";
                break;
            case 'Login & Profile':
                response = "With the help of login & profile only verified user can be present for adoption and safety will be there while adopting a pet.";
                break;
            case 'Donation & Anonymous Donation':
                response = "Donation's plays a important role in improving the quality of life for the animal, NGO's ,Organization, etc will be helped with your contribution.";
                break;
            case 'Vet Appointment':
                response = "Verified & profesional Vet's are availabe for your pet's services. You can take Appointment for your pets by visting Vet section. ";
                break;
            case 'Technical support':
                response = "You can contact with the team by visiting Contact Us page you have to fill the contact form and our team will contact you shortly.";
                break;
            default:
                response = "I'm sorry, I couldn't understand that. Please select one of the options provided.";
        }
        appendMessage('bot', response);
    }
</script>

</footer>
</body>
</html>
