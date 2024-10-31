<!-- not in use admin table ma inser garna matra use garekoo -->
<?php

include '../database/connectDB.php';

$stmt = $conn->prepare("INSERT INTO admin (email, password) VALUES (:email, :password)");

$stmt->bindParam(':email', $email);
$stmt->bindParam(':password', $hashed_password);

$email = "roharzan@gmail.com";
$hashed_password = password_hash("111111", PASSWORD_DEFAULT);  // Use a strong hashing algorithm

$stmt->execute();
$stmt->closeCursor();
$conn = null;
?>