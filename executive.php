<?php
  session_start();
    if(!isset($_SESSION["executive_id"])){
            header("Location: executive_signin.php");
      }
      
  if(isset($_POST['issue'])){
                          
    include 'config.php';

    $executiveId=$_SESSION['executive_id'];
    $deskNum=$_POST['deskNum'];
    $issueType=$_POST['issueKind'];
    $description=$_POST['description'];
    $issuedate=$_POST['date'];
    $status=$_POST['gridRadios'];
    $row;
    

    $emptyCheck = "SELECT * FROM ticket";
    $check = mysqli_query($conn,$emptyCheck);

    if(mysqli_num_rows($check)==0){
      $sql="INSERT INTO ticket(executive_id,desk_num,issue_type,ticket_description,date_issue,issue_status) VALUES($executiveId,'$deskNum','$issueType','$description','$issuedate','$status')";
      $result=mysqli_query($conn,$sql);
      if($result){
        echo '<div class="alert alert-success">Issue Submitted!</div>';
        // header("Location:issueRecords.php");
      }
      else{
        echo '<div class="alert alert-danger">Some Issue Occurred!</div>';
      }
    }
    else{
      $checkQuery = "SELECT * FROM ticket WHERE executive_id = '$executiveId'";
      $records = mysqli_query($conn,$checkQuery);
  
      if(mysqli_num_rows($records)>0){
        for($i=1; $i<=mysqli_num_rows($records); $i++){
          $row = mysqli_fetch_row($records);
        }
        if($row[5]=='0'){
          echo '<div class="alert alert-danger">You\'ve already raised an Issue</div>';
        }
        elseif($row[5]=='1'){
          $sql="INSERT INTO ticket(executive_id,desk_num,issue_type,ticket_description,date_issue,issue_status) VALUES($executiveId,'$deskNum','$issueType','$description','$issuedate','$status')";
          $result=mysqli_query($conn,$sql);
          if($result){
            echo '<div class="alert alert-success">Issue Submitted!</div>';
            // header("Location:issueRecords.php");
          }
          else{
            echo '<div class="alert alert-danger">Some Issue Occurred!</div>';
          }
        }
      }
      elseif(mysqli_num_rows($records)==0){
        $sql="INSERT INTO ticket(executive_id,desk_num,issue_type,ticket_description,date_issue,issue_status) VALUES($executiveId,'$deskNum','$issueType','$description','$issuedate','$status')";
        $result=mysqli_query($conn,$sql);
        if($result){
          echo '<div class="alert alert-success">Issue Submitted!</div>';
          // header("Location:issueRecords.php");
        }
        else{
          echo '<div class="alert alert-danger">Some Issue Occurred!</div>';
        }
      }
    }
  }
  if(isset($_POST['record'])){
    header("Location:issueRecords.php");
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- css style -->
  <link rel="stylesheet" href="assets/bootstrap.min.css">
    <link href="style.css" rel="stylesheet">


</head>

<body style="background-color:#f9fbff">

  <!-- ======= Header ======= -->
  <header id="header" class="header d-flex align-items-center px-2 py-3 mb-4" style="background-color:#ffffff; box-shadow: 0 0 5px 0 rgba(0, 0, 0, 0.25);">

    <div class="d-flex align-items-center justify-content-between" style="color:#012970">
       <span class="d-none d-lg-block fs-2 fw-bold ">Imperative Pulse</span>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
          <div class="nav-link nav-profile d-flex align-items-center pe-0">
            <img src="img/user.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block ps-2 fw-medium" style="color:#4154f1"><?php echo $_SESSION['executive_id']; ?></span>
          </div><!-- End Profile Iamge Icon -->
    </nav>

    <!-- logout -->
    <button type="button" name="logout" class="btn btn-danger text-white ms-5">
      <a href="executive_logout.php" style="text-decoration:none; color:white">Logout</a>
    </button>
  </header><!-- End Header -->

  <main id="main" class="main">
    
    <section class="section d-flex flex-column align-items-center">
      <div class="w-50">
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

                  <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Desk Number</label>
                    <div class="col-sm-10">
                      <input type="text" name="deskNum" class="form-control" required>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="issueKind">Issue Type</label>
                    <div class="col-sm-10">
                      <select class="form-select" name="issueKind" id="issueKind" required>

                        <option value="Hardware">Hardware</option>
                        <option value="Software">Software</option>
                        <option value="Network">Netowork</option>
                        <option value="Other">Other</option>

                      </select>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" name="description" style="height: 100px" required></textarea>
                    </div>
                  </div>

                  <div class="row mb-3">
                  <label for="inputDate" class="col-sm-2 col-form-label">Date</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" name="date" required>
                  </div>
                </div>

                  <fieldset class="row mb-3">
                    <legend class="col-form-label col-sm-2 pt-0">Issue Status</legend>
                    <div class="col-sm-10">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="0" checked>
                        <label class="form-check-label" for="gridRadios2">
                        Unresolved
                        </label>
                      </div>
                    </div>
                  </fieldset>

                    </div>
                  </div>

                  <div class="row mb-3">

                    <div class=" mt-4" style="">
                      <button type="submit" name="issue" class="btn btn-primary">Submit Form</button>
                    </div>
                  </div>
          </form>
          <form action="" method="POST">
          <button  name="record" class="btn btn-primary">My Records</button>
          </form>
      </div>
    </section>

  </main><!-- End #main -->
<!-- JavaScript Libraries -->
<script src="assets/jquery-3.4.1.min.js"></script>
    <script src="assets/bootstrap.bundle.min.js"></script>
    <script src="assets/kit.js"></script>

    
</body>

</html>