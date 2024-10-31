<?php
include '../database/connectDB.php';

if (isset($_POST['product_id'])) {
    $productId = $mysqli->real_escape_string($_POST['product_id']);
    $productName = $mysqli->real_escape_string($_POST['product_name']);
    $price = (float) $_POST['price']; // Convert the string to a float
    $price = number_format($price, 0, '.', ''); // Format the float without decimal places
    $category = $mysqli->real_escape_string($_POST['category']);
    $description = $mysqli->real_escape_string($_POST['description']);

    // Prepare the update query for non-image fields
    $sql = "UPDATE Products SET product_name = ?, price = ?, category = ?, description = ? WHERE product_id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ssssi", $productName, $price, $category, $description, $productId);

    // Handle image upload if enabled
    if (isset($_FILES["product_image"]["name"]) && $_FILES["product_image"]["name"] != "") {
        // Image uploaded, handle processing
        $allowed_extensions = ["jpg", "jpeg", "png"];
        $file_extension = pathinfo($_FILES["product_image"]["name"], PATHINFO_EXTENSION);

        if (!in_array($file_extension, $allowed_extensions)) {
            echo "Invalid image format. Please upload a JPG, JPEG, or PNG file.";
            exit();
        }

        $new_filename = uniqid() . "." . $file_extension;
        $target_dir = "../images/";
        $target_file = $target_dir . $new_filename;

        if (!move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
            echo "Error uploading image.";
            exit();
        }

        // Update database with new image path
        $new_image_path = "images/" . $new_filename;
        $sql1 = "UPDATE Products SET product_image = ? WHERE product_id = ?";
        $stmt1 = $mysqli->prepare($sql1);
        $stmt1->bind_param("si", $new_image_path, $productId);

        if ($stmt->execute()&&$stmt1->execute()) {
            header("Location: ../admin/index.php?file=../product/displayProducts");
        } else {
            echo "Error updating product.";
        }
    } else {
        // No image uploaded, update other fields without image
        if ($stmt->execute()) {
            header("Location: ../admin/index.php?file=../product/displayProducts");
            exit();
        } else {
            echo "Error updating product.";
        }
    }
} else {
    echo "Invalid request.";
}

$mysqli->close();
?>
