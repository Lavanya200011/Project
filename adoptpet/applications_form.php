<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Forms</title>
    <style>
        /* Style for header */
        header {
            background-color: #333;
            color: white;
            padding: 10px;
            text-align: center;
        }
        /* Style for buttons */
        .button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 5px;
        }
        .button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

 <!-- Header with buttons -->
 <header>
       
        <button class="button" onclick="window.location.href='users.php'">Users</button>
        <button class="button" onclick="window.location.href='applications_form.php'">Application Form</button>
         <button class="button" onclick="window.location.href='pets_data.php'">Pets
Data</button>
        <button class="button" onclick="window.location.href='Donation_data.php'">Donations</button>
        <button class="button" onclick="window.location.href='logout.php'">Logout</button>
    </header>


    <h2>Application Forms</h2>
    <?php
// Establish database connection (replace these variables with your actual database credentials)
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

// SQL query to select data from the table
$sql = "SELECT * FROM application_form";
$result = $conn->query($sql);

// Check if there are any records
if ($result->num_rows > 0) {
    // Output data of each row
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Mobile Number</th>
                <th>Password</th>
                <th>Aadhar Number</th>
                <th>Date of Birth</th>
                <th>Pet ID</th>
                <th>Pet Name</th>
                <th>Donation Made</th>
                <th>Total Family Members</th>
                <th>Current Address</th>
                <th>Permanent Address</th>
                <th>Own Pet</th>
                <th>Number of Pets</th>
                <th>Aadhar Card File</th>
                <th>status</th>
                 <th>Action</th>
                
             
            </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["full_name"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["mobile_number"] . "</td>";
        echo "<td>" . $row["password"] . "</td>";
        echo "<td>" . $row["aadhar_number"] . "</td>";
        echo "<td>" . $row["dob"] . "</td>";
        echo "<td>" . $row["pet_id"] . "</td>";
        echo "<td>" . $row["pet_name"] . "</td>";
        echo "<td>" . $row["donation_made"] . "</td>";
        echo "<td>" . $row["total_family_members"] . "</td>";
        echo "<td>" . $row["current_address"] . "</td>";
        echo "<td>" . $row["permanent_address"] . "</td>";
        echo "<td>" . $row["own_pet"] . "</td>";
        echo "<td>" . $row["number_of_pets"] . "</td>";
        echo "<td>" . $row["aadhar_card_file"] . "</td>";
        echo "<td>" . $row["status"] . "</td>";
        echo "<form method='post' action=''>";
        echo "<td>";
        echo "<input type='hidden' name='email' value='" . $row["email"] . "'>"; 
        echo "<button type='submit' name='action' value='approve'>Approve</button>";
        echo "<button type='submit' name='action' value='disapprove'>Disapprove</button>";
        echo "</form>";
       
           echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No application forms found";
}

// Close the database connection
$conn->close();
?>




<?php
// Establish database connection (replace these variables with your actual database credentials)
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the email and action from the form
    $email = $_POST["email"];
    $action = $_POST["action"];

    if ($action == "approve") {
        // Update status to approved in the application_info table
        $sql_update = "UPDATE application_form SET status = 'approved' WHERE email = '$email'";
        if ($conn->query($sql_update) === TRUE) {
            echo "Status updated successfully";
        } else {
            echo "Error updating status: " . $conn->error;
        }
    } elseif ($action == "disapprove") {
        // Update status to disapproved in the application_info table
        $sql_update = "UPDATE application_form SET status = 'disapproved' WHERE email = '$email'";
        if ($conn->query($sql_update) === TRUE) {
            echo "Status updated successfully";
        } else {
            echo "Error updating status: " . $conn->error;
        }
    }
}

// Close the database connection
$conn->close();
?>












<?php
error_reporting(E_ALL);
ini_set('display_error','on');
set_error_handler("var_dump");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if action is set and email is set
    if (isset($_POST['action']) && isset($_POST['email'])) {
        $action = $_POST['action'];
        $email = $_POST['email'];

        // Establish database connection
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

        // Send email based on the action
        if ($action === 'approve' || $action === 'disapprove') {
            // Include PHPMailer files
            require './PHPMailer/src/Exception.php';
            require './PHPMailer/src/PHPMailer.php';
            require './PHPMailer/src/SMTP.php';

            // Create a new PHPMailer instance
            $mail = new PHPMailer(true);

            try {
                // Server settings
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'girishkhedikar3399@gmail.com';
                $mail->Password = 'lyfl gduo vzfk iuiv';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                // Recipients
                $mail->setFrom('girishkhedikar3399@gmail.com', 'Pet Adoption');
                $mail->addAddress($email); // Add a recipient
                $mail->addReplyTo('girishkhedikar3399@gmail.com', 'Pet Adoption');

                // Content
                $mail->isHTML(true);
                $mail->Subject = 'Application Status Notification';

                // Fetch animal information based on email and action
                $animal_info = '';
                if ($action === 'approve') {
                    // Query to fetch animal information based on email
                    $sql_animal_info = "SELECT animal_name, id, pin_code, contact_no FROM animals WHERE id IN (SELECT id FROM application_form WHERE email = '$email')";
                    $result_animal_info = $conn->query($sql_animal_info);

                    if ($result_animal_info->num_rows > 0) {
                        while ($row = $result_animal_info->fetch_assoc()) {
                            // Append animal information to the email body
                            $animal_info .= "Animal Name: " . $row['animal_name'] . "<br>";
                            $animal_info .= "Animal id: " . $row['id'] . "<br>";
                            $animal_info .= "pin code: " . $row['pin_code'] . "<br>";
                            $animal_info .= "contact no: " . $row['contact_no'] . "<br>";

                        }
                    }
                }

                // Construct email body
                $mail->Body = "Your application has been " . ($action === 'approve' ? 'approved' : 'disapproved') . ".<br><br>" . $animal_info;
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                // Send email
                $mail->send();
                echo 'Message has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }

        // Close the database connection
        $conn->close();
    }
}
?>




</body>
</html>
