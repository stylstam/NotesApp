<?php
include 'serverCreds.php';
?>
<?php

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error . "\n");
}

// Create a new database
$databaseName = "notes_app"; // Replace with your desired database name
$createDatabaseQuery = "CREATE DATABASE IF NOT EXISTS $databaseName";
if ($conn->query($createDatabaseQuery) === TRUE) {
    echo '<p style="display: none;">atabase created successfully\n</p>';
} else {
    echo '<p style="display: none;">Error creating database: " . $conn->error . "\n</p>';
    return;
}

// Switch to the created database
$conn->select_db($databaseName);

// Create Users table
$createUsersTableQuery = "CREATE TABLE IF NOT EXISTS Users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
)";
if ($conn->query($createUsersTableQuery) === TRUE) {
    echo '<p style="display: none;">Users table created successfully\n</p>';
} else {
    echo '<p style="display: none;"> Error creating Users table: " . $conn->error . "\n</p>';
    return;
}

// Create Notes table
$createNotesTableQuery = "CREATE TABLE IF NOT EXISTS Notes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    note_title VARCHAR(255) NOT NULL,
    note_content VARCHAR(255),
    posted_by VARCHAR(255) NOT NULL
)";
if ($conn->query($createNotesTableQuery) === TRUE) {
    echo '<p style="display: none;">Notes table created successfully\n</p>';
} else {
    echo '<p style="display: none;">Error creating Notes table: " . $conn->error . "\n</p>';
    return;
}

// Close connection
$conn->close();
?>
