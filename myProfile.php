<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="initial-scale=1, width=device-width" />
  <title>BRR Trading | My Profile</title>
  <link rel="stylesheet" href="./css/global.css" />
  <link rel="stylesheet" href="./css/myProfile.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Tenor Sans:wght@400&display=swap" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Abel:wght@400&display=swap" />
</head>

<body>
  <?php include './nav.php'; ?>
  <div class="myProfileContainer">
    <br><br>
    <!-- Sidebar -->
    <div class="sidebar">
      <h3 class="heading">My Profile</h3>
      <hr id="mpHr"><br>
      <a href="?file=information" class="sidebar-item">Information</a>
      <!-- <a href="?file=wishlist" class="sidebar-item">Wishlist</a> -->
      <a href="?file=cart" class="sidebar-item">Cart</a>
      <a href="?file=orders" class="sidebar-item">Orders</a>
      <a href="?file=orderShipped" class="sidebar-item">Received</a>
      <a href="?file=logout1" class="sidebar-item" onclick="return confirm('Are you sure you want to logout?')">Log
        Out</a>
    </div>
    <!-- mainBar -->
    <div class="myProfileMain" id="myDiv">
      <!-- <?php include 'myWishlist.php'; ?> -->
      <?php
      if (isset($_GET['file'])) {
        $includedFile = './myProfile/' . $_GET['file'] . '.php';

        if (file_exists($includedFile)) {
          include $includedFile;
        } else {
          echo "File does not exist."; // Debug message for non-existent file
        }
      } else {
        include './myProfile/information.php';
      }
      ?>
    </div>
  </div>
</body>

</html>
<script>
  if (window.location.search.includes("pw_change=successful")) {
    alert("Password changed sucessfully");
    // to stop repeatedly alert on refresh
    window.history.pushState({}, "", window.location.pathname);
  }
  if (window.location.search.includes("file")) {
    // window.history.pushState({}, "", window.location.pathname);
  }
</script>