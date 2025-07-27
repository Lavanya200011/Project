
<!DOCTYPE html>
<html>
<head>
    <title>Payment Details</title>
    <style>
        body {
            background-image: url('paymentBG.jpeg'); 
            background-size: cover;
            font-family: Arial, sans-serif;
            margin: 0; 
            padding: 0; 
        }
        .container {
            background-color: rgba(255, 255, 255, 0.8); 
            margin: 50px auto;
            padding: 20px;
            width: 400px;
        }
        h1 {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
        }
        form {
            margin-top: 30px;
        }
        label {
            display: block;
            font-size: 14px;
            margin-bottom: 5px;
        }
        input[type="text"] {
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
            font-size: 14px;
            height: 30px;
            margin-bottom: 10px;
            padding: 5px;
            width: 100%;
        }
        .error {
            color: red;
        }
        .pay {
            background-color: #28a745;
            border: none;
            border-radius: 3px;
            color: #fff;
            cursor: pointer;
            font-size: 16px;
            padding: 10px 20px;
            width: 100%;
        }
    </style>
</head>
<body>
<div class="container">
        <h1>ANONYMOUS PAYMENT</h1>
        <form id="paymentForm" method="post" action="">
            <!-- Populate form fields with the last record data -->
            <div class="other">
                <label for="other">Amount:</label>
                <input type="text" id="amount" name="amount" placeholder="Enter Amount" required>
                <!-- Other form fields -->
            </div>
           
            <div>
                <button type="button" onclick="initiateRazorpayPayment()" class="pay">PAY</button>
            </div>
        </form>
    </div>
    
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    <script>
    function initiateRazorpayPayment() {
        var amount = document.getElementById('amount').value;

        var options = {
            key: 'rzp_test_7GWnyymDusrppy', 
            amount: amount * 100, 
            currency: 'INR',
            name: 'Donation',
            description: 'Payment for Donations',
            image: 'logo.jpg', 
            handler: function(response) {
                // Alert the user that payment is done
                alert('Payment done!');
                
                // Redirect the user to the donation page
                window.location.href = 'donation.php';
            },
            notes: {
                address: 'Razorpay Payment'
            },
            theme: {
                color: '#28a745' 
            }
        };

        var rzp = new Razorpay(options);
        rzp.open();
    }
</script>



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
        width: 60px;
        height: 60px;
        font-size: 1.2rem;
        cursor: pointer;
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .chat-button:hover {
        transform: scale(1.1);
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
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
        background-color: #5c946e; /* Dark green */
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
        background-color: #5c946e; /* Dark green */
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
        background-color: #5c946e; /* Dark green */
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
        <h3>Chat Bot</h3>
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
