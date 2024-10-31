<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/infoEdit.css">
</head>

<body>
    <?php
    include '../database/connectDB.php';

    // Get the email from the query parameter
    $email = $_GET['email'];

    // Retrieve user information
    $sql = "SELECT * FROM user WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        ?>
        <div class="container">

            <form action="update_info.php" method="post">
                <input type="hidden" name="email" value="<?php echo $email; ?>">
                <table>
                    <tr>
                        <td><label for="name">Full Name:</label></td>
                        <td><input type="text" id="name" name="name" value="<?php echo $row['name']; ?>"></td>
                    </tr>
                    <tr>
                        <td><label for="phone">Phone Number:</label></td>
                        <td> <input type="text" id="phone" name="phone" value="<?php echo $row['phone']; ?>"></td>
                    </tr>
                    <tr>
                        <td><label for="address">Address:</label></td>
                        <td><input type="text" id="address" name="address" value="<?php echo $row['address']; ?>"></td>
                    </tr>
                </table>
                <br>
                <button class="orange-button" type="submit">Update</button>
                <button class="orange-button" id="blue"><a href="../myProfile.php">Go Back</a></button>
            </form>
        </div>
        <?php
    } else {
        echo "Invalid User";
    }
    $conn->close();
    ?>
</body>

</html>