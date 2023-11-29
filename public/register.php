<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    if (!$stmt) {
        die("Error: " . $conn->error);
    }
    $stmt->bind_param("ss", $username, $password);
    if (!$stmt) {
        die("Error: " . $conn->error);
    }

    if ($stmt->execute()) {
        header("Location: login.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}

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
    <div class="form">
        <h2 class="text-center">User Registration</h2>
        <form id="registerForm" action="register.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button class="btn-main" type="submit">Register</button>
        </form>
    </div>
</body>

</html>