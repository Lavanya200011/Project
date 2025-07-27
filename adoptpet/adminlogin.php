<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
   
   
    <style>

#bg-img{
    background-image: url("./images/pet5.jpg");
   background-repeat:no-repeat;
   background-size: cover;
}

        body {
            
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url("./images/pet5.jpg");
        }
        
        .container {
            background-color: #ffffff87;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            width: 400px;
            max-width: 90%;
            
            animation: fadeIn 0.5s ease; /* Fade-in animation */
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .form-box {
            text-align: center;
        }

        #title {
            margin-bottom: 20px;
        }

        .input-field {
            margin-bottom: 20px;
            position: relative;
        }

        .input-field input {
            width: 94%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            padding-left: 20px;
        }

        .input-field i {
            position: absolute;
            top: 50%;
            left: 12px;
            transform: translateY(-50%);
            color: #777;
        }

        .btn-field {
            
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
          
            
           
        }

        .btn-field button {
            background-color: rgb(3,155,0);
            color: #fff;
            
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
            width: 48%; /* Adjusting button width */
         
            
        }

     
        .btn-field button:hover {
            background-color: rgb(3,155,0);
            color: #777;
            text-decoration:none;
        }

        p {
            margin-top: 15px;
            font-size: 14px;
            
        }

      a {
          
            text-decoration: none;
        }

        p a:hover {
            text-decoration: none;
        }
        #SignupBtn{
            text-decoration: none;
        }
    </style>
</head>

<body  id="bg-img">

    <div class="container">
  
        <div class="form-box">
            <h1 id="title">Admin Login</h1>
            <form action="adminloginconnect.php" method="post" id="login" >
               
                <div class="input-field">
                    <i class="fas fa-envelope"></i>
                    <input type="text" name="admin_name" placeholder="Enter name" required>
                </div>
               
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Enter Password" required>
                </div>
                
                <div class="btn-field">
                    
                    <button type="submit">Login</button>
                </div>
            </form>
        </div>
    </div> 

   
   
</body>
</html>