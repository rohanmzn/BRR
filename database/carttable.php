<?php
require_once("connectDB.php");

// Initialize cart items array
$cartItems = array();
$totalPrice = 0;

// Check if the user is logged in
if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true) {
    // User is logged in, fetch cart items from the database
    $user_id = $_SESSION['user_id']; // Assuming you have stored the user_id in the session

    $stmt = $conn->prepare("SELECT * FROM cart WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch cart items from the database
    while ($row = $result->fetch_assoc()) {
        // Fetch product details from the products table based on $product_id
        $product_id = $row['product_id'];
        $product_ids[] = $product_id;
        $quantity = $row['quantity'];

        $stmt_product = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
        $stmt_product->bind_param("i", $product_id);
        $stmt_product->execute();
        $result_product = $stmt_product->get_result();

        if ($result_product->num_rows > 0) {
            $product = $result_product->fetch_assoc();
            $price = $product['price'];
            $totalPrice += $price * $quantity;
            $imagepath = $product['image_path'];
            $imagePathArray = explode(',', $imagepath);
            $firstImage = $imagePathArray[0];

            $product_name = $product['name'];
            $product_names[] = $product_name;

            // Append the fetched product details to $cartItems array
            $cartItems[] = array(
                'product_id' => $product_id,
                'image_path' => $firstImage,
                'name' => $product['name'],
                'price' => $price,
                'quantity' => $quantity,
                // Add more product details as needed
            );
        } else {
            // Handle error or ignore if product not found
        }
    }
} elseif (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    // User is not logged in, fetch cart items from the session
    foreach ($_SESSION['cart'] as $product_id => $quantity) {
        // Fetch product details from the products table based on $product_id
        $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if the product exists
        if ($result->num_rows > 0) {
            // Fetch product details
            $product = $result->fetch_assoc();
            $price = $product['price'];
            $totalPrice += $price * $quantity;
            $imagepath = $product['image_path'];
            $imagePathArray = explode(',', $imagepath);
            $firstImage = $imagePathArray[0];

            // Append the fetched product details to $cartItems array
            $cartItems[] = array(
                'product_id' => $product_id,
                'image_path' => $firstImage,
                'name' => $product['name'],
                'price' => $price,
                'quantity' => $quantity,
                // Add more product details as needed
            );

        } else {
            // Product not found in the database, handle error or ignore
        }
    }
}

?>

<div class="table-responsive">
    <table class="table" style="background-color:#1f2937; color:#fff;">
        <!-- Table headers -->
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Image</th>
                <th scope="col">Product</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <!-- Table body -->
        <tbody>
            <?php
            $index = 1; // Initialize index for numbering cart items
            
            foreach ($cartItems as $item) {
                // Display the cart item details in table rows
            
                ?>
                <tr>
                    <!-- Table data for each cart item -->
                    <th scope="row">
                        <?php echo $index; ?>
                    </th>
                    <td><img src="<?php echo $item['image_path']; ?>" alt="<?php echo $item['name']; ?>"
                            style="max-height: 50px;"></td>
                    <td>
                        <?php echo $item['name']; ?>
                    </td>
                    <td>Rs.
                        <?php echo $item['price']; ?>
                    </td>
                    <td>
                        <form class="quantity-form" action="updatequantity.php" method="post">
                            <input type="hidden" name="product_id" value="<?php echo $item['product_id']; ?>" readonly>
                            <button type="button" class="btn btn-secondary quantity-btn" data-action="decrease"
                                style="background-color:#1f2937;">
                                <i class="fas fa-minus"></i>
                            </button>
                            <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1"
                                class="small-input">
                            <button type="button" class="btn btn-secondary quantity-btn" data-action="increase"
                                style="background-color:#1f2937;">
                                <i class="fas fa-plus"></i>
                            </button>
                            <!-- Remove the Update button from here -->
                        </form>
                    </td>





                    <td>Rs.
                        <?php echo number_format($item['price'] * $item['quantity'], 2); ?>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger" data-toggle="modal"
                            data-target="#removeConfirmationModal<?php echo $item['product_id']; ?>">
                            Remove
                        </button>
                    </td>

                </tr>
                <div class="modal fade" id="removeConfirmationModal<?php echo $item['product_id']; ?>" tabindex="-1"
                    role="dialog" aria-labelledby="removeConfirmationModalLabel<?php echo $item['product_id']; ?>"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content" style="background-color:#1f2937;">
                            <div class="modal-header">
                                <h5 class="modal-title" id="removeConfirmationModalLabel<?php echo $item['product_id']; ?>">
                                    Confirm Removal</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to remove this product from your cart?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <form action="removeitem.php" method="post">
                                    <input type="hidden" name="product_id" value="<?php echo $item['product_id']; ?>">
                                    <button type="submit" class="btn btn-danger">Remove</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                $index++;
            }
            $_SESSION['totalCartItems'] = $index - 1;
            ?>
        </tbody>
    </table>
</div>

<div class="cart-total mt-4">
    <div class="row">
        <div class="col-sm-6 offset-sm-6">
            <table class="table table-striped" style="background-color:#1f2937; color:#fff;">
                <tbody>
                    <tr>
                        <td>Subtotal:</td>
                        <td>Rs.
                            <?php echo number_format($totalPrice, 2); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Shipment:</td>
                        <td>
                            <?php
                            // If total price is 0, set shipment to 0
                            $shipment = ($totalPrice == 0) ? 0 : 0.00;
                            echo "Rs. " . number_format($shipment, 2);
                            ?>
                        </td>
                    </tr>
                    <tr style="background-color:#16a34a; color:#fff;">
                        <td>Total:</td>
                        <td>Rs.
                            <?php
                            $totalWithShipment = $totalPrice + $shipment;
                            echo number_format($totalWithShipment, 2);
                            ?>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="text-right">
                <a href="index.php"><button class="btn btn-outline-secondary mr-2">Continue Shopping</button></a>
                <?php if ($totalPrice > 0): ?>
                    <button class="btn btn-success" data-toggle="modal" data-target="#payModal">Finalize and Pay</button>
                    <!-- Modal -->
                    <div class="modal fade" id="payModal" tabindex="-1" role="dialog" aria-labelledby="payModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content" style="background-color:#1f2937;">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="productModalLabel">Select Payment Method</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                        style="color:#fff">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <!-- Your form goes here -->
                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                                    <div class="modal-body">
                                        <!-- <input type="hidden" name="origin_page" value="carttable.php"> -->
                                    </div>
                                    <div class=" modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Pay With Khalti</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <button class="btn btn-success" disabled>Finalize and Pay</button>
            <?php endif; ?>
        </div>
    </div>
</div>
</div>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] == "http://localhost/YourITCenter/cart.php") {
        $product_id_imploded = implode(',', $product_ids);
        $product_name_imploded = implode(',', $product_names);
        $getCustomers = $conn->prepare("SELECT * FROM customers WHERE user_id = ?");
        $getCustomers->bind_param("i", $_SESSION['user_id']);
        $getCustomers->execute();
        $result = $getCustomers->get_result();
        $user = $result->fetch_assoc();
        // Define the payload array
        $payload = array(
            "return_url" => "http://localhost/YourITCenter/payments/success.php",
            "website_url" => "http://localhost/YourITCenter/",
            "amount" => 0,
            "purchase_order_id" => $product_id_imploded,
            "purchase_order_name" => $product_name_imploded,
            "customer_info" => array(
                "name" => $user['name'],
                "email" => $user['email'],
                "phone" => $user['phone']
            ),
            "product_details" => array()
        );
        // Calculate total amount
        $totalAmount = 0;

        // Iterate through cart items
        foreach ($cartItems as $item) {
            // Calculate total price for each product
            $totalPrice = $item['price'] * $item['quantity'];

            // Add product details to the payload
            $payload['product_details'][] = array(
                "identity" => $item['product_id'], // Assuming product_id uniquely identifies each product
                "name" => $item['name'],
                "total_price" => $totalPrice,
                "quantity" => $item['quantity'],
                "unit_price" => $item['price']
            );

            // Update total amount
            $totalAmount += $totalPrice;
        }
        // Update the total amount in the payload
        $payload['amount'] = $totalAmount * 100;

        // Encode the payload as JSON
        $json_payload = json_encode($payload);

        // Initialize cURL
        $curl = curl_init();
        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => 'https://a.khalti.com/api/v2/epayment/initiate/',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $json_payload,
                CURLOPT_HTTPHEADER => array(
                    'Authorization: key 2ab17b262d074d63bc973e9ab5e4d3ef',
                    'Content-Type: application/json',
                ),
            )
        );

        // Execute the cURL request
        $response = curl_exec($curl);

        // Close cURL resource
        curl_close($curl);

        // Output the response
