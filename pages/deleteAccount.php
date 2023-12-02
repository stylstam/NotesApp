<?php
session_start();
require_once(__DIR__ . '/../config/db.php');

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Check if the delete account form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the confirmation checkbox is checked
    if (isset($_POST['confirm_delete']) && $_POST['confirm_delete'] === 'on') {
        // Delete the user's account
        $username = $_SESSION['username'];

        // Add any additional cleanup or cascading deletion of related records as needed

        $deleteUserQuery = "DELETE FROM Users WHERE username = ?";
        $deleteUserStmt = $conn->prepare($deleteUserQuery);
        $deleteUserStmt->bind_param("s", $username);
        $deleteUserResult = $deleteUserStmt->execute();

        if ($deleteUserResult) {
            // Logout the user and redirect to the home page
            session_unset();
            session_destroy();
            header("Location: /pages/home.php");
            exit();
        } else {
            $deleteErrorMessage = "Error deleting the account: " . $deleteUserStmt->error;
        }

        $deleteUserStmt->close();
    } else {
        $deleteErrorMessage = "Please confirm by checking the box.";
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<?php include(__DIR__ . '/../includes/head.php'); ?>

<title>Delete Account</title>


<?php include(__DIR__ . '/../includes/header.php'); ?>

<div class="formContainer">
    <h2 class="text-center">Delete Account</h2>

    <?php if (isset($deleteErrorMessage)) : ?>
        <p style="color: red;"><?php echo $deleteErrorMessage; ?></p>
    <?php endif; ?>

    <form class="form" id="deleteAccountForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label class="label">Are you sure you want to delete your account?</label>

        <div class="checkbox">
            <input type="checkbox" id="confirm_delete" name="confirm_delete">
            <label for="confirm_delete">Yes, I'm sure</label>
        </div>

        <button class="btn-main" type="submit">Delete Account</button>
    </form>
</div>

</body>

</html>