<?php
include '../database/connectDB.php';
$conn = $mysqli;

// Fetch data for each day (last 30 days)
$dayData = [];
$sql = "SELECT delivered_date, COUNT(id) as day_count, SUM(total_amount) as day_total 
        FROM delivered 
        WHERE delivered_date >= DATE_SUB(NOW(), INTERVAL 30 DAY)
        GROUP BY delivered_date";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    $dayData[$row['delivered_date']] = ['count' => $row['day_count'], 'total' => $row['day_total']];
}

// Fetch data for each week (last 6 weeks)
$weekData = [];
$sql = "SELECT YEARWEEK(delivered_date) AS week, COUNT(id) as week_count, SUM(total_amount) as week_total 
        FROM delivered 
        WHERE delivered_date >= DATE_SUB(NOW(), INTERVAL 8 WEEK)
        GROUP BY YEARWEEK(delivered_date)";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    $weekData[$row['week']] = ['count' => $row['week_count'], 'total' => $row['week_total']];
}

// Fetch data for each month (last 12 months)
$monthData = [];
$sql = "SELECT YEAR(delivered_date) AS year, MONTH(delivered_date) AS month, COUNT(id) as month_count, SUM(total_amount) as month_total 
        FROM delivered 
        WHERE delivered_date >= DATE_SUB(NOW(), INTERVAL 12 MONTH)
        GROUP BY YEAR(delivered_date), MONTH(delivered_date)";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    $monthData[$row['year'] . '-' . sprintf("%02d", $row['month'])] = ['count' => $row['month_count'], 'total' => $row['month_total']];
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Sales Data Bar Graph</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="../css/addProduct.css">
    <style>
        .button-container {
            position: absolute;
            bottom: 20px;
            /* Adjust this value as needed to set the distance from the bottom */
            left: 38%;
            transform: translateX(-50%);
        }
    </style>
</head>

<body>
    <div id="heading">
        <h1>Sales Chart</h1>
    </div>
    <div class="button-container">
        <button class="orange-button" onclick="showChart('dailySalesChart')">Day</button>
        <button class="orange-button" onclick="showChart('weeklySalesChart')">Week</button>
        <button class="orange-button" onclick="showChart('monthlySalesChart')">Month</button>
    </div>

    <div id="chart-container" style="background-color: white; border-radius: 10px;">
        <canvas id="monthlySalesChart" width="400" height="185"></canvas>
        <canvas id="weeklySalesChart" width="400" height="185" style="display: none;"></canvas>
        <canvas id="dailySalesChart" width="400" height="185" style="display: none;"></canvas>
    </div>

    <script>
        // Convert PHP arrays to JavaScript objects
        var dayData = <?php echo json_encode($dayData); ?>;
        var weekData = <?php echo json_encode($weekData); ?>;
        var monthData = <?php echo json_encode($monthData); ?>;

        // Function to adjust week labels
        function adjustWeekLabels(data) {
            let adjustedData = {};
            Object.keys(data).forEach((key) => {
                const year = key.substring(0, 4);
                const week = parseInt(key.substring(4), 10); // Parse week number as integer
                const paddedWeek = ('0' + week).slice(-2); // Zero-pad the week number
                adjustedData[`Week ${paddedWeek} (${year})`] = data[key];
            });
            return adjustedData;
        }

        // Adjusting week labels for readability
        weekData = adjustWeekLabels(weekData);

        // Modified createBarGraph function with white text and orange bars
        // Function to create bar graph
        function createBarGraph(ctxId, data, label) {
            var labels = Object.keys(data);
            var dataset = labels.map(function (label) { return data[label].total; });

            var ctx = document.getElementById(ctxId).getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: label,
                        data: dataset,
                        backgroundColor: 'rgba(255, 159, 64, 0.5)', // Orange color for bars
                        borderColor: 'rgba(255, 159, 64, 1)', // Orange color for border
                        borderWidth: 1
                    }]
                }
            });
        }

        // Function to format month labels
        function formatMonthLabels(data) {
            const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
            let formattedData = {};
            Object.keys(data).forEach((key) => {
                const year = key.split('-')[0];
                const monthIndex = parseInt(key.split('-')[1], 10) - 1; // Convert "01" through "12" to 0 through 11
                const formattedKey = `${monthNames[monthIndex]} ${year}`;
                formattedData[formattedKey] = data[key];
            });
            return formattedData;
        }

        // Adjusting month labels for readability
        monthData = formatMonthLabels(monthData);

        // Create bar graphs for daily, weekly, and monthly sales data
        createBarGraph('dailySalesChart', dayData, 'Daily Total Sales');
        createBarGraph('weeklySalesChart', weekData, 'Weekly Total Sales');
        createBarGraph('monthlySalesChart', monthData, 'Monthly Total Sales');

        // Function to switch between charts
        function showChart(chartId) {
            var charts = document.querySelectorAll('canvas');
            charts.forEach(function (chart) {
                chart.style.display = chart.id === chartId ? 'block' : 'none';
            });
        }
    </script>

</body>

</html>