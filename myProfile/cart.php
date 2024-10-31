<?php
// include '../database/connectDB.php';
$mysqli = new mysqli("localhost", "root", "", "brr");
$conn = $mysqli;
// Check connection
if ($mysqli->connect_error) {
  die("Connection failed: " . $mysqli->connect_error);
}
$username = $_SESSION["Username"];
$sql = "SELECT * FROM mycart WHERE username = '$username'";
$result = $mysqli->query($sql);
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="initial-scale=1, width=device-width" />
  <link rel="stylesheet" href="./css/global.css" />
  <link rel="stylesheet" href="./css/myCart.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Abel:wght@400&display=swap" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Tenor Sans:wght@400&display=swap" />
</head>

<body>
  <div class="my-cart">
    <table>
      <div class="cart-heading">
        <tr id="c-head" style="height: 50px; ">
          <td>S.N.</td>
          <td style="width: 45%; text-align:left;">Product Name</td>
          <td>Size</td>
          <td>Price</td>
          <td style="width: 20%; ">Image</td>
          <td>Qty </td>
          <td>Total</td>
          <td>Delete</td>
        </tr>
      </div>
      <div class="cart-product">
        <!-- sabai aaru item koo lagi tr lai loop garni -->
        <?php
        // Check if products exist
        $sn = 1;
        $sum=0;
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            $p_id = $row['product_id'];

            $sql1 = "SELECT * FROM products WHERE product_id = '$p_id'";
            $result1 = $mysqli->query($sql1);
            ?>
            <tr id="p-head">
              <td>
                <?php echo $sn++; ?>
              </td>
              <?php
              if ($result1->num_rows > 0) {
                while ($row1 = $result1->fetch_assoc()) { ?>
                  <td style="width: 45%; text-align:left; padding-left:10px;">
                    <?php echo $row1['product_name']; ?>
                  </td>
                  <td>
                    <?php echo $row['usersize']; ?>
                  </td>
                  <td>
                    <?php 
                    $price=$row1['price']; 
                    echo $price; 
                    $sum=$sum+$price;
                    ?>
                  </td>
                  <td style="width: 20%; " align="center">
                    <div class="img"><img src="<?php echo './' . $row1['product_image']; ?>"
                        alt="<?php echo $row['product_name']; ?>"></div>
                  </td>
                  <td>
                    <div class="quantity">
                      <div class="quantity-btn minus-btn">-</div>
                      <input type="text" class="qty-input" value="1" readonly>
                      <div class="quantity-btn plus-btn">+</div>
                    </div>
                  </td>
                  <td>
                    <span id="total-price"><?php echo $price;?></span>
                  </td>

                  <td align="center"><a href="./myProfile/deleteCartItem.php?id=<?php echo $row['id']; ?>"
                      onclick="return confirm('Are you sure you want to delete this product?')">
                      <div class="delete-rect">
                        <img class="delete-icon" alt="" src="./public/delete-icon.svg" />
                      </div>
                    </a>
                  </td>
                <?php }
              } ?>
            </tr>
          <?php }
        } ?>
      </div>
  </div>
  </table>
  <?php if ($result->num_rows > 0): ?>
    
    <div style="display: flex; align-items: center; padding-right: 1  5px;">
    <p style="margin-right: auto;">Total Amount: Rs <?php echo $sum ?> </p>
    <a href="./checkout.php" style="display: inline-block; max-width: 260px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; padding-right: 2%;">
        <div class="button">
            <div class="checkout">CHECK OUT</div>
        </div>
    </a>
</div>



  <?php else: ?>
    <p class="no-cart-items">
      No items in your cart.
      <a href="./shop.php" style="color:#EC7224; text-decoration:underline">Shop Now</a>
    </p>
  <?php endif; ?>

</body>

</html>