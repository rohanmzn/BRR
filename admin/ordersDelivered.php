<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/addProduct.css">
    <link rel="stylesheet" href="../css/adminTable.css">
    <style>
        #heading {
            display: flex;
        }

        .column {
            flex: 0 0 71.5%;
            /* 70% of the available space */
        }

        .search-column {
            flex: 1;
            padding-top: 20px;
            /* Take up the remaining space */
        }

        .search {
            padding-left: 7px;
            background: #E8EBF3;
            font-family: 'Varela Round', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;

            background: #ffffff;
            border-radius: 15px;
            display: flex;
            align-items: center;
            box-shadow: 0 10px 30px rgba(65, 72, 86, .05);
        }

        .search input[type="text"] {
            font: 400 16px 'Varela Round', sans-serif;
            color: #414856;
            border: none;
            outline: none;
            padding: 10px 20px;
            border-radius: 15px 0 0 15px;
            width: 190px;
        }

        .search button {
            background: #EC7224;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 0 15px 15px 0;
            cursor: pointer;
            /* border: 2px solid #EC7224; */
            font: 400 16px 'Varela Round', sans-serif;
            transition: background 0.3s ease;
            margin-left: 0.5px;
        }

        .search button:hover {
            background: #ca6118;
        }

        #searchInput:-webkit-autofill,
        #searchInput:-webkit-autofill:hover,
        #searchInput:-webkit-autofill:focus,
        #searchInput:-webkit-autofill:active {
            -webkit-box-shadow: 0 0 0 30px white inset !important;
            -webkit-text-fill-color: #000 !important;
        }
    </style>
</head>

<body>
<div id="heading">
        <div class="column">
            <h1>Shipped / Delivered</h1>
        </div>
        <div class="column search-column">
            <div class="search">
                <form id="searchForm" action="index.php" method="GET">
                    <input type="text" id="searchInput" name="search" placeholder="Search for a Order" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>" />
                    <input type="hidden" name="file" value="./ordersDelivered">
                    <button type="submit" id="searchButton">Search</button>
                </form>
            </div>
        </div>
    </div>
    <div>
        <?php
        include '../database/connectDB.php';
        if (isset($_GET['search']) && $_GET['search'] != '') {
            $search = $conn->real_escape_string($_GET['search']);
            $filter = "WHERE order_id LIKE '%$search%'";
        } else {
            $filter = '';
        }
        
        // Build the SELECT query dynamically
        $query = "SELECT * FROM delivered $filter ORDER BY id DESC";
        $result = $conn->query($query);
        // $result = mysqli_query($conn, $sql);

        // Check if any data was found
        if ($result) {
            echo "<table border=1 id='orderTable'>";
            echo "<tr><th>S.N</th><th>Order ID</th><th>User Phone</th><th>Total Amount</th><th>Shipped Address</th><th>Payment Mode</th><th>Delivered Date</th><th>Order Items</th><th>Receipt</th></tr>";
            $i = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr align=center>";
                $order_p_id = $row['id'];
                $order_id = $row['order_id'];
                echo "<td>" . $i++ . "</td>";
                echo "<td>&nbsp;" . $row['order_id'] . "</td>";
                // echo "<td align=left>&nbsp;" . $row['user_email'] . "</td>";
                echo "<td>" . $row['user_phone'] . "</td>";
                echo "<td> Rs. " . $row['total_amount'] . "</td>";
                echo "<td>" . $row['delivery_address'] . "</td>";
                echo "<td>" . $row['payment_mode'] . "</td>";
                // echo "<td>" . $row['order_note'] . "</td>";
                echo "<td>" . $row['delivered_date'] . "</td>";
                echo "<td>
                        <button class='orange-button1' onclick='openModal($order_id)'>View</button>
                     </td>";
                     echo "<td>
                     <button class='orange-button1' onclick=\"window.location.href='../sales_invoice.php?order_id=" . $order_id . "'\">Print</button>
                   </td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "No orders found.";
        }

        // Close the connection
        mysqli_close($conn);

        ?>

    </div>
    <?php include 'viewOrderItemModal.php'; ?>
</body>

</html>