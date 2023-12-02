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
        } else {
            // Update note only if form fields are present in $_POST
            if (isset($_POST['title']) && isset($_POST['content'])) {
                $noteTitle = $_POST['title'];
                $noteContent = $_POST['content'];

                // Perform SQL update using prepared statement
                $updateNoteQuery = "UPDATE Notes SET note_title = ?, note_content = ? WHERE id = ? AND posted_by = ?";
                $updateNoteStmt = mysqli_prepare($conn, $updateNoteQuery);
                mysqli_stmt_bind_param($updateNoteStmt, "ssis", $noteTitle, $noteContent, $noteId, $postedBy);
                $updateNoteResult = mysqli_stmt_execute($updateNoteStmt);

                if ($updateNoteResult) {
                    $_SESSION['note_updated'] = true;
                } else {
                    echo "Error updating note: " . mysqli_stmt_error($updateNoteStmt);
                }

                // Close the prepared statement
                mysqli_stmt_close($updateNoteStmt);
            } else {
                echo "Form fields 'title' and 'content' are missing.";
            }
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

// Include the head
include(__DIR__ . '/../includes/head.php');
?>

<title>NATE-NOTE-UPDATE</title>

<?php
// Include the header
include(__DIR__ . '/../includes/header.php');
?>

<div class="formContainer">
    <h2>Edit Note</h2>
    <?php
    $sql = "SELECT * FROM Notes WHERE id = " . (int)$noteId;
    $result = $conn->query($sql);

    if (!$result) {
        echo "Error fetching note: " . $conn->error;
    }
    ?>

    <div id="notesContainer">
        <?php
        var_dump($noteId);
        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<div>";
                echo "<h3>" . htmlspecialchars($row["note_title"]) . "</h3>";
                echo "<p>" . htmlspecialchars($row["note_content"]) . "</p>";
                echo "<p>\"" . htmlspecialchars($row["posted_by"]) . "\"</p>";
                echo "<p>" . $row["id"] . "</p>";
                // Add an "Edit" button with a link to the updateNote.php page
                echo "</div>";
            }
        } else {
            echo "No notes found.";
        }
        ?>
    </div>

    <?php
    // Display success message only if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['note_updated']) && $_SESSION['note_updated'] === true) {
        unset($_SESSION['note_updated']); // Clear the session variable
        echo "<p>Note updated successfully!</p>";
    }
    ?>
    <form action="" method="post">
        <input type="hidden" name="note_id" value="<?php echo (int)$noteId; ?>">

        <label class="label" for="title">Note Title:</label>
        <input class="input" type="text" name="title" value="<?php echo htmlspecialchars($noteTitle); ?>" required>

        <label class="label" for="content">Note Content:</label>
        <textarea class="input" name="content" required><?php echo htmlspecialchars($noteContent); ?></textarea>

        <button type="submit">Edit Note</button>
    </form>

    <form action="" method="post">
        <input type="hidden" name="note_id" value="<?php echo (int)$noteId; ?>">
        <input type="hidden" name="delete_note" value="true">

        <button type="submit" onclick="return confirm('Are you sure you want to delete this note?')">Delete Note</button>
    </form>

    <?php
    // Display success message for note deletion
    if (isset($_SESSION['note_deleted']) && $_SESSION['note_deleted'] === true) {
        unset($_SESSION['note_deleted']); // Clear the session variable
        echo "<p>Note deleted successfully!</p>";
    }
    ?>
</div>

</body>

</html>

<?php // Close the database connection
mysqli_close($conn);
