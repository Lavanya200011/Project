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
        <button class="button" onclick="window.location.href='index.html'">Home</button>
        <button class="button" onclick="window.location.href='users.php'">Users</button>
        <button class="button" onclick="window.location.href='application_form.php'">Application Form</button>
        <button class="button" onclick="window.location.href='vetbooking.html'">Vet Booking</button>
        <button class="button" onclick="window.location.href='donations.html'">Donations</button>
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
                <th>PAN Card File</th>
                <th>Donation Receipt File</th>
             
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
        echo "<td>" . $row["pan_card_file"] . "</td>";
        echo "<td>" . $row["donation_receipt_file"] . "</td>";
           echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No application forms found";
}

// Close the database connection
$conn->close();
?>

</body>
</html>
