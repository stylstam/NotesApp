<!-- header.php -->

<!DOCTYPE html>
<html lang="en">

<body>
    <!-- Common header content goes here -->
    <header>
       <a href="index.php"> <h1 id="title">Notes App</h1>
        <img id="movingImage" class="logo" src="img/logo2.svg" alt="Logo"> </a>
        <nav>
            <ul>
                <?php
                // Check if the user is logged in
                session_start();
                if (isset($_SESSION['user_id'])) {
                    // User is logged in, show logout option
                    echo '<li><a href="logout.php">Logout</a></li>';
                } else {
                    // User is not logged in, show login and register options
                    echo '<li><a href="login.php">Login</a></li>';
                    echo '<li><a href="register.php">Register</a></li>';
                    echo '<li><a href="printdb.php">Print DB</a></li>';
                }
                ?>
                <li><a href="notes.php">View Notes</a></li>
            </ul>
        </nav>
    </header>