<?php
$conn = new mysqli("us-cdbr-east-05.cleardb.net:3306:3306", "bc53acb34c57c9", "82e4a0ce", "heroku_5f2e6a0f4cd89b0");

if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: " . $conn->connect_error;
    exit();
}
