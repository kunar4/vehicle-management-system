<?php
// Include your database connection code here
$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "sirensleuth";

// Create connection
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Start or resume session
session_start();

// Check if user_id is set in the session
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Create a SQL query to fetch user data using user_id
    $sql = "SELECT * FROM user_data WHERE user_id = $user_id";

    // Execute the query
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch user details
        $userDetails = $result->fetch_assoc();

        // Output user details as JSON
        header('Content-Type: application/json');
        echo json_encode($userDetails);
    } else {
        // No records found for the user
        echo json_encode(['error' => 'No records found for the user.']);
    }
} else {
    // User ID not found in session
    echo json_encode(['error' => 'User ID not found in session.']);
}

// Close the database connection
$conn->close();
?>
