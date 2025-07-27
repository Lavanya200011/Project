<?php
// Check if the logged-in parameter is set to true
$loggedIn = isset($_GET['loggedin']) && $_GET['loggedin'] === 'true';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<script src="https://cdn.tailwindcss.com"></script>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Animal Adoption Page</title>
  <style>

/* General Reset */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

/* Body styling */
body {
  margin: 0;
  padding: 0;
  font-family: Arial, sans-serif;
  background-color: #f4f4f4;
}

/* Header Styling */
header {
  color: #fff;
  padding: 30px 0;
  background-color:#3D90D7;
  border-bottom: 3px solid #e8491d;
}

header a {
  color: #fff;
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

header nav {
  float: right;
  margin-top: 4px;
}

header .highlight, header .current a {
  color: white;
  font-weight: bold;
}

header a:hover {
  color: #cccccc;
  font-weight: bold;
  text-decoration-line: underline;
}

header #branding h1 {
  margin: 0;
}

header .menu-tabs {
  list-style-type: none;
}

header .menu-tabs li {
  display: inline-block;
  margin-left: 15px;
}

header .menu-tabs li a {
  font-size: 14px;
}

/* Responsive Header */
@media only screen and (max-width: 600px) {
  header nav {
    float: none;
    text-align: center;
  }

  header li {
    display: block;
    margin: 10px 0;
  }

  header #branding {
    text-align: center;
  }
}

/* Main Content */
.big-image {
  background-image: url('puppy.jpeg');
  background-size: cover;
  background-position: center;
  height: 400px;
  position: relative;
  color: white;
  text-align: left;
  padding: 20px;
}

.welcome-message {
  font-size: 24px;
  margin-top: 150px;
}

.contact-us-button {
  background-color: rgba(43, 191, 29, 0.696);
  color: black;
  padding: 10px 20px;
  font-size: 16px;
  text-decoration: none;
  border-radius: 5px;
  display: inline-block;
}

/* Search Results */
.search-result {
  margin: 20px;
  padding: 20px;
  border: 2px solid #000;
  background-color:#3af77a;
}

.search-result .dropdown-label {
  display: inline-block;
  width: 100%;
  font-weight: bold;
  margin-bottom: 5px;
}

.search-result .dropdown-select {
  width: 100%;
  padding: 8px;
  box-sizing: border-box;
  margin-bottom: 10px;
}

.submit-button {
  background-color: lightgreen;
  border-radius: 8px;
  padding: 12px;
  cursor: pointer;
}

/* Profile Layout */
.profile-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
}

.profile {
  width: 30%;
  margin-bottom: 20px;
  text-align: center;
  border: 1px solid #000;
  padding: 10px;
  border-radius: 10px;
}

.profile img {
  border-radius: 50%;
  max-width: 100%;
  height: 120px;
  width: 120px;
  margin-bottom: 10px;
}

/* Responsive Profile Layout */
@media only screen and (max-width: 600px) {
  .profile {
    width: 100%;
    margin-bottom: 20px;
  }

  .big-image {
    height: 250px;
  }

  .welcome-message {
    font-size: 20px;
    margin-top: 100px;
  }

  .search-result {
    padding: 10px;
  }
}

/* Footer Styling */
.footer {
  background-color:#7AC6D2;
  color: white;
  padding: 20px;
  text-align: center;
}

.footer a {
  color: #fff;
  text-decoration: none;
  font-weight: bold;
}

.footer p {
  margin-top: 10px;
}

/* Chat Popup Styling */
.chat-button {
  position: fixed;
  bottom: 20px;
  right: 20px;
  background-color: #3bafc9;
  color: #fff;
  border: none;
  border-radius: 50%;
  width: 70px;
  height: 70px;
  font-size: 1.2rem;
  cursor: pointer;
  z-index: 9999;
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
  z-index: 9998;
}

.chat-popup-header {
  background-color: #3bafc9;
  color: #fff;
  padding: 15px;
  border-top-left-radius: 20px;
  border-top-right-radius: 20px;
  display: flex;
  justify-content: space-between;
  align-items: center;
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
}

.chat-option {
  background-color: #3bafc9;
  color: #fff;
  border: none;
  padding: 8px 15px;
  border-radius: 5px;
  margin-right: 5px;
  margin-bottom: 5px;
  cursor: pointer;
  width: 100%;
  text-align: left;
}

.chat-message {
  padding: 8px 15px;
  border-radius: 5px;
  margin-bottom: 5px;
}

.user-message {
  background-color: #3bafc9;
  color: #fff;
  float: right;
}

