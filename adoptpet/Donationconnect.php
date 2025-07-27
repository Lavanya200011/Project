<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $servername = "localhost"; 
    $username = "adoptpet_db"; 
    $password = "adoptpet_db"; 
    $dbname = "adoptpet_db"; 

    
    $conn = new mysqli($servername, $username, $password, $dbname);

    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO donationtable (Name, Email, Number, gender, dob, Country, State, City, Pincode) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssisssssi", $Name, $email, $phone_number, $gender, $dob, $country, $state, $city, $pincode);

    $Name = $_POST['Name'];
    $email = $_POST['Email'];
    $phone_number = $_POST['Number'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $country = $_POST['Country'];
    $state = $_POST['State'];
    $city = $_POST['City'];
    $pincode = $_POST['Pincode'];

    
    if ($stmt->execute()) {
        echo "New record created successfully";
        // Pass name and phone_number to payment.html
        header("Location: payment.php?name=$Name&phone=$phone_number");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    
    $stmt->close();
    $conn->close();
}
?>
