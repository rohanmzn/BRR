<?php
include './database/connectDB.php';
session_start();
$username = $_SESSION['Username'];
$sql = "SELECT * FROM mycart WHERE username = '$username'";
$result = $mysqli->query($sql); 
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="initial-scale=1, width=device-width" />
  <title>BRR Trading</title>
  <link rel="stylesheet" href="./css/global.css" />
  <link rel="stylesheet" href="./css/checkout.css" />
  <script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Abel:wght@400&display=swap" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Tenor Sans:wght@400&display=swap" />
</head>

<body>
<!-- hello -->
  <div class="check-out">
    <?php include 'nav.php'; ?>
    <table border=0>
      <div class="top-heading">
        <tr id="c-head">
          <td>S.N.</td>
          <td style="width: 80%; text-align:left;">Product Name</td>
          <td style="width: 15%;">Price</td>
        </tr>
      </div>
      <div class="checkout-product">
        <?php
        // Check if products exist
        $sn = 1;
        $sum = 0;
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            $p_id = $row['product_id'];
            $sql1 = "SELECT product_id,product_name,price FROM products WHERE product_id = '$p_id'";
            $result1 = $mysqli->query($sql1);
            ?>
            <tr id="p-body" style="height: 50px; ">
              <?php if ($result1->num_rows > 0) {
                while ($row1 = $result1->fetch_assoc()) {
                  $uniqueProductId[] = 'pid_' . $row1['product_id'];
                  $product_names_array[] = $row1['product_name'];
                  ?>
                  <td>
                    <?php echo $sn++; ?>
                  </td>
                  <td style="width: 80%; text-align:left; padding-left:20px;">
                    <?php echo $row1['product_name']; ?>
                  </td>
                  <td style="width: 15%;">
                    <?php echo $row1['price'];
                    $sum = $sum + $row1['price']; ?>
                  </td>
                <?php }
              } ?>
            </tr>
          <?php }
        }
        $product_id_string = implode(", ", $uniqueProductId);
        $product_names_string = implode(", ", $product_names_array); ?>
      </div>
      <tr id="p-body" style="height: 50px;">
        <td></td>
        <td style="width: 80%; text-align:left; padding-left:20px;">Delivery Charge</td>
        <td style="width: 15%;">60</td>
      </tr>
      <div class="totalFoot">
        <tr id="t-foot" style="height: 50px; ">
          <td></td>
          <td style="width: 80%;">Total Price</td>
          <td style="width: 15%;">
            <?php echo $totalsum = $sum + 60;
            $_SESSION['totalsum'] = $totalsum; ?>
          </td>
        </tr>
      </div>
    </table>
    <?php
    //fetch user address here
    $query = "SELECT address FROM user WHERE email = ?";
    $statement = $mysqli->prepare($query);
    $statement->bind_param("s", $username);
    $statement->execute();
    $statement->bind_result($userAddress);
    $statement->fetch();
    $statement->close();
    ?>
    <div class="payment">
      <table>
        <tr>
          <td>Delivery Address: <br><input id="deliveryAddressInput" type="text" id="deliveryAddressInput" value="<?php echo $userAddress ?>"
              placeholder="Enter if not same as home address" style="width: 43.5%;" required></td>
        </tr>
        <tr>
          <td>Add a note: <br><textarea id="myTextarea" rows="4" cols="50"
              placeholder="Add short note to seller regarding delivery date and time and more...."></textarea></td>
        </tr>
        <tr>
          <td>Select Payment Method:</td>
        </tr>
      </table>
    </div>
    <form action="./myProfile/orderPlaced.php" method="POST" id="orderForm">
      <input type="hidden" name="pm" id="paymentMethod" value="1"> <!-- Default to COD -->
      <table id="btn-table">
        <tr>
          <td class="button-container">
            <!-- Remove the <a> tag from around the COD button, use a button of type submit instead -->
            <button type="submit" class="orange-button">COD</button>
            <button type="button" name="payWithKhalti" id="payment-button" class="orange-button">Pay with
              Khalti</button>
            <button type="button" id="goBackButton" class="blue-button">Go Back</button>
          </td>
        </tr>
      </table>
      <input type="hidden" name="deliveryAddress" id="deliveryAddressHidden"
        value="<?php echo htmlspecialchars($userAddress); ?>">
      <input type="hidden" name="orderNote" id="orderNote">
    </form>
    <input type="hidden" name="deliveryAddress" id="deliveryAddressHidden"
      value="<?php echo htmlspecialchars($userAddress); ?>">
    <input type="hidden" name="orderNote" id="orderNote">
  </div>
  <script>
    const goBackButton = document.getElementById('goBackButton');
    goBackButton.addEventListener('click', function () {
      history.back();
    });
    // admin.khalti.com ko test public key use garya
    var config = {
      // replace the publicKey with yours
      "publicKey": "test_public_key_a186ef883b43493480df9becfb559bfb",
      "productIdentity": "1234567890",
      "productName": "Dragon",
      "productUrl": "http://gameofthrones.wikia.com/wiki/Dragons",
      "paymentPreference": [
        "KHALTI",
        // "EBANKING",
        // "MOBILE_BANKING",
        // "CONNECT_IPS",
        // "SCT",
      ],
      "eventHandler": {
        onSuccess(payload) {
          // hit merchant api for initiating verfication
          console.log(payload);
          var updatedDeliveryAddress = document.getElementById('deliveryAddressInput').value;
          var orderNote = document.getElementById('myTextarea').value;

          // Redirect to the orderPlaced1.php page with updated parameters
          window.location.href = 'myProfile/orderPlaced.php?pm=2&deliveryAddress=' + encodeURIComponent(updatedDeliveryAddress) + '&orderNote=' + encodeURIComponent(orderNote);
        },
        onError(error) {
          console.log(error);
        },
        onClose() {
          console.log('widget is closing');
        }
      }
    };

    var checkout = new KhaltiCheckout(config);
    var btn = document.getElementById("payment-button");
    btn.onclick = function () {
      // minimum transaction amount must be 10, i.e 1000 in paisa.
      checkout.show({ amount: <?php echo "200"; ?> * 100 });
    }

    // Get the textarea element
    const textarea = document.getElementById('myTextarea');
    // Get the hidden input for orderNote
    const orderNoteInput = document.getElementById('orderNote');
    // Add an event listener to the textarea for input event
    textarea.addEventListener('input', function () {
      // Update the value of the hidden input with the value of the textarea
      orderNoteInput.value = textarea.value;
    });
    document.getElementById('deliveryAddressInput').addEventListener('input', function () {
      var deliveryAddress = this.value;
      document.getElementById('deliveryAddressHidden').value = deliveryAddress;
    });
  </script>
</body>

</html>