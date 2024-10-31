<?php
include '../database/connectDB.php';

// Get the updated information from the POST request
$email = $_POST['email'];
$name = $_POST['name'];
$phone = $_POST['phone'];
$address = $_POST['address'];

// Prepare the SQL update statement (using placeholders for security)
$sql = "UPDATE user SET name=?, phone=?, address=? WHERE email=?";
// Create a prepared statement
$stmt = $conn->prepare($sql);
// Bind the values to the placeholders
$stmt->bind_param("ssss", $name, $phone, $address, $email);
// Execute the prepared statement
if ($stmt->execute()) {
    header("Location: ../myProfile.php?update_info=successful");
} else {
    echo "Error updating user information: " . $conn->error;
    echo "<button type=''><a href='../myProfile.php'>Go Back</a></button>";
}

// Close the statement and connection
$sql = "UPDATE orders SET user_phone=? WHERE user_email=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $phone, $email);
$stmt->execute();

$stmt->close();
$conn->close();
?>