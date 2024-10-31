<?php
include 'connectDB.php';
$sql = "CREATE TABLE user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    phone VARCHAR(10) UNIQUE NOT NULL,
    address VARCHAR(255),
    password VARCHAR(255) NOT NULL,
    account_createdd TIMESTAMP/*fetch*/
    )";
$result = mysqli_query($conn, $sql);
if (!$result)
  die("Error while creating table due to: ");
else
  echo "User Table created successfully";
?>