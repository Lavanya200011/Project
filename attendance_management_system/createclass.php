<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// DB connection
$conn = new mysqli("localhost", "root", "", "attendance_classes");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $class_name = trim($_POST['class_name']);
    $section = trim($_POST['section']);
    $class_id = "CLS-" . strtoupper(uniqid());

    if (empty($class_name) || empty($section)) {
        $error = "All fields are required.";
    } else {
        $check = $conn->prepare("SELECT * FROM classes WHERE class_name=? AND section=?");
        $check->bind_param("ss", $class_name, $section);
        $check->execute();
        $result = $check->get_result();

        if ($result->num_rows > 0) {
            $error = "This class with the section already exists.";
        } else {
            $stmt = $conn->prepare("INSERT INTO classes (class_id, class_name, section) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $class_id, $class_name, $section);

            if ($stmt->execute()) {
                $success = "✅ Class created successfully!<br><strong>Class ID: $class_id</strong>";
            } else {
                $error = "Error: " . $stmt->error;
            }
            $stmt->close();
        }
        $check->close();
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Class</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 420px;
            margin: 50px auto;
            background: white;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        label {
            display: block;
            margin-top: 20px;
            color: #555;
            font-weight: bold;
        }
        input[type="text"], select {
            width: 100%;
            padding: 10px 14px;
            margin-top: 8px;
            border: 1px solid #ccc;
            border-radius: 6px;
            background-color: #f9f9f9;
        }
        input[type="submit"] {
            margin-top: 25px;
            width: 100%;
            padding: 12px;
            background-color: #0066cc;
            border: none;
            color: white;
            font-weight: bold;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #004a99;
        }
        .message {
            margin-top: 20px;
            padding: 10px;
            border-radius: 6px;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>
   <div class="flex justify-center mt-8">
    <div class="relative w-32 h-32">
        <svg class="transform -rotate-90" width="100%" height="100%" viewBox="0 0 100 100">
            <circle cx="50" cy="50" r="45" stroke="#e5e7eb" stroke-width="10" fill="none" />
            <circle
                cx="50"
                cy="50"
                r="45"
                stroke="#4f46e5"
                stroke-width="10"
                fill="none"
                stroke-dasharray="282.6"
                stroke-dashoffset="<?= 282.6 - (282.6 * $attendance_percentage / 100) ?>"
                stroke-linecap="round"
            />
        </svg>
        <div class="absolute inset-0 flex items-center justify-center text-indigo-700 font-semibold text-xl">
            <?= $attendance_percentage ?>%
        </div>
    </div>
</div>


</body>
</html>
