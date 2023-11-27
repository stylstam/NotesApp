<?php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($user_id, $user, $hashed_password);

    if ($stmt->fetch() && password_verify($password, $hashed_password)) {
        $_SESSION['user_id'] = $user_id;
        $_SESSION['username'] = $user;
        header("Location: notes.php");
    } else {
        echo "Invalid username or password";
    }

    $stmt->close();
    $conn->close();
}
 
?>

<!DOCTYPE html>
<html lang="en">


    <?php
    // Include the footer.php file
    include 'head.php';
    ?>


<body>
    <?php
    // Include the footer.php file
    include 'header.php';
    ?>
    <h2>User Login</h2>
    <form id="loginForm" action="login.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Login</button>
    </form>
</body>

</html>