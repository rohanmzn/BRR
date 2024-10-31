<!DOCTYPE html>
<html lang="en">
<?php
session_start();
// Fetch search term from GET request
$searchTerm = isset($_GET['search']) ? $_GET['search'] : null;
$_SESSION['search']=$searchTerm;
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
    <?php 
            include 'nav.php';
        
    ?>
    <div class="cate-head">
        <div class="cate-text">Search Results for:
            <?php 
                $searchTerm = trim($searchTerm); // Trim whitespace from the searchTerm for accurate comparison
                // Check if searchTerm indicates a request for all products
                if(strtolower($searchTerm) == "all" || $searchTerm == ""){
                    echo "All Products";
                }else{
                    echo $searchTerm;
                }
            ?>
        </div>
        <button class="button" id="filterButton">Filter</button>
        <div id="myModal" class="modal">
            <?php include 'searchModal.php'; ?>
        </div>
    </div>
    <div class="product-grid">
        <?php
        include './database/connectDB.php';
        //to display all products
        if($searchTerm=="All" || $searchTerm=="all" || $searchTerm=="ALL || $searchTerm=''"){
            // Prepare SQL query to fetch products based on search term
            $sql = "SELECT product_id,product_name, price, product_image FROM products";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()):
                    include 'searchItems.php';
                endwhile;
            } else {
                // No matching products found
                echo "<div class='noProduct'>No products found matching the search term.</div>";
            }
            // Close statement and connection
            $stmt->close();
        } // Check if search term is provided
        else if($searchTerm !== null){
            $sql = "SELECT product_id,product_name, price, product_image FROM products WHERE product_name LIKE ? $totalFilter";
            $stmt = $conn->prepare($sql);

            // Bind search term with wildcard to search for partial matches
            $searchTermWithWildcards = "%" . $searchTerm . "%";
            $stmt->bind_param("s", $searchTermWithWildcards);
            $stmt->execute();
            $result = $stmt->get_result();
            // Display products matching the search term
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()):
                    include 'searchItems.php';
                endwhile;
            } else {
                // No matching products found
                echo "<div class='noProduct'>No products found matching the search term.</div>";
            }
            // Close statement and connection
            $stmt->close();
        }else {
            // Search term is not provided
            echo "<div class='product'>Please enter a search term.</div>";
        }
        $conn->close();
        ?>
    </div>
    <?php include 'footer.php'; ?>
</body>

</html>