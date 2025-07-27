<?php
// checkattendance.php

// 1) Connect
$conn = new mysqli("localhost", "root", "", "attendance_system");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$records = [];
$error   = "";

// 2) Handle the form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $student_id   = trim($_POST['student_id']);
    $class_id     = trim($_POST['class_id']);
    $attendance_date = trim($_POST['attendance_date']);  // if you want to filter by date or month

    // 3) Prepare & execute
    $sql = "
      SELECT
        attendance_records.attendance_date,
        attendance_records.status
      FROM attendance_records
      WHERE attendance_records.student_id = ?
        AND attendance_records.class_id = ?
        AND attendance_records.attendance_date = ?
      ORDER BY attendance_records.attendance_date
    ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $student_id, $class_id, $attendance_date);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            $records[] = $row;
        }
    } else {
        $error = "No attendance found for Student ID <strong>$student_id</strong> on <strong>$attendance_date</strong>.";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <title>Check Attendance</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen font-sans">

  <!-- Header -->
  <header class="bg-white shadow p-4 flex justify-between items-center">
    <nav class="space-x-6">
      <a href="main.php" class="text-blue-600 font-semibold hover:underline">🏠 Dashboard</a>
    </nav>
  </header>

  <div class="max-w-xl mx-auto mt-8 bg-white p-6 rounded-lg shadow">
    <h1 class="text-2xl font-bold mb-4">Check Student Attendance</h1>

    <!-- 4) The form -->
    <form method="POST" class="space-y-4">
      <div>
        <label class="block mb-1">Student ID</label>
        <input type="text" name="student_id" class="w-full px-3 py-2 border rounded" required>
      </div>
      <div>
        <label class="block mb-1">Class ID</label>
        <input type="text" name="class_id" class="w-full px-3 py-2 border rounded" required>
      </div>
      <div>
        <label class="block mb-1">Date</label>
        <input type="date" name="attendance_date" class="w-full px-3 py-2 border rounded" required>
      </div>
      <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Check</button>
    </form>

    <!-- Error -->
    <?php if ($error): ?>
      <div class="mt-6 p-4 bg-red-100 text-red-700 rounded"><?= $error ?></div>
    <?php endif; ?>

    <!-- Results -->
    <?php if (!empty($records)): ?>
      <div class="mt-6 overflow-x-auto">
        <table class="w-full text-left border-collapse">
          <thead>
            <tr class="bg-indigo-100 text-indigo-700">
              <th class="p-2">Date</th>
              <th class="p-2">Status</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              $total = count($records);
              $present = 0;
              foreach ($records as $r): 
                if ($r['status'] === 'Present') $present++;
            ?>
              <tr class="border-b hover:bg-gray-50">
                <td class="p-2"><?= htmlspecialchars($r['attendance_date']) ?></td>
                <td class="p-2"><?= htmlspecialchars($r['status']) ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>

        <!-- Summary -->
        <div class="mt-4">
          <p><strong>Total Records:</strong> <?= $total ?></p>
          <p><strong>Present:</strong> <?= $present ?></p>
          <p><strong>Attendance %:</strong> <?= round($present / $total * 100, 2) ?>%</p>
        </div>
      </div>
    <?php endif; ?>

  </div>
</body>
</html>
