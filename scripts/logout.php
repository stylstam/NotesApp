<?php
session_start(); // Start the session

// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the main
header("Location: /pages/home.php");

// Ensure that no further code is executed after the redirect
exit();
?>