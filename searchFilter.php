<?php
$minPrice=isset($_GET['minPrice']) ? $_GET['minPrice'] : 0;
$maxPrice=isset($_GET['maxPrice']) ? $_GET['maxPrice'] : 100000;

if (empty($minPrice) && empty($maxPrice)) {
    $filter = '';
} else {
    // Use proper comparison with $maxPrice
    $filter = " AND price >= $minPrice AND price <= $maxPrice";
}

$sort = isset($_GET['sort']) ? $_GET['sort'] : '';

// Initialize the default filter
$filter1 = "ORDER BY price ASC";

// Adjust the filter based on the 'sort' value
if ($sort === "high") {
    $filter1 = "ORDER BY price DESC";
} elseif ($sort === "low") { 
    $filter1 = "ORDER BY price ASC";
}
$totalFilter= $filter." ".$filter1;
?>