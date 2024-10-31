<?php
include '../database/connectDB.php';
session_start();
$username = $_SESSION["Username"];
$totalsum = $_SESSION["totalsum"];
$usersize = $_SESSION['size1'];
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


$sql = "INSERT INTO order_items (order_id, product_id, usersize)    
            VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iis", $order_id, $_SESSION['product_id'],$usersize);
$stmt1 = $conn->prepare("UPDATE productsizes SET quantity = quantity - 1 WHERE (fk_product_id = ? && size = ?)");
$stmt1->bind_param("is", $_SESSION['product_id'], $usersize);
$stmt1->execute();

if (!$stmt->execute()) {
    $conn->rollback(); // Rollback if any insertion fails
    die("Error inserting into order_items table: " . $stmt->error);
}
unset($_SESSION['p_id']);
unset($_SESSION['product_id']);
unset($_SESSION['size1']);

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