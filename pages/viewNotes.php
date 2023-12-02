<?php
session_start();
require_once(__DIR__ . '/../config/db.php');
include(__DIR__ . '/../config/serverCreds.php');

// Create connection
$conn = new mysqli($servername, $username, $password, $databaseName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all notes
$sql = "SELECT * FROM Notes";
$result = $conn->query($sql);

// Include the head
include(__DIR__ . '/../includes/head.php');
?>

<title>NATE-NOTES</title>

<?php
// Include the header
include(__DIR__ . '/../includes/header.php');
?>

<div class="formContainer">
    <h2 class="text-center">My Notes</h2>

    <div id="notesContainer">
        <?php
        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                $nId = $row["id"];
                echo "<div>";
                echo "<h3>" . $row["note_title"] . "</h3>";
                echo "<p>" . $row["note_content"] . "</p>";
                echo "<p>\"" . $row["posted_by"] . "\"</p>";
                // Add an "Edit" button with a link to the updateNote.php page
                echo '<form action="updateNote.php" method="post">

                        <input type="hidden" name="note_id" value="' . $nId . '">
                        <button type="submit" class="btn-main">Edit</button>

                    </form>';
                // echo '<a class="btn-main" href="updateNote.php?note_id=' . $nId . '">Edit</a>';
                echo "</div>";
            }
        } else {
            echo "No notes found.";
        }
        ?>
    </div>

    <a class="btn-main" href="createNote.php">New Note</a>
</div>

</body>

</html>

<?php
// Close connection
$conn->close();
?>