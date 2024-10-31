<?php
include '../database/connectDB.php';
session_start();
if (isset($_GET['id'])) {
    $productId = $mysqli->real_escape_string($_GET['id']);
    $_SESSION['productId'] = $productId;
    // Check for product existence
    $stmt = $mysqli->prepare("SELECT product_name FROM Products WHERE product_id = ?");
    $stmt->bind_param("i", $productId);

    $stmt->execute();
    $stmt->bind_result($productName);

    if (!$stmt->fetch()) {
        echo "Invalid Product not found.";
        exit(); // Stop execution if product not found
    }
    $stmt->close();
    ?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>BRR Trading</title>
        <link rel="stylesheet" href="../css/infoEdit.css">
        <style>
            h1,h2,th,td,input[type="number"]{
                color:white
            }
            th{
                text-align: left;
            }
        </style>
    </head>

    <body>
        <div class="container">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <table>
                <thead>
                    <tr>
                    <td colspan=2><h3>Product name: <?php echo $productName; ?></h3></td>
                    </tr>
                    <tr>
                        <th width="70px">Size</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT size, quantity FROM ProductSizes WHERE fk_product_id = ?";
                    $stmt = $mysqli->prepare($sql);
                    $stmt->bind_param("i", $productId);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    while ($row = $result->fetch_assoc()) {
                        $size = $row['size'];
                        $quantity = $row['quantity'];
                        ?>
                        <tr>
                            <td>
                                <?php echo $size; ?>
                            </td>
                            <td><input type="number" name="quantity[<?php echo $size; ?>]" value="<?php echo $quantity; ?>">
                            </td>
                        </tr>
                        <?php
                    }
                    $stmt->close();
                    ?>
                </tbody>
                <tfoot>
                    <tr><td>&nbsp;</td></tr>
                    <tr>
                        <td colspan="2">
                            <button class="orange-button" type="submit" onclick="return confirm('Are you sure you want to UPDATE STOCK?')">Update</button>
                            <button class="orange-button" id="blue" type=""><a href="../admin/index.php?file=../product/displayProducts">Go Back</a></button>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </form>
        </div>
    </body>

    </html>
<?php
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve quantities from form
    $quantities = $_POST['quantity'];

    if (isset($_SESSION['productId'])) {
        $fk_product_id = $_SESSION['productId'];

        foreach ($quantities as $size => $quantity) {
            $quantity = (int) $quantity;
            $stmt = $mysqli->prepare("UPDATE ProductSizes SET quantity = ? WHERE fk_product_id = ? AND size = ?");
            $stmt->bind_param("iis", $quantity, $fk_product_id, $size);
            $stmt->execute();
        }
        // echo "<script> alert('Stock Updated Sucessfully'); </script>";
        unset($_SESSION['productId']);
        header("Location: ../admin/index.php?file=../product/displayProducts&&msg=sucessful");
    }
}
$mysqli->close();
?>