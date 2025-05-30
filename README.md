<h1 align="center">🚗 Vehicle Management System</h1>
<h3 align="center">A web-based system for managing vehicle users, incidents, and police activities</h3>

<p align="left"> <img src="https://komarev.com/ghpvc/?username=kunar4&label=Project%20views&color=0e75b6&style=flat" alt="vehicle management system" /> </p>

<h3 align="left">Project Overview:</h3>
<p>This system allows citizens to register, report incidents, and update their personal details. Police users can manage incidents and update user details, providing efficient vehicle and incident management.</p>

<h3 align="left">Project Structure:</h3>
<ul>
  <li><strong>citizen-home.php</strong> - Dashboard page for citizen users showing their reported incidents and options.</li>
  <li><strong>police-home.php</strong> - Dashboard page for police officers to view and manage incident reports.</li>
  <li><strong>login.php</strong> - Login page for all users (citizens and police) to authenticate.</li>
  <li><strong>registration.php</strong> - User registration page for new citizens to create accounts.</li>
  <li><strong>report_incident.php</strong> - Form page where citizens can report new vehicle-related incidents.</li>
  <li><strong>fetch_table_data.php</strong> - Backend PHP script to fetch and display data in tables dynamically (e.g., incidents, users).</li>
  <li><strong>fetch_user_details.php</strong> - PHP script to retrieve user information for display or updates.</li>
  <li><strong>login-check.php</strong> - Script to verify user credentials during login and start sessions.</li>
  <li><strong>registration-check.php</strong> - Processes registration form data and adds new users to the database.</li>
  <li><strong>process_update_user_details.php</strong> - Handles updates to user profile data submitted from forms.</li>
  <li><strong>update_user_details.php</strong> - Page for users to view and edit their personal details.</li>
  <li><strong>update_user_details_form.php</strong> - Contains the form markup for updating user details.</li>
  <li><strong>user_data.php</strong> - Manages retrieval and updating of user data as a backend script.</li>
  <li><strong>member.php</strong> - General user profile page showing user information and status.</li>
</ul>

<h3 align="left">Technologies and Tools Used:</h3>
<p align="left">
  <a href="https://www.php.net/" target="_blank" rel="noreferrer">
    <img src="https://cdn.jsdelivr.net/npm/simple-icons@v9/icons/php.svg" alt="PHP" width="40" height="40" />
  </a>
  <a href="https://www.mysql.com/" target="_blank" rel="noreferrer">
    <img src="https://cdn.jsdelivr.net/npm/simple-icons@v9/icons/mysql.svg" alt="MySQL" width="40" height="40" />
  </a>
  <a href="https://getbootstrap.com" target="_blank" rel="noreferrer">
    <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/bootstrap/bootstrap-plain-wordmark.svg" alt="Bootstrap" width="40" height="40" />
  </a>
  <a href="https://www.apachefriends.org/index.html" target="_blank" rel="noreferrer">
    <img src="https://cdn.worldvectorlogo.com/logos/xampp.svg" alt="XAMPP" width="40" height="40" />
  </a>
  <a href="https://www.html5.org/" target="_blank" rel="noreferrer">
    <img src="https://cdn.jsdelivr.net/npm/simple-icons@v9/icons/html5.svg" alt="HTML5" width="40" height="40" />
  </a>
  <a href="https://www.w3schools.com/css/" target="_blank" rel="noreferrer">
    <img src="https://cdn.jsdelivr.net/npm/simple-icons@v9/icons/css3.svg" alt="CSS3" width="40" height="40" />
  </a>
  <a href="https://www.javascript.com/" target="_blank" rel="noreferrer">
    <img src="https://cdn.jsdelivr.net/npm/simple-icons@v9/icons/javascript.svg" alt="JavaScript" width="40" height="40" />
  </a>
</p>

<h3 align="left">Installation & Usage:</h3>
<ul>
  <li>Clone the repository using: <code>git clone https://github.com/kunar4/vehicle-management-system.git</code></li>
  <li>Install and run a local server environment like XAMPP or WAMP.</li>
  <li>Move the project folder into the server’s root directory (e.g., <code>htdocs</code> in XAMPP).</li>
  <li>Create a MySQL database and import the provided SQL schema.</li>
  <li>Update database connection credentials in the PHP configuration files.</li>
  <li>Access the project by navigating to <code>http://localhost/vehicle-management-system/</code> in your browser.</li>
</ul>

<h3 align="left">Demo Video</h3>

[![Watch the demo video](https://i.postimg.cc/q72ZWV21/Siren-Sleuth.png)](https://drive.google.com/file/d/1ZGR2xUO78N--jIojj-5Ui4eED0ebVsJO/view?usp=drive_link)

<h3 align="left">How to Contribute:</h3>
<p>If you want to improve this project, please fork the repository, make your changes, and submit a pull request. Contributions and suggestions are welcome!</p>

<h3 align="left">License:</h3>
<p>This project is licensed under the MIT License.</p>
