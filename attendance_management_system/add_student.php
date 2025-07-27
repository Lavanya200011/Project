<?php
$conn = new mysqli("localhost", "root", "", "attendance_classes");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$success = "";
$error = "";

// Fetch classes for dropdown
$classes = $conn->query("SELECT class_id, class_name, section FROM classes");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_name = trim($_POST['student_name']);
    $roll_no = trim($_POST['roll_no']);
    $class_id = $_POST['class_id'];
    $student_id = "STU-" . strtoupper(uniqid());

    if (empty($student_name) || empty($roll_no) || empty($class_id)) {
        $error = "All fields are required.";
    } else {
        $stmt = $conn->prepare("INSERT INTO students (student_id, student_name, roll_no, class_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $student_id, $student_name, $roll_no, $class_id);

        if ($stmt->execute()) {
            $success = "✅ Student added successfully!<br><strong>Student ID: $student_id</strong>";
        } else {
            $error = "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
    <style>
        body { font-family: 'Segoe UI'; background-color: #f4f6f9; }
        .container {
            max-width: 450px; margin: 50px auto;
            background: white; padding: 30px 40px;
            border-radius: 10px; box-shadow: 0 8px 16px rgba(0,0,0,0.1);
        }
        label { display: block; margin-top: 20px; font-weight: bold; color: #555; }
        input, select {
            width: 100%; padding: 10px; margin-top: 8px;
            border: 1px solid #ccc; border-radius: 6px;
        }
        input[type="submit"] {
            margin-top: 25px; background-color: #0066cc;
            border: none; color: white; font-weight: bold;
            cursor: pointer; transition: background 0.3s ease;
        }
        input[type="submit"]:hover { background-color: #0066cc; }
        .message { margin-top: 20px; padding: 10px; border-radius: 6px; }
        .success { background-color: #d4edda; color: #155724; }
        .error { background-color: #f8d7da; color: #721c24; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Add New Student</h2>

        <?php if (!empty($success)): ?>
            <div class="message success"><?php echo $success; ?></div>
        <?php endif; ?>
        <?php if (!empty($error)): ?>
            <div class="message error"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <label for="student_name">Student Name:</label>
            <input type="text" name="student_name" required>

            <label for="roll_no">Roll Number:</label>
            <input type="text" name="roll_no" required>

            <label for="class_id">Class:</label>
            <select name="class_id" required>
                <option value="">-- Select Class --</option>
                <?php while($row = $classes->fetch_assoc()): ?>
                    <option value="<?php echo $row['class_id']; ?>">
                        <?php echo $row['class_name'] . " - Section " . $row['section']; ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <input type="submit" value="Add Student">
        </form>
    </div>
</body>
</html>
