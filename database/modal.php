<!-- file hasn't been used anywhere  -->
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./css/modal.css" />
</head>

<body>
    <!-- Trigger/Open The Modal -->
    <a id="myBtn">Open Modal</a>
    <!-- The Modal -->
    <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <div class="close">&times;&nbsp;</div>
            <?php include 'lockScreen.php' ?>
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
</body>

</html>