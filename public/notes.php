<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Handle note creation/update/deletion here

// Fetch user's notes
$stmt = $conn->prepare("SELECT id, title, content FROM notes WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($note_id, $title, $content);

$notes = array();

while ($stmt->fetch()) {
    $notes[] = array("id" => $note_id, "title" => $title, "content" => $content);
}

$stmt->close();
$conn->close();

?>

<!DOCTYPE html>
<html lang="en">


    <?php
    // Include the footer.php file
    include 'head.php';
    ?>


<body>
    <?php
    // Include the footer.php file
    include 'header.php';
    ?>
    <h2>My Notes</h2>
    <button onclick="logout()">Logout</button>

    <div id="notesContainer">
        <!-- Display user's notes here -->
    </div>

    <form id="noteForm">
        <label for="noteTitle">Title:</label>
        <input type="text" id="noteTitle" name="noteTitle" required>

        <label for="noteContent">Content:</label>
        <textarea id="noteContent" name="noteContent" required></textarea>

        <button type="submit">Save Note</button>
    </form>

    <script src="main.js"></script>
</body>

</html>

