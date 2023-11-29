<!-- header.php -->

<body>
    <header>
        <a class="centeredV centeredH nava" href="index.php">
            <h1 class="title">Notes App</h1>
            <img class="logo" src="img/logo2.svg" alt="Logo">
        </a>
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


    <!-- // JS Function to change colour theme in the page -->
    <script>
        function changeContent() {

        // ADD FUNCTION TO SAVE AND RETAIN BUTTON STATE

            var svgContainer = document.getElementById('svg-container');
            var svgImage = document.getElementById('svg-image');
            var svgText = document.getElementById('svg-text');
            var navaElements = document.querySelectorAll('.nava');

            if (svgImage.src.endsWith('img/sun.svg')) {
                svgImage.src = 'img/moon.svg';
                svgText.textContent = 'Dark Mode';
                document.documentElement.style.backgroundColor = '#ffffff';
                document.documentElement.style.color = '#000000';
                navaElements.forEach(function(element) {
                    element.style.color = '#000000';
                });



            } else {
                svgImage.src = 'img/sun.svg';
                svgText.textContent = 'Light Mode';
                document.documentElement.style.backgroundColor = '#343541';
                document.documentElement.style.color = '#ffffff';
                navaElements.forEach(function(element) {
                    element.style.color = '#ffffff';
                });

            }


            function changeAttributes() {
                var paragraph = document.getElementById('my-paragraph');

                paragraph.style.backgroundColor = '#e74c3c';
            }

        }
    </script>