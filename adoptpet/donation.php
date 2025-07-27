<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donations</title>
    <link rel="stylesheet" href="Donation.css">
    <script src="https://kit.fontawesome.com/f28a22a28f.js" crossorigin="anonymous"></script>
    <style>
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




.mySlides {
    display: none;
  }

  img {
    width: 100%;
    height: auto;
    aspect-ratio: 16 / 9;
    border-radius:18px;
  }

        

    </style>
</head>
<body>
<header>
    <div class="container2 position">
        <div id="branding">
            <h1><span class="highlight">Donation Page</span></h1>
        </div>
        <nav>
            <ul>
                <li class="current"><a href="Home.php">Home</a></li>
                <li><a href="animalAdd.php">Add Animal</a></li>
                <li><a href="Vet1.php">Vet</a></li>
                
                <li><button onclick="window.location.href='payment_history.php';">Donation History</button></li>
            </ul>
        </nav>
    </div>
</header>



    
    <div class="container">
        <div class="form-box">
            <h3 id="Donations">Enter Details For Donation:</h3>
            <h6 id="Donations">----You Can Donate Anonymously Below----</h6>
            <form id="donationForm" action="Donationconnect.php" method="post">

                
                <div class="Name">
                    <label for="Name">Full Name:</label>
                    <i class="fa-solid fa-user"></i>
                    <input type="text" id="Name" name="Name" placeholder="Enter Your Name" required>
                </div>
                <div class="Email">
                    <label for="Email">Email:</label>
                    <i class="fa-solid fa-envelope"></i>
                    <input type="email" id="Email" name="Email" placeholder="Enter Your Email" required>
                </div>
                <div class="Number">
                       <label for="Number">Phone no:</label>
                       <i class="fa-solid fa-phone"></i>
                     <input type="text" id="Number" name="Number" placeholder="Enter Your Phone Number" maxlength="10" required>
                </div>
                <div class="Gender">
                    <label for="gender">Gender:</label>
                    <label for="gender">Male:</label>
                    <input type="radio" id="male" name="gender" value="m" required="required">
                    <label for="gender">Female:</label>
                    <input type="radio" id="female" name="gender" value="f" required="required">
                    <label for="gender">Other:</label>
                    <input type="radio" id="other" name="gender" value="o" required="required">
                </div>
                <div>
                    <label for="dob">DOB:</label>
                    <input type="date" id="dob" name="dob" required="required">
                </div>
                <div>
                    <label for="country">Country:</label>
                    <select name="Country" id="country">
                        <option value="country">Select Country</option>
                        <option value="India">India</option>
                    </select>
                </div>
                <div class="select-state">
                    <label for="state">State:</label>
                    <select name="State" id="State" required="required">
                        <option value="Select State">Select State</option>
                        <option value="Andhra Pradesh">Andhra Pradesh</option>
                        <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                        <option value="Assam">Assam</option>
                        <option value="Bihar">Bihar</option>
                        <option value="Chhattisgarh">Chhattisgarh</option>
                        <option value="Goa">Goa</option>
                        <option value="Gujarat">Gujarat</option>
                        <option value="Haryana">Haryana</option>
                        <option value="Himachal Pradesh">Himachal Pradesh</option>
                        <option value="Jharkhand">Jharkhand</option>
                        <option value="Karnataka">Karnataka</option>
                        <option value="Kerala">Kerala</option>
                        <option value="Madhya Pradesh">Madhya Pradesh</option>
                        <option value="Maharashtra">Maharashtra</option>
                        <option value="Manipur">Manipur</option>
                        <option value="Meghalaya">Meghalaya</option>
                        <option value="Mizoram">Mizoram</option>
                        <option value="Nagaland">Nagaland</option>
                        <option value="Odisha">Odisha</option>
                        <option value="Punjab">Punjab</option>
                        <option value="Rajasthan">Rajasthan</option>
                        <option value="Sikkim">Sikkim</option>
                        <option value="Tamil Nadu">Tamil Nadu</option>
                        <option value="Telangana">Telangana</option>
                        <option value="Tripura">Tripura</option>
                        <option value="Uttar Pradesh">Uttar Pradesh</option>
                        <option value="Uttarakhand">Uttarakhand</option>
                        <option value="West Bengal">West Bengal</option>
                        
                    </select>
                </div>
                <div class="city">
                    <label for="city">City:</label>
                    <input type="text" name="City" id="city" placeholder="Enter Your City" required>
                </div>
                <div class="pincode">
                    <label for="pincode">Pincode:</label>
                    <input type="text" id="pincode" name="Pincode" placeholder="Enter Your Pincode" maxlength="6" required>
                </div>
                <div class="button">
                    <button type="submit" class="btn" id="submitButton">Submit</button> 
                    

                    <button onclick="window.location.href='anonymouspayment.php'" class="btn" id="AnonymousButton">Make Anonymous Donation</button>
                </div>
            </form>
            
        </div>
    </div>
    
<div class="slidecontainer">

    <center>
    <h3>Our Organization:</h3>
    </center>
  <div class="mySlides fade">
    <img src="slide1.png">
  </div>

  <div class="mySlides fade">
    <img src="slide2.png">
  </div>

  <div class="mySlides fade">
    <img src="slide3.png">
  </div>

  <div class="mySlides fade">
    <img src="slide4.png">
  </div>

  <div class="mySlides fade">
    <img src="slide5.png">
  </div>


  <h5>Why we need your help?</h5>
  <p>
  Every day, countless animals suffer from neglect, abuse, and exploitation. Many are abandoned, left to fend for themselves in harsh conditions, while others are subjected to cruel treatment in industries like factory farming, entertainment, and experimentation. These animals are voiceless, relying solely on compassionate individuals like you and me to speak up and take action on their behalf. <br><br>

  But our mission extends beyond just rescue and shelter. We are committed to raising awareness about animal welfare issues, advocating for stronger legal protections, and promoting compassionate lifestyles that prioritize the well-being of all living beings. Through education and outreach initiatives, we strive to inspire empathy and foster a deeper understanding of the intrinsic value of every creature.<br><br>

  Together, we can build a brighter future for animals—one where they are treated with the dignity, respect, and kindness they deserve. Thank you for considering our cause, and thank you for your continued support in our mission to create a more compassionate world for all beings.


  </p>
</div>

<script>
let slideIndex = 0;
showSlides();

function showSlides() {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  slides[slideIndex-1].style.display = "block";  
  setTimeout(showSlides, 2000); // Change image every 2 seconds
}
</script>

<script>
    //text to Number

var numberInput = document.getElementById('Number');
numberInput.addEventListener('keypress', function (event) {
    var charCode = event.which ? event.which : event.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode !== 8) {
        event.preventDefault();
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