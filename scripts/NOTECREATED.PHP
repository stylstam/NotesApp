<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Include any necessary styles/scripts -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        // Check if the note has been created and show a popup
        $(document).ready(function() {
            <?php
            if (isset($_SESSION['note_created']) && $_SESSION['note_created'] === true) {
                unset($_SESSION['note_created']); // Clear the session variable
            ?>
                alert("Your note has been created!");
            <?php } ?>
        });
    </script>
</head>
<body>
    <!-- Your "View Notes" page content -->
</body>
</html>