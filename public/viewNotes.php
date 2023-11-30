<?php
session_start();
require_once 'db.php';
?>
<?php
include 'serverCreds.php';
?>
<?php

// Create connection
$conn = new mysqli($servername, $username, $password, $databaseName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all notes
$sql = "SELECT * FROM notes";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "Title: " . $row["title"] . ", Content: " . $row["content"] . "<br>";
    }
} else {
    echo "No notes found.";
}

// Close connection
$conn->close();
?>

<?php
// Include the footer.php file
include 'head.php';
?>
</head>


<body>
    <?php
    // Include the footer.php file
    include 'header.php';
    ?>
    <div class="formContainer">
        <h2 class="text-center">My Notes</h2>

        <div id="notesContainer">
            <!-- Display user's notes here -->
        </div>


            <a class="btn-main" href="createNote.html">New Note</a>
    </div>
    <script src="main.js"></script>
</body>

</html>