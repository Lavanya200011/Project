<?php
    require("connection.php");
    session_start();
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $email = $_POST['email'];
        $password = $_POST['password'];

        // SQL query to check if the user exists
        $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // User exists, fetch user data
            $row = $result->fetch_assoc();
            $_SESSION['email'] = $row['email'];
           // Assuming 'name' is the column name for the user's name
            header("location:profilepage.php");
            // Display welcome message
            
        } else {
            // User not found or invalid credentials
            echo "<script>alert('Invalid email or password. Please try again');</script>";
        }
    }

    // Close the connection
    $conn->close();
    ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
   
    <script src="https://kit.fontawesome.com/f28a22a28f.js" crossorigin="anonymous"></script>
    <style>

    #bg-img{
    background-image: url("./images/pet5.jpg");
   background-repeat:no-repeat;
   background-size: cover;
    }

    body {
            
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url("./images/pet5.jpg");
    }
        


    header {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            background-color: #ffffff;
            padding: 15px 0; /* Adjust padding for header */
            border-bottom: #e8491d 3px solid;
            box-sizing: border-box; /* Ensure padding is included in width */
        }

        header .container2 {
            width: 80%;
            margin: auto;
            overflow: hidden;
            font: 15px/1.5 Arial, Helvetica, sans-serif;
        }

        header nav {
            float: right;
            margin-top: 4px;
        }

        header a {
            color: black;
            text-decoration: none;
            text-transform: uppercase;
            font-size: 16px;
            font-weight: bold;
        }

        header li {
            float: left;
            display: inline;
            padding: 0 20px;
        }

        header #branding {
            float: left;
        }

        header #branding h1 {
            margin: 0;
        }

        header .highlight,
        header .current a {
            color: black;
            font-weight: bold;
        }

        header a:hover {
            color: #cccccc;
            font-weight: bold;
        }

        button {
            background-color: rgb(3, 155, 0);
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 12px 24px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .container {
    padding-top: 25px;
    margin-left: 20px; /* Adjust left margin */
    
}


        .container {
            background-color: #ffffff87;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            width: 400px;
            max-width: 90%;
            
            animation: fadeIn 0.5s ease; /* Fade-in animation */
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .form-box {
            text-align: center;
        }

        #title {
            margin-bottom: 20px;
        }

        .input-field {
            margin-bottom: 20px;
            position: relative;
        }

        .input-field input {
            width: 94%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            padding-left: 40px;
        }

        .input-field i {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            color: #777;
        }

        .btn-field {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
          
            
           
        }

        .btn-field button {
            background-color: rgb(3,155,0);
            color: #fff;
            
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
            width: 48%; /* Adjusting button width */
         
            
        }

     
        .btn-field button:hover {
            background-color: rgb(3,155,0);
            color: #777;
            text-decoration:none;
        }

        p {
            margin-top: 15px;
            font-size: 14px;
            
        }

      a {
          
            text-decoration: none;
        }

        p a:hover {
            text-decoration: none;
        }
        #SignupBtn{
            text-decoration: none;
        }
    </style>
</head>
<body  id="bg-img">
<header>
    <div class="container2 position">
        <div id="branding">
            <h1><span class="highlight">Login</span></h1>
        </div>
        <nav>
            <ul>
                <li class="current"><a href="Home.php">Home</a></li>
                <li><a href="animalAdd.php">Add Animal</a></li>
                <li><a href="Vet1.php">Vet</a></li>
                <li><a href="donation.php">Donation</a></li>
                
                
            </ul>
        </nav>
    </div>
</header>


    <div class="container">
        <div class="form-box">
            <h1 id="title">Login</h1>
            <form action="login.php" method="post" id="login" >
                <div class="input-field">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" placeholder="Enter Email" required>
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Enter Password" required>
                </div>
                <p>Forget Password? <a href="forgetpassword.php" >Click Here</a></p>
                <div class="btn-field">
                    <button type="button" id="SignupBtn" onclick="window.location.href='signup.php'">Sign Up</a></button>
                    <button type="submit" id="SigninBtn" onclick="hide()">Login</button>
                    
                </div>
            </form>
        </div>
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
