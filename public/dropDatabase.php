<?php
include 'serverCreds.php';

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Drop the database
$sql = "DROP DATABASE IF EXISTS $databaseName";

if ($conn->query($sql) === TRUE) {
    echo "Database $databaseName dropped successfully";
} else {
    echo "Error dropping database: " . $conn->error;
}

// Close connection
$conn->close();
?>