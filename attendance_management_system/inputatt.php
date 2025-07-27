<?php
// DB connection
$conn = new mysqli("localhost", "root", "", "attendance_classes");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$success = "";
$error = "";

// On form submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $class_id = $_POST['class_id'];
    $attendance_date = $_POST['attendance_date'];
    $status_data = $_POST['status']; // student_id => Present/Absent

    foreach ($status_data as $student_id => $status) {
        $stmt = $conn->prepare("INSERT INTO attendance_records (student_id, class_id, student_name, attendance_date, status) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $student_id, $class_id, $attendance_date, $status);
        $stmt->execute();
        $stmt->close();
    }

    $success = "✅ Attendance marked successfully.";
}

// Get all classes
$classes = $conn->query("SELECT * FROM classes");

// Get students if class selected
$students = [];
if (isset($_GET['class_id'])) {
    $class_id = $_GET['class_id'];
    $result = $conn->prepare("SELECT * FROM students WHERE class_id = ?");
    $result->bind_param("s", $class_id);
    $result->execute();
    $students = $result->get_result();
    $result->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Mark Attendance</title>
    <style>
        body {
            font-family: sans-serif;
            background-color: #eef2f5;
            padding: 30px;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
        }
        table {
            width: 100%;
            margin-top: 15px;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #ccc;
        }
        input[type="submit"] {
            padding: 12px 20px;
            margin-top: 20px;
            background-color: #2b7de9;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        .msg {
            margin-bottom: 20px;
            padding: 10px;
            border-radius: 6px;
        }
        .success { background-color: #d4edda; color: #155724; }
        .error { background-color: #f8d7da; color: #721c24; }
    </style>
</head>
<body>
<div class="container">
    <h2>Mark Attendance</h2>

    <?php if ($success): ?>
        <div class="msg success"><?= $success ?></div>
    <?php endif; ?>

    <form method="GET" action="">
        <label>Select Class:</label>
        <select name="class_id" required>
            <option value="">-- Select Class --</option>
            <?php while ($class = $classes->fetch_assoc()): ?>
                <option value="<?= $class['class_id'] ?>" <?= (isset($_GET['class_id']) && $_GET['class_id'] == $class['class_id']) ? 'selected' : '' ?>>
                    <?= $class['class_name'] ?> (<?= $class['section'] ?>)
                </option>
            <?php endwhile; ?>
        </select>
        <button type="submit">Load Students</button>
    </form>

    <?php if ($students && $students->num_rows > 0): ?>
    <form method="POST">
        <input type="hidden" name="class_id" value="<?= htmlspecialchars($_GET['class_id']) ?>">
        <label>Date:</label>
        <input type="date" name="attendance_date" required value="<?= date('Y-m-d') ?>">

        <table>
            <thead>
                <tr>
                    <th>Roll No</th>
                    <th>Student Name</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            <?php while ($row = $students->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['roll_no'] ?></td>
                    <td><?= $row['student_name'] ?></td>
                    <td>
                        <select name="status[<?= $row['id'] ?>]" required>
                            <option value="Present">Present</option>
                            <option value="Absent">Absent</option>
                        </select>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>

        <input type="submit" value="Save Attendance">
    </form>
    <?php elseif (isset($_GET['class_id'])): ?>
        <p><strong>No students found in this class.</strong></p>
    <?php endif; ?>
</div>
</body>
</html>