.bot-message {
  background-color: #f8f8f8;
  color: #000;
  float: left;
}

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

.f1{
margin-right:22px;
}

/* Media Query for smaller screens */
@media only screen and (max-width: 600px) {
  .chat-popup {
    width: 80%;
    max-width: 400px;
  }

  .chat-popup-header h3 {
    font-size: 1rem;
  }

  .chat-button {
    width: 60px;
    height: 60px;
  }
}


    
  </style>
  
</head>
<body class="background-img">
 <header class="bg-green-400 text-white shadow">
    <div class="container mx-auto flex flex-wrap items-center py-2 px-5">
      <h1 class="flex-1 text-xl font-bold">ANIMAL ADOPTION</h1>
      <nav class="flex space-x-4">
        <a href="animalAdd.php" class="hover:text-black">Add Animal</a>
        <a href="Vet1.php" class="hover:text-black">Vet</a>
        <a href="donation.php" class="hover:text-black">Donation</a>
        <a href="adminlogin.php" class="hover:text-black">Admin</a>
        <?php if (!$loggedIn): ?>
          <a href="login.php" class="hover:text-black">Login / Sign Up</a>
        <?php else: ?>
          <a href="profilepage.php"><img src="profile-logo.png" alt="Profile" class="w-6 h-6 rounded-full"></a>
        <?php endif; ?>
      </nav>
    </div>
  </header>


<div class="big-image" id="slideshow">
     
    <div class="welcome-message">Welcome to our animal adoption service</div>
    <a class="contact-us-button" href="contact us.html">Contact Us</a>
  </div>
  <hr>
  <br>
  <br>
  
<hr>


<div>
 
<!--About us info section-->
<section class="text-gray-600 body-font">
  <div class="container px-5 py-24 mx-auto">
    <h1 class="text-3xl font-medium title-font text-gray-900 mb-12 text-center">About us</h1>
    <div class="flex flex-wrap -m-4">
      <div class="p-4 md:w-1/2 w-full">
        <div class="h-full bg-gray-100 p-8 rounded">
          <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="block w-5 h-5 text-gray-400 mb-4" viewBox="0 0 975.036 975.036">
            <path d="M925.036 57.197h-304c-27.6 0-50 22.4-50 50v304c0 27.601 22.4 50 50 50h145.5c-1.9 79.601-20.4 143.3-55.4 191.2-27.6 37.8-69.399 69.1-125.3 93.8-25.7 11.3-36.8 41.7-24.8 67.101l36 76c11.6 24.399 40.3 35.1 65.1 24.399 66.2-28.6 122.101-64.8 167.7-108.8 55.601-53.7 93.7-114.3 114.3-181.9 20.601-67.6 30.9-159.8 30.9-276.8v-239c0-27.599-22.401-50-50-50zM106.036 913.497c65.4-28.5 121-64.699 166.9-108.6 56.1-53.7 94.4-114.1 115-181.2 20.6-67.1 30.899-159.6 30.899-277.5v-239c0-27.6-22.399-50-50-50h-304c-27.6 0-50 22.4-50 50v304c0 27.601 22.4 50 50 50h145.5c-1.9 79.601-20.4 143.3-55.4 191.2-27.6 37.8-69.4 69.1-125.3 93.8-25.7 11.3-36.8 41.7-24.8 67.101l35.9 75.8c11.601 24.399 40.501 35.2 65.301 24.399z"></path>
          </svg>
          <h2><b>What We Do</b></h2>
          <br>
          <p class="leading-relaxed mb-6">We are doing tasks like (animal adoption, listing, searching on filter) provide ability to user yo see animal profile to understand their future pet better.</p>
          <a class="inline-flex items-center">
           
          </a>
        </div>
      </div>
      <div class="p-4 md:w-1/2 w-full">
        <div class="h-full bg-gray-100 p-8 rounded">
          <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="block w-5 h-5 text-gray-400 mb-4" viewBox="0 0 975.036 975.036">
            <path d="M925.036 57.197h-304c-27.6 0-50 22.4-50 50v304c0 27.601 22.4 50 50 50h145.5c-1.9 79.601-20.4 143.3-55.4 191.2-27.6 37.8-69.399 69.1-125.3 93.8-25.7 11.3-36.8 41.7-24.8 67.101l36 76c11.6 24.399 40.3 35.1 65.1 24.399 66.2-28.6 122.101-64.8 167.7-108.8 55.601-53.7 93.7-114.3 114.3-181.9 20.601-67.6 30.9-159.8 30.9-276.8v-239c0-27.599-22.401-50-50-50zM106.036 913.497c65.4-28.5 121-64.699 166.9-108.6 56.1-53.7 94.4-114.1 115-181.2 20.6-67.1 30.899-159.6 30.899-277.5v-239c0-27.6-22.399-50-50-50h-304c-27.6 0-50 22.4-50 50v304c0 27.601 22.4 50 50 50h145.5c-1.9 79.601-20.4 143.3-55.4 191.2-27.6 37.8-69.4 69.1-125.3 93.8-25.7 11.3-36.8 41.7-24.8 67.101l35.9 75.8c11.601 24.399 40.501 35.2 65.301 24.399z"></path>
          </svg>
          <h2><b>Pet Adoption</b></h2>
          <br>
          <p class="leading-relaxed mb-6">Saving one animal won’t change the world, but it will change the world for that one animal.</p>
          <a class="inline-flex items-center">
           
          </a>
        </div>
      </div>
    </div>
  </div>
