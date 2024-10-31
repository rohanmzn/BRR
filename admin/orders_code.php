<?php

$order_id = $_GET['id'];

function processDeliveredOrder($order_id)
{
    include '../database/connectDB.php';

    try {
        // Start transaction
        $mysqli->begin_transaction();

        // Select order data
        $sql = "SELECT * FROM orders WHERE order_id = $order_id";
        $result = $mysqli->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $order_p_id = $row['id'];
                $user_email = $row['user_email'];
                $user_email = $row['user_email'];
                $user_phone = $row['user_phone'];
                $total_amount = $row['total_amount'];
                $payment_mode = $row['payment_mode'];
                $delivery_address = $row['delivery_address'];
                $order_note = $row['order_note'];
                $delivered_date = date('Y-m-d');
                // Insert into delivered table
                $insertStmt = $mysqli->prepare("INSERT INTO delivered (order_id, user_email, user_phone, total_amount, payment_mode,delivered_date,delivery_address,order_note) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                $insertStmt->bind_param("isiissss", $order_id, $user_email, $user_phone, $total_amount, $payment_mode, $delivered_date,$delivery_address,$order_note);
                $insertStmt->execute();

                // $deleteOrderItemsStmt = $mysqli->prepare("DELETE FROM order_items WHERE order_id = ?");
                // $deleteOrderItemsStmt->bind_param("i", $order_id);
                // $deleteOrderItemsStmt->execute();

                // Delete from orders table
                $deleteStmt = $mysqli->prepare("DELETE FROM orders WHERE order_id = ?");
                $deleteStmt->bind_param("i", $order_id);
                $deleteStmt->execute();
            }

            // Commit transaction if both queries succeeded
            $mysqli->commit();
            header('Location: ../admin/index.php?deliver=success');
            // echo "Order successfully marked as delivered!<br>";
        } else {
            echo "Order not found.";
        }
    } catch (Exception $e) {
        // Rollback transaction on error
        $mysqli->rollback();
        echo "Error processing delivered order: " . $e->getMessage();
    }
}

processDeliveredOrder($order_id);

?>