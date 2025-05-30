<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get user inputs
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $role = isset($_POST['role']) ? $_POST['role'] : '';

    // Database connection parameters
    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "SirenSleuth";

    // Create connection
    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Sanitize inputs
    $username = $conn->real_escape_string($username);
    $password = $conn->real_escape_string($password);
    $role = $conn->real_escape_string($role);

    // Example SQL query to insert a new user with role
    $query = "INSERT INTO user_profile (username, password_hash, role) VALUES ('$username', '$password', '$role')";

    if ($conn->query($query) === TRUE) {
        // Registration successful
        echo "Registration successful. You can now login.";
    } else {
        // Registration failed
        echo "Error: " . $query . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
