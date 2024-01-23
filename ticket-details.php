<?php
if(isset($_POST['deviceId'])){
  include('config.php');
  $deviceid = $_POST['deviceId'];
  $sql="SELECT * FROM ticket WHERE (desk_num='$deviceid') AND (issue_status = 0)";
  
  $result=mysqli_query($conn,$sql);
  if(mysqli_num_rows($result)>0){
      $row=mysqli_fetch_row($result);   
      echo json_encode($row);
    }
}
if (mysqli_error($conn)) {
  die(mysqli_error($conn));
}

?>