</section>




  
  <hr>
  <h2 align="center"><b>Search Pet</b></h2>
  <hr>
  <fieldset class="search-result">
    <br>
    <div>
      <label class="dropdown-label">Category:</label>
      <br><br>
      <select id="category" class="dropdown-select">
        <option value="select">Select</option>
        <option value="Dog">Dog</option>
        <option value="Cat">Cat</option>
        <option value="Rabbit">Rabbit</option>
        <option value="Hamster">Hamster</option>
      </select>
      <label class="dropdown-label">Gender:</label>
      <br><br>
      <select id="gender" class="dropdown-select">
        <option value="select">Select</option>
        <option value="male">Male</option>
        <option value="female">Female</option>
      </select>
    </div>
    &nbsp &nbsp  &nbsp &nbsp  &nbsp &nbsp  &nbsp &nbsp
    <div>
      <label class="dropdown-label">Breed:</label>
      <br><br>
      <select id="breed" class="dropdown-select">
        <option value="select">Select</option>
        <option value="German shepherd">German shepherd</option>
        <option value="Bulldog">Bulldog</option>
        <option value="Labrador">Labrador</option>
        <option value="golden retriever">Golden Retriever</option>
      </select>
    </div>
    &nbsp &nbsp  &nbsp &nbsp  &nbsp &nbsp  &nbsp &nbsp
    <div>
  <label class="dropdown-label">Pincode:</label>
  <br><br>
  <input type="text" id="pincode">
</div>

  </fieldset>
  <div align="right" class="f1">
    <button class="submit-button" onclick="filterProfiles()">Search</button>
  </div>
  <!-- Search results -->
  <fieldset class="fieldset">
    <legend align="center">Search Result</legend>
    <div id="searchResults"></div>
  </fieldset>
</div>
<script>
var images = ['slide4.png', 'slide1.png', 'slide2.png','slide3.png','slide5.png']; // Replace with actual image paths
var currentIndex = 0;
var slideshowElement = document.getElementById('slideshow');

function changeImage() {
    slideshowElement.style.backgroundImage = "url('" + images[currentIndex] + "')";
    currentIndex = (currentIndex + 1) % images.length;
}

// Initial call to changeImage
changeImage();

// Set interval to change image every 2 seconds
setInterval(changeImage, 2000);




  // Function to filter profiles based on dropdown selections
  function filterProfiles() {
    var category = document.getElementById("category").value;
    var gender = document.getElementById("gender").value;
    var breed = document.getElementById("breed").value;
    var pincode = document.getElementById("pincode").value;

    // AJAX request to fetch filtered results
    var xhr = new XMLHttpRequest();
xhr.open("GET", "fetch_results.php?category=" + category + "&gender=" + gender + "&breed=" + breed + "&pincode=" + pincode, true);
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        document.getElementById("searchResults").innerHTML = xhr.responseText;
      }
    };
    xhr.send();
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



