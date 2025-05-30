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
            background: rgba(255, 255, 255, 0.8);
            padding: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            z-index: 1;
            overflow: hidden;
        }

        .kebab-menu {
            cursor: pointer;
            font-size: 20px;
            margin-left: 20px;
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
            flex: 1 1 calc(35% - 20px); /* Adjust the width to make the boxes slightly smaller */
            box-sizing: border-box;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            text-align: center;
            margin: 20px; /* Add margin to create a gap between boxes */
            transition: transform 0.3s;
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
        function showPopup(tableName) {
            var popup = document.getElementById(`popup-${tableName}`);
            popup.innerHTML = `<h1>${tableName}</h1>
                               <p>Do you want to:</p>
                               <button onclick='viewReports("${tableName}")'>View Reports</button>
                               <button onclick='reportNewIncident("${tableName}")'>Report New Incident</button>`;
            popup.style.display = 'block';
        }

        function hidePopup(tableName) {
            document.getElementById(`popup-${tableName}`).style.display = 'none';
        }

        function viewReports(tableName) {
            fetchTableData(tableName);
            hidePopup(tableName);
        }

        function reportNewIncident(tableName) {
            // Redirect to the reporting page with the table name
            window.location.href = `report_incident.php?table=${tableName}`;
        }

        function toggleMenu() {
            var kebabMenu = document.getElementById('kebab-menu');
            var menu = document.getElementById('menu');
            if (kebabMenu.style.marginLeft === '250px') {
                kebabMenu.style.marginLeft = '20px';
                menu.style.left = '-250px';
                document.removeEventListener('click', closeMenuOutsideClick);
            } else {
                kebabMenu.style.marginLeft = '250px';
                menu.style.left = '0';
                document.addEventListener('click', closeMenuOutsideClick);
            }
        }

        function showUserDetails() {
            var userDetailsContainer = document.getElementById('user-details');
            userDetailsContainer.innerHTML = '';

            fetch('fetch_user_details.php')
                .then(response => response.json())
                .then(data => {
                    if (data.user_id) {
                        userDetailsContainer.innerHTML = `<p>User ID: ${data.user_id}</p>
                                                         <p>Name: ${data.name}</p>
                                                         <p>Email: ${data.email}</p>`;
                    }
                })
                .catch(error => console.error('Error fetching user details:', error));
        }

        function closeMenuOutsideClick(event) {
            var kebabMenu = document.getElementById('kebab-menu');
            var menu = document.getElementById('menu');

            if (!kebabMenu.contains(event.target) && !menu.contains(event.target)) {
                kebabMenu.style.marginLeft = '20px';
                menu.style.left = '-250px';
                document.removeEventListener('click', closeMenuOutsideClick);
            }
        }

        // Updated fetchTableData function
        function fetchTableData(tableName) {
            fetch(`fetch_table_data.php?table=${tableName}`)
                .then(response => response.json())
                .then(data => {
                    // Process the retrieved data
                    if (data.error) {
                        console.error('Error fetching table data:', data.error);
                    } else {
                        // Display the data in a popup or any other way you prefer
                        showDataPopup(tableName, data);
                    }
                })
                .catch(error => console.error('Error fetching table data:', error));
        }

        // New function to display data in a popup
        function showDataPopup(tableName, data) {
            var popup = document.getElementById(`popup-${tableName}`);
            popup.innerHTML = `<h1>${tableName}</h1>`;

            if (data.length > 0) {
                // Append data to the popup
                data.forEach(row => {
                    Object.entries(row).forEach(([key, value]) => {
                        popup.innerHTML += `<p>${key}: ${value}</p>`;
                    });
                    popup.innerHTML += '<hr>';
                });
            } else {
                popup.innerHTML += '<p>You do not have any record.</p>';
            }

            // Show the popup
            popup.style.display = 'block';
        }

        function logout() {
            // Add any additional logout logic here (e.g., clearing session data)
            alert('Logout successful'); // You can replace this with actual logout logic
            // Redirect to the logout page or perform any other necessary actions
            window.location.href = 'login.php';
        }
    </script>
</head>

<body>
    <div class="header">
        <span id="kebab-menu" class="kebab-menu" onclick="toggleMenu(); showUserDetails();">&#9776;</span>
        <div id="menu" class="menu">
            <div id="user-details"></div>
            <div class="menu-links">
                <a href="user_data.php">User Data</a>
                <a href="#" onclick="logout()">Logout</a>
            </div>
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