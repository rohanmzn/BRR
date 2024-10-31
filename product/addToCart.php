<?php
session_start();
// Include database connection file
include '../database/connectDB.php';
// Handle form submission outside the loop
$product_id = $_POST['product_id'];
if (!isset($_SESSION['Username']) || $_SESSION['Username'] === '0') {
  include 'invalidCarter.php';
  exit;
}
$username = $_SESSION['Username'];
if ($_POST['usersize'] != null) {

  $usersize = $_POST['usersize'];

  // Prepare and execute SQL query to insert data into the Cart table
  $sql = "INSERT INTO myCart (username, product_id, usersize) VALUES (?, ?, ?)";
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param("sis", $username, $product_id, $usersize);
  $stmt->execute();
  if ($stmt->affected_rows > 0) {
    //   echo "<script> alert('Product added to cart sucessfully') </script>";
    header('Location: ../shop.php?msg=sucessfull');
  } else {
    echo "<script> alert('Failed to add product to cart') </script>";
  }
  // header('Location: ./productDetail.php?size=null');
}
$stmt->close();
$mysqli->close();
?>