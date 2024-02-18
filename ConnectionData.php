<?php
$servername = "localhost";
$username = "db";
$password = "pass";
$dbname = "fak";

$conn = new mysqli($servername, $username, $password,$dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>