<?php
$conn = new mysqli("localhost", "root", "", "attendance_system");

$date = $_POST['date'];
$lecture = $_POST['lecture'];
$subject = $_POST['subject'];
$statusArray = $_POST['status']; // This is an array like: status[student_id] = 'Present'

foreach ($statusArray as $student_id => $status) {
  $stmt = $conn->prepare("INSERT INTO attendance (student_id, date, lecture, subject, status) VALUES (?, ?, ?, ?, ?)");
  $stmt->bind_param("isiss", $student_id, $date, $lecture, $subject, $status);
  $stmt->execute();
}

echo "✅ Attendance recorded successfully!";
header("Location:markattendance.php");
?>
