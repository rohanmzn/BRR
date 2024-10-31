<?php
include '../database/connectDB.php'; // Include your database connection file
session_start();

// Initialize sorting parameters
$orderBy = isset($_GET['orderby']) ? $_GET['orderby'] : 'product_id'; // Default sorting by product ID
$sortOrder = isset($_GET['order']) ? $_GET['order'] : 'ASC'; // Default sorting order ascending

// Retrieve product data from the database
$sql = "SELECT * FROM Products ORDER BY $orderBy $sortOrder";
$result = $mysqli->query($sql);

// Check if products exist
if ($result->num_rows > 0) {
    ?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>BRR Trading</title>
        <link rel="stylesheet" href="../css/adminTable.css">
        <style>
            #heading {
                display: flex;
            }

            .column {
                flex: 0 0 71.5%;
                /* 70% of the available space */
            }

            .search-column {
                flex: 1;
                padding-top: 20px;
                /* Take up the remaining space */
            }

            .search-column>button {
                display: inline-block;
                padding: 5px 10px;
                border-radius: 5px;
                background-color: #f27f04;
                /* Orange color */
                color: white;
                font-weight: bold;
                text-decoration: none;
                transition: all 0.2s ease-in-out;
            }

            .search-column>button :hover {
                background-color: #d46621;
                /* Darker orange for hover effect */
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            }
            .search-column button:nth-child(2) {
    margin-left: 5px; /* Adjust the value as needed */
}
        </style>
    </head>

    <body>
        <div id="heading">
            <div class="column">
                <h1>All Products</h1>
            </div>
            <div class="column search-column">
                <button onclick="window.location.href='?file=../product/displayProducts&orderby=product_id&order=<?php echo $sortOrder == 'ASC' ? 'DESC' : 'ASC'; ?>'"> Sort by Product ID</button><button onclick="window.location.href='?file=../product/displayProducts&orderby=category&order=<?php echo $sortOrder == 'ASC' ? 'DESC' : 'ASC'; ?>'"> Sort by Category</button>
            </div>
        </div>
        <table>
            <thead>
                <tr>
                    <th><a href="?orderby=product_id&order=<?php echo $orderBy == 'product_id' && $sortOrder == 'ASC' ? 'DESC' : 'ASC'; ?>">P_ID</a></th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th><a href="?orderby=category&order=<?php echo $orderBy == 'category' && $sortOrder == 'ASC' ? 'DESC' : 'ASC'; ?>">Category</a></th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td>
                            <?php echo $row['product_id']; ?>
                        </td>
                        <td>
                            <?php echo $row['product_name']; ?>
                        </td>
                        <td>
                            <?php echo $row['price']; ?>
                        </td>
                        <td>
                            <?php echo $row['category']; ?>
                        </td>
                        <td><img src="<?php echo '../' . $row['product_image']; ?>" alt="Product Image" width="100"></td>
                        <td width="30%">
                            <?php echo $row['description']; ?>
                        </td>
                        <td width="25%">
                            <a href="../product/productStock.php?id=<?php echo $row['product_id']; ?>">View Stock</a>
                            <a href="../product/editProduct.php?id=<?php echo $row['product_id']; ?>">Edit</a>
                            <a href="../product/deleteProduct.php?id=<?php echo $row['product_id']; ?>"
                                onclick="return confirm('Are you sure you want to delete this product?')">Delete
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </body>

    </html>

    <?php
} else {
    echo "No products found.";
}
$mysqli->close(); // Close database connection
?>
<script>
    if (window.location.search.includes("msg=sucessful")) {
        alert("Stock has been updated successfully");
        // to stop repeatedly alert on refresh
        window.history.pushState({}, "", window.location.pathname);
    }
</script>
