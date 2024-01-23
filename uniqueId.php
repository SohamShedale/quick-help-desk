<?php

  include 'config.php';
  if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('Invalid request');
  }
  $deviceId = $_POST["deviceId"]; 
  $monitorId = $_POST['monitorId'];
  $cpuId = $_POST['cpuId'];
  $keyboardId = $_POST['keyboardId'];
  $mouseId = $_POST['mouseId'];


  if(strpos($deviceId,'L')===0){
    $checkQuery1 = "SELECT monitor_sr_num FROM device_details WHERE monitor_sr_num = '$monitorId' EXCEPT SELECT monitor_sr_num FROM device_details WHERE device_id = '$deviceId'";
    $checkQuery2 = "SELECT cpu_sr_num FROM device_details WHERE cpu_sr_num = '$cpuId' EXCEPT SELECT cpu_sr_num FROM device_details WHERE device_id = '$deviceId'";
    $checkQuery3 = "SELECT keyboard_sr_num FROM device_details WHERE keyboard_sr_num = '$keyboardId' EXCEPT SELECT keyboard_sr_num FROM device_details WHERE device_id = '$deviceId'";
    $checkQuery4 = "SELECT mouse_sr_num FROM device_details WHERE mouse_sr_num = '$mouseId' EXCEPT SELECT mouse_sr_num FROM device_details WHERE device_id = '$deviceId'";
  }

  if((strpos($deviceId,'BO')===0) || (strpos($deviceId,'QC')===0)){
    $checkQuery1 = "SELECT monitor_sr_num FROM cabin_details WHERE monitor_sr_num = '$monitorId' EXCEPT SELECT monitor_sr_num FROM cabin_details WHERE device_id = '$deviceId'";
    $checkQuery2 = "SELECT cpu_sr_num FROM cabin_details WHERE cpu_sr_num = '$cpuId' EXCEPT SELECT cpu_sr_num FROM cabin_details WHERE device_id = '$deviceId'";
    $checkQuery3 = "SELECT keyboard_sr_num FROM cabin_details WHERE keyboard_sr_num = '$keyboardId' EXCEPT SELECT keyboard_sr_num FROM cabin_details WHERE device_id = '$deviceId'";
    $checkQuery4 = "SELECT mouse_sr_num FROM cabin_details WHERE mouse_sr_num = '$mouseId' EXCEPT SELECT mouse_sr_num FROM cabin_details WHERE device_id = '$deviceId'";
  }

  // $checkQuery = "SELECT device_id FROM devices WHERE device_uniqueId = '$changeId'";


  $result1 = mysqli_query($conn, $checkQuery1);

  $result2 = mysqli_query($conn, $checkQuery2);

  $result3 = mysqli_query($conn, $checkQuery3);

  $result4 = mysqli_query($conn, $checkQuery4);


  if ((mysqli_num_rows($result1) > 0) || (mysqli_num_rows($result2) > 0) || (mysqli_num_rows($result3) > 0) || (mysqli_num_rows($result4) > 0)) {
    echo json_encode(false);
  }
  else {
    echo json_encode(true);
  }

  // mysqli_close($conn);

  if (mysqli_error($conn)) {
    die(mysqli_error($conn));
  }
?>