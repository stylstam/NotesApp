<?php
require_once(__DIR__ . '/../config/database.php');

// Include the head
include(__DIR__ . '/../includes/head.php');
?>
<title> NATE-HOME </title>
<?php
// Include the header
include(__DIR__ . '/../includes/header.php');
?>


<div class="centeredV centeredH column" id="mainContainer">

    <h1> The Simplest app to keep notes in </h1>
    <p> All your notes in one place: Create, Edit or Delete notes! </p>

    <?php

    if (isset($_SESSION['user_id'])) {
    ?>
        <a href="viewnotes.php">
            <p class="btn-main">View Notes</p>
        </a>
    <?php
    } else {
    ?>
        <a href="login.php">
            <p class="btn-main">Login</p>
        </a>
        <a href="register.php">
            <p class="btn-main">Register</p>
        </a>
    <?php } ?>
</div>

<?php
// Include the footer
include(__DIR__ . '/../includes/footer.php');
?>

</html>