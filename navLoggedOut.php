<head>
    <link rel="stylesheet" href="./css/nav.css">
    <link rel="stylesheet" href="./css/modal.css">
</head>

<div class="nav">
    <img class="toplogo-icon" alt="" src="./public/toplogo@2x.png" />
    <?php include 'searchBar.php'; ?>
    <div class="nav-menu"><a href="index.php" id="btn-anker">Home</a></div>
    <div class="nav-menu"><a href="shop.php" id="btn-anker">Shop</a></div>
    <div class="nav-menu"><a href="./myProfile/oops.php" id="btn-anker">My Profile</a></div>
    <div class="nav-menu"><a id="myBtn">Login</a></div>
</div>
<div id="myModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <div class="close">&times;&nbsp;</div>
        <?php include 'loginScreen.php' ?>
    </div>
</div>
<script>
    var modal = document.getElementById("myModal");
    var btn = document.getElementById("myBtn");
    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];
    // When the user clicks the button, open the modal 
    btn.onclick = function () {
        modal.style.display = "block";
    }
    // When the user clicks on <span> (x), close the modal
    span.onclick = function () {
        modal.style.display = "none";
    }
    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>