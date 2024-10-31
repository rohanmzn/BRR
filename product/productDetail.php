<?php

if (isset($_SESSION['Username']) && $_SESSION['Username'] === null) {
  $_SESSION['Username'] = null;//it sets 0
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="initial-scale=1, width=device-width" />
  <title>BRR Trading</title>
  <link rel="stylesheet" href="../css/global.css" />
  <link rel="stylesheet" href="../css/nav.css" />
  <link rel="stylesheet" href="../css/productDetail.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Abel:wght@400&display=swap" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Tenor Sans:wght@400&display=swap" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" />
</head>

<body>
  <script>
    var sessionUsername = "<?php echo $_SESSION['Username']; ?>";
    // Rest of your JavaScript code follows
  </script>
  <?php
  if (isset($_GET['id'])) {
    $p_id = $_GET['id'];
  }
  include '../database/connectDB.php'; // Include your database connection file
  // Retrieve product data from the database
  $sql = "SELECT * FROM Products WHERE product_id= $p_id";
  $result = $mysqli->query($sql);

  // Check if products exist
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      ?>
      <div class="product-detail">
      
              <img id="imgBtn" src="../public/left-arrow.png" alt="">
              <script>
                const imgBtn = document.getElementById('imgBtn');
                imgBtn.addEventListener('click', function () {
                  history.back();
                });
              </script>
        <div class="display">
          <div class="disp"><img src="<?php echo '../' . $row['product_image']; ?>"
              alt="<?php echo $row['product_name']; ?>">
          </div>
        </div>
        <div class="left-group">

          <div class="product-description">
            <div class="price">Rs:<?php echo $row['price']; ?>
            </div>
            <div class="product-name">
              <?php echo $row['product_name']; ?>
            </div>
            <div class="product-text">
              Details:
              <?php echo $row['description']; ?>
            </div>
          </div>
        <?php }
  } ?>
      <form action="addToCart.php" method="post" id="addToCartForm">
        <?php
        $sizeStock = []; // Array to store size and quantity
        
        $sql1 = "SELECT size, quantity FROM productsizes WHERE fk_product_id = $p_id";
        $result1 = $mysqli->query($sql1);

        if ($result1->num_rows > 0) {
          while ($row1 = $result1->fetch_assoc()) {
            // Ensure values are integers (not strings)
            $sizeStock[$row1['size']] = (int) $row1['quantity'];
          }
        }
        ?>
        <div class="sizes">
          Select size:
          <?php
          foreach ($sizeStock as $size => $quantity): ?>
            <label for="size-<?= $size ?>" class="<?= $quantity === 0 ? 'disabled' : '' ?>">
              <input type="radio" id="size-<?= $size ?>" name="usersize" value="<?= $size ?>" <?= $quantity === 0 ? 'disabled' : '' ?>>
              <span class="size-option">
                <?= $size ?>
              </span>
            </label>
          <?php endforeach; ?>
        </div>
        <div class="buy-now1">
        <a href="../checkoutOneProduct.php?id=<?php echo $p_id; ?>&size=" id="buyNowLink">
            <div class="add-to-cart">Buy Now</div>
          </a>
        </div>

        <div class="buy-now">
          <input type="hidden" name="product_id" value="<?php echo $p_id; ?>">
          <input type="hidden" name="username" value="<?php echo $_SESSION['Username']; ?>">
          <input type="submit" value="Add To Cart" class="add-to-cart">Add To Cart</input>
        </div>
      </form>
    </div>
  </div>
</body>

</html>
<script>
  // Further disable based on user interaction (optional)
  const sizeLabels = document.querySelectorAll('.sizes label');

  sizeLabels.forEach(label => {
    label.addEventListener('click', () => {
      const selectedSize = label.querySelector('input').value;
      const otherLabels = Array.from(sizeLabels).filter(l => l !== label); // Get all other labels

      // Example disabling logic for other sizes based on selection (modify as needed)
      otherLabels.forEach(l => {
        const otherSizeStock = <?= json_encode($sizeStock); ?>[l.querySelector('input').value];
        if (otherSizeStock === 0 || (selectedSize !== 'XL' && otherSizeStock < selectedSizeStock)) {
          l.classList.add('disabled');
          l.querySelector('input').disabled = true;
        } else {
          l.classList.remove('disabled');
          l.querySelector('input').disabled = false;
        }
      });
    });
  });

  const buyNowDiv = document.querySelector('.buy-now1 div.add-to-cart'); // Access the Buy Now div
  const sizeInputs = document.querySelectorAll('input[name="usersize"]'); // Get all size input elements
  const buyNowLink = document.getElementById('buyNowLink'); // Get the Buy Now link

  // Validate selection on "Buy Now" div click
  buyNowDiv.addEventListener('click', (e) => {
    const selectedSize = Array.from(sizeInputs).find(input => input.checked);

    if (!selectedSize) {
      e.preventDefault(); // Prevent default action (redirecting to checkout)
      alert('Please select a size before continuing.');
    } else {
      // Append selected size to the Buy Now link href
      const selectedSizeValue = selectedSize.value;
      buyNowLink.href = buyNowLink.href + selectedSizeValue;
    }
  });

  document.getElementById('addToCartForm').addEventListener('submit', function (e) {
    const selectedSize = Array.from(document.querySelectorAll('input[name="usersize"]')).find(input => input.checked);

    if (!selectedSize) {
      e.preventDefault(); // Prevent the form from submitting
      alert('Please select a size before adding to cart.');
    }
  });

</script>