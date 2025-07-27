
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="CONTENT-TYPE" content="text/html; charset=UTF-8">
  <title>Logout !</title>
  <style>
    body {
      background-image: url("./images/pet4.jpg");
      background-color: #f0f0f0;
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    #logout {
      border: 2px solid #333;
      background-color: #fff;
      max-width: 400px;
      margin: 50px auto;
      padding: 20px;
      text-align: center;
    }

    h1 {
      color: #333;
    }

    button {
      padding: 10px 20px;
      border: none;
      cursor: pointer;
      font-size: 16px;
      border-radius: 5px;
    }

    #btn-cancel {
      background-color: rgb(3,155,0);
      color: #333;
      margin-right: 10px;
    }

    #btn-logout {
      background-color: rgb(3,155,0); /* Tomato */
      color: #333;
    }
  </style>
</head>
<body>
  <div id="logout">
    <h1>Are you sure you want to logout?</h1>
    <br>
    <button id="btn-cancel">Cancel</button>
    <button id="btn-logout">Logout</button>
  </div>

  <script>
    document.getElementById("btn-logout").addEventListener("click", function() {
      // Perform logout action
      fetch("logout.php", {
        method: "POST",
        credentials: "same-origin"
      })
      .then(response => {
        if (response.ok) {
          // Redirect to login page after successful logout
          window.location.href = "adminlogin.php";
        } else {
          // Handle error if logout fails
          console.error("Logout failed");
        }
      })
      .catch(error => {
        console.error("Error:", error);
      });
    });

    document.getElementById("btn-cancel").addEventListener("click", function() {
      // Redirect to profile page
      window.location.href = "application_form.php";
    });
  </script>
</body>
</html>