<br>
<br>
<section class="text-gray-400 body-font relative">
  <div class="absolute inset-0 bg-gray-300">
    <iframe width="100%" height="100%" frameborder="0" marginheight="0" marginwidth="0" title="map" scrolling="no" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3769.641878948861!2d79.9976348!3d21.0858412!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a2b73df79727253%3A0x6a7926edf0a945b8!2sSakoli%2C%20Maharashtra%20441802!5e0!3m2!1sen!2sin!4v1713612990000!5m2!1sen!2sin" style="filter: grayscale(1) contrast(1.2) opacity(0.4);"></iframe>
  </div>
  <div class="container px-5 py-24 mx-auto">
    <div class=" mr-8 lg:w-1/3 md:w-1/2 bg-white rounded-lg p-8 flex flex-col md:ml-auto w-full mt-10 md:mt-0 relative z-10 shadow-md">
     <div class=" text-center ">
    <h2 class="text-gray-900 text-2xl mb-1 font-bold title-font ">Feedback</h2>
    </div>
    <p class="leading-relaxed mb-5 text-gray-600">If you have feedback please share with us we can improve our website</p>
      <div class="relative mb-4">
        <label for="email" class="leading-7 text-sm text-gray-600">Email</label>
        <input type="email" id="email" name="email" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
      </div>
      <div class="relative mb-4">
        <label for="message" class="leading-7 text-sm text-gray-600">Message</label>
        <textarea id="message" name="message" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
      </div>
      <button class="text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">Send feedback</button>
      
    </div>
  </div>
</section>





<footer class="text-gray-700 body-font bg-green-400">
  <div class="container px-5 py-8 mx-auto flex md:items-start ml-6 lg:items-start md:flex-row md:flex-nowrap flex-wrap flex-col">
    <!-- Branding Section -->
    <div class="w-64 flex-shrink-0 mx-auto text-center md:text-left">
      <a class="flex title-font font-bold items-center justify-center md:justify-start text-gray-900 text-2xl">
        Adoptpet
      </a>
      <p class="mt-2 text-sm text-gray-600">Bringing Paws and People Together.</p>
    </div>

    <!-- Spacer -->
    <div class="flex-grow flex flex-wrap md:pl-20 mt-10 md:mt-0 -mb-10 md:text-left text-center">
      
      <!-- Team -->
      <div class="lg:w-1/4 md:w-1/2 w-full px-4 mb-6">
        <h2 class="title-font font-medium text-gray-900 tracking-widest text-sm mb-3"><b>Developing Team</b></h2>
        <ul class="list-none space-y-2">
          <li><a class="text-gray-600 hover:text-gray-900">Sumiran Kamdi</a></li>
          <li><a class="text-gray-600 hover:text-gray-900">Girish Khedikar</a></li>
          <li><a class="text-gray-600 hover:text-gray-900">Sangh Raut</a></li>
          <li><a class="text-gray-600 hover:text-gray-900">Lavanya Thawkar</a></li>
        </ul>
      </div>

      <!-- Tech Stack -->
      <div class="lg:w-1/4 md:w-1/2 w-full px-4 mb-6">
        <h2 class="title-font font-medium text-gray-900 tracking-widest text-sm mb-3"><b>Technologies Used</b></h2>
        <ul class="list-none space-y-2">
          <li><a class="text-gray-600 hover:text-gray-900">HTML</a></li>
          <li><a class="text-gray-600 hover:text-gray-900">Tailwind CSS</a></li>
          <li><a class="text-gray-600 hover:text-gray-900">JavaScript</a></li>
          <li><a class="text-gray-600 hover:text-gray-900">PHP</a></li>
        </ul>
      </div>
    </div>
  </div>

  <!-- Bottom Bar -->
  <div class="bg-green-500">
    <div class="container mx-auto py-4 px-5 flex flex-wrap flex-col sm:flex-row items-center">
      <p class="text-gray-700 text-sm text-center sm:text-left">
        © 2024 Adoptpet —
        <a href="#" class="text-gray-900 ml-1 hover:underline" target="_blank">@adoptpet</a>
      </p>

      <span class="inline-flex sm:ml-auto sm:mt-0 mt-2 justify-center sm:justify-start space-x-4">
        <a class="text-gray-700 hover:text-blue-600" href="#">
          <svg fill="currentColor" class="w-5 h-5" viewBox="0 0 24 24"><path d="M18 2h-3..."></path></svg>
        </a>
        <a class="text-gray-700 hover:text-blue-600" href="#">
          <svg fill="currentColor" class="w-5 h-5" viewBox="0 0 24 24"><path d="M23 3a10..."></path></svg>
        </a>
        <a class="text-gray-700 hover:text-pink-600" href="#">
          <svg fill="none" stroke="currentColor" class="w-5 h-5" viewBox="0 0 24 24"><rect ... /><path ... /></svg>
        </a>
        <a class="text-gray-700 hover:text-blue-800" href="#">
          <svg fill="currentColor" class="w-5 h-5" viewBox="0 0 24 24"><path ... /><circle ... /></svg>
        </a>
      </span>
    </div>
  </div>
</footer>


</body>
</html>

