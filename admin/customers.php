<?php include '../database/connectDB.php';
;
$conn = $mysqli ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BRR Trading</title>
    <link rel="stylesheet" href="../css/global.css" />
    <link rel="stylesheet" href="../css/adminTable.css" />
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

        .search {
            padding-left: 7px;
            background: #E8EBF3;
            font-family: 'Varela Round', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;

            background: #ffffff;
            border-radius: 15px;
            display: flex;
            align-items: center;
            box-shadow: 0 10px 30px rgba(65, 72, 86, .05);
        }

        .search input[type="text"] {
            font: 400 16px 'Varela Round', sans-serif;
            color: #414856;
            border: none;
            outline: none;
            padding: 10px 20px;
            border-radius: 15px 0 0 15px;
            width: 190px;
        }

        .search button {
            background: #EC7224;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 0 15px 15px 0;
            cursor: pointer;
            /* border: 2px solid #EC7224; */
            font: 400 16px 'Varela Round', sans-serif;
            transition: background 0.3s ease;
            margin-left: 0.5px;
        }

        .search button:hover {
            background: #ca6118;
        }

        #searchInput:-webkit-autofill,
        #searchInput:-webkit-autofill:hover,
        #searchInput:-webkit-autofill:focus,
        #searchInput:-webkit-autofill:active {
            -webkit-box-shadow: 0 0 0 30px white inset !important;
            -webkit-text-fill-color: #000 !important;
        }
    </style>
</head>

<body>
    <div id="heading">
        <div class="column">
            <h1>Customers Information</h1>
        </div>
        <div class="column search-column">
            <div class="search">
                <form id="searchForm" action="index.php" method="GET">
                    <input type="text" id="searchInput" name="search" placeholder="Search for a customer"
                        value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>" />
                    <input type="hidden" name="file" value="./customers">
                    <button type="submit" id="searchButton">Search</button>
                </form>
            </div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Sno:</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Acc Created</th>
                <th>Orders</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($_GET['search']) && $_GET['search'] != '') {
                $search = $conn->real_escape_string($_GET['search']);
                $filter = "WHERE name LIKE '%$search%' OR email LIKE '%$search%' OR phone LIKE '%$search%'";
            } else {
                $filter = '';
            }
            $query = "SELECT id, name, email, phone, address, account_created FROM user $filter";
            $result = $conn->query($query);

            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    $user_email=htmlspecialchars($row["email"]);
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
                    echo "<td>" . $user_email . "</td>";
                    echo "<td>" . htmlspecialchars($row["phone"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["address"]) . "</td>";
                    echo "<td>" . htmlspecialchars(substr($row["account_created"], 0, 10)) . "</td>";
                    // The SQL query
                    $sql = "SELECT COUNT(*) AS email_count FROM delivered WHERE user_email = '$user_email'";
                    $result1 = $conn->query($sql);
                    if ($result1->num_rows > 0) {
                        // Fetch associative array
                        $row1 = $result1->fetch_assoc();
                        echo "<td>" . htmlspecialchars($row1['email_count']) . "</td>";
                    }
                    echo "</tr>";
                }
            }
            ?>
        </tbody>
    </table>
</body>

</html>
<?php $conn->close(); ?>