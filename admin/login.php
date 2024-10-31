<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="initial-scale=1, width=device-width" />
  <title>BRR Trading</title>
  <link rel="stylesheet" href="../css/footer1.css" />
  <link rel="stylesheet" href="../css/global.css" />
  <link rel="stylesheet" href="../css/adminLogin.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open Sans:wght@400;600&display=swap" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Telex:wght@400&display=swap" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Tenor Sans:wght@400&display=swap" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
  <div id='topBlue'></div>
  <div class="login-screen">
    <div class="bg">
      <div class="blue-rect"></div>
      <div class="white-rect"></div>
    </div>
    <div class="content">
      <form action="login.php" method='post'>
        <div class="texts">
          <div class="welcome-back">Admin Panel</div>
        </div>
        <div class="email">
          <div class="password1">Email</div>
          <div class="password-child"></div>
          <img class="lock-icon" alt="" src="../public/mail@2x.png" />
          <div class="inputField"><input type="email" name="email" placeholder="username123@emailcom" required></div>
        </div>
        <div class="password">
          <div class="password-child"></div>
          <img class="lock-icon" alt="" src="../public/lock@2x.png" />

          <img class="closed-eye-icon" alt="" src="../public/closed-eye@2x.png" />

          <div class="inputField"><input type="password" name="password" placeholder="********" required></div>
          <div class="password1">Password</div>
          <div class="forgotten-password-reset-container">
            <span class="forgotten-password">Forgotten Password? <a href="" class="reset">Reset</a></span>
          </div>
        </div>
        <div class="sign-in">
          <input type="submit" value='Login' class="sign-in">
        </div>
      </form>
    </div>
    <div class="lsLogo">
      <div class="lsLogo1">
        <div class="slogan">
          <p id="lsP">Wear better, Look smarter &nbsp;</p>
        </div>
        <img class="lsLogo-icon" alt="" src="../public/logo@2x.png" />
      </div>
    </div>
  </div>
  <?php include '../footer1.php'; ?>
  <?php

  include '../database/connectDB.php';

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare the SQL query (corrected syntax)
    $stmt = $mysqli->prepare("SELECT * FROM admin WHERE email = ?");
    $stmt->bind_param("s", $email); // Use bind_param for clarity
    $stmt->execute();
    $result = $stmt->get_result(); // Use get_result for PDO-like behavior
    $row = $result->fetch_assoc();

    // Check if user exists and password is correct
    if ($row && password_verify($password, $row['password'])) {
      $_SESSION['admin_email']=$email;
      header("Location: ./index.php");
      exit(); // Prevent further code execution after redirect
    } else {
      echo "<script> alert('Invalid email or password')</script>";
    }
  }

  // Close the database connection explicitly
  $mysqli->close();
  ?>

</body>

</html>