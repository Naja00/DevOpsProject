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

// Retrieve form data
$full_name = $_POST['full_name'];
$email = $_POST['email1'];
$user_password = $_POST['password1']; // Rename to avoid overwriting

// Hash the password
$hashed_password = password_hash($user_password, PASSWORD_DEFAULT);

// Check if email already exists in the database
$email_check_query = "SELECT * FROM login WHERE email='$email'";
$result = $conn->query($email_check_query);
if ($result->num_rows > 0) {
    echo "Error: This email is already registered. Please use another email.";
    exit();
}

// Insert data into the database with hashed password
$sql = "INSERT INTO login (email, password, full_name) VALUES ('$email', '$hashed_password', '$full_name')";

if ($conn->query($sql) === TRUE) {
    header("Location: login.php");
    exit(); // Ensure that no further code is executed after the redirect
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
