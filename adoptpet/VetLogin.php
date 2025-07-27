<?php
require("VetLoginconnect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Doctor Login</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-image: url(payment_history.jpg);
      background-size:cover;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    form {
      background-color: #fff;
      padding: 40px;
      
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    input[type="email"], input[type="password"] {
      width: 100%;
      padding: 10px;
      margin: 5px 0 20px 0;
      border: 1px solid #ccc;
      border-radius: 3px;
    }
    input[type="submit"] {
      background-color: #4caf50;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 3px;
      cursor: pointer;
    }
    input[type="submit"]:hover {
      background-color: #45a049;
    }
    h2 {
      text-align: center;
    }



    body {
            margin: 0; /* Remove default margin */
            padding-top: 80px; /* Adjust padding for fixed navbar */
        }

        header {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            background-color: #ffffff;
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
            color: black;
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

        header #branding {
            float: left;
        }

        header #branding h1 {
            margin: 0;
        }

        header .highlight,
        header .current a {
            color: black;
            font-weight: bold;
        }

        header a:hover {
            color: #cccccc;
            font-weight: bold;
        }
  </style>
</head>
<body>
<header>
    <div class="container2 position">
        <div id="branding">
            <h1><span class="highlight">Vet's Login</span><img src="logo.png" alt=""></h1>
        </div>
        <nav>
            <ul>
                <li class="current"><a href="Home.php">Home</a></li>
                <li><a href="Vet2.php">Vet</a></li>
            </ul>
        </nav>
    </div>
</header>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

    <h2>Vet's Login</h2>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <center>
    <input type="submit" value="Login"></center>
  </form>
</body>
</html>
