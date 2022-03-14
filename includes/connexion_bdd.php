<?php

$dbServerName = "localhost";
$dbUsername = "root";
$dbPasseword = "2001antene";
$dbName = "bdd_bde";

$conn = mysqli_connect($dbServerName, $dbUsername, $dbPasseword, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
