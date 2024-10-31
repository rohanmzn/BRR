<!-- <link rel="stylesheet" href="../css/addProduct.css">
    <link rel="stylesheet" href="../css/adminTable.css"> -->
    <style>
        /* Style for modal */
        .modalView {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }

        .modalView-content {
            background-color: #fefefe;
            margin: 10% auto;
            padding: 2px;
            border: 1px solid #888;
            width: 80%;
        }
    </style>
    <div id="myModalView" class="modalView">
        <div class="modalView-content">
            <!-- Order details will be loaded here -->
        </div>
    </div>
    <script>
        // Function to open modal and load order details
        function openModal(orderId) {
            var modal = document.getElementById("myModalView");
            var modalContent = modal.querySelector(".modalView-content");
            modal.style.display = "block";

            // Make AJAX request to fetch order details
            // Replace 'viewOrderItem.php' with the correct URL endpoint
            var url = './viewOrderItem.php?id=' + orderId;
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    modalContent.innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", url, true);
            xhttp.send();
        }

        // Close the modal when clicking outside of it
        window.onclick = function(event) {
            var modal = document.getElementById("myModalView");
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>