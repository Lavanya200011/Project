<?php
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

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Initialize variables for appointment details
    $name = $Day = $Time = $Date = $pet = $service = $symptoms = "";
    
    // Retrieve form data
    $Day = $_POST['Day'];
    $Time = $_POST['Time'];
    $Date = $_POST['Date'];
    $name = $_POST['name'];
    $pet = $_POST['pet'];
    $service = $_POST['service'];
    $symptoms = $_POST['symptoms'];

    // Check if the selected time slot is available
    $sql_check_availability = "SELECT * FROM vet3table WHERE Day = '$Day' AND Time = '$Time' AND Date = '$Date'";
    $result_check_availability = $conn->query($sql_check_availability);

    if ($result_check_availability->num_rows > 0) {
        // Appointment slot is not available
        echo "<script>alert('Appointment is not available. Please change the time slot, day, or date.');
        window.location.href = 'Vet2.php';</script>";
    } else {
        // Insert data into the database
        $sql = "INSERT INTO vet3table (Day, Time, Date, Name, Pet, Service, Symptoms) 
                VALUES ('$Day', '$Time', '$Date', '$name', '$pet', '$service', '$symptoms')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Appointment booked successfully.');
                  </script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Close connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image:url('VetAP.jpeg');
            background-size:cover;
        }

        .confirmation-section {
            max-width: 600px;
            margin: 110px auto;
            padding: 20px;
            background-color: #ffffff97;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1, h2, p {
            margin-bottom: 10px;
        }
        button{
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
    </style>
</head>
<body>

<section class="confirmation-section">
    <h1>Appointment Confirmation</h1>
    <?php if(!empty($name) && !empty($Day) && !empty($Time) && !empty($Date)) { ?>
        <p>Thank you, <?php echo $name; ?>, for booking an appointment with Lifeline Pet Clinic.</p>

        <h2>Details:</h2>
        <p><strong>Name:</strong> <?php echo $name; ?></p>
        <p><strong>Day:</strong> <?php echo $Day; ?></p>
        <p><strong>Time:</strong> <?php echo $Time; ?></p>
        <p><strong>Date:</strong> <?php echo $Date; ?></p>
        <p><strong>Pet:</strong> <?php echo $pet; ?></p>
        <p><strong>Service:</strong> <?php echo $service; ?></p>
        <p><strong>Symptoms:</strong> <?php echo $symptoms; ?></p>

        <p>Your appointment is confirmed. We look forward to seeing you.</p>
        <button onclick="printPDF()">Print</button>
        <button onclick="window.location.href='Vet2.php'">Go Back</button>
        <script>
            function printPDF() {
                window.open('generate_pdf.php', '_blank');
            }
        </script>
    <?php } else { ?>
        <p>Appointment details could not be retrieved. Please try again later.</p>
    <?php } ?>
</section>

</body>
</html>
