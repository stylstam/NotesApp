<?php /*
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit();
}
?>
<?php
include 'serverCreds.php';
?>
<?php
// Get the user ID from the session
$userID = $_SESSION['user_id'];

// Create connection
$conn = new mysqli($servername, $username, $password, $databaseName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Perform user deletion
$deleteUserQuery = "DELETE FROM Users WHERE id = ?";
$stmt = $conn->prepare($deleteUserQuery);

if ($stmt) {
    $stmt->bind_param("i", $userID);
    $stmt->execute();

    // Check if the deletion was successful
    if ($stmt->affected_rows > 0) {
        // User deleted successfully
        // Destroy the session
        session_destroy();
        header("Location: login.php");
        exit();
    } else {
        // No user found with the given ID
        echo "User not found.";
    }

    $stmt->close();
} else {
    // Error in preparing the statement
    echo "Error in preparing the statement.";
}

// Close connection
$conn->close();

*/
?>