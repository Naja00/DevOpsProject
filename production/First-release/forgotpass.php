<?php
// Include PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// No need to require PHPMailer files since it's included in the Docker image
require 'vendor/autoload.php';

// Database configuration
$servername = "wissamha-db-service";
$database = "mydatabasewissam";
$username = "myuser";
$password = "mypassword";

// Establish database connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to generate a unique token
function generate_token() {
    return bin2hex(random_bytes(5)); // Generate a 32-byte random token (64 characters in hexadecimal)
}

// Function to send a password reset email using PHPMailer
function send_password_reset_email($email, $token) {
    // Create a new PHPMailer instance
    $mail = new PHPMailer;

    // Set up SMTP configuration for Outlook
    $mail->isSMTP(); // Set mailer to use SMTP
    $mail->Host = 'smtp.office365.com'; // Outlook SMTP server
    $mail->SMTPAuth = true; // Enable SMTP authentication
    $mail->Username = 'wissamhassan213@outlook.com'; // Your Outlook email address
    $mail->Password = '@wissam@123@hassan'; // Your Outlook password
    $mail->SMTPSecure = 'tls'; // Enable TLS encryption
    $mail->Port = 587; // TCP port to connect to

    try {
        // Set up sender and recipient
        $mail->setFrom('wissamhassan213@outlook.com', 'Wissam Hassan'); // Sender's email address and name
        $mail->addAddress($email); // Recipient's email address

        // Email subject and body
        $mail->Subject = 'Password Reset Request';
        $mail->Body = "Dear user,\r\n\r\nYou have requested to reset your password. Please click on the following link to reset your password:\r\n\r\n";
        $mail->Body .= "http://127.0.0.1:58773/verify.html\ntoken=$token\r\n\r\n";
        $mail->Body .= "If you did not request this, please ignore this email.\r\n\r\nBest regards,\r\nYour Website";

        // Send the email
        $mail->send();
        echo "Password reset email sent successfully to $email";
    } catch (Exception $e) {
        echo "Password reset email could not be sent. Error: {$mail->ErrorInfo}";
    }
}

// Function to check if the email exists in the database
function check_email_exists($email) {
    global $conn;
    
    $sql = "SELECT * FROM login WHERE email = '$email'";
    $result = $conn->query($sql);
    
    return $result->num_rows > 0;
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];

    // Validate email address
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email address!";
    } else {
        // Check if the email exists in the database
        if (!check_email_exists($email)) {
            $error = "Email not found in the database";
            echo "<script>alert('$error'); window.location.href = 'reset_password.php';</script>";
            exit(); // Stop further execution
        }
        
        $token = generate_token();
        $expires_at = date('Y-m-d H:i:s', strtotime('+1 hour')); // Token expires in 1 hour

        // Store the token and associated email address in the database
        $sql = "INSERT INTO password_reset_tokens (email, token, expires_at) VALUES ('$email', '$token', '$expires_at')";
        if ($conn->query($sql) === TRUE) {
            // Send password reset email
            send_password_reset_email($email, $token);

            // Redirect to confirmation page
            header("Location: reset_password_confirmation.php");
            exit();
        } else {
            $error = "Error storing reset token: " . $conn->error;
        }
    }
}
?>
