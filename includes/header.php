<!-- header.php -->
</head>

<body>
    <div class="container" id="headerT">
        <a class="nava" href="/pages/home.php">
            <h1 class="hText">NATE</h1>
            <img class="hLogo" src="/assets/img/favicon.svg" alt="SVG Logo">
        </a>
    </div>

    <nav class="hNav">
        <ul>
            <?php
            // Check if the user is logged in
            session_start();
            if (isset($_SESSION['user_id'])) {
                // User is logged in, show logout option
                echo '<li><a class="nava" href="/scripts/logout.php">Logout</a></li>';
            } else {
                // User is not logged in, show login and register options
                echo '<li><a class="nava" href="login.php">Login</a></li>';
                echo '<li><a class="nava" href="register.php">Register</a></li>';
            }
            ?>
            <li><a class="nava" href="/pages/printServer.php">Print DB</a></li>
            <li><a class="nava" href="/scripts/dropDatabase.php">Drop DB</a></li>
            <li><a class="nava" href="/pages/viewNotes.php">View Notes</a></li>

        </ul>
    </nav>


    <div id="svg-container" onclick="changeContent()">
        <img id="svg-image" src="/assets/img/sun.svg" alt="SVG Image">
        <div id="svg-text">Light Mode </div>
    </div>
    <?php echo $_SESSION['username'];
    if (isset($_SESSION['user_id'])) {
        echo '<li><a class="nava" href="/pages/deleteAccount.php">Delete Account</a></li>';
    }
    ?>

    </header>


    <!-- JS Function to change colour theme in the page -->
    <script src="/assets/js/theme.js"></script>