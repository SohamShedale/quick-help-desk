<?php
include 'config.php';
    if(isset($_POST['deviceId'])){
        $deviceid = $_POST["deviceId"];
        

        if(strpos($deviceid,'L')===0){
            $sql="SELECT * FROM device_details WHERE device_id='$deviceid'";
        }

        if((strpos($deviceid,'B')===0) || (strpos($deviceid,'Q')===0)){
            $sql="SELECT * FROM cabin_details WHERE device_id='$deviceid'";
        }
        
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result)>0){
            $row=mysqli_fetch_row($result);
            echo json_encode($row);     
        }
        
    }
    if (mysqli_error($conn)) {
        die(mysqli_error($conn));
    }
?>