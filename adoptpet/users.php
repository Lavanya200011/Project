<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
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
        <button class="button" onclick="window.location.href='pets_data.html'">Pets
Data</button>
        <button class="button" onclick="window.location.href='Donation_data.php'">Donations</button>
        <button class="button" onclick="window.location.href='logout.php'">Logout</button>
    </header>


    <!-- Display user data in a table -->
    <table border="1">
        
        <tbody>
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
$sql = "SELECT id, email, mobile, name, profile_image FROM users";
$result = $conn->query($sql);

// Check if there are any records
if ($result->num_rows > 0) {
    // Output data of each row
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Name</th>
                <th>Profile Image</th>
            </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["mobile"] . "</td>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td><img src='" . $row["profile_image"] . "' width='100' height='100'></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No users found";
}

// Close the database connection
$conn->close();
?>

        </tbody>
    </table>
</body>
</html>
