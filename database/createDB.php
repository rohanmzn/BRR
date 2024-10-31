<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = mysqli_connect($servername, $username, $password);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error($conn));
}
// Create database
$sql = "CREATE DATABASE BRR";
$result = mysqli_query($conn, $sql);
if ($result)
  echo "Database created successfully";
else
  echo "Error creating database: " . mysqli_error();
?>