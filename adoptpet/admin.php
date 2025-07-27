<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Requests</title>

<style>


.container{
    display:flex;
}
body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      background-color:white;
    }

    #container {
      display: flex;
      height: 100%;
    }

    #left-section {
      background-color:white;
      width: 20%;
      padding: 20px;
    }

    .logo {
      height: 120px; /* Adjust as needed */
      width: 100%;
      border-radius: 12px;
      
      
    }

    #menu-tabs {
      display: flex;
      flex-direction: column;
     
        
        
     
    }

    .menu-tab {
      padding: px;
      margin-bottom: 10px;
      color:black;
      background-color: lightgreen;
      cursor: pointer;
      border-radius:8px;
     
      
      
     
    }
    
    
    
    a{
           text-decoration:none;
           color:white; 
    }

    #right-section {
      background-color:white;
      width: 100%;
      height:100%;
      padding: 20px;
      border:solid;
    }

    fieldset {
      margin: 60px 40px;
      padding: 20px;
      border: 2px solid #000;
      display: flex;
    }

    .column {
      flex: 1;
      margin-right: 20px;
      border:solid;
      margin-top: 12px;
    }

    .row {
      display: flex;
      flex-direction: column;
      margin-bottom: 20px;
    }

    .image {
      height: 60px; /* Adjust as needed */
      width: 100%; /* Adjust as needed */
     border-radius: 50%;
   
    }

    .description {
      margin-top: 80px;
    }

.image-correct{
      margin-top:115px;
      padding-bottom:120px ;
}



 /* approval disapproval button */
 
.flex-button{
    display:flex;
}

.left-button{
    left:2px;
}

.right-button{
    right:2px;
    margin-left:120px;
}




            /*  Admin history */


.fieldset-adjust{
    padding:0px;
    margin-right: 280px;
}



</style>
</head>
<body>
    <div class="container">
        <div id="left-section">
            <div><img src="logo.jpg" alt="" class="logo"></div>
            <hr><hr>
            <div id="menu-tabs">
                <div class="menu-tab" align="center"><a href="adminpage.html">Customer request</a></div>
                <br>
                <div class="menu-tab" align="center"><button onclick="displayHistory()" class="menu-tab">History</button></div>
            </div>
        </div>

        <div id="right-section">
            <h1>User Requests</h1><br>

            <table border="1">
                <tr>
                    <th>User ID</th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Application Details</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>



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
$sql = "SELECT user_id, user_name, email, application_details, status FROM animal_info";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["user_id"] . "</td>";
        echo "<td>" . $row["user_name"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["application_details"] . "</td>";
        echo "<td>" . $row["status"] . "</td>";
        echo "<td>";
        echo "<form method='post' action='email1.php'>";
        echo "<input type='hidden' name='user_id' value='" . $row["user_id"] . "'>";
        echo "<button type='submit' name='action' value='approve'>Approve</button>";
        echo "<button type='submit' name='action' value='disapprove'>Disapprove</button>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6'>No user requests found</td></tr>";
}

// Close the database connection
$conn->close();
?>
    </table>
        </div>
    </div>
</body>
</html>