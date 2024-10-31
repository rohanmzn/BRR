<?php
include '../database/connectDB.php';

if (isset($_GET['id'])) {
    $productId = $mysqli->real_escape_string($_GET['id']);

    // Delete product from Products table
    $sql = "DELETE FROM Products WHERE product_id = $productId";
    if ($mysqli->query($sql)) {
        // Delete related sizes from ProductSizes table
        $sql = "DELETE FROM ProductSizes WHERE fk_product_id = $productId";
        $mysqli->query($sql);
        // include 'product_idRearrange.php';
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        echo "<script> alert('Product Deleted Sucessfully'); </script>";
        header("Location: ../admin/index.php?file=../product/displayProducts");
    } else {
        echo "Error deleting product.";
    }
} else {
    echo "Invalid product ID.";
}
$mysqli->close();
?>
