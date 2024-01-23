<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- css style -->
    <link rel="stylesheet" href="assets/bootstrap.min.css">
    <link href="style.css" rel="stylesheet">


    <title>Quick Help Desk</title>

</head>

<body class="bg-black ">
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

        <!-- floor and cabin -->
        <div class="col-sm-12 col-xl-12 d-flex justify-content-center">
            <div class="bg-white rounded-pill   mt-5 mb-3">
                <ul class="nav nav-pills m-2 justify-content-center">
                    <li class="nav-item">
                        <a href="./resolver.php" style="text-decoration: none;">
                            <button
                                class="nav-link  rounded-pill btn-lg me-3 p-2 ps-5 pe-5 fs-4">Floor
                                <!-- <span><img src="img/Vector.png" alt="" style="margin-top:-30px;"></span> -->
                            </button>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./cabin.php" style="text-decoration: none;">
                            <button class="nav-link active rounded-pill btn-lg p-2 ps-5 pe-5 fs-4">Cabin
                                <!-- <span><img src="img/Vector.png" alt="" style="margin-top:-30px; "></span> -->
                            </button>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="container-fluid pt-4 px-4">
            <div class="row g-4">
                <div class="col-sm-6 col-xl-3">
                    <div class="rounded d-flex align-items-center justify-content-center p-5" style="background-color:#191c24">
                        <button type="button"
                            class="hr-c cabin-btn btn btn-lg justify-content-center bg-white text-dark border border-5">HR
                            Cabin</button>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="rounded d-flex align-items-center justify-content-center p-5" style="background-color:#191c24">
                        <button type="button"
                            class="t-c cabin-btn btn btn-lg justify-content-center bg-white text-dark border border-5">Training
                            Cabin</button>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="rounded d-flex align-items-center justify-content-center p-5"       style="background-color:#191c24">
                        <button type="button" class="s-c cabin-btn btn btn-lg justify-content-center bg-white text-dark border border-5">Software Cabin
                        </button>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="rounded d-flex align-items-center justify-content-center p-5" style="background-color:#191c24">
                        <button type="button" class="d-c cabin-btn btn btn-lg justify-content-center bg-white text-dark border border-5">Director Cabin
                        </button>
                    </div>
                </div>
            </div>
        </div><br>

        <!-- BO cabin -->
        <div style="background: #191c24; padding: 3rem; margin: 2rem 2rem;" class="d-flex align-items-center border border-2 border-white position-relative ">

            <div class="rows BO-L1 BO-L1-left" style="width:10%;">
            </div>

            <div class="" style="width:70%;">
                <div class="d-flex justify-content-between">
                    <div class="rows BO-L1 BO-L1-1 border-bottom d-flex ps-5 ">
                    </div>
                    <div class="rows BO-L1 BO-L1-2 border-bottom d-flex pe-5">
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <div class="rows BO-L2 BO-L2-1 border-top d-flex ps-5">
                    </div>
                    <div class="rows BO-L2 BO-L2-2 border-top d-flex pe-5">
                    </div>
                </div>
            </div>

            <div class="rows BO-L1 BO-L1-right" style="width:10%;">
            </div>

            <div class="d-flex flex-column justify-content-between " style="height:7rem">
                <button type="button" class="btn bg-white text-dark rounded btn-sm mt-2 ">L1</button>
                <button type="button" class="btn bg-white text-dark rounded btn-sm mt-2">L2</button>
            </div>

            <!-- BO cabin template -->
            <button style="background: #191c24; top: -1.5rem" class=" text-light border border-0 pb-2 pt-2 ps-3 pe-3 fs-5 fw-medium  rounded position-absolute start-50 translate-middle-x ">BO Cabin</button>
        </div><br>

        <!-- QC cabin -->
        <div style="background: #191c24; padding: 3rem; margin: 2rem 2rem;" class="d-flex align-items-center border border-2 border-white position-relative ">

            <div class="rows QC-L1-left" style="width:10%;">
            </div>

            <div class="d-flex flex-column" style="width:80%;">
                <div class="rows QC-L1 border-bottom d-flex ps-5">
                </div>
                <div class="rows QC-L2 border-top d-flex ps-5">
                </div>
            </div>

            <div class="d-flex flex-column justify-content-between " style="height:7rem;">
                <button type="button" class="btn bg-white text-dark rounded btn-sm mt-2 ">L1</button>
                <button type="button" class="btn bg-white text-dark rounded btn-sm mt-2">L2</button>
            </div>

            <!-- QC cabin template -->
            <button style="background: #191c24; top: -1.5rem" class=" text-light border border-0 pb-2 pt-2 ps-3 pe-3 fs-5 fw-medium  rounded position-absolute start-50  translate-middle-x ">QC Cabin</button>
        </div>

         <!-- black overlay -->
         <div class="overlay position-fixed top-0 h-100 w-100 opacity-0 z-n1" style="background-color: rgba(0,0,0,0.5)"></div>
        
        <!-- modal -->
        <div class="custom-modal bg-white px-4 py-2 z-3 position-fixed top-0 start-50 translate-middle-x mt-3 rounded-4 visually-hidden" style="width:30rem;">
            <span class="close-modal bg-white border-0 position-relative top-0 start-100" style="cursor:pointer; width:1%;" onMouseOver="this.style.color='red'" onMouseOut="this.style.color='#00F'">
                &#128939;
            </span>
            <div class="d-flex flex-column align-items-center">
                <h5 class="fw-bold my-3">Change Details</h5>
                <span class="device-id mb-3"></span>
                <form action="" class="d-flex flex-column" style="width:25rem">
                    <div class="container text-center">
                        <div class="row">
                            <div class="col">
                                <label for="monitor-id" class=" float-start">Monitor ID</label>
                            </div>
                            <div class="col border border-top-0 border-end-0 border-start-0 border-primary">
                                <input type="text" class="monitor-id bg-white" style="outline:none; border:none">
                            </div>
                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label for="cpu-id" class=" float-start">CPU ID</label>
                            </div>
                            <div class="col border border-top-0 border-end-0 border-start-0 border-primary">
                            <input type="text" class="cpu-id  bg-white" style="outline:none; border:none">
                            </div>
                        </div><br>
                
                        <div class="row">
                            <div class="col">
                            <label for="keyboard-id" class=" float-start">Keyboard ID</label>
                            </div>
                            <div class="col border border-top-0 border-end-0 border-start-0 border-primary">
                            <input type="text" class="keyboard-id bg-white" style="outline:none; border:none">
                            </div>
                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label for="mouse-id" class=" float-start">Mouse ID</label>
                            </div>
                            <div class="col border border-top-0 border-end-0 border-start-0 border-primary">
                                <input type="text" class="mouse-id bg-white" style="outline:none; border:none">
                            </div>
                        </div><br>
                    </div>
                    <button class="change-details rounded-pill border border-0 text-light fw-bold mb-3 border border-black py-3" style="background: #6f2cf5;">Save Chnages</button>
                </form>
            </div>
        </div>

        <!-- choice between 2 modals -->
        <div class="choice bg-white px-4 py-2 z-3 position-fixed top-0 start-50 translate-middle-x mt-3 rounded-4 visually-hidden" style="width:20rem;">
            <span class="close-modal bg-white border-0 position-relative top-0 start-100" style="cursor:pointer; width:1%;" onMouseOver="this.style.color='red'" onMouseOut="this.style.color='#00F'">
                &#128939;
            </span>
            <div class="">
                <div>
                    <center><img src="./img/repair.svg" alt="" class="w-50 h-50"></center>
                </div>
                <form action="" class="d-flex justify-content-between">
                    <button class="change-id-modal rounded-pill border border-0 text-light fw-bold mb-3 border border-black py-2 px-2" style="background: #6f2cf5;">Change Device ID</button>
                    <button class="display-issue-modal rounded-pill border border-0 text-light fw-bold mb-3 border border-black py-2 px-2" style="background: #6f2cf5;">Check Issue</button>
                </form>
            </div>
        </div>

        <!-- issue modal -->
        <div class="issue-modal bg-white px-4 py-2 z-3 position-fixed top-0 start-50 translate-middle-x mt-3 rounded-4 visually-hidden " style="width:30rem;">
            <span class="close-modal bg-white border-0 position-relative top-0 start-100" style="cursor:pointer; width:1%;" onMouseOver="this.style.color='red'" onMouseOut="this.style.color='#00F'">
                &#128939;
            </span>
            <div class="container text-center">
                <div class="row">
                    <div class="col">
                     <label for="id" class=" float-start">Issuer's ID</label>
                    </div>
                    <div class="col">
                    <input type="text" disabled class="issuer-id border border-top-0 border-end-0 border-start-0 border-primary bg-white" style="cursor:no-drop;">
                    </div>
                </div><br>

                <div class="row">
                    <div class="col">
                     <label for="name" class=" float-start">Issuer's Device ID</label>
                    </div>
                    <div class="col">
                    <input type="text" disabled class="issue-device border border-top-0 border-end-0 border-start-0 border-primary bg-white" style="cursor:no-drop;">
                    </div>
                </div><br>
                
                <div class="row">
                    <div class="col">
                     <label for="name" class=" float-start">Issue Type</label>
                    </div>
                    <div class="col">
                    <input type="text" disabled class="issue-type border border-top-0 border-end-0 border-start-0 border-primary bg-white" style="cursor:no-drop;">
                    </div>
                </div><br>

                <div class="row">
                    <div class="col">
                     <label for="name" class=" float-start">Description</label>
                    </div>
                    <div class="col">
                    <input type="text" disabled class="issue-description border border-top-0 border-end-0 border-start-0 border-primary bg-white" style="cursor:no-drop;">
                    </div>
                </div><br>
            </div>
        </div>

         <!-- JavaScript Libraries -->
    <script src="assets/jquery-3.4.1.min.js"></script>
    <script src="assets/bootstrap.bundle.min.js"></script>
    <!-- <script src="assets/kit.js"></script> -->

    <!-- Template Javascript -->
    <script src="./cal.js"></script>
</body>

</html>