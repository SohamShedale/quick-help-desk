<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Issue Type Pie Chart</title>
    <!-- Include Chart.js library -->
	<script	src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .chart-container {
            text-align: center;
        }

        canvas {
            margin: 15px;
            max-width: 700px;
        }
    </style>
</head>
<body>

<?php
// Database connection details
include "config.php";
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to get data from the database
$sql = "SELECT issue_type, COUNT(*) as count FROM ticket GROUP BY issue_type";
$result = $conn->query($sql);

// Initialize arrays to store data for the pie chart
$issueTypes = [];
$issueCounts = [];

// Fetch data and populate arrays
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $issueTypes[] = $row['issue_type'];
        $issueCounts[] = $row['count'];
    }
}
// Calculate the total count for the issue types
$totalCount = array_sum($issueCounts);
// Calculate percentages for issue types
$issuePercentages = array_map(function ($count) use ($totalCount) {
    return round(($count / $totalCount) * 100, 2);
}, $issueCounts);


// Query to get data from the database for issue status where issue is solved or resolved
$sqlIssueStatus = "SELECT issue_status, COUNT(*) as count FROM ticket WHERE issue_status IN (0,1) GROUP BY issue_status";
$resultIssueStatus = $conn->query($sqlIssueStatus);

// Initialize arrays to store data for the issue status pie chart
$issueStatuses = ['Unresolved','Resolved'];
$issueStatusCounts = [];

// Fetch data and populate arrays for issue status
if ($resultIssueStatus->num_rows > 0) {
    while ($row = $resultIssueStatus->fetch_assoc()) {
        $issueStatusCounts[] = $row['count'];
    }
}
// Calculate the total count for the issue types
$totalCount2 = array_sum($issueCounts);
// Calculate percentages for issue types
$issuePercentages2 = array_map(function ($count) use ($totalCount2) {
    return round(($count / $totalCount2) * 100, 2);
}, $issueStatusCounts);

// Close the database connection
$conn->close();
?>

<!-- Create a canvas element for the pie chart -->
<canvas id="issueChart" style="width:100%;max-width:700px"></canvas>
<canvas id="issueStatusChart" style="width:100%;max-width:700px"></canvas>

<script>
    // Get the data from PHP and convert it to JavaScript variables
    var issueTypes = <?php echo json_encode($issueTypes); ?>;
    var issueCounts = <?php echo json_encode($issuePercentages); ?>;

    // Create a pie chart using Chart.js
    var ctx = document.getElementById('issueChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: issueTypes,
            datasets: [{
                data: issueCounts,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.7)',
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(255, 206, 86, 0.7)',
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            title: {
                display: true,
                text: 'Issue Type Distribution'
            },
            tooltips: {
                callbacks: {
                    label: function (tooltipItem, data) {
                        var dataset = data.datasets[tooltipItem.datasetIndex];
                        var total = dataset.data.reduce(function (previousValue, currentValue, currentIndex, array) {
                            return previousValue + currentValue;
                        });
                        var currentValue = dataset.data[tooltipItem.index];
                        var percentage = Math.floor(((currentValue / total) * 100) + 0.5);
                        return percentage + "%";
                    }
                }
            }
        }
    });


 // Get the data from PHP and convert it to JavaScript variables for issue status
 var issueStatuses = <?php echo json_encode($issueStatuses); ?>;
    var issueStatusCounts = <?php echo json_encode($issuePercentages2); ?>;

    // Create a pie chart for issue status using Chart.js
    var ctx2 = document.getElementById('issueStatusChart').getContext('2d');
    var myChart2 = new Chart(ctx2, {
        type: 'pie',
        data: {
            labels: issueStatuses,
            datasets: [{
                data: issueStatusCounts,
                backgroundColor: [
                    'rgba(255,0,0)',
                    'rgba(0,255,0)',
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 99, 132, 1)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            title: {
                display: true,
                text: 'Issue Status Distribution (UnResolved/Resolved)'
            },
            tooltips: {
                callbacks: {
                    label: function (tooltipItem, data) {
                        var dataset = data.datasets[tooltipItem.datasetIndex];
                        var total = dataset.data.reduce(function (previousValue, currentValue, currentIndex, array) {
                            return previousValue + currentValue;
                        });
                        var currentValue = dataset.data[tooltipItem.index];
                        var percentage = Math.floor(((currentValue / total) * 100) + 0.5);
                        return percentage + "%";
                    }
                }
            }
        }
    });
</script>



</body>
</html>


