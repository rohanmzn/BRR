<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="initial-scale=1, width=device-width" />
  <title>BRR Trading | Shop</title>
  <link rel="stylesheet" href="./css/global.css" />
  <link rel="stylesheet" href="./css/shop.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Abel:wght@400&display=swap" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Tenor Sans:wght@400&display=swap" />
</head>

<body>

  <?php include 'nav.php'; ?>
  <?php include './database/connectDB.php'; ?>
  <div class="shop">
    <div class="home">
      <div class="jacket-banner">
        <img class="jackets-icon" alt="" src="./public/jackets@2x.png" />

        <!-- <div class="jackets1">Jackets</div> -->
      </div>
      <div class="shirt-banner">
        <img class="shirts-icon" alt="" src="./public/shirts@2x.png" />

        <!-- <div class="shirts">Shirts</div> -->
      </div>
      <div class="main-banner">
        <img class="sweatshirts-icon" alt="" src="./public/sweatshirts@2x.png" />

        <div class="logo">
          <img class="logo-icon1" alt="" src="./public/logo@2x.png" />

          <div class="slogan">
            <p class="wear-better-look">Wear better, Look smarter</p>
          </div>
        </div>
      </div>
    </div>
    <?php
    $categories = [
      'Others',
      'Jockers',
      'Hoodies',
      'Jackets',
      'Sweatshirts',
      'T-shirts',
      'Pants',
    ];
    ?>

    <div class="categories">
      <div class="cate-buttons">
        <?php foreach ($categories as $index => $categoryName): ?>
          <div class="category<?= $index ?>">
            <div class="category-child">
              <!-- Wrapping the category name with an <a> tag -->
              <a href="searchCategory.php?item=<?= urlencode($categoryName) ?>" class="others">
                <?= htmlspecialchars($categoryName) ?>
              </a>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
      <div class="label2">Categories</div>
    </div>

    <!-- New Arrivals -->
    <div class="products1">
      <div class="product-grid">
        <?php
        $query = "SELECT * FROM products WHERE product_id = (SELECT MAX(product_id) FROM products) - 3";
        $result = $mysqli->query($query);
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) { ?>
            <a href="./product/productDetail.php?id=<?php echo $row['product_id']; ?>">
              <div class="product">
                <div class="main"></div>
                <div class="text">
                  <!-- <img class="wishlist-icon" alt="" src="./public/wishlist-icon.svg" /> -->

                  <div class="price">Rs:
                    <?php echo $row['price']; ?>
                  </div>
                  <div class="product-name">
                    <?php echo $row['product_name']; ?>
                  </div>
                </div>
                <div class="display">
                  <div class="disp"><img src="<?php echo $row['product_image']; ?>"
                      alt="<?php echo $row['product_name']; ?>">
                  </div>
                </div>

              </div>
            </a>
          <?php }
        } else {
          // No products found
          echo "<div class='product'>No products available.</div>";
        }
        ?>
        <?php
        $query = "SELECT * FROM products WHERE product_id = (SELECT MAX(product_id) FROM products) - 2";
        $result = $mysqli->query($query);
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) { ?>
            <a href="./product/productDetail.php?id=<?php echo $row['product_id']; ?>">
              <div class="product1">
                <div class="main"></div>


                <div class="text">
                  <!-- <img class="wishlist-icon" alt="" src="./public/wishlist-icon.svg" /> -->

                  <div class="price">Rs:
                    <?php echo $row['price']; ?>
                  </div>
                  <div class="product-name">
                    <?php echo $row['product_name']; ?>
                  </div>
                </div>
                <div class="display">
                  <div class="disp"><img src="<?php echo $row['product_image']; ?>"
                      alt="<?php echo $row['product_name']; ?>">
                  </div>
                </div>
              </div>
            <?php }
        } else {
          // No products found
          echo "<div class='product'>No products available.</div>";
        }
        ?>
          <?php
          $query = "SELECT * FROM products WHERE product_id = (SELECT MAX(product_id) FROM products) - 1";
          $result = $mysqli->query($query);
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) { ?>
              <a href="./product/productDetail.php?id=<?php echo $row['product_id']; ?>">
                <div class="product2">
                  <div class="main"></div>

                  <div class="text">
                    <!-- <img class="wishlist-icon" alt="" src="./public/wishlist-icon.svg" /> -->

                    <div class="price">Rs:
                      <?php echo $row['price']; ?>
                    </div>
                    <div class="product-name">
                      <?php echo $row['product_name']; ?>
                    </div>
                  </div>
                  <div class="display">
                    <div class="disp"><img src="<?php echo $row['product_image']; ?>"
                        alt="<?php echo $row['product_name']; ?>">
                    </div>
                  </div>
                </div>
              <?php }
          } else {
            // No products found
            echo "<div class='product'>No products available.</div>";
          }
          ?>
            <?php
            $query = "SELECT * FROM products WHERE product_id = (SELECT MAX(product_id) FROM products) - 0";
            $result = $mysqli->query($query);
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) { ?>
                <a href="./product/productDetail.php?id=<?php echo $row['product_id']; ?>">
                  <div class="product3">
                    <div class="main"></div>

                    <div class="text">
                      <!-- <img class="wishlist-icon" alt="" src="./public/wishlist-icon.svg" /> -->

                      <div class="price">Rs:
                        <?php echo $row['price']; ?>
                      </div>
                      <div class="product-name">
                        <?php echo $row['product_name']; ?>
                      </div>
                    </div>
                    <div class="display">
                      <div class="disp"><img src="<?php echo $row['product_image']; ?>"
                          alt="<?php echo $row['product_name']; ?>">
                      </div>
                    </div>
                  </div>
          </div>
          <div class="label">New Arrivals</div>
        </div>
      <?php }
            } else {
              // No products found
              echo "<div class='product'>No products available.</div>";
            }
            ?>
    <!-- Top Selling Products -->
    <?php
    $sql = "SELECT product_id, COUNT(product_id) AS count 
  FROM order_items 
  GROUP BY product_id 
  ORDER BY count DESC 
  LIMIT 3, 1";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      // output data of each row
      while ($row1 = $result->fetch_assoc()) {
        $product_id = $row1['product_id'];
        $query = "SELECT * FROM products WHERE product_id = $product_id";
        $result = $mysqli->query($query);
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) { ?>
            <a href="./product/productDetail.php?id=<?php echo $row['product_id']; ?>">
              <div class="products">
                <div class="product-grid">
                  <div class="product">
                    <div class="main"></div>
                    <div class="text">
                      <!-- <img class="wishlist-icon" alt="" src="./public/wishlist-icon.svg" /> -->

                      <div class="price">Rs:
                        <?php echo $row['price']; ?>
                      </div>
                      <div class="product-name">
                        <?php echo $row['product_name']; ?>
                      </div>
                    </div>
                    <div class="display">
                      <div class="disp"><img src="<?php echo $row['product_image']; ?>"
                          alt="<?php echo $row['product_name']; ?>">
                      </div>
                    </div>
                  </div>
                <?php }
        } else {
          // No products found
          echo "<div class='product'>No products available.</div>";
        }
      }
    }
    ?>
          <?php
          $sql = "SELECT product_id, COUNT(product_id) AS count 
      FROM order_items 
      GROUP BY product_id 
      ORDER BY count DESC 
      LIMIT 2, 1";

          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            // output data of each row
            while ($row1 = $result->fetch_assoc()) {
              $product_id = $row1['product_id'];
              $query = "SELECT * FROM products WHERE product_id = $product_id";
              $result = $mysqli->query($query);
              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) { ?>
                  <a href="./product/productDetail.php?id=<?php echo $row['product_id']; ?>">
                    <div class="product1">
                      <div class="main"></div>
                      <div class="text">
                        <!-- <img class="wishlist-icon" alt="" src="./public/wishlist-icon.svg" /> -->

                        <div class="price">Rs:
                          <?php echo $row['price']; ?>
                        </div>
                        <div class="product-name">
                          <?php echo $row['product_name']; ?>
                        </div>
                      </div>
                      <div class="display">
                        <div class="disp"><img src="<?php echo $row['product_image']; ?>"
                            alt="<?php echo $row['product_name']; ?>">
                        </div>
                      </div>
                    </div>
                  <?php }
              } else {
                // No products found
                echo "<div class='product'>No products available.</div>";
              }
            }
          }
          ?>
            <?php
            $sql = "SELECT product_id, COUNT(product_id) AS count 
          FROM order_items 
          GROUP BY product_id 
          ORDER BY count DESC 
          LIMIT 1, 1";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
              // output data of each row
              while ($row1 = $result->fetch_assoc()) {
                $product_id = $row1['product_id'];
                $query = "SELECT * FROM products WHERE product_id = $product_id";
                $result = $mysqli->query($query);
                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) { ?>
                    <a href="./product/productDetail.php?id=<?php echo $row['product_id']; ?>">
                      <div class="product2">
                        <div class="main"></div>
                        <div class="text">
                          <!-- <img class="wishlist-icon" alt="" src="./public/wishlist-icon.svg" /> -->

                          <div class="price">Rs:
                            <?php echo $row['price']; ?>
                          </div>
                          <div class="product-name">
                            <?php echo $row['product_name']; ?>
                          </div>
                        </div>
                        <div class="display">
                          <div class="disp"><img src="<?php echo $row['product_image']; ?>"
                              alt="<?php echo $row['product_name']; ?>">
                          </div>
                        </div>
                      </div>
                    <?php }
                } else {
                  // No products found
                  echo "<div class='product'>No products available.</div>";
                }
              }
            }
            ?>
              <?php
              $sql = "SELECT product_id, COUNT(product_id) AS count 
      FROM order_items 
      GROUP BY product_id 
      ORDER BY count DESC 
      LIMIT 1";

              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                // output data of each row
                while ($row1 = $result->fetch_assoc()) {
                  $product_id = $row1['product_id'];
                  $query = "SELECT * FROM products WHERE product_id = $product_id";
                  $result = $mysqli->query($query);
                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) { ?>
                      <a href="./product/productDetail.php?id=<?php echo $row['product_id']; ?>">
                        <div class="product3">
                          <div class="main"></div>
                          <div class="text">
                            <div class="price">Rs:
                              <?php echo $row['price']; ?>
                            </div>
                            <div class="product-name">
                              <?php echo $row['product_name']; ?>
                            </div>
                          </div>
                          <div class="display">
                            <div class="disp"><img src="<?php echo $row['product_image']; ?>"
                                alt="<?php echo $row['product_name']; ?>">
                            </div>
                          </div>
                        </div>
                      </a>
                    <?php }
                  } else {
                    // No products found
                    echo "<div class='product'>No products available.</div>";
                  }
                }
              } ?>
        </div>
        <div class="label">TOP SELLING PRODUCTS</div>
      </div>
  </div>
  <?php include 'footer.php'; ?>
</body>

</html>
<script>
  if (window.location.search.includes("msg=sucessfull")) {
    alert("Product added to cart sucessfully");
    // to stop repeatedly alert on refresh
    window.history.pushState({}, "", window.location.pathname);
  }
</script>