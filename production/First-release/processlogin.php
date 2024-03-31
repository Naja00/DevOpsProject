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

// Retrieve email and password from the form submission
$email = $_POST['email'];
$password = $_POST['password'];

// SQL query to retrieve hashed password for the given email
$sql = "SELECT * FROM login WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // User with the given email exists
    $row = $result->fetch_assoc();
    $hashed_password = $row['password'];

    // Verify the password
    if (password_verify($password, $hashed_password)) {
        // Password is correct, redirect to lectures.html
        header("Location: lectures.html");
        exit(); // Ensure that no further code is executed after the redirect
    } else {
        // Password is incorrect
        echo "Invalid email or password!";
    }
} else {
    // User with the given email does not exist
    echo "Invalid email or password!";
}

// Close the database connection
$conn->close();
?>
