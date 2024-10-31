<?php
include '../database/connectDB.php';
session_start();
$username = $_SESSION["Username"];
$totalsum = $_SESSION["totalsum"];

if (isset($_POST['pm']) & ($_POST['pm']) == 1) {
    $payment_mode = 'Cash On Delivery'; //retrive from cheeckout
}
if (isset($_GET['pm']) & ($_GET['pm']) == 2) {
    $payment_mode = 'Khalti Wallet'; //retrive from cheeckout
}
$delivery_address = isset($_GET['deliveryAddress']) ? $_GET['deliveryAddress'] : '';
$order_note = isset($_GET['orderNote']) ? $_GET['orderNote'] : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming you're using POST now
    $delivery_address = $_POST['deliveryAddress'] ?? '';
    $order_note = $_POST['orderNote'] ?? '';
    // Handle these variables accordingly
}


$sql2 = "SELECT phone FROM user WHERE email = '$username'";
$result2 = $mysqli->query($sql2);
if ($result2->num_rows > 0) {
    while ($row2 = $result2->fetch_assoc()) {
        $user_phone = $row2['phone'];
    }
}
$total_amount = $totalsum;  // Assuming total_amount is calculated elsewhere

// Start a transaction to ensure data consistency
$conn->begin_transaction();
$timestamp = date("YmdHis");//ts only int
$order_id = $timestamp;
$order_date = date('Y-m-d');
// Insert into orders table
$sql = "INSERT INTO orders (user_email, user_phone, total_amount,order_id,payment_mode,order_date,delivery_address,order_note)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssdissss", $username, $user_phone, $total_amount, $order_id, $payment_mode, $order_date,$delivery_address,$order_note);

if (!$stmt->execute()) {
    $conn->rollback(); // Rollback if insertion fails
    die("Error inserting into orders table: " . $stmt->error);
}

// Insert into order_items table (assuming multiple items)
$sql3 = "SELECT * FROM mycart WHERE username='$username'";
$result3 = $mysqli->query($sql3);
if ($result3->num_rows > 0) {
    while ($row3 = $result3->fetch_assoc()) {
        $sql = "INSERT INTO order_items (order_id, product_id, usersize)    
            VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iis", $order_id, $row3['product_id'], $row3['usersize']);
        // echo "<script> alert('{$row3['usersize']}')</script>";
        $stmt1 = $conn->prepare("UPDATE productsizes SET quantity = quantity - 1 WHERE (fk_product_id = ? && size = ?)");
        $stmt1->bind_param("is", $row3['product_id'], $row3['usersize']);
        $stmt1->execute();

        if (!$stmt->execute()) {
            $conn->rollback(); // Rollback if any insertion fails
            die("Error inserting into order_items table: " . $stmt->error);
        }
    }
}

$sql = "DELETE FROM mycart WHERE username = ?";  // Replace `your_table` with the actual table name
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();

$conn->commit(); // Commit transaction if all insertions succeed

$stmt->close();
$conn->close();

header('Location: orderSuccess.php');
exit;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Redirecting...</title>
    <script>
        // Disable the back button
        history.pushState(null, null, location.href);
        window.onpopstate = function () {
            history.go(1);
        };
    </script>
</head>
<body>
    <p>You are being redirected...</p>
</body>
</html>