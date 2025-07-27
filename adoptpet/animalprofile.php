
<html>
<head>
<style>
/* Default styles */
body {
            margin: 0; /* Remove default margin */
            padding-top: 80px; /* Adjust padding for fixed navbar */
        }

        header {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            background-color: #4caf50;
            padding: 15px 0; /* Adjust padding for header */
            border-bottom: #e8491d 3px solid;
            box-sizing: border-box; /* Ensure padding is included in width */
        }

        header .container2 {
            width: 80%;
            margin: auto;
            overflow: hidden;
            font: 15px/1.5 Arial, Helvetica, sans-serif;
        }

        header nav {
            float: right;
            margin-top: 4px;
        }





        header a {
            color: white;
            text-decoration: none;
            text-transform: uppercase;
            font-size: 14px;
            font-weight: bold;
            
        }

        header li {
            float: left;
            display: inline;
            padding: 0 20px;
        }

        header #branding {
            float: left;
        }

        header #branding h1 {
            margin: 0;
        }

        header .highlight,
        header .current a {
            color: white;
            font-weight: bold;
        }

        header a:hover {
            color: #cccccc;
            font-weight: bold;
            text-decoration-line: underline;
        }

        button {
            background-color: rgb(3, 155, 0);
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 12px 24px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .container {
    padding-top: 25px;
    margin-left: 20px; /* Adjust left margin */
    
}
/* Mobile styles */
@media only screen and (max-width: 600px) {
    .menu-tabs {
        text-align: center;
    }

    .menu-tabs li {
        display: block;
        margin: 10px 0;
    }

    .display-text-image {
        flex-direction: column;
        text-align: center;
    }

    .profile-img {
        margin-left: 0;
        margin-bottom: 20px;
    }

    .adopt-button {
        margin-top: 20px;
    }

    .second-section {
        margin-right: 10px;
        margin-left: 10px;
    }
}

/* Tablet and desktop styles */
@media only screen and (min-width: 601px) {
    .second-section {
        margin-right: 50px;
        margin-left: 50px;
    }
}
</style>
</head>
<body>
<<header>
  <div class="container">
    <div id="branding">
      <h1><span class="highlight">Pet Profile</span></h1>
    </div>
    <nav>
      <ul>
        <li><a href="home.php">Home</a></li>
        <li><a href="animalAdd.php"> Add Animal</a></li>
        <li><a href="Vet1.php">Vet</a></li>
        
        
      </ul>
    </nav>
  </div>
</header>


<?php
    // Assuming you have already started the session
    // Connect to your database (replace 'localhost', 'username', 'password', and 'database_name' with your actual credentials)
    $connection = mysqli_connect('localhost', 'adoptpet_db', 'adoptpet_db', 'adoptpet_db');

    // Check connection
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Check if the ID is set in the query parameters
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Query to fetch animal information based on the ID
        $sql = "SELECT * FROM animals WHERE id = $id"; // Adjust this query according to your database schema
        $result = mysqli_query($connection, $sql);

     // Check if there are any rows returned
// Check if there are any rows returned
if (mysqli_num_rows($result) > 0) {
    // Output data of the specific profile
    $row = mysqli_fetch_assoc($result);
    $name = $row["animal_name"];
    $age = $row["age"];
    $category = $row["category"];
    $pin_code = $row["pin_code"];
    $image = $row["image_path"];
    $breed = $row["breed"];
    $description = $row["description"];

    // Start displaying profile information with inline styles
    echo '<div class="profile" style="text-align: center; padding: 20px; border: 2px solid #ccc; border-radius: 10px;">';
    echo '<img src="' . $image . '" alt="Profile" style="width: 400px; height: 350px; border-radius: 15px;">'; // Adjust width and height as needed
    echo '<hr>';
    echo '<p style="font-weight: bold; font-size: 20px;">' .'Name : '. $name . '</p>';
    echo '<p><strong>Category:</strong> ' . $category . '</p>';
    echo '<p><strong>Age:</strong> ' . $age . '</p>';
    echo '<p><strong>Breed:</strong> ' . $breed . '</p>';
    echo '<p><strong>Pin Code:</strong> ' . $pin_code . '</p>';
    echo '<p><strong>Description:</strong> ' . $description . '</p>';
    
    // Add more inline styles as needed for other profile information
    echo '</div>';
} 

else {
            echo "Profile not found.";
        }
    } else {
        echo "Profile ID not provided.";
    }

    // Close database connection
    mysqli_close($connection);
    ?>
<center>
<button type="submit" name="adopt" onclick="window.location.href='applicationform.php'">Adopt</button>
</center>

</body>
</html>
