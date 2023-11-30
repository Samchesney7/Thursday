<?php

require_once('/home/stud/0/2219976/vendor/autoload.php');

// Error handling for Twig
try {
    $loader = new \Twig\Loader\FilesystemLoader('.');
    $twig = new \Twig\Environment($loader);

    $thisStyle = 0;

    if (isset($_COOKIE["selectedStyle"])) {
        // Sanitize the cookie value before using it
        $thisStyle = intval($_COOKIE["selectedStyle"]);
    }

    if (isset($_POST["changeStyle"])) {
        // Sanitize the POST input
        $thisStyle = intval($_POST["changeStyle"]);
    }

    // Update or create the cookie
    setcookie("selectedStyle", $thisStyle);

    // Render the Twig template
    echo $twig->render('./html/changestyle.html', array('style' => $thisStyle));
} catch (\Twig\Error\LoaderError $e) {
    // Handle Twig loader errors
    echo 'Twig Loader Error: ' . $e->getMessage();
} catch (\Twig\Error\RuntimeError $e) {
    // Handle Twig runtime errors
    echo 'Twig Runtime Error: ' . $e->getMessage();
} catch (\Twig\Error\SyntaxError $e) {
    // Handle Twig syntax errors
    echo 'Twig Syntax Error: ' . $e->getMessage();
} catch (Exception $e) {
    // Handle other exceptions
    echo 'Error: ' . $e->getMessage();
}
?>

