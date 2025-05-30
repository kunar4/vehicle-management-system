<!-- File: registration.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <style>
        body {
            font-family: Times New Roman, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            background: url('https://www.shutterstock.com/image-vector/black-skin-traffic-police-officer-600w-1615705531.jpg') right; /* Adjusted the background position */
        }
        .registration-container {
            display: flex;
            justify-content: space-between;
            width: 600px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: rgba(255, 255, 255, 0.8); /* Add a background color for better visibility */
        }
        .registration-column {
            width: 48%; /* Adjust as needed */
        }
        label {
            display: block;
            margin-bottom: 8px;
        }
        input,
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 12px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            cursor: pointer;
        }
        .login-link {
            margin-top: 10px;
            text-align: center;
            color: #555;
        }
        .login-link a {
            color: #4caf50;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="registration-container">
        <div class="registration-column">
            <h2>Login Information</h2>
            <form action="registration-check.php" method="post">
                <label for="username">Username:</label>
                <input type="text" name="username" required>

                <label for="password">Password:</label>
                <input type="password" name="password" required>
                
                <label for="role">User Role:</label>
                <select name="role">
                    <option value="Citizen">Citizen</option>
                    <option value="Police">Police</option>
                </select>

                <p class="login-link">Already have an account? <a href="login.php">Login here</a>.</p>
            </div>

        <div class="registration-column">
            <h2>Personal Information</h2>
            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" required>

            <label for="last_name">Last Name:</label>
            <input type="text" name="last_name" required>

            <label for="email">Email:</label>
            <input type="email" name="email" required>

            <label for="phone_number">Phone Number:</label>
            <input type="tel" name="phone_number" required>

            <label for="date_of_birth">Date of Birth:</label>
            <input type="date" name="date_of_birth" required>

            <label for="address">Address:</label>
            <textarea name="address" rows="4" required></textarea>

            <input type="submit" value="Register">
            
        </form>
    </div>
</div>

</body>
</html>
