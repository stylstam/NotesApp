<?php
require_once(__DIR__ . '/../config/db.php');
session_start();

include(__DIR__ . '/../config/error.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve note ID
    $noteId = isset($_POST['note_id']) ? (int)$_POST['note_id'] : null;

    // Retrieve note data from the database
    $sql = "SELECT * FROM Notes WHERE id = " . (int)$noteId;
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Use values from the database for update
        $noteTitle = $row['note_title'];
        $noteContent = $row['note_content'];

        // Check if the form is submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve note ID
            $noteId = isset($_POST['note_id']) ? (int)$_POST['note_id'] : null;

            // Check if the username is set in the session
            if (isset($_SESSION['username']) && !empty($noteId)) {
                $postedBy = $_SESSION['username'];

                // Check if the delete_note flag is set
                if (isset($_POST['delete_note'])) {
                    // Perform SQL delete using prepared statement
                    $deleteNoteQuery = "DELETE FROM Notes WHERE id = ? AND posted_by = ?";
                    $deleteNoteStmt = mysqli_prepare($conn, $deleteNoteQuery);
                    mysqli_stmt_bind_param($deleteNoteStmt, "is", $noteId, $postedBy);
                    $deleteNoteResult = mysqli_stmt_execute($deleteNoteStmt);

                    if ($deleteNoteResult) {
                        $_SESSION['note_deleted'] = true;
                    } else {
                        echo "Error deleting note: " . mysqli_stmt_error($deleteNoteStmt);
                    }

                    // Close the prepared statement
                    mysqli_stmt_close($deleteNoteStmt);
                }
            } else {
                echo "Invalid or missing note ID.";
            }
        }
    } else {
        // Handle error, e.g., note not found
        echo "Error fetching note data: " . $conn->error;
    }
} else {
    echo "Invalid request method!";
}

// Close the database connection
mysqli_close($conn);

header("Location: ../pages/viewNotes.php");
exit();
?>