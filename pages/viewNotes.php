<?php
require_once(__DIR__ . '/../config/db.php');
include(__DIR__ . '/../config/serverCreds.php');
session_start();

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

<div class="container">
    <h2 class="text-center">All Notes</h2>
    
    <?php
    if (isset($_SESSION['user_id'])) {
    ?>
        <a class="btn-main text-center" href="createNote.php">Add a Note</a>
    <?php
    }
    ?>

</div>

<div class="d-flex justify-content-center">
    <div class="formContainer d-flex items-flex-start">


        <div class="notesContainer d-flex">
            <?php
            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    $nId = $row["id"];
                    echo '<div class="note">';
                    echo '<h3 class="note_title">' . $row["note_title"] . '</h3>';
                    echo '<p class="note_contnent">' . $row["note_content"] . '</p>';
                    echo '<p class="note_author">posted by: "' . $row["posted_by"] . '"</p>';

                    if (isset($_SESSION['user_id'])) {
                        echo '<form action="updateNote.php" method="post">
                            <input type="hidden" name="note_id" value="' . $nId . '">
                            <button type="submit" class="btn-main">Edit</button>
                          </form>';
                    }

                    echo '</div>';
                }
            } else {
                echo "No notes found.";
            }
            ?>
        </div>

    </div>

</div>

</body>

</html>

<?php
// Close connection
$conn->close();
?>