<?php
$host = "localhost";
$user = "root"; // Change this if needed
$pass = ""; // Change if your MySQL has a password
$dbname = "journal_db";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
