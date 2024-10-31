<?php
require_once('TCPDF-main/tcpdf.php');

// Connect to your database (replace these values with your actual database credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "brr";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Check if the order_id parameter is present in the URL
if (isset($_GET['order_id'])) {
    // Retrieve the order_id value from the URL
    $order_id = $_GET['order_id'];
} else {
    echo "Error printing the bill";
}

// Query to fetch order details
$sql = "SELECT * FROM delivered WHERE order_id = $order_id";
$result = $conn->query($sql);

// Fetch order information
if ($result->num_rows > 0) {
    $orderInfo = $result->fetch_assoc();

    // Fetching name from user table based on email
    $email = $orderInfo['user_email'];
    $sql = "SELECT name FROM user WHERE email = '$email'";
    $result = $conn->query($sql);

    // Fetch the name if the query is successful
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
    } else {
        $name = 'Unknown'; // Set a default name if user with given email is not found
    }

    // Fetch product details from the database based on the order ID
    $sql = "SELECT * FROM order_items WHERE order_id = $order_id";
    $result = $conn->query($sql);

    // Create new PDF document
    $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

    // Set document information
    $pdf->SetCreator('BRR Trading Pvt Ltd');
    $pdf->SetAuthor('BRR Trading Pvt Ltd');
    $pdf->SetTitle('Invoice');
    $pdf->SetSubject('Invoice');

    // Set margins
    $pdf->SetMargins(20, 20, 20, true);

    // Add a page
    $pdf->AddPage();

    // Set font
    $pdf->SetFont('helvetica', '', 12);

    // Add header
    $pdf->SetFont('helvetica', 'B', 20); // Set font to bold and larger size
    $pdf->Cell(0, 10, 'BRR Trading Pvt. Ltd.', 0, 1, 'C');
    $pdf->SetFont('helvetica', '', 12); // Reset font settings
    $pdf->Cell(0, 5, 'Mahabouddha, Kathmandu', 0, 1, 'C');
    $pdf->Cell(0, 5, 'Email at: brr.trading2023@gmail.com', 0, 1, 'C');
    $pdf->Cell(0, 5, 'Phone: 9861767923, 9810047599', 0, 1, 'C');
    $pdf->SetFont('helvetica', 'BU', 16); // Set font to bold and larger size
    $pdf->Cell(0, 10, 'Sales Invoice Receipt', 0, 1, 'C');
    $pdf->Ln(10);

    // Add customer information
    $pdf->SetFont('helvetica', '', 12);
    $pdf->Cell(0, 5, 'Name: ' . $name, 0, 1);
    $pdf->Cell(0, 5, 'Email: ' . $orderInfo['user_email'], 0, 1);
    $pdf->Cell(0, 5, 'Address: ' . $orderInfo['delivery_address'], 0, 1);
    $pdf->Cell(0, 5, 'Phone: ' . $orderInfo['user_phone'], 0, 1);
    $pdf->SetFont('helvetica', 'B'); // Set font to bold
    $pdf->Cell(0, 10, 'Order ID: ' . $orderInfo['order_id'], 0, 1, 'L'); // Assuming static order ID for now
    $pdf->SetFont('helvetica', ''); // Reset font settings
    $pdf->Ln(2);

    // Fetch product details if the query is successful
    if ($result && $result->num_rows > 0) {
        // Add table header
        $pdf->Cell(10, 10, 'S no', 1, 0, 'C');
        $pdf->Cell(80, 10, 'Product Items', 1, 0, 'C');
        $pdf->Cell(15, 10, 'P_ID', 1, 0, 'C');
        $pdf->Cell(15, 10, 'Size', 1, 0, 'C');
        $pdf->Cell(40, 10, 'Amount', 1, 1, 'C');

        $sn = 1;
        // Loop through each row to fetch product details
        while ($row = $result->fetch_assoc()) {
            $product_id = $row['product_id'];
            $user_size = isset($row['usersize']) ? $row['usersize'] : ''; // Check if 'user_size' key exists
            $product_query = "SELECT product_name, price FROM products WHERE product_id = $product_id";
            $product_result = $conn->query($product_query);

            if ($product_result && $product_result->num_rows > 0) {
                $product_data = $product_result->fetch_assoc();
                $product_name = $product_data['product_name'];
                $product_price = $product_data['price'];
            } else {
                $product_name = 'Unknown';
                $product_price = 'Unknown';
            }
            // Add product details to the PDF
            $pdf->Cell(10, 10, $sn++, 1, 0, 'C'); // SN
            $pdf->Cell(80, 10, " " . $product_name, 1, 0); // Product ID (Replace with actual product name)
            $pdf->Cell(15, 10, 'pid_' . $product_id, 1, 0, 'C'); // User Size
            $pdf->Cell(15, 10, $user_size, 1, 0, 'C'); // User Size
            $pdf->Cell(40, 10, "Rs." . $product_price, 1, 1, 'C'); // You can add amount here
        }
    } else {
        // Handle case where no product details are found
        $pdf->Cell(0, 10, 'No product details found', 0, 1);
    }


    // Add total amount
    $pdf->Cell(120, 10, 'Delivery Charge', 1, 0, 'C');
    $pdf->Cell(40, 10, "Rs. 60", 1, 1, 'C');
    $pdf->Cell(120, 10, 'Total Amount', 1, 0, 'C');
    $pdf->Cell(40, 10, "Rs." . $orderInfo['total_amount'], 1, 1, 'C'); // You can calculate and replace with actual total amount
    $pdf->Ln(10);
}
// Add signature and stamp
$pdf->SetFont('helvetica', 'I', 9); // Set font to italic
$pdf->Cell(0, 10, 'Company Stamp:', 0, 0, 'L'); // Add signature
// Add QR code image
$qr_image_path = './public/websiteQR.png'; // Path to the QR code image

// Check if the QR code image file exists
if (file_exists($qr_image_path)) {
    // Width of the QR code image
    $qr_width = 30;

    // Calculate X and Y positions for the QR code image
    $qr_x = 160; // Adjust as needed
    $qr_y = 15; // Align with the stamp

    // Add the QR code image to the PDF
    $pdf->Image($qr_image_path, $qr_x, $qr_y, $qr_width, 0, 'PNG');
    // Add caption below the QR code
    $caption_x = $qr_x; // X position of the caption (same as QR code)
    $caption_y = $qr_y + $qr_width + 0; // Y position below the QR code
    $caption = 'www.brrtrading.com'; // Caption text
    $pdf->SetXY($caption_x, $caption_y);
    $pdf->Cell(0, 0, $caption, 0, 1, 'C');
} else {
    // Handle case where the QR code image file does not exist
    echo "QR code image file not found.";
}

// Output PDF
$pdf->Output('invoice.pdf', 'I');

?>