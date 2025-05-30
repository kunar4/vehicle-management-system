<?php
// Include your database connection code here (similar to your citizen-home.php file)
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

// Ensure that the 'table' parameter is set in the URL
if (isset($_GET['table'])) {
    // Get the table name from the URL parameter
    $rawTableName = $_GET['table'];

    // Sanitize the table name to avoid SQL injection
    $tableName = str_replace(' ', '_', mysqli_real_escape_string($conn, $rawTableName));

    // You can perform additional validation or security checks on $tableName if needed

    // Assuming the user's user_id is stored in the session
    session_start();
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        // Create a SQL query to fetch data from the specified table using user_id
        $sql = "SELECT * FROM $tableName WHERE user_id = ?";

        // Assuming you have a prepared statement for better security
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            // Handle the case when the prepared statement fails
            echo json_encode(array('error' => 'Error preparing statement: ' . $conn->error));
        } else {
            // Bind parameters
            $bindResult = $stmt->bind_param("s", $user_id);

            if ($bindResult === false) {
                // Handle the case when binding parameters fails
                echo json_encode(array('error' => 'Error binding parameters: ' . $stmt->error));
            } else {
                // Execute the query
                $executeResult = $stmt->execute();

                if ($executeResult === false) {
                    // Handle the case when executing the query fails
                    echo json_encode(array('error' => 'Error executing query: ' . $stmt->error));
                } else {
                    // Get the result set
                    $result = $stmt->get_result();

                    // Check if there are any rows in the result
                    if ($result->num_rows > 0) {
                        // Output data for each row
                        $outputData = array();
                        while ($row = $result->fetch_assoc()) {
                            // Append each row to the output data array
                            $outputData[] = $row;
                        }

                        // Return the output data as JSON
                        echo json_encode($outputData);
                    } else {
                        // Return a message if no records found
                        echo json_encode(array('message' => 'You do not have any record.'));
                    }
                }
            }

            // Close the prepared statement
            $stmt->close();
        }

        // Close the session
        session_write_close();
    } else {
        // Return an error message if user ID not found in session
        echo json_encode(array('error' => 'User ID not found in session.'));
    }
} else {
    // Return an error message if the 'table' parameter is not set
    echo json_encode(array('error' => 'Table parameter is missing.'));
}

// Close the database connection (if not using a persistent connection)
$conn->close();
?>
