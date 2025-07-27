<?php
require("connection.php");
session_start();


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user information from the database
$email = $_SESSION['email']; // Assuming you store the email in the session after login
$sql = "SELECT * FROM users WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    // User exists, fetch user data
    $row = $result->fetch_assoc();
    $name = $row['name'];
    $phone = $row['mobile'];
    $email=$row['email'];
    // Add more fields as needed

    // Close the result set
    $result->close();
} else {
    // Handle the case where user data is not found
    echo "User data not found.";
}

// Close the connection
$conn->close();
?>


<!DOCTYPE html>
<html>
<head>
    <title>Application Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: linear-gradient(black, purple);
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #fff;
            background-color: #fff;
            border-radius: 5px;
        }

        .input-field {
            width: 95%;
            padding: 10px;
            margin: 10px 0;
        }

        .select-field {
            width: 30%;
        }

        button {
            padding: 10px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 text-align="center">Application Form</h1>
         <form method="post" action="<?php $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
        <input class="input-field" type="text" name="full_name" placeholder="Full Name" value="<?php echo $name?>" readonly>
        <br><br>
        <input class="input-field" type="email" name="email" placeholder="Email" value="<?php echo $email?>" readonly>
        <br><br>
        <input class="input-field" type="text" name="mobile_number" placeholder="Mobile Number" value="<?php echo $phone?>" readonly>
        <br><br>

            <input class="input-field" type="password" name="password" placeholder="Password" required>
            <br><br>
            <input class="input-field" type="text" name="aadhar_number" placeholder="Aadhar Number" required>
            <br><br>
            Date of Birth: <input class="input-field" type="date" id="dob" name="dob" required>
            <br><br>
            <input class="input-field" type="text" name="pet_id" placeholder="Pet ID" required>
            <br><br>
            <input class="input-field" type="text" name="pet_name" placeholder="Pet Name" required>
            <br><br>
            Donation Made:
            <select class="select-field" id="donation_made" name="donation_made" required>
                <option value="yes">Yes</option>
                <option value="no">No</option>
            </select>
            <br><br>
            <input class="input-field" type="number" name="total_family_members" placeholder="Total Family Members" required>
            <br><br>
            <textarea class="input-field" name="current_address" placeholder="Current Address" required></textarea>
            <br><br>
            <textarea class="input-field" name="permanent_address" placeholder="Permanent Address" required></textarea>
            <br><br>
            Do you own a pet:
            <select class="select-field" id="own_pet" name="own_pet" required>
                <option value="yes">Yes</option>
                <option value="no">No</option>
            </select>
            <br><br>
            Number of Pets You Have:
            <input class="input-field" type="number" name="number_of_pets" placeholder="Number of Pets You Have 0 if does not have pet" required>
            <br><br>
            <div>
                Choose Adhar card
           
            <input class="input-field" type="file" accept="image/*" id="adharFile" name="aadhar_card_file" placeholder="Upload Aadhar Card" required>
            </div>
            <br><br>
            
           
            <label>
                <input type="checkbox" id="termsCheckbox" name="terms_checkbox" required> I have read the terms and conditions
            </label>
            <br><br>
            <div align="center">
                <button id="previewButton" type="reset">Reset</button>
                &nbsp;&nbsp;
                <button type="submit" id="nextButton">Next</button>
            </div>
        </form>
    </div>

    <?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection parameters
    $servername = "localhost";
    $username = "adoptpet_db";
    $password = "adoptpet_db";
    $database = "adoptpet_db";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve user information from the database
    $email = $_SESSION['email']; 

    $sqlfetch="SELECT * FROM application_form WHERE email='$email'";
    $result = $conn->query($sqlfetch);

if ($result->num_rows > 0) {
  echo '<script>
  alert("Your application is already under process Please check your email for status");
  window.location="profilepage.php";
  </script>';
}else{


    // Prepare SQL statement to insert form data into database
    $sql = "INSERT INTO application_form (full_name, email, mobile_number, password, aadhar_number, dob, pet_id, pet_name, donation_made, total_family_members, current_address, permanent_address, own_pet, number_of_pets, aadhar_card_file, terms_checkbox)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";


    // Prepare and bind parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssssssssss", $full_name, $email, $mobile_number, $password, $aadhar_number, $dob, $pet_id, $pet_name, $donation_made, $total_family_members, $current_address, $permanent_address, $own_pet, $number_of_pets, $aadhar_card_file_path, $terms_checkbox);

    // Set parameters
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $mobile_number = $_POST['mobile_number'];
    $password = $_POST['password'];
    $aadhar_number = $_POST['aadhar_number'];
    $dob = $_POST['dob'];
    $pet_id = $_POST['pet_id'];
    $pet_name = $_POST['pet_name'];
    $donation_made = $_POST['donation_made'];
    $total_family_members = $_POST['total_family_members'];
    $current_address = $_POST['current_address'];
    $permanent_address = $_POST['permanent_address'];
    $own_pet = $_POST['own_pet'];
    $number_of_pets = $_POST['number_of_pets'];
    $terms_checkbox = isset($_POST['terms_checkbox']) ? $_POST['terms_checkbox'] : 'no';

    // File upload directory
    $target_dir = "upload_aadhar/";

    // Upload Aadhar card file
    $aadhar_card_file =basename( $_FILES['aadhar_card_file']['name']);
    $aadhar_card_file_path = $target_dir . $aadhar_card_file;
    move_uploaded_file($_FILES['aadhar_card_file']['tmp_name'], $aadhar_card_file_path);


   
    // Execute SQL statement
    if ($stmt->execute() === TRUE) {
        $stmt->close();
        $conn->close();
        echo '<script>
        alert("Application form submitted successfully");
        window.location=
        "profilepage.php";</script>';
        exit(); // Ensure script stops execution after redirection
    } else {
        echo "Error: " . $conn->error;
    }
}
}
?>

</body>
</html>
