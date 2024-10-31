<?php
include '../database/connectDB.php';
session_start();
$email = 'roharzan@gmail.com';
// Get the email from the query parameter
$current_password = $_POST['current_password'];
if (isset($_POST['new_password'])) {
    $new_password = $_POST['new_password'];
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Retrieve admin information
    $sql = "SELECT password FROM admin WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $verified = password_verify($current_password, $row['password']);

        if ($verified == 1) {
            $stmt = $conn->prepare("UPDATE admin SET password = ? WHERE email = ?");
            $stmt->bind_param("ss", $hashed_password, $email);
            // Execute the statement
            $stmt->execute();
            // Redirect to a default index page:
            header("Location: ../index.php?pw_change=successful");
            exit;
        } else {
            //show alert and redirect back
            header("Location: ./change_password.php?pw_change=failed");
        }
    } else {
        echo "Invalid admin";
    }
}
$conn->close();
?>