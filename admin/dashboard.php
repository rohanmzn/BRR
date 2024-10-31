<?php session_start();
include '../database/connectDB.php';
// for Table 1
function getCount($conn, $tableName)
{
    try {
        $count = null;
        $sql = "SELECT COUNT(*) FROM " . $tableName;
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
        return $count;
    } catch (Exception $e) {
        die("Error: " . $e->getMessage());
    }
}

try {
    $ordersCount = getCount($conn, 'orders');
    $deliveredCount = getCount($conn, 'delivered');
    // table 2
    $productCount = getCount($conn, 'products');
    $userCount = getCount($conn, 'user');
    $soldItemCount = getCount($conn, 'order_items');
} catch (Exception $e) {
    die("Error fetching counts: " . $e->getMessage());
}
//common size
try {
    $sql = "SELECT usersize
            FROM order_items
            GROUP BY usersize
            ORDER BY COUNT(usersize) DESC
            LIMIT 2";

    $result = $conn->query($sql);
    $sizes = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $sizes[] = $row["usersize"];
        }
        $commonSize = join(', ', $sizes);
    } else {
        echo "No data found";
    }
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
try {
    // SQL query to get the total sum of 'total_amount' from both 'delivered' and 'orders' tables
    $sql = "SELECT SUM(total_amount) AS total_sum FROM (
                SELECT total_amount FROM delivered
                UNION ALL
                SELECT total_amount FROM orders
            ) AS combined_sales";

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $totalSales = $row["total_sum"];
        if (floor($totalSales) == $totalSales) {
            $totalSales = (int) $totalSales;
        }
    } else {
        echo "No data found";
    }
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}

//for Table 3
function getSalesAmount($conn, $timeFrame)
{
    $amount = 0;
    $today = date('Y-m-d');
    $startOfWeek = date('Y-m-d', strtotime('last saturday'));
    $startOfMonth = date('Y-m-01');

    // Determine the time frame for the SQL query
    switch ($timeFrame) {
        case 'today':
            $sql = "SELECT SUM(total_amount) FROM delivered WHERE delivered_date = '$today'";
            break;
        case 'week':
            $sql = "SELECT SUM(total_amount) FROM delivered WHERE delivered_date >= '$startOfWeek' AND delivered_date <= '$today'";
            break;
        case 'month':
            $sql = "SELECT SUM(total_amount) FROM delivered WHERE delivered_date >= '$startOfMonth' AND delivered_date <= '$today'";
            break;
        default:
            return $amount;
    }

    try {
        $result = $conn->query($sql);
        if ($result) {
            $row = $result->fetch_row();
            $amount = $row[0] ? $row[0] : 0; // Check if the result is null, then return 0
            if (floor($amount) == $amount) {
                $amount = (int) $amount;
            }
        }
        return $amount;
    } catch (Exception $e) {
        die("Error: " . $e->getMessage());
    }
}
$salesToday = getSalesAmount($conn, 'today');
$salesWeek = getSalesAmount($conn, 'week');
$salesMonth = getSalesAmount($conn, 'month');


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BRR Trading</title>
    <link rel="stylesheet" href="../css/adminInfo.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Tenor Sans:wght@400&display=swap" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha384-k6vP0kho+2zLcIvVbCVEJf2mvNw1T2Rn8D289v/Ty7UpqM5V2kMJZDyWIlJy5B/T" crossorigin="anonymous">
</head>

<body>
    <div id="heading">
        <h1>Admin Dashboard</h1>
    </div>
    <br>
    <table id='orders'>
        <tr>
            <th>Orders Pending</th>
            <th>Orders Delivered</th>
        </tr>
        <tr>
            <td>
                <?php echo htmlspecialchars($ordersCount); ?>
            </td>
            <td>
                <?php echo htmlspecialchars($deliveredCount); ?>
            </td>
        </tr>
    </table>
    <table id='insights'>
        <tr>
            <th>Total Products</th>
            <th>Number of Customers</th>
            <th>Common Size</th>
            <th>Total Item Sold</th>
            <th>Total Sales</th>
        </tr>
        <tr>
            <td>
                <?php echo htmlspecialchars($productCount); ?>
            </td>
            <td>
                <?php echo htmlspecialchars($userCount); ?>
            </td>
            <td>
                <?php echo htmlspecialchars($commonSize); ?>
            </td>
            <td>
                <?php echo htmlspecialchars($soldItemCount); ?>
            </td>
            <td>
                <?php echo htmlspecialchars($totalSales); ?>
            </td>
        </tr>
    </table>
    <br>
    <table id='total_sales'>
        <tr>
            <th colspan=2>Total Sales</th>
        </tr>
        <tr>
            <td>Today</td>
            <td>Rs.
                <?php echo $salesToday; ?>
            </td>
        </tr>
        <tr>
            <td>This Week</td>
            <td>Rs.
                <?php echo $salesWeek; ?>
            </td>
        </tr>
        <tr>
            <td>This Month</td>
            <td>Rs.
                <?php echo $salesMonth; ?>
            </td>
        </tr>
    </table>

    <?php

    try {
        // Query to fetch the top selling products
        $sql = "SELECT p.product_id, p.product_name, p.price, p.category
            FROM products p
            JOIN order_items oi ON p.product_id = oi.product_id
            GROUP BY p.product_id
            ORDER BY COUNT(oi.product_id) DESC
            LIMIT 2";

        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            echo "<table id='topSelling'>";
            echo "<tr>";
            echo "<th colspan=4>Top Selling Product</th>";
            echo "</tr>";
            echo "<tr id='underline'>";
            echo "<td>Product ID</td>";
            echo "<td>Product Name</td>";
            echo "<td>Price</td>";
            echo "<td>Category</td>";
            echo "</tr>";

            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>pid_" . $row["product_id"] . "</td>";
                echo "<td>" . $row["product_name"] . "</td>";
                echo "<td>" . $row["price"] . "</td>";
                echo "<td>" . $row["category"] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "No top selling products found";
        }
    } catch (Exception $e) {
        die("Error: " . $e->getMessage());
    }
    ?>

    <table id='profileInfo'>
        <tr>
            <th colspan=2>Admin Information</th>
        </tr>
        <tr>
            <td>Email</td>
            <td>roha****@gmail.com</td>
        </tr>
        <tr>
            <td>Password</td>
            <td>********</td>
        </tr>
        <tr>
            <td colspan=2>
                <button class='orange-button' id="changePassword">Change Password</button>
            </td>
        </tr>
    </table>
    <?php

    try {
        // Query to fetch the newest arrivals
        $sql = "SELECT product_id, product_name, price, category
            FROM products
            ORDER BY product_id DESC
            LIMIT 2";

        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            echo "<table id='newArrivals'>";
            echo "<tr>";
            echo "<th colspan=4>New Arrivals</th>";
            echo "</tr>";
            echo "<tr id='underline'>";
            echo "<td>Product ID</td>";
            echo "<td>Product Name</td>";
            echo "<td>Price</td>";
            echo "<td>Category</td>";
            echo "</tr>";

            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>pid_" . htmlspecialchars($row["product_id"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["product_name"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["price"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["category"]) . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "No new arrivals found";
        }
    } catch (Exception $e) {
        die("Error: " . $e->getMessage());
    }
    ?>
    <script>
        // Get the button element
        var changePassword = document.getElementById('changePassword');

        // Add click event listener to the button
        changePassword.addEventListener('click', function () {
            // Redirect to the edit page
            window.location.href = 'change_password.php';
        });
    </script>


</body>

</html>