<link rel="stylesheet" href="../css/infoEdit.css">
<link rel="stylesheet" href="../css/addProduct.css">
<?php
include '../database/connectDB.php';

if (isset($_GET['id'])) {
    $productId = $mysqli->real_escape_string($_GET['id']);

    // Retrieve product details
    $sql = "SELECT * FROM Products WHERE product_id = $productId";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
        ?>

        <!DOCTYPE html>
        <html>

        <head>
            <title>BRR Trading</title>
        </head>

        <body>
            <div class="container">

                <form action="updateProduct.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                    <table>
                        <tr>
                        <tr>
                            <td colspan=2>
                                <h1>Edit Product</h1>
                            </td>
                        </tr>
                        <th>Product Name:</th>
                        <td>
                            <input type="text" id="product_name" name="product_name"
                                value="<?php echo $product['product_name']; ?>">
                        </td>
                        </tr>
                        <tr>
                            <th>Price:</th>
                            <td>
                                <input type="number" step="0.01" id="price" name="price"
                                    value="<?php echo $product['price']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <th>Category:</th>
                            <td>
                                <select id="category" name="category">
                                    <option value="T-Shirts" <?php echo $product['category'] == 'T-Shirts' ? 'selected' : ''; ?>>
                                        T-Shirts</option>
                                    <option value="Sweatshirts" <?php echo $product['category'] == 'Sweatshirts' ? 'selected' : ''; ?>>Sweatshirts</option>
                                    <option value="Jackets" <?php echo $product['category'] == 'Jackets' ? 'selected' : ''; ?>>
                                        Jackets</option>
                                    <option value="Hoodies" <?php echo $product['category'] == 'Hoodies' ? 'selected' : ''; ?>>
                                        Hoodies</option>
                                    <option value="Jockers" <?php echo $product['category'] == 'Jockers' ? 'selected' : ''; ?>>
                                        Jockers</option>
                                    <option value="Pants" <?php echo $product['category'] == 'Pants' ? 'selected' : ''; ?>>Pants
                                    </option>
                                    <option value="Others" <?php echo $product['category'] == 'Others' ? 'selected' : ''; ?>>
                                        Others</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Description:</th>
                            <td>
                                <textarea id="description" name="description"><?php echo $product['description']; ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th>Product Image:</th>
                            <td>
                                <input type="file" id="product_image" name="product_image">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" align="left">
                                <button class="orange-button" type="submit">Update Product</button>
                                <button class="orange-button" id="blue" type="button"><a
                                        href="../admin/index.php?file=../product/displayProducts">Go Back</a></button>
                            </td>
                        </tr>
                    </table>

                </form>
            </div>
        </body>

        </html>

        <?php
    } else {
        echo "Product not found.";
    }
} else {
    echo "Invalid product ID.";
}

$mysqli->close();
?>