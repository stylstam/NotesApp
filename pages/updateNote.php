<?php
require_once(__DIR__ . '/../config/db.php');
session_start();

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
                    $_SESSION['error'] = "Form fields 'title' and 'content' are missing.";
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


<div class="container">
    <h2 class="text-center">Edit Note</h2>

    <div class="d-flex justify-content-center">
        <div class="formContainer">
            <?php
            $sql = "SELECT * FROM Notes WHERE id = " . (int)$noteId;
            $result = $conn->query($sql);

            if (!$result) {
                echo "Error fetching note: " . $conn->error;
            }
            ?>

            <div id="notesContainer">
                <?php
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="note">';
                        echo '<h3 class="note_title">' . htmlspecialchars($row["note_title"]) . '</h3>';
                        echo '<p class="note_contnent">' . htmlspecialchars($row["note_content"]) . '</p>';
                        echo '<p class="note_author">posted by: "' . htmlspecialchars($row["posted_by"]) . '"</p>';
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
            <div class="d-flex justify-content-center">
                <div class="formContainer">
                    <form class="form" action="" method="post">
                        <input type="hidden" name="note_id" value="<?php echo (int)$noteId; ?>">

                        <label class="label" for="title">Note Title:</label>
                        <input class="input" type="text" name="title" value="<?php echo htmlspecialchars($noteTitle); ?>" required>

                        <label class="label" for="content">Note Content:</label>
                        <textarea class="input" name="content" required><?php echo htmlspecialchars($noteContent); ?></textarea>

                        <button class="btn-main" type="submit">Edit Note</button>
                    </form>

                    <form action="../scripts/deleteNoteBnd.php" method="post">
                        <input type="hidden" name="note_id" value="<?php echo (int)$noteId; ?>">
                        <input type="hidden" name="delete_note" value="true">

                        <button class="btn-main" type="submit" onclick="return confirm('Are you sure you want to delete this note?')">Delete Note</button>
                    </form>
                    <a class="btn-main" href="../pages/viewNotes.php">Back</a>
                </div>
            </div>

            <?php
            // Display success message for note deletion
            if (isset($_SESSION['note_deleted']) && $_SESSION['note_deleted'] === true) {
                unset($_SESSION['note_deleted']); // Clear the session variable
                echo "<p>Note deleted successfully!</p>";
            }
            ?>
        </div>
    </div>
</div>

</body>

</html>

<?php // Close the database connection
mysqli_close($conn);
?>