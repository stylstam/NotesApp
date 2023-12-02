<!-- <?php
require_once(__DIR__ . '/../config/db.php');

session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve note data
    $noteId = $_POST['id'];
    $noteTitle = $_POST['note_title'];
    $noteContent = $_POST['note_content'];

    // Check if the username is set in the session
    if (isset($_SESSION['username'])) {
        $postedBy = $_SESSION['username'];

        // Perform SQL update using prepared statement
        $updateNoteQuery = "UPDATE Notes SET note_title = ?, note_content = ? WHERE id = ? AND posted_by = ?";
        $updateNoteStmt = mysqli_prepare($conn, $updateNoteQuery);
        mysqli_stmt_bind_param($updateNoteStmt, "ssis", $noteTitle, $noteContent, $noteId, $postedBy);
        $updateNoteResult = mysqli_stmt_execute($updateNoteStmt);

        if ($updateNoteResult) {
            $_SESSION['note_updated'] = true;
        } else {
            echo "Error: " . mysqli_stmt_error($updateNoteStmt);
        }

        // Close the prepared statement
        mysqli_stmt_close($updateNoteStmt);
    } else {
        echo "Error: Username not set in session.";
    }
} else {
    echo "Invalid request method!";
}

// Close the database connection
mysqli_close($conn);

// Redirect to the "View Notes" page
header("Location: ../pages/viewNotes.php");
exit();
?> -->