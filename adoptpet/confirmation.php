<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

session_start();

if (isset($_SESSION['payment_data'])) {
    require('fpdf/fpdf.php');

    class PDF extends FPDF
    {
        function Header()
        {
            $this->SetFont('Arial', 'B', 12);
            $this->Cell(0, 10, 'Payment Confirmation', 0, 1, 'C');
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
            $this->Cell(0, 10, 'Go back to Donation Page', 0, 0, 'R');
            $this->Link($this->GetPageWidth() - 130, 15, 120, 10, 'donation.php'); // Invisible link area
        }
    }

    $pdf = new PDF();
    $pdf->AddPage();

    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, 'Invoice', 0, 1, 'C');

    $pdf->Image('logo.jpg', 10, 10, 30);

    $pdf->SetFont('Arial', '', 12);

    $payment_data = $_SESSION['payment_data'];
    $amount = $payment_data['amount'];
    $phone = $payment_data['phone'];
    $name = $payment_data['name'];
    $email = $payment_data['email'];
    $code = $payment_data['code'];
    $date = $payment_data['date'];

    $pageWidth = $pdf->GetPageWidth();
    $tableWidth = 120;
    $centerX = ($pageWidth - $tableWidth) / 2;

    $pdf->SetFillColor(200, 220, 255);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0, 0, 0);
    $pdf->SetFont('Arial', 'B', 12);

    $pdf->SetXY($centerX, $pdf->GetY());
    $pdf->Cell(60, 10, 'Donation Code', 1, 0, 'C', true);
    $pdf->Cell(60, 10, $code, 1, 1, 'C');

    $pdf->SetXY($centerX, $pdf->GetY());
    $pdf->Cell(60, 10, 'Date & Time', 1, 0, 'C', true);
    $pdf->Cell(60, 10, $date, 1, 1, 'C');

    $pdf->SetXY($centerX, $pdf->GetY());
    $pdf->Cell(60, 10, 'Customer Name', 1, 0, 'C', true);
    $pdf->Cell(60, 10, $name, 1, 1, 'C');

    $pdf->SetXY($centerX, $pdf->GetY());
    $pdf->Cell(60, 10, 'Email', 1, 0, 'C', true);
    $pdf->Cell(60, 10, $email, 1, 1, 'C');

    $pdf->SetXY($centerX, $pdf->GetY());
    $pdf->Cell(60, 10, 'Phone', 1, 0, 'C', true);
    $pdf->Cell(60, 10, $phone, 1, 1, 'C');

    $pdf->SetXY($centerX, $pdf->GetY());
    $pdf->Cell(60, 10, 'Payment Details', 1, 0, 'C', true);
    $pdf->Cell(60, 10, "Amount: $amount INR", 1, 1, 'C');

    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(0, 10, 'Thank you for your donation! Email has been sent to your email.', 0, 1, 'C');

    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(0, 10, '*You Can see payment history in profile page or at Donation page by entering the above Donation code.', 0, 1, 'C');

    $pdf_content = $pdf->Output('', 'S');
    $pdf_filename = 'Payment_Confirmation_' . $code . '.pdf';

    // Send email with PDF attachment
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = 'skamde05@gmail.com';  // SMTP username
        $mail->Password = 'uzvm cfzt cxyg yfii';  // SMTP password
        $mail->SMTPSecure = 'tls';  // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;  // TCP port to connect to

        //Recipients
        $mail->setFrom('skamde05@gmail.com', 'Pet adoption');
        $mail->addAddress($email, $name); // Add a recipient

        //Attachments
        $mail->addStringAttachment($pdf_content, $pdf_filename); // Add attachments

        //Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = 'Payment Confirmation';
        $mail->Body = 'Dear ' . $name . ',<br><br>Your payment has been confirmed. Thank you for your donation.<br><br>Kind Regards,<br>Pet Adoption Organization';

        // Send the email
        $mail->send();

        // Output PDF directly
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="' . $pdf_filename . '"');
        header('Cache-Control: private, max-age=0, must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . strlen($pdf_content));
        ob_clean();
        flush();
        echo $pdf_content;

        // Unset session data
        unset($_SESSION['payment_data']);
    } catch (Exception $e) {
        http_response_code(500);
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    http_response_code(404);
    echo "No payment data found.";
}
?>
