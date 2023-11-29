<?php
// DB init and exists check
include 'database.php';
?>


<?php
// Appwide Head file
include 'head.php';
?>
</head>

<body>
    <?php
    // Appwide Header file
    include 'header.php';
    ?>

    <div class="centeredV centeredH column" id="mainContainer">

        <h1> The Simplest app to keep notes in </h1>
        <p> All your notes in one place: Create, Edit or Delete notes! </p>

        <?php
        session_start();
        if (isset($_SESSION['user_id'])) {
        ?>
            <a href="login.php">
                <p class="btn-main">Login</p>
            </a>
        <?php
        } else {
        ?>
            <a href="notes.php">
                <p class="btn-main">View Notes</p>
            </a>
        <?php } ?>
    </div>

    <!-- Include your main.js file -->
    <script src="main.js"></script>

    <?php
    // Appwide Footer file
    include 'footer.php';
    ?>

</html>