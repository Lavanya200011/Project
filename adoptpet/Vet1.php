<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veterinary Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('VetBG123.jpeg');
            background-size: cover;
            background-repeat: no-repeat;
        }

        /* Header Styling */
        header {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            background-color: #4CAF50; /* Green background color */
            padding: 15px 0;
            border-bottom: #e8491d 3px solid;
            box-sizing: border-box;
        }

        header a {
            color: white;
            text-decoration: none;
            text-transform: uppercase;
            font-size: 16px;
            font-weight: bold;
        }

        header li {
            float: left;
            display: inline;
            padding: 0 20px;
        }

        header nav {
            float: right;
            margin-top: 4px;
        }

        header .highlight,
        header .current a {
            color: white;
            font-weight: bold;
            text-transform: uppercase;
        }

        header a:hover {
            color: #cccccc;
            font-weight: bold;
            text-decoration-line: underline;
        }

        header button {
            font-size: 16px;
            text-transform: uppercase;
            font-weight: bold;
            background: none;
            border: none;
            color: white;
            cursor: pointer;
        }

        header button:hover {
            color: #cccccc;
            text-decoration: underline;
        }

        header #branding h1 {
            margin: 0;
        }

        header .menu-tabs {
            list-style-type: none;
        }

        header .menu-tabs li {
            display: inline-block;
            margin-left: 15px;
        }

        header .menu-tabs li a {
            font-size: 16px;
        }

        /* Responsive Header */
        @media only screen and (max-width: 600px) {
            header nav {
                float: none;
                text-align: center;
            }

            header #branding {
                text-align: center;
            }
        }

        .container {
            max-width: 600px;
            margin-top: 150px;
            margin-left: 425px;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.564);
            border-radius: 6px;
        }

        img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }

        h1,
        h2,
        p {
            margin-bottom: 10px;
        }

        button {
            display: block;
            margin-bottom: 10px;
            width: 100%;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        .services-list {
            list-style: none;
            padding: 0;
            text-align: center;
        }

        .services-list li {
            margin: 10px 0;
            background-color: #f0f0f0;
            padding: 10px;
            border-radius: 5px;
        }

        .small-button {
            background-color: #4CAF50;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .small-button:hover {
            background-color: #45a049;
        }

        button {
            background-color: #4CAF50;
            color: #f4f4f4;
            display: block;
            margin: 1px auto;
            width: 60%;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <header>
        <div class="position">
            <div id="branding">
                <h1><span class="highlight">Vet Profile</span></h1>
            </div>
            <nav>
                <ul>
                    <li class="current"><a href="Home.php">Home</a></li>
                    <li><button onclick="window.location.href='VetLogin.php';">Vet's Login</button></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container">
        <img src="Vetimg.png" width="150" height="150">
        <h2>Dr. Abhishek Rawt</h2>
        <p>Specialty: Dogs</p>
        <p>Experience: 6 years</p>
        <p>Gender: Male</p>
        <p>Qualification: BVSc.Bachelor in Veterinary Science PGDA---</p>
        <p>Address: Jeevan Hospital, Sakoli</p>
        <a href="Vet2.php">
            <button class="small-button">Book Appointment</button>
        </a>
        <center>
            <h2 class="PetServ">Vet's Services</h2>
        </center>
        <ul class="services-list">
            <li>Veterinary Physician</li>
            <li>Veterinary Services</li>
            <li>Grooming</li>
            <li>Emergency Care</li>
            <li>Veterinary Surgery</li>
        </ul>
    </div>
</body>

</html>
