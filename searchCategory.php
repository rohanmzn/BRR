<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if (isset($_GET['item'])) {
    $item = $_GET['item'];
    $_SESSION['item']=$item;
}
$totalFilter=null;
include 'searchFilter.php';
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BRR Trading</title>
    <link rel="stylesheet" href="./css/global.css" />
    <link rel="stylesheet" href="./css/searchProduct.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Tenor Sans:wght@400&display=swap" />
</head>

<body>
    <?php include 'nav.php'; ?>
    <div class="cate-head">
        <div class="cate-text">Shop&nbsp;>&nbsp;
            <?php $item=$_SESSION['item']; 
            echo $item;?>
        </div>
        <button class="button" id="filterButton">Filter</button>
        <!-- Modal -->
        <div id="myModal" class="modal">
            <?php include 'searchModal.php'; ?>
        </div>

    </div>
    <div class="product-grid">
        <!-- include './database/connectDB.php'; // Include your database connection -->
        <?php
        include './database/connectDB.php';
        // Check if category is provided in the URL
        if ($item!=null) {
            // Prepare the SQL query to fetch products based on category
            $sql = "SELECT * FROM products WHERE category = ? $totalFilter";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $item);
            $stmt->execute();
            $result = $stmt->get_result();
            // Fetch products and integrate them with the HTML structure
            while ($row = $result->fetch_assoc()){
                include 'searchItems.php';
            }
            // Close statement
            $stmt->close();
        }
        else{
           echo "<div class='product'>This category is empty</div>";
        }
        // Close connection
        $conn->close();
        ?>

    </div>
    <br><br>
    <?php include 'footer.php'; ?>
</body>
</html>