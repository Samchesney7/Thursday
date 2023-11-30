<?php
require_once('/home/stud/0/2219976/vendor/autoload.php');
$loader = new \Twig\Loader\FilesystemLoader('.');
$twig = new \Twig\Environment($loader);

// Check if the user is logged in
session_start(); // Start the session (if not already started)

if (isset($_SESSION['user_id'])) {
    // User is logged in, retrieve the username from somewhere (this is just an example)
    $username = 'John';

    // Render the Twig template with the provided data
    echo $twig->render('template.twig', ['username' => $username]);
} else {
    // User is not logged in
    // You can redirect, show a login form, or whatever suits your needs
    echo "User not logged in!";
    // Add the rest of the page content here for the case when the user is not logged in
}
?>
