<!DOCTYPE html>
<html>

<head>
    <title>BRR Trading</title>
    <link rel="stylesheet" href="../css/addProduct.css">
</head>

<body>
    <div id="heading">
        <h1>Add New Product</h1>
    </div>

    <table>
        <form action="../product/addProduct_code.php" method="post" enctype="multipart/form-data">
            <tr>
                <td><label for="product_name">Product Name:</label></td>
                <td><input required type="text" id="product_name" name="product_name"></td>
            </tr>
            <tr>
                <td><label for="price">Price:</label></td>
                <td><input required type="number" step="5" id="price" name="price"></td>
            </tr>
            <tr>
                <td><label for="category">Category:</label></td>
                <td><select id="category" name="category">
                        <option value="Others">Others</option>
                        <option value="T-Shirts">T-Shirts</option>
                        <option value="Sweatshirts">Sweatshirts</option>
                        <option value="Jackets">Jackets</option>
                        <option value="Hoodies">Hoodies</option>
                        <option value="Jockers">Jockers</option>
                        <option value="Pants">Pants</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="description">Product Description:</label></td>
                <td><textarea required id="description" name="description" rows="4" cols="30"></textarea></td>
            </tr>

            <tr>
                <td><label for="product_image">Product Image:</label></td>
                <td><input required type="file" id="product_image" name="product_image"></td>
            </tr>
            <tr>
                <td>&nbsp</td>
            </tr>
            <tr>
                <td><label for="sizes">Sizes</label></td>
                <td><label for="sizes">Quantity:</label></td>
            </tr>
            <tr>
                <td><label for="size">"S"</label></td>
                <td>
                    <input required type="number" name="quantity_S">
                </td>
            </tr>
            <tr>
                <td><label for="size">"M"</label></td>
                <td>
                    <input required type="number" name="quantity_M">
                </td>
            </tr>
            <tr>
                <td><label for="size">"L"</label></td>
                <td>
                    <input required type="number" name="quantity_L">
                </td>
            </tr>
            </div>
            <tr>
                <td><label for="size">"XL"</label></td>
                <td>
                    <input required type="number" name="quantity_XL">
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><button class="orange-button" type="submit">Add Product</button></td>
            </tr>
        </form>
    </table>
</body>

</html>