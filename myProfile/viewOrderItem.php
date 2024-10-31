<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BRR Trading | My Profile</title>
    <style>
        .orderItem{
            background-color: #4b586b;
        }
    </style>
</head>

<body>
    <?php
    // $order_p_id = $_GET['order_p_id'];
    $order_id = $_GET['id'];
    include '../database/connectDB.php';

    ?>
    <div class="orderItem">
        <h2>Order ID:
            <?php echo $order_id ?>
        </h2>
        <table border="1">
            <tr>
                <th>S.N</th>
                <th>Product Name</th>
                <th>Product Image</th>
                <th>User Size</th>
                <th>Category</th>
                <th>Product Id</th>
            </tr>
            <?php
            $sql = "SELECT * FROM order_items WHERE order_id = ? ORDER BY product_id ASC";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $order_id);
            $stmt->execute();

            $sn = 1;
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                echo "<tr align=center>";

                $pid = $row['product_id'];
                echo "<td>" . $sn++ . "</td>";

                $sql1 = "SELECT * FROM Products WHERE product_id='$pid'";
                $result1 = $mysqli->query($sql1);
                if ($result1->num_rows > 0) {
                    while ($row1 = $result1->fetch_assoc()) {
                        echo "<td>" . $row1['product_name'] . "</td>";
                        $img_path = '../' . $row1['product_image'];
                        echo "<td><img src='" . $img_path . "' alt='Product Image' width='100'></td>";
                        echo "<td>" . $row['usersize'] . "</td>";
                        echo "<td>" . $row1['category'] . "</td>";
                    }
                }
                echo "<td>pid_" . $pid . "</td>";
                echo "</tr>";
            }
            $conn->close();
            ?>
        </table>
    </div>
</body>

</html>