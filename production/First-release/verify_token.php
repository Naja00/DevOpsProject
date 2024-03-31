<?php
// Include PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

// Database configuration
$servername = "najaboughader-db-service";
$database = "UserPass";
$username = "myuser";
$password = "mypassword";

// Establish database connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to validate the token and update the password
function validate_token_and_update_password($email, $token, $newPassword) {
    global $conn;

    // Check if the token is valid and not expired
    $currentDateTime = date('Y-m-d H:i:s');
    $sql = "SELECT * FROM password_reset_tokens WHERE email = '$email' AND token = '$token' AND expires_at > '$currentDateTime'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Token is valid, update the password
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $updateSql = "UPDATE login SET password = '$hashedPassword' WHERE email = '$email'";
        if ($conn->query($updateSql) === TRUE) {
            // Password updated successfully, delete the token
            $deleteSql = "DELETE FROM password_reset_tokens WHERE email = '$email' AND token = '$token'";
            if ($conn->query($deleteSql) === TRUE) {
                echo "Password updated successfully";
            } else {
                echo "Error deleting token: " . $conn->error;
            }
        } else {
            echo "Error updating password: " . $conn->error;
        }
    } else {
        echo "Invalid or expired token";
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $token = $_POST["token"];
    $newPassword = $_POST["new_password"];

    // Validate the token and update the password
    validate_token_and_update_password($email, $token, $newPassword);
}
?>
