<?php

// $servername = "localhost";
// $username = "root";
// $password = "";
// $db = "ecommerce";

// $con = mysqli_connect($servername, $username, $password, $db);

// if (!$con) {
//     die("Connection failed: " . mysqli_connect_error());
// }

// $servername = "remotemysql.com:3306";
// $username = "dYOBa5KYD8";
// $password = "G4nJxXSlDJ";
// $db = "dYOBa5KYD8";

$servername = "us-cdbr-east-05.cleardb.net:3306:3306";
$username = "bc53acb34c57c9";
$password = "82e4a0ce";
$db = "heroku_5f2e6a0f4cd89b0";

$con = mysqli_connect($servername, $username, $password, $db);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
