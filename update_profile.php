<?php
// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to login page if not logged in
    header("Location: userlogin.php");
    exit();
}

// Database connection
$servername = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "lms_db";

// Create connection
$conn = new mysqli($servername, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get username and email from the form
$username = $_SESSION['username'];
$email = $_POST['email'];

// Prepare SQL statement to update user's email
$sql = "UPDATE users SET email='$email' WHERE username='$username'";

// Execute SQL statement
if ($conn->query($sql) === TRUE) {
    // Redirect to UserProfile.php upon successful update
    header("Location: UserProfile.php");
    exit();
} else {
    echo "Error updating record: " . $conn->error;
}

// Close database connection
$conn->close();
?>
