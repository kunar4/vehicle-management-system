<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citizen Home</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap">
    <style>
        html {
            margin: 0;
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
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .kebab-menu {
            cursor: pointer;
            font-size: 20px;
            transition: margin-left 0.3s;
            z-index: 2;
        }

        #user-details-button {
            cursor: pointer;
            font-size: 16px;
            padding: 5px 10px;
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 5px;
            margin-right: 20px;
            transition: background-color 0.3s;
        }

        #user-details-button:hover {
            background-color: #217dbb;
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

        .table-link {
            color: #3498db;
            text-decoration: none;
            font-weight: bold;
            margin-top: 10px;
            display: block;
            cursor: pointer;
        }

        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            font-family: 'Quicksand', sans-serif;
            max-width: 400px;
            text-align: left;
        }

        .popup.hidden {
            display: none;
        }

        .popup h1 {
            color: #3498db;
            font-size: 1.8em;
            margin-bottom: 15px;
        }

        .popup p {
            font-size: 1.2em;
            margin-bottom: 20px;
        }

        .popup button {
            background-color: #3498db;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 1.2em;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .popup button:hover {
            background-color: #217dbb;
        }
    </style>
    <script>
        // Existing script...
    </script>
</head>
<body>
    <div class="header">
        <span id="kebab-menu" class="kebab-menu" onclick="toggleMenu(); showUserDetails();">&#9776;</span>
        <div id="user-details" style="display: flex; align-items: center;">
            <button id="user-details-button" onclick="showUserDetails();">User Profile</button>
        </div>
        <div id="menu" class="menu">
            <!-- Existing menu content... -->
        </div>
    </div>
    <?php
    // Function to display a table link
    function displayTableLink($tableName, $linkText) {
        echo "<div class='box'>";
        echo "<h1>$tableName</h1>";
        echo "<a class='table-link' onclick='showPopup(\"$tableName\")'>$linkText</a>";
        echo "<div id='popup-$tableName' class='popup hidden' onclick='hidePopup(\"$tableName\")'></div>";
        echo "</div>";
    }

    // Display links for all the tables
    $allowedTables = array("Theft Reports", "Accident Report", "Traffic Violations", "Case Filing", "Ceased Vehicles", "Cancelled License", "Missing Vehicles", "Tow Vehicles", "Vehicle Data");
    foreach ($allowedTables as $table) {
        displayTableLink($table, "View Data");
    }
    ?>
</body>
</html>
