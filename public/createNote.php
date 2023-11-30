<?php
include 'serverCreds.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $databaseName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get user input from the form
    $title = $_POST["title"];
    $content = $_POST["content"];

    // You should replace the user_id with the actual user ID of the logged-in user.
    $user_id = 1; // Replace with the actual user ID

    // Insert new note
    $sql = "INSERT INTO notes (title, content, user_id) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssi", $title, $content, $user_id);
        $stmt->execute();

        echo "New note created successfully";

        $stmt->close();
    } else {
        echo "Error in preparing the statement: " . $conn->error;
    }
}

// Close connection
$conn->close();
?>