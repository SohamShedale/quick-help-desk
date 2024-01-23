<?php
    session_start();
    if(!isset($_SESSION["r_email"])){
        header("Location: index.php");
    }
    if(isset($_POST['logout'])){
        session_unset();
        session_destroy();
        header("Location:index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- css style -->
    <link rel="stylesheet" href="assets/bootstrap.min.css">
    <link href="style.css" rel="stylesheet">

    <script	src="assets/Chart.js"></script>
    <title>Quick Help Desk</title>
    
</head>

<body class="body bg-black">
     
    <!-- Content Start -->
    <div class="content">
     <!-- Navbar Start -->
     <div class="">
            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0 z-0">
                    <!-- details -->
                    <div class="d-flex align-items-center bg-white ms-2 p-2 pe-4 mt-3 mb-3 me-4 rounded" style="">
                      <!--  profile img -->
                        <div class="position-relative ">
                            <img class="rounded" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                        </div>
                        <div class="ms-3">
                            <h6 class="mb-0 text-dark fs-5 fs-bold"><?php echo $_SESSION['r_email'];?></h6>
                            <span>IT Associate</span>
                        </div>
                    </div>

                    <!-- notification -->
                    <div class="align-items-center me-5">
                        <div class=" dropdown" style="cursor:pointer;" data-bs-toggle="dropdown">
                              <div class=" d-flex align-items-center p-3 rounded bg-white">
                                <img src="img/notification.png" alt="">
                                <?php 

                                        include 'config.php';

                                        $sql="SELECT * FROM ticket WHERE issue_status=0";

                                        $result=mysqli_query($conn,$sql);

                                        if(mysqli_num_rows($result)>0){
                                            echo '<span><img src="img/Vector.png" alt="" style="margin-top:-30px; margin-left: -5px;"></span>';
                                            echo '<div class="dropdown-menu  mt-3 ">';
                                            while($row=mysqli_fetch_assoc($result)){
                                            
                                            echo '
                                            <a href="#" class="dropdown-item ">
                                              <div class="d-flex justify-content-start bg-white">
                                             <div class=" rounded h-100 w-100 d-flex" style="background-image: linear-gradient(144deg,#9151bf, #6f5af2 80%);">
                                             <div class="text-white d-flex justify-content-center align-items-center">
                                             <span class="p-3"> SOFT <br> Cabin</span></div>
                                             <div class="vr"></div>
                                               <div class="text-white p-3 pt-4 ">'; echo $row['issue_type'].' Issue</div>
                                               <div class="mt-4">
                                                 <svg width="25" height="26" viewBox="0 0 25 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                   <text x="12" y="15" font-size="13" font-family="poppins" fill="white" text-anchor="middle"></text>
                                                   <g id="Mask group">
                                                   <mask id="mask0_668_1218" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="0" width="25" height="24">
                                                   <g id="Group">
                                                   <g id="Group_2">
                                                   <path id="Vector" d="M21.3819 1.5H3.39578C2.40243 1.5 1.59717 2.2835 1.59717 3.25V16.0833C1.59717 17.0498 2.40243 17.8333 3.39578 17.8333H21.3819C22.3752 17.8333 23.1805 17.0498 23.1805 16.0833V3.25C23.1805 2.2835 22.3752 1.5 21.3819 1.5Z" fill="#555555" stroke="white" stroke-width="2" stroke-linejoin="round"/>
                                                   <path id="Vector_2" d="M6.39343 22.5H18.3842M12.3888 17.8333V22.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                   </g>
                                                   </g>
                                                   </mask>
                                                   <g mask="url(#mask0_668_1218)">
                                                   <path id="Vector_3" d="M-1.5 -1.5H26.2778V25.5H-1.5V-1.5Z" fill="white" stroke="black"/>
                                                   </g>
                                                   </g>
                                                   </svg>
                                               </div>


                                               <button type="button" class="border border-white btn text-white rounded m-3 me-3" disabled>';echo $row['desk_num'].'</button>
                                                 </div>

                                               </div>
                                           </a>
                                           ';
                                       }
                                       echo '</div>';
                                   }
                                   ?>
                            </div>
                        </div>
                    </div>

                    <!-- issues -->
                    <div class=" d-flex justify-content-center" style="margin-left:6rem;">
                          <div href="#" class="nav-link text-white fs-5 me-5">Total Issues  <?php
                                include 'config.php';
                                $sql="SELECT * FROM ticket";
                                $result=mysqli_query($conn,$sql);
                                $num= mysqli_num_rows($result);
                                echo $num;
                                ?></div>

                          <div href="#" class=" nav-link text-white fs-5 me-5 ">Resolved <?php
                                    include 'config.php';
                                    $sql="SELECT * FROM ticket WHERE issue_status=1";
                                    $result=mysqli_query($conn,$sql);

                                    $num= mysqli_num_rows($result);
                                    echo $num;
                                ?></div>


                          <div href="#" class=" nav-link text-white fs-5 me-2">Unresolved  <?php
                                    include 'config.php';
                                    $sql="SELECT * FROM ticket WHERE issue_status=0";
                                    $result=mysqli_query($conn,$sql);
                                    $num= mysqli_num_rows($result);
                                    echo $num;
                                ?>
                            </div>
                    </div>

                    <!-- select building -->
                    <div class="navbar-nav align-items-center" style="margin-left:1rem;">
                          <div class="nav-item dropdown">
                              <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                <button type="btn"class="btn fs-5 bg-white p-1 ps-2 ">Select Building
                                    <span class="" style="vertical-align:middle;">&#129171</span>
                                </button>
                              </a>
                              <div class="dropdown-menu  fs-5 ms-4">
                                  <a href="#" class="dropdown-item">Town Square</a>
                                  <a href="resolver.php" class="dropdown-item">Sky Vista</a>
                              </div>
                          </div>
                    </div>

                    <!-- calender -->
                    <div class="navbar-nav align-items-center">
                        <div class=" dropdown ">
                            <a href="#" class="nav-link d-flex align-items-center p-2 rounded bg-white" data-bs-toggle="dropdown">
                                <img src="img/calender.png" alt="" class="p-1">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end me-5 mt-3 m-0"> 
                                <div class="calendar">
                                    <div class="header">
                                        <div class="month">July 2021</div>
                                            <div class="btns">
                                                <!-- today -->
                                                <div class="btn today">
                                                    <i class="">&#9719</i>
                                                </div>
                                                <!-- previous month -->
                                                <div class="btn prev">
                                                    <i class="">&#10096</i>
                                                </div>
                                                <!-- next month -->
                                                <div class="btn next">
                                                    <i class="">&#10097</i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="weekdays">
                                          <div class="day">Sun</div>
                                          <div class="day">Mon</div>
                                          <div class="day">Tue</div>
                                          <div class="day">Wed</div>
                                          <div class="day">Thu</div>
                                          <div class="day">Fri</div>
                                          <div class="day">Sat</div>
                                        </div>
                                        <div class="days">
                                          <!-- render days with js -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 

                    <!-- Addition -->
                    <div class="navbar-nav align-items-center" >
                        <div class="nav-item dropdown">
                          <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                              <button type="btn"class="btn  fs-5 bg-white p-1 ps-2">Additional
                                <span class="" style="vertical-align:middle;">&#129171</span>
                              </button>
                          </a>
                          <div class="dropdown-menu  fs-5 ms-4">
                              <a href="overview.php" class="dropdown-item">Overview</a>
                              <a href="report.php" class="dropdown-item">Report</a>
                          </div>
                        </div>
                    </div>                
                               
                    <!-- logout -->
                    <div class="" style="">
                    <button type="button" name="logout" class="btn btn-danger text-white ms-4">
                       <a href="logout.php" style="text-decoration:none; color:white">Logout</a>
                    </button>
                    </div>
            </nav>
        </div>
        <!-- Navbar End -->
<div class="d-flex justify-content-center  mt-5">
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

    var colorMap = {
        'Hardware': 'rgba(236, 186, 237, 1)',
        'Software': 'rgba(149, 164, 252, 1)',
        'Other': 'rgba(161, 227, 203, 1)',
        'Network': 'rgba(113, 159, 150, 1)'
    };

    var backgroundColors = issueTypes.map(function (issueType) {
        return colorMap[issueType] || colorMap['Other'];
    });

    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: issueTypes,
            datasets: [{
                data: issueCounts,
                backgroundColor: backgroundColors,
                borderColor: backgroundColors,
                borderWidth: 1
            }]
        },
        options: {
            title: {
                display: true,
                text: 'Issue Type Distribution' // Set title text color to white
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
                    'rgba(198,199,248,1)',
                    'rgba(24,134,254,1)',
                ],
                borderColor: [
                    'rgba(198,199,248,1)',
                    'rgba(24,134,254,1)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            title: {
                display: true,
                text: 'Issue Status Distribution (UnResolved / Resolved)'
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
</div>
        <!-- JavaScript Libraries -->
    <script src="assets/jquery-3.4.1.min.js"></script>
    <script src="assets/bootstrap.bundle.min.js"></script>
    <script src="assets/kit.js"></script>
	<script>
        const daysContainer = document.querySelector(".days");
        const nextBtn = document.querySelector(".next");
        const prevBtn = document.querySelector(".prev");
        const todayBtn = document.querySelector(".today");
        const month = document.querySelector(".month");

        const months = [
          "January",
          "February",
          "March",
          "April",
          "May",
          "June",
          "July",
          "August",
          "September",
          "October",
          "November",
          "December",
        ];

        const days = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];

        const date = new Date();
        let currentMonth = date.getMonth();
        let currentYear = date.getFullYear();

        const renderCalendar = () => {
          date.setDate(1);
          const firstDay = new Date(currentYear, currentMonth, 1);
          const lastDay = new Date(currentYear, currentMonth + 1, 0);
          const lastDayIndex = lastDay.getDay();
          const lastDayDate = lastDay.getDate();
          const prevLastDay = new Date(currentYear, currentMonth, 0);
          const prevLastDayDate = prevLastDay.getDate();
          const nextDays = 7 - lastDayIndex - 1;
        
          month.innerHTML = `${months[currentMonth]} ${currentYear}`;
        
          let days = "";
        
          for (let x = firstDay.getDay(); x > 0; x--) {
            days += `<div class="day prev">${prevLastDayDate - x + 1}</div>`;
          }
      
          for (let i = 1; i <= lastDayDate; i++) {
            if (
              i === new Date().getDate() &&
              currentMonth === new Date().getMonth() &&
              currentYear === new Date().getFullYear()
            ) {
              days += `<div class="day today">${i}</div>`;
            } else {
              days += `<div class="day">${i}</div>`;
            }
          }
      
          for (let j = 1; j <= nextDays; j++) {
            days += `<div class="day next">${j}</div>`;
          }
      
          daysContainer.innerHTML = days;
          hideTodayBtn();
        };

        nextBtn.addEventListener("click", () => {
          currentMonth++;
          if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
          }
          renderCalendar();
        });

        prevBtn.addEventListener("click", () => {
          currentMonth--;
          if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
          }
          renderCalendar();
        });

        todayBtn.addEventListener("click", () => {
          currentMonth = date.getMonth();
          currentYear = date.getFullYear();
          renderCalendar();
        });

        function hideTodayBtn() {
          if (
            currentMonth === new Date().getMonth() &&
            currentYear === new Date().getFullYear()
          ) {
            todayBtn.style.display = "none";
          } else {
            todayBtn.style.display = "flex";
          }
        }

        renderCalendar();
    </script>
    
</body>

</html>