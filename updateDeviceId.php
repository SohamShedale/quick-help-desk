<?php
include 'config.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  die('Invalid request');
}

$deviceId = $_POST['deviceId'];
// $changeId = $_POST['changeId'];
$monitorId = $_POST['monitorId'];
$cpuId = $_POST['cpuId'];
$keyboardId = $_POST['keyboardId'];
$mouseId = $_POST['mouseId'];

if(strpos($deviceId,'L')===0){
  $updateQuery = "UPDATE device_details SET monitor_sr_num = '$monitorId',cpu_sr_num = '$cpuId',keyboard_sr_num = '$keyboardId',mouse_sr_num = '$mouseId' WHERE device_id = '$deviceId'";
  mysqli_query($conn, $updateQuery);
}

if((strpos($deviceId,'BO')===0) || (strpos($deviceId,'QC')===0)){
  $updateQuery = "UPDATE cabin_details SET monitor_sr_num = '$monitorId',cpu_sr_num = '$cpuId',keyboard_sr_num = '$keyboardId',mouse_sr_num = '$mouseId' WHERE device_id = '$deviceId'";
  mysqli_query($conn, $updateQuery);
}


  // mysqli_query($conn, $updateQuery);

if (mysqli_error($conn)) {
    die(mysqli_error($conn));
}
  
  echo 'Success';
  
  mysqli_close($conn);

?>