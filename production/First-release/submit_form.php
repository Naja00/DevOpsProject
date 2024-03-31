<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Include PHPMailer autoloader

// Initialize PHPMailer
$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP(); // Set mailer to use SMTP
    $mail->Host = 'smtp.office365.com'; // Outlook SMTP server
    $mail->SMTPAuth = true; // Enable SMTP authentication
    $mail->Username = 'wissamhassan213@outlook.com'; // Your Outlook email address
    $mail->Password = '@wissam@123@hassan'; // Your Outlook password
    $mail->SMTPSecure = 'tls'; // Enable TLS encryption
    $mail->Port = 587; // TCP port to connect to
    
    // Sender and recipient settings
    $mail->setFrom('wissamhassan213@outlook.com', 'Wissam Hassan');
    $mail->addAddress('Profit-Plus2024@outlook.com', 'Profit-plus'); // Add your email here
    
    // Content
    $mail->isHTML(true); // Set email format to HTML
    $mail->Subject = 'New Message from Website';
    
    // Construct the email body
    $emailBody = "User's Email: {$_POST['userEmail']}<br>";
    $emailBody .= "User's Message: {$_POST['userMessage']}";

    $mail->Body = $emailBody;
    
    // Send email
    $mail->send();
    
    // Redirect to contact-us.html and display alert
    echo "<script>alert('Message has been sent'); window.location.href = 'contact-us.html';</script>";
} catch (Exception $e) {
    echo "<script>alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}'); window.location.href = 'contact-us.html';</script>";
}
?>
