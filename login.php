<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Collect values from input fields
  $name = $_POST['username'];
  $pass = $_POST['password'];

  // Database connection parameters
  $servername = "localhost";
  $db_username = "2219976";
  $db_password = "jj9nq4";
  $db_name = "db2219976";

  // Create connection
  $conn = new mysqli($servername, $db_username, $db_password, $db_name);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Prepare and execute a query to check the user's credentials
  $stmt = $conn->prepare("SELECT * FROM users WHERE user_name = ? AND password = ?");
  $stmt->bind_param("ss", $name, $pass);
  $stmt->execute();

  // Store the result for later use
  $result = $stmt->get_result();

  // Check if a row is returned, indicating a successful login
  if ($result->num_rows > 0) {
    // Set a cookie upon successful login
    setcookie("user", $name, time() + 3600, "/"); // Expires in 1 hour

    // Redirect the user to another page after a successful login
    header("Location: https://mi-linux.wlv.ac.uk/~2219976/menu.php");
    exit();
  } else {
    echo "Login failed. Please check your credentials.";
  }

  // Close the prepared statement and database connection
  $stmt->close();
  $conn->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") 
  // ... (Your existing PHP code)

  if ($result->num_rows > 0) {
    // ... (Your existing successful login code)

    // Return a JSON success message
    echo json_encode(['status' => 'success', 'message' => 'Login successful']);
  } else {

  }
  require_once 'vendor/autoload.php';
  
  // Your existing PHP code
  
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // ... (Your existing PHP code)
  
      if ($result->num_rows > 0) {
        
  
          // Return a JSON success message
          echo json_encode(['status' => 'success', 'message' => 'Login successful']);
      } else {
          // Render the login form using Twig on unsuccessful login
          $loader = new \Twig\Loader\FilesystemLoader('templates');
          $twig = new \Twig\Environment($loader);
  
          echo $twig->render('login.twig');
      }
  }
  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        .back-button {
            text-align: right;
            margin-top: 20px;
            position: fixed;
            top: 0;
            right: 0;
            padding: 10px;
        }

        .back-button a {
            color: #000000;
            text-decoration: none;
            padding: 10px 20px;
            background-color: #3498db;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .back-button a:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>

    

    
    <div class="back-button">
        <a href="menu.php">Back to Menu</a>

                