<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <title>BRR Trading</title>
  <link rel="stylesheet" href="style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/global.css" />
  <link rel="stylesheet" href="../css/register.css" />
</head>

<body>
  <div class="container">
    <div class="title">
      Registration for BRR Trading <?php include '../components/backButton.php' ?>
    <div class="content">
      <form action="#" method="post">
        <div class="user-details">
          <div class="input-box">
            <span class="details">Full Name</span>
            <input type="text" name="name" placeholder="Enter your name" required>
          </div>
          <div class="input-box">
            <span class="details">Email</span>
            <input type="text" name="email" placeholder="Enter your email" required>
          </div>
          <div class="input-box">
            <span class="details">Phone Number</span>
            <input type="text" name="phone" placeholder="Enter your number" required>
          </div>
          <div class="input-box">
            <span class="details">Address</span>
            <input type="text" name="address" placeholder="Enter your address with district" required>
          </div>
          <div class="input-box">
            <span class="details">Password</span>
            <input type="password" name="password" placeholder="Enter minimum 6 characters" required>
          </div>
          <div class="input-box">
            <span class="details">Confirm Password</span>
            <input type="password" name="confirmPassword" placeholder="Confirm your password" required>
          </div>
        </div>

        <div class="button">
          <input type="submit" value="Register">
        </div>
      </form>
    </div>
  </div>
  <?php
  // Connect to your database
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "BRR";

  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Get form data
      $name = $_POST['name'];
      $email = $_POST['email'];
      $phone = $_POST['phone'];
      $address = $_POST['address'];
      $password = $_POST['password'];
      $confirmPassword = $_POST['confirmPassword'];

      // Validate form data
      if (strlen($phone) !== 10) {
        echo "<script>alert('Phone number must be 10 digits long');</script>";
      } elseif (strlen($password) <= 5) {
        echo "<script>alert('Password must be minimum 6 digits');</script>";
      } elseif ($password !== $confirmPassword) {
        echo "<script>alert('Passwords do not match');</script>";
      } else {
        // Check for existing email
        $stmt = $conn->prepare("SELECT * FROM user WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
          echo "<script>alert('Email or phone number already exists');</script>";
        } else {
          // Hash the password
          $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

          // Prepare the INSERT statement
          $stmt = $conn->prepare("INSERT INTO user (name, email, phone, address, password, account_created) VALUES (:name, :email, :phone, :address, :password, CURRENT_TIMESTAMP)");
          $stmt->bindParam(':name', $name);
          $stmt->bindParam(':email', $email);
          $stmt->bindParam(':phone', $phone);
          $stmt->bindParam(':address', $address);
          $stmt->bindParam(':password', $hashedPassword);

          // Execute the statement
          $stmt->execute();
            // Redirect to a default index page:
            echo "<script>alert('User registered successfully! Redirecting to homepage. ');</script>";
            header("Location: ./registerSuccess.php");
            exit;
        }
      }
    }

  } catch (PDOException $e) {
    echo "<script>alert('Connection failed: " . $e->getMessage() . ");</script>";
    ;
  }

  $conn = null; // Close the connection*/
  ?>


</body>

</html>