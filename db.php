<?php
// db.php

$host = 'localhost';
$port = 3306;
$db   = 'notes_app';
$user = 'root';
$pass = 'root';

// Create a new mysqli connection
$conn = new mysqli($host, $user, $pass, null, $port);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the database 'notes_app' exists
$query = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$db'";
$result = $conn->query($query);

if (!$result || $result->num_rows === 0) {
    // Database does not exist, create it
    $createDbQuery = "CREATE DATABASE $db";
    if ($conn->query($createDbQuery) === TRUE) {
        echo "Database '$db' created successfully.";
    } else {
        die("Error creating database: " . $conn->error);
    }
}

// Close the temporary connection used for database creation
$conn->close();

// Create a new connection to the specific database
$conn = new mysqli($host, $user, $pass, $db, $port);

// Check if the connection to the database was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>


/*
This script does the following:

Creates a temporary connection to the MySQL server without specifying a database (null is used for the database name).
Checks if the 'notes_app' database exists by querying the INFORMATION_SCHEMA.SCHEMATA table.
If the database does not exist, it creates the 'notes_app' database using the CREATE DATABASE query.
Closes the temporary connection.
Opens a new connection to the 'notes_app' database.
*/