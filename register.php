<?php
require_once('/home/stud/0/2219976/vendor/autoload.php');
$loader = new \Twig\Loader\FilesystemLoader('.');
$twig = new \Twig\Environment($loader);

session_start();

// Establish a connection to the database
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


$user_name = $_POST['new_username'];
$password = $_POST['new_password'];


$sql = "INSERT INTO users (user_name, password, admin) VALUES ('$user_name', '$password', 'default_admin_value')";

if ($conn->query($sql) === TRUE) {
    $response = "Registration successful";
} else {
    $response = "Error: " . $sql . "<br>" . $conn->error;
}

// Check if the request is AJAX
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    // AJAX response
    echo json_encode(['response' => $response]);
} else {
    // Non-AJAX response
    echo $response;

    // Redirect the user after successful registration
    header("Location: https://mi-linux.wlv.ac.uk/~2219976/menu.php");
    // You can redirect the user to another page after successful register
    // header("Location: menu.php");
    // exit();
}

// Close the connection
$conn->close();
?>




