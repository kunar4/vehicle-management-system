<!-- File: login.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            display: flex;
            height: 100vh;
        }
        .image-container {
            flex: 1;
            background: url('https://images.pond5.com/traffic-police-scene-stop-signal-illustration-226748455_iconl_nowm.jpeg') center/cover no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-container {
            flex: 1;
            margin: 50px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            background-color: rgba(255, 255, 255, 0.8);
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        h1 {
            color: #3498db;
            font-size: 1.8em;
            margin-bottom: 15px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }
        h2 {
            color: #3498db;
            font-size: 1.5em;
            margin-bottom: 10px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }
        label {
            display: block;
            margin-bottom: 10px;
            color: #333;
            font-size: 1.1em;
        }
        input,
        select {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            box-sizing: border-box;
            border: 1px solid #3498db;
            border-radius: 5px;
            font-size: 1em;
            background-color: #fff;
            color: #333;
            outline: none;
        }
        input[type="submit"] {
            background-color: #3498db;
            color: white;
            cursor: pointer;
        }
        .register-link {
            margin-top: auto;
            text-align: center;
            color: #555;
            font-size: 1em;
        }
        .register-link a {
            color: #3498db;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="image-container">
        <!-- Empty container for image background -->
    </div>

    <div class="login-container">
		<img class="small-image"src="images/small_image.png">
		<h1>𝕊𝕚𝕣𝕖𝕟𝕊𝕝𝕖𝕦𝕥𝕙</h1>
        <h2>𝕃𝕠𝕘𝕚𝕟</h2>
        <form action="login-check.php" method="post">
            <label for="username">Username:</label>
            <input type="text" name="username" required>

            <label for="password">Password:</label>
            <input type="password" name="password" required>

            <label for="role">User Role:</label>
            <select name="role" required>
                <option value="citizen">Citizen</option>
                <option value="police">Police</option>
                <!-- Add more roles as needed -->
            </select>

            <input type="submit" value="Login">
        </form>

        <p class="register-link">Don't have an account? <a href="registration.php">Register here</a>.</p>
    </div>

</body>
</html>
