<?php
// Connect to database
$mysqli = new mysqli("localhost", "root", "", "brr");
$conn = $mysqli;
// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>