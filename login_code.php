<?php

include './database/connectDB.php';
@session_start();
// Handle POST request for login
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Get form data
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = $_POST['password'];

  // Prepared statement with parameterization
  $stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
  $stmt->bind_param('s', $email);

  // Execute and fetch result
  if ($stmt->execute()) {
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row && password_verify($password, $row['password'])) {
      // Successful login
      $_SESSION['Username'] = $email;
      header("Location: ./index.php");
      exit; // Prevent further code execution
    } else {
      echo "<script>alert('Invalid email or password')</script>";
      header("Location: index.php?error=invalid_credentials");
    }
  } else {
    echo "<script>alert('Error processing login')</script>";
  }

  $stmt->close();
}

$conn->close();
?>
