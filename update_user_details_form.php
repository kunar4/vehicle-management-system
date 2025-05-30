<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Data</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap">
    <style>
        html {
            margin: 0; /* Add this line to remove default margin on html */
        }
        body {
            font-family: 'Quicksand', sans-serif;
            margin: 0;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 20px;
            background: url('https://static.vecteezy.com/system/resources/previews/003/420/646/non_2x/traffic-police-illustration-vector.jpg') center/cover no-repeat fixed;
        }

        .header {
            width: 100%;
            text-align: left;
            position: fixed;
            top: 0;
            background: rgba(255, 255, 255, 0.8);
            padding: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            z-index: 1;
            overflow: hidden;
        }

        .kebab-menu {
            cursor: pointer;
            font-size: 20px;
            margin-left: 20px; /* Adjust margin to move it slightly to the right */
            transition: margin-left 0.3s;
            z-index: 2;
        }

        .menu {
            width: 250px;
            height: 100%;
            position: fixed;
            top: 0;
            left: -250px;
            background: rgba(255, 255, 255, 0.8);
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: left 0.3s;
            z-index: 2;
            overflow: hidden;
        }

        .menu a {
            display: block;
            padding: 10px;
            color: #333;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .menu a:hover {
            background-color: #ddd;
        }

        #user-details {
            margin-top: 20px;
            text-align: center;
            color: #333;
        }

        #user-details p {
            margin: 0;
            font-size: 1em;
        }

        .box {
            flex: 1 1 300px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            background-color: rgba(255, 255, 255, 0.8);
            text-align: center;
            margin-top: 40px;
            margin-bottom: 20px;
        }

        h1 {
            color: #3498db;
            font-size: 1.5em;
            margin-bottom: 15px;
        }

        .update-details-btn {
            background-color: #3498db;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 1.2em;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .update-details-btn:hover {
            background-color: #217dbb;
        }
    </style>
</head>
<body>
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

        // Create a SQL query to fetch user data using user_id
        $sql = "SELECT * FROM user_data WHERE user_id = $user_id";

        // Execute the query
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<div class='box'>";
            echo "<h1>Update User Details</h1>";

            // Display the update form
            echo "<form action='update_user_details.php' method='post'>";
            while ($row = $result->fetch_assoc()) {
                foreach ($row as $key => $value) {
                    echo "<label for='$key'>$key:</label>";
                    echo "<input type='text' name='$key' value='$value'>";
                }
            }

            echo "<button type='submit'>Update</button>";
            echo "</form>";

            echo "</div>";
        } else {
            echo "<div class='box'>";
            echo "<h1>Update User Details</h1>";
            echo "<p>No records found for the user.</p>";
            echo "</div>";
        }
    } else {
        echo "<div class='box'>";
        echo "<h1>Update User Details</h1>";
        echo "<p>User ID not found in session.</p>";
        echo "</div>";
    }
    session_write_close();

    // Close the database connection
    $conn->close();
    ?>
</body>
</html>
