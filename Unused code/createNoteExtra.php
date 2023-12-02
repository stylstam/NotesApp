<?php


require_once(__DIR__ . '/../config/db.php');
session_start();


$conn = new mysqli($servername, $username, $password, $databaseName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve note data
    $noteTitle = $_POST['title'];
    $noteContent = $_POST['content'];

    // Check if the username is set in the session
    if (isset($_SESSION['username'])) {
        $postedBy = $_SESSION['username'];

        // Perform SQL insertion using prepared statement
        $insertNoteQuery = "INSERT INTO Notes (note_title, note_content, posted_by) VALUES (?, ?, ?)";
        $insertNoteStmt = mysqli_prepare($conn, $insertNoteQuery);
        mysqli_stmt_bind_param($insertNoteStmt, "sss", $noteTitle, $noteContent, $postedBy);
        $insertNoteResult = mysqli_stmt_execute($insertNoteStmt);

        if ($insertNoteResult) {
            $_SESSION['note_created'] = true;
        } else {
            echo "Error: " . mysqli_stmt_error($insertNoteStmt);
        }

        // Close the prepared statement
        mysqli_stmt_close($insertNoteStmt);
    } else {
        echo "Error: Username not set in session.";
    }
} else {
    echo "Invalid request method!";
}

?>