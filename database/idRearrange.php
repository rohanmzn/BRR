<?php
include 'connectDB.php';
$sql1 = "SET  @num := 0";
$result1 = (mysqli_query($conn, $sql1));
$sql1 = "UPDATE products SET product_id = @num := (@num+1)";
$result1 = (mysqli_query($conn, $sql1));
$sql1 = "ALTER TABLE user AUTO_INCREMENT = 1;";
$result1 = (mysqli_query($conn, $sql1));
?>
<!-- raw code form phuyal deletepost ma halirachu this is backup -->