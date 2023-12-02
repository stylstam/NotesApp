<?php
require_once(__DIR__ . '/../config/db.php');

function usernameExists($conn, $username)
{
    $checkUsernameQuery = "SELECT * FROM Users WHERE username = ?";
    $checkUsernameStmt = $conn->prepare($checkUsernameQuery);
    $checkUsernameStmt->bind_param("s", $username);
    $checkUsernameStmt->execute();
    $checkUsernameResult = $checkUsernameStmt->get_result();

    return $checkUsernameResult->num_rows > 0;
}


// Create a database connection
$conn = new mysqli($servername, $username, $password, $databaseName);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Check if the 'username' key is set in the $_SESSION array
$username = isset($_SESSION['username']) ? $_SESSION['username'] : null;
// Allows the use of $username without causing an "Undefined array key" error

$registrationMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve user input
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Check if the username already exists
    if (usernameExists($conn, $username)) {
        $registrationMessage = "Username already exists. Please choose a different one.";
    } else {
        // Perform user registration
        $insertUserQuery = "INSERT INTO Users (username, password) VALUES (?, ?)";
        $insertUserStmt = $conn->prepare($insertUserQuery);
        $insertUserStmt->bind_param("ss", $username, $password);
        $insertUserResult = $insertUserStmt->execute();

        if ($insertUserResult) {
            $registrationMessage = "Registration successful!";
        } else {
            $registrationMessage = "Error: " . $insertUserStmt->error;
        }

        // Close the prepared statement
        $insertUserStmt->close();
    }
}

// Close the database connection
$conn->close();
?>

<?php include(__DIR__ . '/../includes/head.php'); ?>


<title>NATE-REGISTER</title>

<?php include(__DIR__ . '/../includes/header.php'); ?>

<div class="formContainer">
    <h2 class="text-center">User Registration</h2>
    <form class="form" id="registerForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label class="label" for="username">Username:</label>
        <input class="input" type="text" id="username" name="username" required>

        <label class="label" for="password">Password:</label>
        <input class="input" type="password" id="password" name="password" required>

        <button class="btn-main" type="submit">Register</button>
    </form>
    <div id="registrationResult">
        <?php if (!empty($registrationMessage)) : ?>
            <p style="color: <?php echo $registrationMessage === 'Registration successful!' ? 'green' : 'red'; ?>">
                <?php echo $registrationMessage; ?>
            </p>
        <?php endif; ?>
    </div>
</div>

</body>

</html>