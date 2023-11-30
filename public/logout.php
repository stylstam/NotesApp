<?php
session_start(); // Start the session

// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the login page or any other page you want
header("Location: login.php"); // Replace with the desired destination

// Ensure that no further code is executed after the redirect
exit();
?>