<!-- update_user_details.php -->
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

// Assuming the user's user_id is stored in the session
session_start();
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Initialize an array to store the column-value pairs
    $update_values = array();

    // Iterate through form fields
    foreach ($_POST as $key => $value) {
        // Sanitize input to prevent SQL injection
        $cleanValue = mysqli_real_escape_string($conn, $value);

        // Add the column-value pair to the array
        $update_values[$key] = "'$cleanValue'";
    }

    // Construct the SQL query to update data in the table
    $updateQuery = "UPDATE user_data SET " . implode(', ', array_map(function ($k, $v) { return "$k = $v"; }, array_keys($update_values), $update_values)) . " WHERE user_id = $user_id";

    // Execute the query
    if ($conn->query($updateQuery) === TRUE) {
        echo "<p>User details updated successfully.</p>";
    } else {
        echo "<p>Error updating user details: " . $conn->error . "</p>";
    }
} else {
    echo "<p>Error: User ID not found in session.</p>";
}
session_write_close();

// Close the database connection
$conn->close();
?>
