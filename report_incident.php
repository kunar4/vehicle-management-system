<?php
// Include your database connection code here (similar to your citizen-home.php file)
session_start();
$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "sirensleuth";
// Add the user_id to the column-values array


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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Incident</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <style>
        body {
            font-family: 'Quicksand', sans-serif;
            margin: 0;
            background: url('https://static.vecteezy.com/system/resources/previews/003/420/646/non_2x/traffic-police-illustration-vector.jpg') center/cover no-repeat fixed;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            padding: 20px;
        }

        h2 {
            color: #3498db;
            text-align: center;
        }

        form {
            max-width: 600px;
            width: 100%;
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            display: inline-block;
        }

        .datepicker {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            display: inline-block;
        }

        button {
            background-color: #3498db;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 1.2em;
            cursor: pointer;
            transition: background-color 0.3s;
            display: block;
            margin: 0 auto;
        }

        button:hover {
            background-color: #217dbb;
        }
    </style>
    <head>
    <!-- ... (existing code) ... -->
    <script>
        $(function () {
            $(".datepicker").datepicker({
                dateFormat: 'yy-mm-dd'
            });
        });
    </script>
</head>

</head>
<body>
    <form action='' method='post'>
        <h2>Report New Incident</h2>
        <?php
        // Fetch columns from the table to dynamically generate form fields
        $columnsQuery = "SHOW COLUMNS FROM $tableName";
        $columnsResult = $conn->query($columnsQuery);

        if ($columnsResult->num_rows > 0) {
            while ($columnRow = $columnsResult->fetch_assoc()) {
                $columnName = $columnRow['Field'];

                // Exclude 'user_id' from the form fields
                if ($columnName !== 'user_id') {
                    // Check if the column name contains the substring 'date'
                    $isDateColumn = stripos($columnName, 'date') !== false;

                    // Check if the column is of type 'date' to include a date picker
                    $inputType = $isDateColumn ? 'text' : 'text';

                    echo "<label for='$columnName'>$columnName:</label>";

                    // Include a date picker for the 'date' column
                    if ($isDateColumn) {
                        echo "<input type='text' id='datepicker' name='$columnName' class='datepicker' required>";
                    } else {
                        echo "<input type='$inputType' id='$columnName' name='$columnName' required>";
                    }

                    echo "<br>";
                }
            }

            echo "<button type='submit'>Submit Report</button>";
            echo "</form>";

            // Handle form submission
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Ensure that 'user_id' is set and not empty
                if (!empty($_SESSION['user_id'])) {
                    $user_id = mysqli_real_escape_string($conn, $_SESSION['user_id']);
            
                    // Initialize an array to store the column-value pairs
                    $columnValues = array();
            
                    // Add the user_id to the column-values array
                    $columnValues['user_id'] = "'$user_id'";
            
                    // Iterate through form fields
                    foreach ($_POST as $key => $value) {
                        // Sanitize input to prevent SQL injection
                        $cleanValue = mysqli_real_escape_string($conn, $value);
            
                        // Add the column-value pair to the array
                        $columnValues[$key] = "'$cleanValue'";
                    }
            
                    // Construct the SQL query to insert data into the table
                    $insertQuery = "INSERT INTO $tableName (" . implode(', ', array_keys($columnValues)) . ") VALUES (" . implode(', ', $columnValues) . ")";
            
                    // Execute the query
                    if ($conn->query($insertQuery) === TRUE) {
                        echo "<p>Incident reported successfully.</p>";
                    } else {
                        echo "<p>Error reporting incident: " . $conn->error . "</p>";
                    }
                } else {
                    echo "<p>Error: User not logged in.</p>";
                }
            }
        } else {
            echo "<p>No columns found for the specified table.</p>";
        }

        // Close the result set
        $columnsResult->close();
        ?>
    </body>
</html>

<?php
    // Rest of your PHP code...
} else {
    // Handle the case when the 'table' parameter is not set
    echo "<p>Table parameter is missing.</p>";
}

// Close the database connection (if not using a persistent connection)
$conn->close();
?>
