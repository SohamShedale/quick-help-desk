<?php
if(isset($_POST['deviceId'])){
  include('config.php');
  $row;
  $deviceid = $_POST['deviceId'];
  $sql="SELECT * FROM ticket WHERE desk_num='$deviceid'";
  
  $result=mysqli_query($conn,$sql);
  // print_r($result);
  if(mysqli_num_rows($result)>0){
    for($i=0; $i<mysqli_num_rows($result); $i++){
      $row = mysqli_fetch_row($result);
    }  
  }
  if($row[5]==0){
    $colorRed='#F61216';
    echo json_encode($colorRed);
  }
}
if (mysqli_error($conn)) {
  die(mysqli_error($conn));
}

?>