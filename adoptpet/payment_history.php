<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Information</title>
</head>
<body>
    <style>



        body {
            font-family: Arial, sans-serif;
            background-image: url(payment_history.jpg);
            background-size:cover;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 400px;
            width: 100%;
        }

        h1 {
            margin-bottom: 20px;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            margin-bottom: 10px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"],input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: rgb(3, 155, 0);;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 12px 24px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 8px;
    border-bottom: 1px solid #ddd;
    text-align: left;
}

th {
    background-color: #f2f2f2;
}


body {
            margin: 0; /* Remove default margin */
            padding-top: 80px; /* Adjust padding for fixed navbar */
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

        .container2 {
            padding-top: 7px; 
            padding-bottom: 10px;
        }


    </style>
</head>

<body>
<header>
    <div class="container2 position">
        <div id="branding">
            <h1><span class="highlight">Animal Adoption</span><img src="logo.png" alt=""></h1>
        </div>
        <nav>
            <ul>
                <li class="current"><a href="Home.php">Home</a></li>
                <li><a href="animalAdd.php">Add Animal</a></li>
                <li><a href="Vet2.php">Vet</a></li>
                <li><a href="donation.php">Donation</a></li>
                
                
            </ul>
        </nav>
    </div>
</header>





    <div class="container">
        <h1>Donation History</h1>
        <form method="post">
    <label for="code">Enter Donation Code:</label>
    <input type="text" id="code" name="code">
    <center><h4>OR</h4></center>
    <label for="phone">Enter Phone Number:</label>
    <input type="text" id="phone" name="phone">
    <button type="submit">Get Payment Information</button>
    <h6>---Not Available For Anonymous Donations---</h6>
</form>




        <?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $code = $_POST['code'];
    $phone = $_POST['phone'];

    $servername = "localhost";
    $username = "adoptpet_db";
    $password = "adoptpet_db";
    $dbname = "adoptpet_db";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (!empty($code)) {
        $stmt = $conn->prepare("SELECT * FROM payment_form WHERE code = ?");
        $stmt->bind_param("s", $code);
    } elseif (!empty($phone)) {
        $stmt = $conn->prepare("SELECT * FROM payment_form WHERE phone = ?");
        $stmt->bind_param("s", $phone);
    } else {
        echo "<p>Please enter either a donation code or a phone number.</p>";
        exit();
    }

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Collect payment details into an array
        $payments = array();
        while ($row = $result->fetch_assoc()) {
            $payment = array(
                'amount' => $row['amount'],
                'name' => $row['name'],
                'phone' => $row['phone'],
                'date' => $row['date']
            );
            $payments[] = $payment;
        }

        // Close the statement
        $stmt->close();
        
        // Display payment details in a separate table
        echo "<h2>Payment Details:</h2>";
        echo "<table>";
        echo "<tr><th>Amount</th><th>Name</th><th>Phone</th><th>Date & Time</th></tr>";
        foreach ($payments as $payment) {
            echo "<tr>";
            echo "<td>" . $payment['amount'] . " INR</td>";
            echo "<td>" . $payment['name'] . "</td>";
            echo "<td>" . $payment['phone'] . "</td>";
            echo "<td>" . $payment['date'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No payment information found for the provided code or phone number.</p>";
    }

    $conn->close();
}
?>




 




    
</body>
<footer>
<style>
    /* General styling */
    

    /* Button styling */
    .chat-button {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background-image: url('Chatlogo.png'); /* Background image */
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
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
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
        border: none;
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
        <button class="chat-option" id="option-5">Donation History</button>
        <button class="chat-option" id="option-6"> Vet Appointment</button>
        <button class="chat-option" id="option-7">Technical support</button>
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
        handleChat('Donation History');
    });
    document.getElementById('option-6').addEventListener('click', function() {
        handleChat('Vet Appointment');
    });
    document.getElementById('option-7').addEventListener('click', function() {
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
                case 'Donation History':
                response = "Donation History can be accesed by entering the donation code which is present in the invoice so please download the invoice or save the donation code.";
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


</html>
