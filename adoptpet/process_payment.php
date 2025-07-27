<?php
session_start();

date_default_timezone_set('Asia/Kolkata');

function generateCode($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $code = '';
    for ($i = 0; $i < $length; $i++) {
        $code .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $code;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "adoptpet_db";
    $password = "adoptpet_db";
    $dbname = "adoptpet_db";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO payment_form (amount, phone, name, email, code, date) VALUES (?, ?, ?, ?,?, ?)");
    $stmt->bind_param("ssssss", $amount, $phone, $name,$email, $code, $payment_date);

    $amount = $_POST['amount'];
    $phone = $_POST['phone'];
    $name = $_POST['name'];
    $email= $_POST['email'];
    $code = generateCode(); 
    $payment_date = date("Y-m-d H:i");
    $stmt->execute();

    $stmt->close();

   

    $conn->close();

    $_SESSION['payment_data'] = array(
        'amount' => $amount,
        'phone' => $phone,
        'name' => $name,
        'email' => $email,
        'code' => $code,
        'date' => $payment_date,
    );

    header("Location: confirmation.php");
    exit();
}
?>
