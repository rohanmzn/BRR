<?php
$conn = new mysqli("localhost", "root", "", "brr");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql1 = "SET  @num := 0";
$result1 = (mysqli_query($conn, $sql1));
$sql1 = "UPDATE products SET product_id = @num := (@num+1)";
$result1 = (mysqli_query($conn, $sql1));
$sql1 = "ALTER TABLE products AUTO_INCREMENT = 1;";
$result1 = (mysqli_query($conn, $sql1));


echo "sucessful";
;
?>
<!-- not in use as of 2024 jan 28 yesko copy use va cha in deleteProduct.php -->