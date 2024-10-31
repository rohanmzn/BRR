<?php
include '../database/connectDB.php';

if (isset($_GET['id'])) {
    $id = $mysqli->real_escape_string($_GET['id']);

    // Delete product from Products table
    $sql = "DELETE FROM mycart WHERE id = $id";
    if ($mysqli->query($sql)) {
        // Delete related sizes from ProductSizes table
        // include 'product_idRearrange.php';
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        echo "<script> alert('Remove from cart Sucessfully'); </script>";
        header("Location: ../myprofile.php?file=../myProfile/cart");
    } else {
        echo "Error deleting product.";
    }
} else {
    echo "Invalid product ID.";
}
$mysqli->close();
?>