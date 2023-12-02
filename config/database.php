    <?php
    include 'serverCreds.php';
    ?>
    <?php

    // Create connection
    $conn = new mysqli($servername, $username, $password);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Create a new database
    $databaseName = "notes_app"; // Replace with your desired database name
    $createDatabaseQuery = "CREATE DATABASE IF NOT EXISTS $databaseName";
    if ($conn->query($createDatabaseQuery) === TRUE) {
        echo "Database created successfully\n";
    } else {
        echo "Error creating database: " . $conn->error . "\n";
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
        echo "Users table created successfully\n";
    } else {
        echo "Error creating Users table: " . $conn->error . "\n";
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
        echo "Notes table created successfully\n";
    } else {
        echo "Error creating Notes table: " . $conn->error . "\n";
        return;
    }

    // Close connection
    $conn->close();