// Decode the JSON response
        $response_data = json_decode($response, true);

        // Check if the response contains the payment URL
        if (isset($response_data['payment_url'])) {
            // Redirect the user to the payment URL
            // Convert the array of product IDs to a comma-separated string
            // Get user information from session
            $customer_id = $_SESSION['user_id'];
            $customer_email = $_SESSION['email'];

            // Split the product IDs if there are multiple
            $product_ids = explode(',', $product_id_imploded);

            // Convert product IDs to integers
            $product_ids = array_map('intval', $product_ids);
            ?>
            <script>alert("<?php var_dump($product_ids) ?>");</script>
            <?php
            // Iterate through each product ID
            foreach ($product_ids as $product_id) {
                // Retrieve product information from the database
                $stmt = $conn->prepare("SELECT name, price FROM products WHERE product_id = ?");
                $stmt->bind_param('i', $product_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $product = $result->fetch_assoc();

                // Check if the product exists
                if ($product) {
                    // Insert order into the Orders table
                    $stmt = $conn->prepare("INSERT INTO Orders (product_id, name, customer_id, customer_email, price, status) VALUES (?, ?, ?, ?, ?, 'Pending')");
                    $stmt->bind_param('isisd', $product_id, $product['name'], $customer_id, $customer_email, $product['price']);
                    $stmt->execute();
                } else {
                    // Handle case where product ID does not exist
                    echo "Product with ID $product_id does not exist.";
                }
            }

            // Redirect or perform other actions after successful insertion
            ?>
            <script>window.location.href = "<?php echo $response_data['payment_url'] ?>";</script>
            <?php

            exit(); // Make sure to exit to prevent further execution
        } else {
            var_dump($response);
            // Handle the case where payment URL is not received
            echo "Payment URL not found in the response.";
        }
    }

}
?>