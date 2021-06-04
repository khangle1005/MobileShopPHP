<?php

// $servername = "localhost";
// $username = "root";
// $password = "";
// $db = "ecommerce";

// $con = mysqli_connect($servername, $username, $password, $db);

// if (!$con) {
//     die("Connection failed: " . mysqli_connect_error());
// }

$servername = "remotemysql.com";
$username = "dYOBa5KYD8";
$password = "G4nJxXSlDJ";
$db = "dYOBa5KYD8";

$con = mysqli_connect($servername, $username, $password, $db);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
