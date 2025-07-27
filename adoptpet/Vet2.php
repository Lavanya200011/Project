<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Booking</title>
    <style>
        /* General Styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('VetBG123.jpeg');
            background-size: cover;
            background-repeat: no-repeat;
        }

        header {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            background-color: #4caf50;
            padding-top:40px;
            padding-bottom:20px;
            border-bottom: #e8491d 3px solid;
            box-sizing: border-box;
        }

        .container2 {
            padding-right: 20px;
            margin: auto;
            overflow: hidden;
        }

        #branding {
            float: left;
        }

        #branding h1 {
            margin: 0;
        }

        nav {
            float: right;
            margin-top: 4px;
        }

        nav ul {
            margin: 0;
            padding: 0;
        }

        nav li {
            display: inline-block;
            margin-left: 20px;
        }

        nav li:first-child {
            margin-left: 0;
        }

        nav a {
            color: white;
            text-decoration: none;
            text-transform: uppercase;
            font-size: 16px;
            font-weight: bold;
        }

        nav a:hover {
            color: #cccccc;
        }

        .highlight {
            font-weight: bold;
            color:white;
        }

        section {
            max-width: 600px;
            margin: 80px auto 20px;
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }

        h1, h2, p {
            margin-bottom: 10px;
        }

        button {
            background-color: #4CAF50;
            color: #f4f4f4;
            display: block;
            margin: 10px auto;
            width: 60%;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        input[type="text"],
        input[type="date"],
        select {
            width: 95%;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: center;
        }

        footer {
            margin-top: 20px;
        }

        /* Chat Button Styling */
        .chat-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-image: url('Chatlogo.png');
            background-size: cover;
            border: none;
            border-radius: 50%;
            width: 70px;
            height: 70px;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .chat-button:hover {
            transform: scale(1.35);
            box-shadow: 0 0 20px rgba(0, 0, 0, 1);
        }

        .chat-popup {
            display: none;
            position: fixed;
            bottom: 90px;
            right: 20px;
            width: 300px;
            border-radius: 20px;
            background-color: #fff;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .chat-popup-header {
            background-color: rgb(3, 155, 0);
            color: #fff;
            padding: 15px;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
        }

        .chat-popup-body {
            padding: 15px;
            max-height: 400px;
            overflow-y: auto;
        }

        .chat-popup-footer {
            padding: 15px;
            border-top: 1px solid #ccc;
        }

        .chat-option {
            background-color: rgb(3, 155, 0);
            color: #fff;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            margin-bottom: 5px;
            cursor: pointer;
            text-align: left;
            width: 100%;
        }

        .chat-option:hover {
            background-color: #45a049;
        }

        .chat-message {
            padding: 8px 15px;
            border-radius: 5px;
            margin-bottom: 5px;
        }

        .user-message {
            background-color: rgb(3, 155, 0);
            color: #fff;
            float: right;
        }

        .bot-message {
            background-color: #f8f8f8;
            color: #000;
            float: left;
        }
    </style>
</head>

<body>
    <header>
        <div class="container2">
            <div id="branding">
                <h1><span class="highlight">Vet Appointment</span></h1>
            </div>
            <nav>
                <ul>
                    <li class="current"><a href="Home.php">Home</a></li>
                    <li><a href="Vet1.php">Vet's Profile</a></li>
                    <li><a href="Vetlogin.php">Vet loginS</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <form action="Vet2PHP.php" method="post">
            <section>
                <h1>Lifeline Pet Clinic</h1>
                <img src="clinic.jpeg" alt="Clinic Image">
                <h1>In-Clinic Appointment</h1>
            </section>

            <section class="appointment-section">
                <h2>Appointment Details</h2>
                <table>
                    <tr>
                        <th>Day</th>
                        <th>Book Slots</th>
                        <th>Date</th>
                    </tr>
                    <tr>
                        <td>
                            <select name="Day" required>
                                <option value="monday">Monday</option>
                                <option value="tuesday">Tuesday</option>
                                <option value="wednesday">Wednesday</option>
                                <option value="thursday">Thursday</option>
                                <option value="friday">Friday</option>
                                <option value="saturday">Saturday</option>
                                <option value="sunday">Sunday</option>
                            </select>
                        </td>
                        <td>
                            <select name="Time" required>
                                <option value="select">Select</option>
                                <option value="9AM">9:00 AM</option>
                                <option value="10AM">10:00 AM</option>
                                <option value="11AM">11:00 AM</option>
                                <option value="12PM">12:00 PM</option>
                                <option value="1PM">1:00 PM</option>
                                <option value="2PM">2:00 PM</option>
                                <option value="3PM">3:00 PM</option>
                            </select>
                        </td>
                        <td>
                            <input type="date" name="Date" required>
                        </td>
                    </tr>
                </table>

                <label for="Name">Name:</label>
                <input type="text" id="Name" name="name" placeholder="Enter Your Name" required>

                <label for="pet">Select Pet:</label>
                <select name="pet" id="pet" required>
                    <option value="select">Select Animal</option>
                    <option value="dog">Dog</option>
                    <option value="cat">Cat</option>
                    <option value="bird">Bird</option>
                    <option value="cow">Cow</option>
                    <option value="other">Other</option>
                </select>

                <label for="service">Select Service:</label>
                <select name="service" id="service" required>
                    <option value="select">Select Service</option>
                    <option value="vaccination">Vaccination</option>
                    <option value="checkup">Checkup</option>
                    <option value="grooming">Grooming</option>
                    <option value="other">Other</option>
                </select>

                <label for="symptoms">Select Symptoms:</label>
                <select name="symptoms" id="symptoms" required>
                    <option value="select">Select Symptoms</option>
                    <option value="no symptoms">No Symptoms</option>
                    <option value="Loss of appetite">Loss of appetite</option>
                    <option value="Difficult breathing">Difficult breathing</option>
                    <option value="Wounds">Wounds</option>
                    <option value="Coughing or sneezing">Coughing or sneezing</option>
                    <option value="other">Other</option>
                </select>

                <p>This Appointment Booking is Free; The Clinic May Charge Applicable Consultation Fees During The Visit.</p>
                <button type="submit">Confirm</button>
            </section>
        </form>
    </main>

    <div class="chat-button" id="open-chat"></div>

    <div class="chat-popup" id="chat-popup">
        <div class="chat-popup-header">
            <h3>Pet Bot</h3>
            <button id="close-chat">&#x2715;</button>
        </div>
        <div class="chat-popup-body" id="chat-popup-body">
            <div class="chat-message bot-message">Hello! How can I assist you today?</div>
        </div>
        <div class="chat-popup-footer">
            <button class="chat-option" id="option-1">About The Website</button>
            <button class="chat-option" id="option-2">How to adopt a pet</button>
            <button class="chat-option" id="option-3">Login & Profile</button>
            <button class="chat-option" id="option-4">Donation & Anonymous Donation</button>
            <button class="chat-option" id="option-5">Vet Appointment</button>
            <button class="chat-option" id="option-6">Technical support</button>
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



</body>
</html>
