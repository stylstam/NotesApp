<?php
session_start();
require_once(__DIR__ . '/../config/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($user_id, $user, $hashed_password);
    $stmt->fetch();

    if ($hashed_password && password_verify($password, $hashed_password)) {
        $_SESSION['user_id'] = $user_id;
        $_SESSION['username'] = $user;
        header("Location: /pages/home.php");
        exit(); // Ensure that no further code is executed after the redirect
    } else {
        $loginError = "Invalid username or password";
    }

    $stmt->close();
    $conn->close();
}
?>


<?php
// Include the head
include(__DIR__ . '/../includes/head.php');
?>
<title> NATE-LOGIN </title>
<?php
// Include the header
include(__DIR__ . '/../includes/header.php');
?>

<?php if (isset($loginError)) : ?>
    <p style="color: red;"><?php echo $loginError; ?></p>
<?php endif; ?>

<div class="formContainer">
    <h2 class="text-center">Login</h2>
    <form class="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label class="label" for="username">Username:</label>
        <input class="input" type="text" id="username" name="username" required>

        <label class="label" for="password">Password:</label>
        <input class="input" type="password" id="password" name="password" required>

        <button class="btn-main" type="submit">Login</button>
    </form>
</div>
</body>

</html>