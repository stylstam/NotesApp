<?php
require_once(__DIR__ . '/../config/db.php');

if ($conn) {
    echo "Connected successfully!";
} else {
    echo "Connection failed: " . $conn->connect_error;
}

$conn->close();
