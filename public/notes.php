<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
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
