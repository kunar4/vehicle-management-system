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

// Start session
session_start();

// Assuming the user's user_id is stored in the session
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Get form data
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);

    // Update user details
    $sql = "UPDATE user_data 
        SET first_name = '$first_name', last_name = '$last_name', email = '$email', address = '$address', date_of_birth = '$dob', phone_number = '$phone_number'
        WHERE user_id = $user_id";

    if ($conn->query($sql) === TRUE) {
        echo "User details updated successfully";
    } else {
        echo "Error updating user details: " . $conn->error;
    }
} else {
    echo "User ID not found in session.";
}

// Close the database connection
$conn->close();
?>
