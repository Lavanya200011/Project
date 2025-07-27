<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor's Appointment Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
        }
        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
        h2 {
            color: #333;
            text-align: center;
            margin-top: 20px;
        }
        button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 10px;
            cursor: pointer;
            border-radius: 4px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        .done-btn {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 8px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .message {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<header>
    <h1>Vet's Appointment Data</h1>
    <button onclick="window.location.href='Vet2.php'">Go Back</button>
</header>

<div class="container">
    <h2>Appointments</h2>
    <table>
        <tr>
            <th>Day</th>
            <th>Time</th>
            <th>Date</th>
            <th>Name</th>
            <th>Pet</th>
            <th>Service</th>
            <th>Symptoms</th>
            <th>Status</th>
        </tr>
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

        // Fetch data from the database
        $sql = "SELECT * FROM vet3table";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['Day'] . "</td>";
                echo "<td>" . $row['Time'] . "</td>";
                echo "<td>" . $row['Date'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['pet'] . "</td>";
                echo "<td>" . $row['service'] . "</td>";
                echo "<td>" . $row['symptoms'] . "</td>";
                echo "<td><form method='post'><input type='hidden' name='delete_id' value='" . $row['id'] . "'><input class='done-btn' type='submit' value='Done'></form></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='8'>No appointments found</td></tr>";
        }

        // Close connection
        $conn->close();
        ?>
    </table>
    <div class="message">
        <?php
        // Process delete action
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
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

            // Delete record from the database
            $delete_id = $_POST['delete_id'];
            $sql = "DELETE FROM vet3table WHERE id = $delete_id";

            if ($conn->query($sql) === TRUE) {
                // Redirect back to the same page after deletion
                header("Location: ".$_SERVER['PHP_SELF']);
                exit();
            } else {
                echo "Error deleting record: " . $conn->error;
            }

            // Close connection
            $conn->close();
        }
        ?>
    </div>
</div>

</body>
</html>
