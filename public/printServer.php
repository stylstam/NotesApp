<?php
// Appwide Head file
include 'head.php';
?>
</head>

<body>
    <?php
    // Appwide Header file
    include 'header.php';
    ?>
    
    <?php
    include 'serverCreds.php';
    ?>

    <?php
  
    // Create connection
    $conn = new mysqli($servername, $username, $password);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Select the specific database
    $conn->select_db($databaseName);

    // Query to retrieve all tables in the selected database
    $tablesQuery = "SHOW TABLES";
    $tablesResult = $conn->query($tablesQuery);

    if ($tablesResult->num_rows > 0) {
        // Output data of each table
        while ($tableRow = $tablesResult->fetch_row()) {
            $tableName = $tableRow[0];
            echo "Table: " . $tableName . "<br>";

            // Query to retrieve all rows in the current table
            $rowsQuery = "SELECT * FROM $tableName";
            $rowsResult = $conn->query($rowsQuery);

            if ($rowsResult->num_rows > 0) {
                // Output data of each row
                while ($row = $rowsResult->fetch_assoc()) {
                    echo "Row: " . implode(", ", $row) . "<br>";
                }
            } else {
                echo "No rows found in table $tableName.<br>";
            }

            echo "<hr>"; // Add a horizontal line for separation between tables
        }
    } else {
        echo "No tables found in the database $databaseName.";
    }

    // Close connection
    $conn->close();
    ?>

    <?php
    // Appwide Footer file
    include 'footer.php';
    ?>

    </html>