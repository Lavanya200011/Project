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
$sql = "SELECT * FROM animals";
$result = $conn->query($sql);

// Check if there are any records
if ($result->num_rows > 0) {
    // Output data of each row
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>animal_name</th>
                <th>breed</th>
                 <th>catogory</th>
                 <th>age</th>
                <th>is_stray</th>
                <th>pin_code</th>
                <th>contact_no</th>
                <th>gender</th>
                <th>description</th>
                <th>image_path</th>
        </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["animal_name"] . "</td>";
        echo "<td>" . $row["breed"] . "</td>";
        echo "<td>" . $row["category"] . "</td>";
        echo "<td>" . $row["age"] . "</td>";
        echo "<td>" . $row["is_stray"] . "</td>";
        echo "<td>" . $row["pin_code"] . "</td>";
        echo "<td>" . $row["contact_no"] . "</td>";
        echo "<td>" . $row["gender"] . "</td>";
       
        echo "<td>" . $row["description"] . "</td>";
        echo "<td>" . $row["image_path"] . "</td>";
       
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
