<?php
include '../database/connectDB.php';
session_start();
$email = $_SESSION['Username'];
// Get the email from the query parameter
$current_password = $_POST['current_password'];
if (isset($_POST['new_password'])) {
    $new_password = $_POST['new_password'];
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Retrieve user information
    $sql = "SELECT password FROM user WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $verified = password_verify($current_password, $row['password']);

        if ($verified == 1) {
            $stmt = $conn->prepare("UPDATE user SET password = ? WHERE email = ?");
            $stmt->bind_param("ss", $hashed_password, $email);
            // Execute the statement
            $stmt->execute();
            // Redirect to a default index page:
            header("Location: ../myProfile.php?pw_change=successful");
            exit;
        } else {
            //show alert and redirect back
            header("Location: ./change_password.php?pw_change=failed");
        }
    } else {
        echo "Invalid User";
    }
}
$conn->close();
?>