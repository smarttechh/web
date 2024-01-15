<?php
session_start();

// Assuming you have a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "smarttech";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the current user from the session
$current_user = isset($_SESSION['current_user']) ? $_SESSION['current_user'] : null;

if ($current_user) {
    // Get the new email from the form submission
    $newEmail = isset($_POST['newEmail']) ? $_POST['newEmail'] : null;

    if ($newEmail) {
        // Update the email in the database
        $updateSql = "UPDATE register SET email = '$newEmail' WHERE username = '$current_user'";

        if ($conn->query($updateSql) === TRUE) {
            echo "Email updated successfully";
        } else {
            echo "Error updating email: " . $conn->error;
        }
    } else {
        echo "New email not provided";
    }
} else {
    echo "User not logged in";
}

$conn->close();
?>
