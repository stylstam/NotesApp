<?php
require_once(__DIR__ . '/../config/db.php');
session_start();

include(__DIR__ . '/../config/error.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve note data
    $noteId = isset($_POST['note_id']) ? (int)$_POST['note_id'] : null;
    $noteTitle = $_POST['title'];
    $noteContent = $_POST['content'];

    // Check if the username is set in the session
    if (isset($_SESSION['username']) && !empty($noteId)) {
        $postedBy = $_SESSION['username'];

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
        echo "Invalid or missing note ID.";
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
    if (isset($_SESSION['note_updated']) && $_SESSION['note_updated'] === true) {
        unset($_SESSION['note_updated']); // Clear the session variable
        echo "<p>Note updated successfully!</p>";
    }
    ?>
    <form action="../scripts/updateNoteBnd.php" method="post">
        <input type="hidden" name="note_id" value="<?php echo (int)$noteId; ?>">

        <label for="title">Note Title:</label>
        <input type="text" name="title" required>

        <label for="content">Note Content:</label>
        <textarea name="content" required></textarea>

        <button type="submit">Edit Note</button>
    </form>
</div>

</body>

</html>

<?php // Close the database connection
mysqli_close($conn);
