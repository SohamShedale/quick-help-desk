<?php
  session_start();
  if(!isset($_SESSION["executive_id"])){
          header("Location: executive_signin.php");
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

    ,<link rel="stylesheet" href="./assets/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body style="background-color:#f9fbff" onload="fetchRecords()">

  <!-- ======= Header ======= -->
  <header id="header" class="header d-flex align-items-center px-2 py-3 mb-4" style="background-color:#ffffff; box-shadow: 0 0 5px 0 rgba(0, 0, 0, 0.25);">

    <div class="d-flex align-items-center justify-content-between" style="color:#012970">
       <span class="d-none d-lg-block fs-2 fw-bold ">Imperative Pulse</span>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
          <div class="nav-link nav-profile d-flex align-items-center pe-0">
            <img src="img/user.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block ps-2 fw-medium" style="color:#4154f1"><?php  echo $_SESSION['executive_id']; ?></span>
          </div><!-- End Profile Iamge Icon -->
    </nav>

    <!-- logout -->
    <button type="button" name="logout" class="btn btn-danger text-white ms-5">
      <a href="executive_logout.php" style="text-decoration:none; color:white">Logout</a>
    </button>
    
  </header><!-- End Header -->

  <?php
    include 'config.php';
        $id = $_SESSION['executive_id'];
        $records = [];
        $status;
        $query = "SELECT * FROM ticket WHERE executive_id = '$id'";
        $result = mysqli_query($conn,$query);
        if(mysqli_num_rows($result)>0){
            for($i=1; $i<=mysqli_num_rows($result); $i++){
                array_push($records,mysqli_fetch_row($result));
            }
        }
    
        if(isset($_POST['resolve'])){
            $checkQuery = "SELECT * FROM ticket WHERE executive_id = '$id'";
            $check = mysqli_query($conn,$checkQuery);
            if(mysqli_num_rows($check)>0){
                for($i=0; $i<mysqli_num_rows($check); $i++){
                    $status = mysqli_fetch_row($check);
                }
            }
            if($status[5]=='0'){
                $updateQuery = "UPDATE ticket SET issue_status = '1' WHERE executive_id = '$id'";
                mysqli_query($conn,$updateQuery);
                // echo '<div class="alert alert-success">Issue Resolved</div>';
                header("Refresh:0");
            }
            if($status[5]=='1'){
                echo '<div class="alert alert-danger">All Issues are already resolved.</div>';
            }
            
        }
        if(isset($_POST['issue'])){
            header("Location:executive.php");
          }
  ?>

  <div class="m-4">
  <center><h3>Issue Records</h3></center>
  
  <!-- issue records -->
  <table class="table table-success table-striped">
      <thead>
          <tr>
              <th scope="col">Ticket ID</th>
              <th scope="col">Executive ID</th>
              <th scope="col">DeviceID</th>
              <th scope="col">Issue Type</th>
              <th scope="col">Issue Description</th>
              <th scope="col">Issue Status</th>
          </tr>
      </thead>
      <tbody>
          
          <?php
          foreach($records as $record){
            echo "<tr>";
            echo "<th scope=\"row\">"; echo $record[0]; echo"</th>";
            echo "<td>"; echo $record[1]; echo"</td>";
            echo "<td>"; echo $record[2]; echo"</td>";
            echo "<td>"; echo $record[3]; echo"</td>";
            echo "<td>"; echo $record[4]; echo"</td>";
            echo "<td>"; 
                if($record[5]=='0'){echo "Unresolved";} 
                if($record[5]=='1'){echo "Resolved";}
            echo"</td>";
            echo "</tr>";
          }
          ?>
      </tbody>
  </table>

  </div>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <center><button type="submit" name="resolve" class="btn btn-primary">Resolve Issue</button></center>
    </form>

    <form action="" method="POST" class="d-flex justify-content-center mt-3">
          <button  name="issue" class="btn btn-primary">Raise Issue</button>
    </form>
  
</body>
</html>