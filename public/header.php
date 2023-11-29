<!-- header.php -->

<body>
    <div class="container">
        <a class="nava" href="index.php">
            <h1>Notes App</h1>
            <img class="hLogo" src="img/logo2.svg" alt="SVG Logo">
        </a>
    </div>

    <nav id="headerL">
        <ul>
            <?php
            // Check if the user is logged in
            session_start();
            if (isset($_SESSION['user_id'])) {
                // User is logged in, show logout option
                echo '<li><a class="nava" href="logout.php">Logout</a></li>';
            } else {
                // User is not logged in, show login and register options
                echo '<li><a class="nava" href="login.php">Login</a></li>';
                echo '<li><a class="nava" href="register.php">Register</a></li>';
                echo '<li><a class="nava" href="printdb.php">Print DB</a></li>';
            }
            ?>
            <li><a class="nava" href="notes.php">View Notes</a></li>

        </ul>
    </nav>


    <div id="svg-container" onclick="changeContent()">
        <img id="svg-image" src="img/sun.svg" alt="SVG Image">
        <div id="svg-text">Light Mode </div>
    </div>

    </header>


    <!-- JS Function to change colour theme in the page -->
    <script src="/header.js"></script>