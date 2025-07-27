<?php
require('fpdf/fpdf.php');

// Database connection parameters
$servername = "localhost";
$username = "adoptpet_db";
$password = "adoptpet_db";
$database = "adoptpet_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the last inserted record from the database
$sql = "SELECT * FROM vet3table ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result !== false && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $Day = $row['Day'];
    $Time = $row['Time'];
    $Date = $row['Date'];
    $name = $row['name'];
    $pet = $row['pet'];
    $service = $row['service'];
    $symptoms = $row['symptoms'];
} else {
    echo "No appointment found.";
}

// Close connection
$conn->close();

// Create PDF
class PDF extends FPDF
{
    // Page header
    function Header()
    {
        // Logo and title
        $this->SetFont('Arial', 'B', 16);
        $this->Cell(0, 10, 'Appointment Confirmation', 0, 1, 'C');
        $this->Ln(10);
    }


    
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');

        // Add HTML button
        $this->SetFont('Arial', '', 10);
        $this->SetTextColor(0, 0, 128);
        $this->SetXY($this->GetPageWidth() - 100, 15); // Adjusted X position
        $this->Cell(0, 10, 'Go back to Vet Profile', 0, 0, 'R');
        $this->Link($this->GetPageWidth() - 130, 15, 120, 10, 'Vet1.php'); // Invisible link area
    }


    
    

    // Page content
    function Content($name, $Day, $Time, $Date, $pet, $service, $symptoms)
    {
        // Content
        $this->SetFont('Arial', '', 12);
        $this->Cell(0, 10, "Thank you, $name, for booking an appointment with Lifeline Pet Clinic.", 0, 1);
        $this->Ln(5);
        $this->Cell(0, 10, "Details:", 0, 1);
        $this->Cell(0, 10, "Name: $name", 0, 1);
        $this->Cell(0, 10, "Day: $Day", 0, 1);
        $this->Cell(0, 10, "Time: $Time", 0, 1);
        $this->Cell(0, 10, "Date: $Date", 0, 1);
        $this->Cell(0, 10, "Pet: $pet", 0, 1);
        $this->Cell(0, 10, "Service: $service", 0, 1);
        $this->Cell(0, 10, "Symptoms: $symptoms", 0, 1);
        $this->Ln(10);
        $this->Cell(0, 10, "Your appointment is confirmed. We look forward to seeing you.", 0, 1);
    }
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->Content($name, $Day, $Time, $Date, $pet, $service, $symptoms);
$pdf->Output();
?>
