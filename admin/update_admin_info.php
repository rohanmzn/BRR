<?php
include '../database/connectDB.php'; // Adjust the path as necessary

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $email = $_POST['new_email']; // Assuming this is the new email
    $currentEmail = $_POST['original_email']; // Assuming you pass the current email to identify the record
    $newPassword = $_POST['new_password'];

    // Validate inputs (You should add more validation based on your requirements)
    if (empty($email) || empty($newPassword)) {
        echo "Email and password cannot be empty.";
        exit;
    }

    // Hash the new password
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    // Prepare SQL query to update admin info
    $sql = "UPDATE admin SET email = ?, password = ? WHERE email = ?";

    // Prepare and bind
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sss", $email, $hashedPassword, $currentEmail);

        // Attempt to execute
        if ($stmt->execute()) {
            echo "Admin info updated successfully.";
            // Redirect or perform additional actions here as needed
        } else {
            echo "Error updating record: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }

    $conn->close();
} else {
    // Not a POST request
    echo "Invalid request.";
}
?>
