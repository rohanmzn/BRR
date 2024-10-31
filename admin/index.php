<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BRR Trading</title>
    <link rel="stylesheet" href="../css/global.css" />
    <link rel="stylesheet" href="../css/adminIndex.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Tenor Sans:wght@400&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Abel:wght@400&display=swap" />
</head>

<body>
    <div class="myProfileContainer">
        <!-- Sidebar -->
        <div class="sidebar">
            <?php include 'sidebar.php' ?>
        </div>

        <div class="myProfileMain" id="myDiv">
            <?php
            if (isset($_GET['file'])) {
                $includedFile = $_GET['file'] . '.php';
                if (file_exists($includedFile)) {
                    include $includedFile;
                } else {
                    // Handle non-existent file gracefully
                }
            } else {
                include "dashboard.php";
            }
            ?>
        </div>
    </div>
</body>

</html>
<?php
if (isset($_GET['success']) && $_GET['success'] == 1) {
    echo "<script>alert('Product Added Successfully');
    window.history.pushState({}, '', window.location.pathname);
    </script>";
}
?>
<script>
    if (window.location.search.includes("deliver=success")) {
        alert("Order successfully marked as delivered!");
        // to stop repeatedly alert on refresh
        window.history.pushState({}, "", window.location.pathname);
    }
</script>