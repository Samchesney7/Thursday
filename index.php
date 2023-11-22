<?php


require_once('/home/stud/0/2219976/vendor/autoload.php');
$loader = new \Twig\Loader\FilesystemLoader('.');
$twig = new \Twig\Environment($loader);


if (!isset($_SESSION["loggedIn"])) {
   include ("loginPage.html");
   exit;
 }
 // else user is logged in, show rest of page