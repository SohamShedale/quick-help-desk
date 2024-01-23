<?php
    session_start();
    if(!isset($_SESSION["r_email"])){
        header("Location: index.php");
    }
    if(isset($_POST['logout'])){
        session_unset();
        session_destroy();
        header("Location:index.php");
        // exit();
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

     <!-- js scripts -->
        <script src="assets/bootstrap.bundle.min.js"></script>
        <script src="assets/kit.js"></script>
 <!-- Datepicker -->
 <link rel="stylesheet" href="assets/jquery-ui.css">

<!-- Datatables -->
<link rel="stylesheet" type="text/css"
href="assets/datatables.min.css" />

    <title>Quick Help Desk</title>
</head>

<body class="body bg-black">
     
    <!-- Content Start -->
    <div class="content">
     <!-- Navbar Start -->
     <div class="">
            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0 z-1">
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

<div class="container z-0">
        <div class="row">
            <div class="col-md-12 mt-3">
                <h1 class="text-center text-white">Issue Status</h1>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-info text-white" id="basic-addon1"><i
                                        class="fas fa-calendar-alt m-1"></i></span>
                            </div>
                            <input type="text" class="form-control" id="start_date" placeholder="Start Date" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-info text-white" id="basic-addon1"><i
                                        class="fas fa-calendar-alt m-1"></i></span>
                            </div>
                            <input type="text" class="form-control" id="end_date" placeholder="End Date" readonly>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <button id="filter" class="btn btn-outline-info btn-lg me-3">Filter</button>
                    <button id="reset" class="btn btn-outline-warning btn-lg">Reset</button>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <!-- Table -->
                        <div class="table-responsive z-0">
                            <table class="table table-borderless display nowrap table-striped" id="records" style="width:100%">
                                <thead class="table-primary">
                                    <tr>
                                        <th scope="col">Ticket ID</th>
                                        <th scope="col">Executive ID</th>
                                        <th scope="col">DeviceID</th>
                                        <th scope="col">Issue Type</th>
                                        <th scope="col">Issue Description</th>
                                        <th scope="col">Issue Date</th>
                                        <th scope="col">Issue Status</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  

<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="assets/jquery-3.5.0.min.js"
        integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
    <script src="assets/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="assets/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    <!-- Font Awesome -->
    <script src="assets/all.min.js"></script>
    <!-- Datepicker -->
    <script src="assets/jquery-ui.js"></script>
    <!-- Datatables -->
    <script type="text/javascript" src="assets/pdfmake.min.js"></script>
    <script type="text/javascript" src="assets/vfs_fonts.js"></script>
    <script type="text/javascript" src="assets/datatables.min.js">
    </script>
    <!-- Momentjs -->
    <script src="assets/moment.min.js"></script>


    <script>
    $(function() {
        $("#start_date").datepicker({
            "dateFormat": "yy-mm-dd"
        });
        $("#end_date").datepicker({
            "dateFormat": "yy-mm-dd"
        });
    });
    </script>

    <script>
    // Fetch records

    function fetch(start_date, end_date) {
        $.ajax({
            url: "records.php",
            type: "POST",
            data: {
                start_date: start_date,
                end_date: end_date
            },
            dataType: "json",
            success: function(data) {
                // Datatables
                var i = "1";

                $('#records').DataTable({
                    "data": data,
                    // buttons
                    "dom": "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'B><'col-sm-12 col-md-4'f>>" +
                        "<'row'<'col-sm-12'tr>>" +
                        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                    "buttons": [
                        'copy', 'csv', 'excel', 'pdf', 'print'
                    ],
                    // responsive
                    "responsive": true,
                    "columns": [{
                            "data": "ticket_id",
                            
                        },
                        {
                            "data": "executive_id",
                            
                        },
                        {
                            "data": "desk_num",
                            
                        },
                        {
                            "data": "issue_type",
                           
                        },
                        {
                            "data": "ticket_description",
                        },
                        {
                            "data": "date_issue",
                            "render": function(data, type, row, meta) {
                                return moment(row.date_issue).format('YYYY-MM-DD');
                            }
                        },
                        {
                            "data": "issue_status",
                            "render": function(data, type, row, meta) {
                                return data === '0' ? 'Unresolved' : 'Resolved';
                            }
                        }
                    ]
                });
            }
        });
    }
    fetch();

    // Filter

    $(document).on("click", "#filter", function(e) {
        e.preventDefault();

        var start_date = $("#start_date").val();
        var end_date = $("#end_date").val();

        if (start_date == "" || end_date == "") {
            alert("both date required");
        } 
        else {
            $('#records').DataTable().destroy();
            fetch(start_date.slice(0,10), end_date.slice(0,10));
        }
    });

    // Reset

    $(document).on("click", "#reset", function(e) {
        e.preventDefault();

        $("#start_date").val(''); // empty value
        $("#end_date").val('');

        $('#records').DataTable().destroy();
        fetch();
    });
    </script>
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