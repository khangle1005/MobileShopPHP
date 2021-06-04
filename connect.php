<?php
// $conn = new mysqli("localhost", "root", "", "ecommerce");

// if ($conn->connect_errno) {
//     echo "Failed to connect to MySQL: " . $conn->connect_error;
//     exit();
// }

$conn = new mysqli("remotemysql.com", "dYOBa5KYD8", "G4nJxXSlDJ", "dYOBa5KYD8");

if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: " . $conn->connect_error;
    exit();
}
