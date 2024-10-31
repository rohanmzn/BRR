<?php
include '../database/connectDB.php';
//warning haru dekhako  vayera matra if vhitra halya
if (isset($_POST['product_name'])) {
    // Get form data
    $productName = $mysqli->real_escape_string($_POST['product_name']);
    $price = (float) $_POST['price']; // Convert the string to a float
    $price = number_format($price, 0, '.', ''); // Format the float without decimal places
    $category = $mysqli->real_escape_string($_POST['category']);
    $description = $mysqli->real_escape_string($_POST['description']);
    $productImage = $_FILES['product_image'];
    $sizeQuantity = [
        'S' => $_POST['quantity_S'],
        'M' => $_POST['quantity_M'],
        'L' => $_POST['quantity_L'],
        'XL' => $_POST['quantity_XL']
    ];
    // Move uploaded image
    $targetDir = "../images/"; // Replace with your desired upload directory
    $targetFile = $targetDir . basename($productImage["name"]); //images folder ma halna
    $product_image = "images/" . basename($productImage["name"]); //db ma pathauna
    try {
        if (!move_uploaded_file($productImage["tmp_name"], $targetFile)) {
            // throw new Exception("Failed to move uploaded file");
        }
        // Insert product into Products table
        $sql = "INSERT INTO Products (product_name, price, category, product_image, description) VALUES (?, ?, ?, ?, ?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("sssss", $productName, $price, $category, $product_image, $description);
        $stmt->execute();
        // Get newly inserted product_id
        $productId = $mysqli->insert_id;
        // Insert size and quantity into ProductSizes table
        foreach ($sizeQuantity as $size => $quantity) {
            $sql = "INSERT INTO ProductSizes (fk_product_id, size, quantity) VALUES (?, ?, ?)";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("isi", $productId, $size, $quantity);
            $stmt->execute();
        }
    } catch (Exception $e) {
        // Handle errors
        echo "Error: " . $e->getMessage();
    } finally {

        $mysqli->close();
    }
    header('Location: ../admin/index.php?success=1');
    exit();
}
exit();
?>