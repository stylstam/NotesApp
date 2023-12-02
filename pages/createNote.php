<?php

// Include the head
include(__DIR__ . '/../includes/head.php');
?>

<title>NATE-NOTE-CREATE</title>

<?php
// Include the header
include(__DIR__ . '/../includes/header.php');
?>

<div class="d-flex justify-content-center">
    <div class="formContainer">
        <h1>Create a New Note</h1>
        <form class="form" action="../scripts/createNoteBnd.php" method="post">
            <label class="label" for="title">Title:</label>
            <input class="input" type="text" id="title" name="title" required>
            <br>
            <label class="label" for="content">Content:</label>
            <textarea class="input" id="content" name="content" required></textarea>
            <br>
            <button class="btn-main" type="submit">Create Note</button>
        </form>
    </div>
</div>

</body>

</html>

<?php // Close the database connection
mysqli_close($conn);
?>