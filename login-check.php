<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get user inputs
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

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

    // Use prepared statement to avoid SQL injection
    $query = "SELECT * FROM user_profile WHERE username=? AND password_hash=?";
    $stmt = $conn->prepare($query);

    // Check if the prepare() succeeded
    if (!$stmt) {
        die("Error during prepare: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("ss", $username, $password);

    // Execute the statement
    $stmt->execute();

    // Get result
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User found, fetch user details
        $user = $result->fetch_assoc();

        // Determine user role
        $role = $user['role'];

        // Redirect based on user role
        if ($role === 'Citizen') {
            header("Location: citizen-home.php");
            exit();
        } elseif ($role === 'Police') {
            header("Location: police-home.php");
            exit();
        } else {
            // Handle other roles or scenarios
            echo "Invalid role.";
        }
    } else {
        // User not found, display an error message
        echo "Invalid username or password. Please try again.";
    }

    // Close the prepared statement and the database connection
    $stmt->close();
    $conn->close();
}
?>
