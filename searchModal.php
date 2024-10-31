<style>
    .close {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
        font-size: 16px;
    }
    .close>span{
        padding: 0 5px;
    }
    label,.sort{
        font-size: 12px;
    }
    .sort>span,#pr{
        font-size: 16px;
    }
    #pr,.sort>span{
        padding-left: 10px;
    }
</style>
<div class="modal-content">
<form method="GET" action="<?php echo basename($_SERVER['PHP_SELF']); ?>">
    <span class="close">
        <span>Filter</span>
        <span class="times-symbol">&times;</span>
    </span>
    <span id='pr'>Price Range:</span><br>
    <label for="minPrice">&nbsp;&nbsp;Min Price:</label>
    <input type="hidden" id="search" name="search" value="<?php echo $_SESSION['search']?>">
    <input type="number" id="minPrice" name="minPrice" value="0">
    <label for="maxPrice">Max Price:</label>
    <input type="number" id="maxPrice" name="maxPrice" value="10000">
    <br><br>
    <div class='sort'>
            <span>Sort by:</span><br><br>&nbsp;&nbsp;
            <label>
                <input type="radio" name="sort" value="low" checked> Lowest first
            </label>&nbsp;&nbsp;
            <label>
                <input type="radio" name="sort" value="high"> Highest first
            </label>
        </div>
    <!-- Inside your modal content -->
    <div class="button-container">
        <button>Apply</button>&nbsp;&nbsp;
        <button id='blue'>Cancel</button>
    </div>
</form>
</div>
<script>
    var modal = document.getElementById("myModal");
    var btn = document.getElementById("filterButton");
    var btn1 = document.getElementById("blue");
    var span = document.getElementsByClassName("close")[0];
    btn.onclick = function () {
        modal.style.display = "block";
    }
    btn1.onclick = function () {
        modal.style.display = "none";
    }
    span.onclick = function () {
        modal.style.display = "none";
    }
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
    document.getElementById("applyFilter").onclick = function () {
        var minPrice = document.getElementById("minPrice").value;
        var maxPrice = document.getElementById("maxPrice").value;
        // Perform filtering based on minPrice and maxPrice
        console.log("Min Price: " + minPrice + ", Max Price: " + maxPrice);
        // Close the modal after applying filter
        modal.style.display = "none";
    }
</script>