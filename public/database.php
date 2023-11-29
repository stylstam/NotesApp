<?php
// Appwide Head file
include 'head.php';
?>
</head>

<?php
$servername = "localhost";
$username = "root";
$password = "root";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the database "notes_app" exists
$databaseName = "notes_app";
$result = $conn->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$databaseName'");

if (!$result) {
    die("Error checking database existence: " . $conn->error);
}

if ($result->num_rows === 0) {
    // Database does not exist, create it
    $createDatabaseSQL = "CREATE DATABASE $databaseName";
    if ($conn->query($createDatabaseSQL) === TRUE) {


        $conn->query("CREATE TABLE users (
            id INT PRIMARY KEY AUTO_INCREMENT,
            username VARCHAR(255) UNIQUE NOT NULL,
            password VARCHAR(255) NOT NULL
        );");

        // -- Table for notes
        $conn->query("CREATE TABLE notes (
            id INT PRIMARY KEY AUTO_INCREMENT,
            user_id INT,
            title VARCHAR(255) NOT NULL,
            content TEXT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users(id)
        );");


        echo "Database $databaseName created successfully.";
    } else {
        echo "Error creating database: " . $conn->error;
    }
} else {
    echo "Database $databaseName already exists.";
    $conn->query("SELECT id, title, content FROM notes *);");
    $conn->query("SELECT id, username, password FROM users *);");
}

$conn->close();
?>