<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/myProfile.css">
    <link rel="stylesheet" href="./css/addProduct.css">
    <link rel="stylesheet" href="./css/adminTable.css">
    <style>
        /* Style for modal */
        .modalView {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }

        .modalView-content {
            background-color: #fefefe;
            margin: 10% auto;
            padding: 2px;
            border: 1px solid #888;
            width: 80%;
        }
    </style>
</head>

<body>
    <div id="heading">
        <h1>Orders Placed</h1>
    </div>
    <div>
        <?php
        include './database/connectDB.php';

        if (isset($_SESSION['Username'])) {
            $email = $_SESSION['Username'];
            $sql = "SELECT * FROM orders WHERE user_email = ? ORDER BY order_id DESC";
            if ($stmt = mysqli_prepare($conn, $sql)) {
                mysqli_stmt_bind_param($stmt, "s", $email);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                if ($result) {
                    echo "<table border=1 id='orderTable'>";
                    echo "<tr><th>S.N</th><th>Order ID</th><th>Order Items</th><th>Payment Mode</th><th>Total Amount</th><th>Order Date</th><th>Delivery Address</th><th>Order Note</th></tr>";
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr align=center>";
                        $order_p_id = $row['id'];
                        $order_id = $row['order_id'];
                        echo "<td>" . $i++ . "</td>";
                        echo "<td>" . $row['order_id'] . "</td>";
                        echo "<td>
                        <button class='orange-button1' onclick='openModal($order_id)'>View</button>
                     </td>";
                        echo "<td>" . $row['payment_mode'] . "</td>";
                        echo "<td> Rs. " . $row['total_amount'] . "</td>";
                        echo "<td>" . $row['order_date'] . "</td>";
                        echo "<td>" . $row['delivery_address'] . "</td>";
                        echo "<td>" . $row['order_note'] . "</td>";
                        ?>
                        <?php
                        echo "</tr>";
                    }
                    mysqli_free_result($result);
                    mysqli_stmt_close($stmt);

                    echo "</table>";
                } else {
                    echo "No orders found.";
                }

                // Close the connection
                mysqli_close($conn);
            }
        }
        ?>

    </div>
    <div id="myModalView" class="modalView">
        <div class="modalView-content">
            <!-- Order details will be loaded here -->
        </div>
    </div>
    <script>
        // Function to open modal and load order details
        function openModal(orderId) {
            var modal = document.getElementById("myModalView");
            var modalContent = modal.querySelector(".modalView-content");
            modal.style.display = "block";

            // Make AJAX request to fetch order details
            // Replace 'viewOrderItem.php' with the correct URL endpoint
            var url = './myprofile/viewOrderItem.php?id=' + orderId;
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    modalContent.innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", url, true);
            xhttp.send();
        }

        // Close the modal when clicking outside of it
        window.onclick = function(event) {
            var modal = document.getElementById("myModalView");
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>

</html>