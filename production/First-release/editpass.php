<?php
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

// Function to validate the old password for a given email
function validate_old_password($email, $oldPassword) {
    global $conn;

    // Retrieve the hashed password from the database for the given email
    $sql = "SELECT password FROM login WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row["password"];

        // Verify if the old password matches the hashed password
        if (password_verify($oldPassword, $hashedPassword)) {
            return true; // Old password matches
        } else {
            return false; // Old password does not match
        }
    } else {
        return false; // Email not found
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST["email_password"];
    $oldPassword = $_POST["old_pwd"];
    $newPassword = $_POST["new_pwd"];

    // Validate the old password
    if (validate_old_password($email, $oldPassword)) {
        // Old password is correct, update the password
        $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $updateSql = "UPDATE login SET password = '$hashedNewPassword' WHERE email = '$email'";

        if ($conn->query($updateSql) === TRUE) {
            echo "Password updated successfully";
        } else {
            echo "Error updating password: " . $conn->error;
        }
    } else {
        echo "Incorrect email or old password";
    }
}
?>
