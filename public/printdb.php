<?php
require_once 'database.php';
?>

<?php
// Appwide Head file
include 'head.php';
?>
</head>
<?php

// Get a list of tables in the database
$result = $conn->query("SHOW TABLES");

if (!$result) {
    die("Error: " . $conn->error);
}

// Fetch the tables and display the data
while ($row = $result->fetch_row()) {
    $tableName = $row[0];

    echo "<h2>$tableName Table</h2>";
    echo "<table border='1'>
    <tr>";

    // Get column names
    $columnsResult = $conn->query("SHOW COLUMNS FROM $tableName");
    while ($column = $columnsResult->fetch_assoc()) {
        echo "<th>" . $column['Field'] . "</th>";
    }

    echo "</tr>";

    // Select all rows from the current table
    $dataResult = $conn->query("SELECT * FROM $tableName");

    while ($dataRow = $dataResult->fetch_assoc()) {
        echo "<tr>";
        foreach ($dataRow as $value) {
            echo "<td>" . $value . "</td>";
        }
        echo "</tr>";
    }

    echo "
</table>";
}

// Free the result sets
$result->free();
$columnsResult->free();
$dataResult->free();

// Close the database connection
$conn->close();
?>