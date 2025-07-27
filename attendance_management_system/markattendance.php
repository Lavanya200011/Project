<?php
$conn = new mysqli("localhost", "root", "", "attendance_system");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mark Attendance</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

<header class="bg-white shadow p-4 flex justify-between items-center">
    <h1 class="text-xl font-semibold flex items-center space-x-2">
      📘 <span>Student Attendance System</span>
    </h1>
    <nav class="space-x-6">
      <a href="main.php" class="text-blue-600 font-semibold">Dashboard</a>
    </nav>
  </header>

  <div class="max-w-4xl mx-auto p-6">
    <h1 class="text-3xl font-bold text-center mb-6">📝 Mark Attendance</h1>

    <?php if (!isset($_POST['section_id'])): ?>
      <form method="POST" action="">
        <div class="grid md:grid-cols-2 gap-4 mb-6">
          <div>
            <label class="block font-semibold mb-1">Department</label>
            <select name="dept_id" class="w-full p-2 border rounded" required>
              <?php
              $res = $conn->query("SELECT * FROM departments");
              while ($row = $res->fetch_assoc()) {
                echo "<option value='{$row['dept_id']}'>{$row['dept_name']}</option>";
              }
              ?>
            </select>
          </div>
          <div>
            <label class="block font-semibold mb-1">Section</label>
            <select name="section_id" class="w-full p-2 border rounded" required>
              <?php
              $res = $conn->query("SELECT * FROM sections");
              while ($row = $res->fetch_assoc()) {
                echo "<option value='{$row['section_id']}'>Section {$row['section_name']} (Dept {$row['dept_id']})</option>";
              }
              ?>
            </select>
          </div>
          <div>
            <label class="block font-semibold mb-1">Lecture No</label>
            <input type="number" name="lecture" class="w-full p-2 border rounded" required min="1" max="8">
          </div>
          <div>
            <label class="block font-semibold mb-1">Subject</label>
            <input type="text" name="subject" class="w-full p-2 border rounded" required>
          </div>
          <div class="md:col-span-2">
            <label class="block font-semibold mb-1">Date</label>
            <input type="date" name="date" class="w-full p-2 border rounded" required>
          </div>
        </div>
        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Load Students</button>
      </form>

    <?php else: ?>
      <?php
      $section_id = $_POST['section_id'];
      $lecture = $_POST['lecture'];
      $subject = $_POST['subject'];
      $date = $_POST['date'];
      $students = $conn->query("SELECT * FROM students WHERE section_id=$section_id");
      ?>
      <form method="POST" action="submit_attendance.php" class="space-y-4">
        <input type="hidden" name="section_id" value="<?= $section_id ?>">
        <input type="hidden" name="lecture" value="<?= $lecture ?>">
        <input type="hidden" name="subject" value="<?= $subject ?>">
        <input type="hidden" name="date" value="<?= $date ?>">

        <div class="bg-white p-4 rounded shadow">
          <h2 class="text-xl font-bold mb-4">Students in Section <?= $section_id ?></h2>
          <?php while ($student = $students->fetch_assoc()): ?>
            <div class="mb-4">
              <strong><?= $student['roll_no'] ?> - <?= $student['name'] ?></strong><br>
              <label><input type="radio" name="status[<?= $student['student_id'] ?>]" value="Present" checked> Present</label>
              <label><input type="radio" name="status[<?= $student['student_id'] ?>]" value="Absent"> Absent</label>
             <!-- <label><input type="radio" name="status[<?= $student['student_id'] ?>]" value="Late"> Late</label> -->
            </div>
          <?php endwhile; ?>
        </div>

        <button type="submit" class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700">Submit Attendance</button>
      </form>
    <?php endif; ?>
  </div>
</body>
</html>
