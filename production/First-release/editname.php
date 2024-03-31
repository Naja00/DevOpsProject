<?php
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

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_profile'])) {
    // Retrieve form data
    $email = $_POST["email"];
    $newFullName = $_POST["full_name"];

    // Validate email existence
    $emailExistQuery = "SELECT * FROM login WHERE email = '$email'";
    $result = $conn->query($emailExistQuery);
    if ($result->num_rows > 0) {
        // Email exists, proceed with updating the full name
        // Update the full name
        $updateSql = "UPDATE login SET full_name = '$newFullName' WHERE email = '$email'";

        if ($conn->query($updateSql) === TRUE) {
            // Full name updated successfully, redirect to edit-user.html
            echo "<script>alert('Full name updated successfully'); window.location.href = 'edit-user.html';</script>";
        } else {
            // Error updating full name
            echo "<script>alert('Error updating full name: " . $conn->error . "');</script>";
        }
    } else {
        // Email does not exist
        echo "<script>alert('Email does not exist'); window.location.href = 'edit-user.html';</script>";
    }
}
?>
