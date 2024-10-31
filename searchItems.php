<div class="product">
<?php echo "<a href='./product/productDetail.php?id=" . $row['product_id'] . "'>"; ?>
        <div class="display">
            <div class="disp"><img src="./<?php echo $row['product_image'] ?>" alt="Product Image"></div>
        </div>
        <div class="product-text">
            <div class="product-name">
                <?php echo $row['product_name'] ?>
            </div>
            <div class="price">Rs:
                <?php echo $row['price'] ?>
            </div>
        </div>
    </a>
</div>