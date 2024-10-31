<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/information.css" />
</head>

<body>
    <h1>Profile Information</h1>
    <?php
    include './database/connectDB.php';
    $email = $_SESSION['Username'];
    // Retrieve user information
    $sql = "SELECT * FROM user WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='0'>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<th>Full Name</th>";
            echo "<td>" . $row['name'] . "</td>";
            echo "</tr>";

            echo "<tr>";
            echo "<th>Email Address</th>";
            echo "<td>" . $row['email'] . "</td>";
            echo "</tr>";

            echo "<tr>";
            echo "<th>Phone Number</th>";
            echo "<td>" . $row['phone'] . "</td>";
            echo "</tr>";

            echo "<tr>";
            echo "<th>Address</th>";
            echo "<td>" . $row['address'] . "</td>";
            echo "</tr>";

            echo "<tr>";
            echo "<th>Account Created</th>";
            echo "<td>" . mb_strimwidth($row['account_created'], 0, 10) . "</td>";
            echo "</tr>";
        }
        echo "</table><br>";
        echo "<button class='orange-button'><a href='./myProfile/edit_info.php?email=$email'>Edit Information</a></button>&nbsp;&nbsp;";
        echo "<button class='orange-button'><a href='./myProfile/change_password.php?email=$email'>Change Password</a></button>";
    } else {
        echo "Invalid User";
    }

    $conn->close();
    ?>


</body>

</html>
<script>
    if (window.location.search.includes("update_info=successful")) {
        alert("Your information has been updated sucessfully");
        // to stop repeatedly alert on refresh
        window.history.pushState({}, "", window.location.pathname);
    }
</script>